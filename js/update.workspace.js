$(function () {
    $('#update-group').click(function () {
        //alert('Hello');
        group = $('#list-groups').children('.active').text();
        url = './update.workspace.php';
        data = {
            'save': 'save',
            'graph': JSON.stringify(graph.toJSON()),
            'group': group
        };
        $.ajax(
            {
                url: url,
                method: "post",
                data: data,
                success: function (data, status) {
                    alert(data)
                }
            }
        )
    });

    $('#delete-group').click(function () {
        //alert('Hello');
        group = $('#list-groups').children('.active').text();
        url = './update.workspace.php';
        let con = confirm('Are you sure you want to delete group: ' + group);
        if (con) {
            data = {
                'delete': 'delete',
                'group': group
            };
            $.ajax(
                {
                    url: url,
                    method: "post",
                    data: data,
                    success: function (data, status) {
                        updateGroups();
                        graph.clear();
                        $('#create-elem, #update-group, #delete-group').attr('disabled', true);
                        alert(data);
                    }
                }
            )
        }
    });

    $('#create-group').click(function () {
        url = './update.workspace.php';
        let group = prompt("Enter Group name: ");
        if (group == '') {
            alert('Empty value not allowed to create group');
        } else {
            data = {
                'create': 'create',
                'group': group
            };
            $.ajax(
                {
                    url: url,
                    method: "post",
                    data: data,
                    success: function (data) {
                        if (data == 'Group Already exists!') {
                            alert(data);
                        } else {
                            graph.clear();
                            if ($('#list-groups').children('div .alert-warning')) {
                                $('#list-groups').children('div').remove();
                            }
                            $('#list-groups').children('.active').removeClass('active');
                            $('#list-groups').append('<li class="list-group-item active"><button class="btn btn-block"  onclick= "openGroup(this)">' + group + '</button></li>');
                            alert(data);
                        }
                    }
                }
            )
        }
    });
})

function updateGroups() {
    let url = './getAllGroups.php'
    $.ajax(
        {
            url: url,
            method: "get",
            success: function (data) {
                $('#list-groups').html(data);
            }
        }
    )
}