$(function () {
    // when docs ready call data table
    var targetURL = 'getUsersAjax';
    $('#Users').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: targetURL,
            type: "GET",
        },
        columns: [{
                data: 'image',
                orderable: false,
                render: function (data) {
                    id = data.split('_');
                    renderImg = '<img class="faculty_logo" src="storage/user_pic/' + id[0] + '/' + data + '" >';
                    return renderImg;
                }
            },
            {
                data: 'name',
                render: function (name) {
                    if (name.length >= 30) {
                        return name.substring(0, 30) + '...';
                    }
                    return name;
                }
            },

            {
                data: 'email',
            },
            {
                data: 'Position',
                render: function (Position) {
                    return Position;
                }
            },
            {
                data: 'id',
                orderable: false,
                render: function (data) {
                    view = '<a href="users/' + data + '" class="btn btn-sm btn-success text-white ml-2"><i class="fas fa-eye"></i> </a>';
                    edit = '<a href="users/' + data + '/edit" class="btn btn-sm btn-info text-white ml-2"><i class="fas fa-marker"></i> </a>';
                    remove = '<a  class="btn btn-sm btn-danger text-white" data-toggle="modal" data-target="#deleteModal" onclick="openModal(' + data + ')" > <i class="far fa-trash-alt"></i> </a>';
                    return view + '&nbsp;' + edit + '&nbsp;' + remove;
                }
            },
        ]
    });

    $('.message').slideDown(function () {
        setTimeout(function () {
            $('.message').slideUp(function () {
                $(this).remove();
            });
        }, 8000);
    });

});


// open modal to delete item
function openModal(id) {
    $('#RemoveItem').val(id);
}
//  delete Gas Station
function DeleteItem() {
    var id = $('#RemoveItem').val();
    // ajax delete data to database
    var targetURL = 'users/' + id;

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: targetURL,
        type: "POST",
        data: {
            "id": id,
            '_method': 'DELETE'
        },
        success: function (response) {
            if (response == 1) {
                $('#SuccessDelete').fadeIn(200);
                $('#Users').DataTable().ajax.reload(null, false);
                setTimeout(function () {
                    $('#SuccessDelete').fadeOut('fast');
                }, 5000); // <-- time in milliseconds
            } else {
                alert('Drawing not deleted !!  try again later');
            }
        },
        error: function (err) {
            console.log(err);
        }
    });
}
