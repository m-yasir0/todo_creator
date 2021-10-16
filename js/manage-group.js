var openGroup = function (group) {
    var li = $(group).parent();
    const group_id = $(li).text();
    url = './getGroup.php';
    data = {
        'group': group_id
    };
    $.ajax(
        {
            url: url,
            method: "post",
            data: data,
            success: function (data, status) {
                data = JSON.parse(data);
                if (data.statusCode == 200) {
                    graph.clear();
                    $('#list-groups').children('.active').removeClass('active');
                    $(li).addClass('active');
                    let req_graph = data.body.graph;
                    createGraphFromJson(req_graph);
                    $('#create-elem, #update-group, #delete-group').removeAttr('disabled');
                } else {
                    alert('Cannot Open requested graph');
                }
            }
        }
    )
}