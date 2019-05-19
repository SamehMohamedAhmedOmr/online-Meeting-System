$(function () {
    // when docs ready call data table
    var targetURL = 'getRankAjax';
    $('#Ranks').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: targetURL,
            type: "GET",
        },
        columns: [{
                data: 'rank_name',
                render: function (rank_name) {
                    return rank_name;
                }
            },
            {
                data: 'id',
                orderable: false,
                render: function (data) {
                    edit = '<a href="rank/' + data + '/edit" class="btn btn-sm btn-info text-white ml-2"><i class="fas fa-marker"></i> </a>';
                    remove = '<a  class="btn btn-sm btn-danger text-white" data-toggle="modal" data-target="#deleteModal" onclick="openModal(' + data + ')" > <i class="far fa-trash-alt"></i> </a>';
                    return edit + '&nbsp;' + remove;
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
    var targetURL = 'rank/' + id;

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
                $('#Ranks').DataTable().ajax.reload(null, false);
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
