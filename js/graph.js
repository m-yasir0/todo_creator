var graph, paper;
(function () {
  graph = new joint.dia.Graph();
  paper = new joint.dia.Paper({
    el: $("#paper-html-elements"),
    width: 1000,
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
      '<button class="delete">x</button>',
      "<span hidden class='hidden notes' aria-lable='notes'></span>",
      "<span hidden class='hidden id' aria-lable='id'></span>",
      "<span hidden class='hidden description' aria-lable='description'></span>",
      "<span hidden class='hidden url' aria-lable='url'></span>",
      "<span hidden class='hidden last_changed' aria-lable='last_changed'></span>",
      "<span class= 'status' aria-lable='status'></span>",
      "<div class='image'></div>",
      "<label></label>",
      "<br/>",
      "</div>",
    ].join(""),

    initialize: function () {
      _.bindAll(this, "updateBox");
      joint.dia.ElementView.prototype.initialize.apply(this, arguments);

      this.$box = $(_.template(this.template)());

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
      this.$box.find(".status").text(this.model.get("status"));
      this.$box.find(".notes").text(this.model.get("notes"));
      this.$box.find(".image").html(this.model.get("image_src"));
      this.$box.find(".url").html(this.model.get("url"));
      this.$box.find(".description").html(this.model.get("description"));
      this.$box.find(".id").html(this.model.get("id"));
      this.$box.find(".last_changed").html(this.model.get("last_changed"));
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

  // enable interactions
  bindInteractionEvents(adjustVertices, graph, paper);

  paper.hideTools();
  // enable tools
  bindToolEvents(paper);
}());

// Create Elements
function createElem(image, label, status = 'up', x, y, id) {
  var el1 = new joint.shapes.html.Element({
    id: id,
    position: { x: x, y: y },
    size: { width: 130, height: 75 },
    label: label,
    status: status,
    image_src: image,
    description: '',
    url: '',
    notes: '',
    last_changed: new Date().toUTCString()
  });
  graph.addCells([el1]);
  console.log(el1)
  return el1;
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
  return link;
}

// Add tools
function addTools(paper, link) {

  var toolsView = new joint.dia.ToolsView({
    tools: [
      new joint.linkTools.Remove(),
      new joint.linkTools.SourceArrowhead(),
      new joint.linkTools.TargetArrowhead(),
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
function createGraphFromJson(graph) {
  let json_graph = graph;
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