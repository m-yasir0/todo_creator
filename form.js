var graph, paper;
(function () {
  graph = new joint.dia.Graph();
  new joint.dia.Paper({
    el: $("#paper-html-elements"),
    width: 650,
    height: 400,
    gridSize: 1,
    model: graph,
  });

  // Create a custom element.
  // ------------------------

  joint.shapes.html = {};
  joint.shapes.html.Element = joint.shapes.basic.Rect.extend({
    defaults: joint.util.deepSupplement(
      {
        type: "html.Element",
        attrs: {
          rect: { stroke: "none", "fill-opacity": 0 },
        },
      },
      joint.shapes.basic.Rect.prototype.defaults
    ),
  });

  // Create a custom view for that element that displays an HTML div above it.
  // -------------------------------------------------------------------------

  joint.shapes.html.ElementView = joint.dia.ElementView.extend({
    template: [
      '<div class="html-element">',
      "<span hidden class='hidden'></span>",
      "<div class='image'></div>",
      "<label></label>",
      "<span></span>",
      "<div></div>",
      "<br/>",
      "</div>",
    ].join(""),

    initialize: function () {
      _.bindAll(this, "updateBox");
      joint.dia.ElementView.prototype.initialize.apply(this, arguments);

      this.$box = $(_.template(this.template)());

      this.$box.find("select").val(this.model.get("select"));
      this.$box
        .find(".delete")
        .on("click", _.bind(this.model.remove, this.model));
      // Update the box position whenever the underlying model changes.
      this.model.on("change", this.updateBox, this);
      // Remove the box when the model gets removed from the graph.
      this.model.on("remove", this.removeBox, this);

      this.updateBox();
    },
    render: function () {
      joint.dia.ElementView.prototype.render.apply(this, arguments);
      this.paper.$el.prepend(this.$box);
      this.updateBox();
      return this;
    },
    updateBox: function () {
      // Set the position and dimension of the box so that it covers the JointJS element.
      var bbox = this.model.getBBox();
      // Example of updating the HTML with a data stored in the cell model.
      this.$box.find("label").text(this.model.get("label"));
      this.$box.find("span").text(this.model.get("select"));
      this.$box.find(".image").html(this.model.get("image_src"));
      this.$box.find(".hidden").html(this.model.get("id"));
      this.$box.css({
        width: bbox.width,
        height: bbox.height,
        left: bbox.x,
        top: bbox.y,
        transform: "rotate(" + (this.model.get("angle") || 0) + "deg)",
      });
    },
    removeBox: function (evt) {
      this.$box.remove();
    },
  });
})();

(function multipleLinks() {

  function adjustVertices(graph, cell) {
    cell = cell.model || cell;

    if (cell instanceof joint.dia.Element) {

      _.chain(graph.getConnectedLinks(cell))
        .groupBy(function (link) {
          return _.omit([link.source().id, link.target().id], cell.id)[0];
        })
        .each(function (group, key) {
          if (key !== 'undefined') adjustVertices(graph, _.first(group));
        })
        .value();

      return;
    }

    var sourceId = cell.get('source').id || cell.previous('source').id;
    var targetId = cell.get('target').id || cell.previous('target').id;

    if (!sourceId || !targetId) {
      // no vertices needed
      cell.unset('vertices');
      return;
    }

    // identify link siblings
    var siblings = graph.getLinks().filter(function (sibling) {

      var siblingSourceId = sibling.source().id;
      var siblingTargetId = sibling.target().id;

      // if source and target are the same
      // or if source and target are reversed
      return ((siblingSourceId === sourceId) && (siblingTargetId === targetId))
        || ((siblingSourceId === targetId) && (siblingTargetId === sourceId));
    });

    var numSiblings = siblings.length;
    switch (numSiblings) {

      case 0: {
        // the link has no siblings
        break;
      }
      default: {

        if (numSiblings === 1) {
          // there is only one link
          // no vertices needed
          cell.unset('vertices');
        }

        // there are multiple siblings
        // we need to create vertices

        // find the middle point of the link
        var sourceCenter = graph.getCell(sourceId).getBBox().center();
        var targetCenter = graph.getCell(targetId).getBBox().center();
        var midPoint = g.Line(sourceCenter, targetCenter).midpoint();

        // find the angle of the link
        var theta = sourceCenter.theta(targetCenter);

        // constant
        // the maximum distance between two sibling links
        var GAP = 20;

        _.each(siblings, function (sibling, index) {

          // we want offset values to be calculated as 0, 20, 20, 40, 40, 60, 60 ...
          var offset = GAP * Math.ceil(index / 2);

          var sign = ((index % 2) ? 1 : -1);

          // to assure symmetry, if there is an even number of siblings
          // shift all vertices leftward perpendicularly away from the centerline
          if ((numSiblings % 2) === 0) {
            offset -= ((GAP / 2) * sign);
          }

          // make reverse links count the same as non-reverse
          var reverse = ((theta < 180) ? 1 : -1);

          // we found the vertex
          var angle = g.toRad(theta + (sign * reverse * 90));
          var vertex = g.Point.fromPolar(offset, angle, midPoint).toJSON();

          // replace vertices array with `vertex`
          sibling.vertices([vertex]);
        });
      }
    }
  }

  // create paper
  paper = new joint.dia.Paper({
    el: document.getElementById('paper-html-elements'),
    model: graph,
    width: 600,
    height: 400,
    gridSize: 1,
    // disable built-in link dragging
    interactive: {
      linkMove: false
    }
  });

  // enable interactions
  bindInteractionEvents(adjustVertices, graph, paper);

  paper.hideTools();
  // enable tools
  bindToolEvents(paper);
}());

