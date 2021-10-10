$(function () {

    $('#save').click(function () {
        //alert('Hello');
        url = './save.workspace.php';
        data = {
            'save': 'save',
            'graph': JSON.stringify(graph.toJSON())
        };
        $.ajax(
            {
                url: url,
                method: "post",
                data: data,
                success: function (data, status) {
                    alert(data)
                },
                error: function (err) {
                    alert(err)
                }
            }
        )
    });
})