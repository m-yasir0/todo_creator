$(function () {
    $('#option1').click(function () {
        $('#create_user').css('display', 'block');
        $('#user_table').css('display', 'none');
    });
    $('#option2').click(function () {
        $('#create_user').css('display', 'none');
        $('#user_table').css('display', 'block');
    })


})

const deleteUser = function (user) {
    let choice = confirm('Are You sure you want to delete User ' + user + '?');
    if (choice) {
        url = './deleteUsers.php';
        data = {
            'delete': 'delete',
            'email': user
        };
        $.ajax(
            {
                url: url,
                method: "post",
                data: data,
                success: function (data, status) {
                    var div = document.getElementById('message');
                    div.innerHTML = data;
                    div.style.display = 'block';
                    setTimeout(() => {
                        div.style.display = 'none'
                    }, 4000);

                    $.post('./allUsers.php', function (data) {
                        $('#dataTable tbody').html(data);
                    })
                }
            }
        )
    }
}