// Create Elements
function createElem(image, label, span, x, y, id) {
  var el1 = new joint.shapes.html.Element({
    id: id,
    position: { x: x, y: y },
    size: { width: 100, height: 50 },
    label: label,
    select: span,
    image_src: image
  });
  graph.addCells([el1]);
  console.log(el1)
  return el1;
}

// Serialize Graph
function serializeGraph() {
  console.log(graph.toJSON())
  alert(graph.toJSON())
}

// Create link Elem
function createLink(source, target, id) {
  var link = new joint.shapes.standard.Link();
  link.connector('smooth');
  link.attr({
    line: {
      strokeWidth: 3,
      stroke: '#222222'
    }
  });
  link.source(source);
  link.target(target);
  link.addTo(graph);
  addTools(paper, link);
  console.log(link)
  return link;
}

// Add tools
function addTools(paper, link) {

  var toolsView = new joint.dia.ToolsView({
    tools: [
      new joint.linkTools.SourceArrowhead(),
      new joint.linkTools.TargetArrowhead()
    ]
  });
  link.findView(paper).addTools(toolsView);
}

// Bind tools
function bindToolEvents(paper) {

  // show link tools
  paper.on('link:mouseover', function (linkView) {
    linkView.showTools();
  });

  // hide link tools
  paper.on('link:mouseout', function (linkView) {
    linkView.hideTools();
  });
  paper.on('blank:mouseover cell:mouseover', function () {
    paper.hideTools();
  });
}

// Bind Interaction Events
function bindInteractionEvents(adjustVertices, graph, paper) {

  // bind `graph` to the `adjustVertices` function
  var adjustGraphVertices = _.partial(adjustVertices, graph);

  // adjust vertices when a cell is removed or its source/target was changed
  graph.on('add remove change:source change:target', adjustGraphVertices);

  // adjust vertices when the user stops interacting with an element
  paper.on('cell:pointerup', adjustGraphVertices);
}

// create graph from JSON
function createGraphFromJson() {
  let json_graph = { "cells": [{ "type": "html.Element", "position": { "x": 349, "y": 228 }, "size": { "width": 100, "height": 50 }, "angle": 0, "id": "423a13d8-c431-4b20-95eb-58e5374232dd", "label": "label", "select": "box", "image_src": "<div><img src ='./icon.png'/></div>", "z": 1, "attrs": {} }, { "type": "html.Element", "position": { "x": 303, "y": 44 }, "size": { "width": 100, "height": 50 }, "angle": 0, "id": "846e7b27-8ebb-4a59-944a-74985301d86b", "label": "label", "select": "box", "image_src": "<div><img src ='./icon.png'/></div>", "z": 2, "attrs": {} }, { "type": "html.Element", "position": { "x": 97, "y": 154 }, "size": { "width": 100, "height": 50 }, "angle": 0, "id": "044e9e4b-a1d4-40f4-9db5-f444e9f2845d", "label": "label", "select": "box", "image_src": "<div><img src ='./icon.png'/></div>", "z": 3, "attrs": {} }, { "type": "standard.Link", "source": { "id": "044e9e4b-a1d4-40f4-9db5-f444e9f2845d" }, "target": { "id": "846e7b27-8ebb-4a59-944a-74985301d86b" }, "id": "e9acc243-d484-4428-9875-91a408818d81", "connector": { "name": "smooth" }, "z": 4, "vertices": [{ "x": 250, "y": 124 }], "attrs": { "line": { "stroke": "#222222", "strokeWidth": 3 } } }, { "type": "standard.Link", "source": { "id": "846e7b27-8ebb-4a59-944a-74985301d86b" }, "target": { "id": "423a13d8-c431-4b20-95eb-58e5374232dd" }, "id": "b68e78b7-90cf-40e1-a98f-b00b887c249a", "connector": { "name": "smooth" }, "z": 5, "vertices": [{ "x": 376, "y": 161 }], "attrs": { "line": { "stroke": "#222222", "strokeWidth": 3 } } }, { "type": "standard.Link", "source": { "id": "423a13d8-c431-4b20-95eb-58e5374232dd" }, "target": { "id": "044e9e4b-a1d4-40f4-9db5-f444e9f2845d" }, "id": "d7dce7c4-032f-4048-ba2e-784ddaa9fe2a", "connector": { "name": "smooth" }, "z": 6, "vertices": [{ "x": 273, "y": 216 }], "attrs": { "line": { "stroke": "#222222", "strokeWidth": 3 } } }] }
  let html_element = [], standard_links = [];
  let seperated = seperate(json_graph);
  //console.log(seperated)
  for (let elem of seperated.elements) {
    html_element.push(
      createElem(
        elem.image_src,
        elem.label,
        elem.select,
        elem.position.x,
        elem.position.y,
        elem.id
      )
    )
  };
  for (let i = 0; i < seperated.links.length; i++) {
    let target, source;
    for (let j = 0; j < html_element.length; j++) {
      console.log(html_element[j]);
      if (html_element[j].id == seperated.links[i].source.id)
        source = html_element[j];
      if (html_element[j].id == seperated.links[i].target.id)
        target = html_element[j];
    }
    standard_links.push(
      createLink(source, target, seperated.links[i].id)
    )
  }
}

// Seperate html elements and links
function seperate(json_graph) {
  let elems = [], links = [];
  for (let obj of json_graph.cells) {
    if (obj.type == 'html.Element')
      elems.push(obj);
    else if (obj.type == 'standard.Link')
      links.push(obj);
  }
  return {
    elements: elems,
    links: links
  }
}