$(function () {
    // when docs ready call data table
    var type = $('#scriptDefinition').data('type');

    var targetURL = 'getCouncielDefinitionAjax';
    $('#get-data').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: targetURL,
            type: "get",
        },
        columns: [{
                data: 'council_name',
                render: function (council_name) {
                    return council_name;
                }
            },
            {
                data: 'faculty',
                render: function (faculty) {
                    return faculty;
                }
            },
            {
                data: 'number_of_members',
                render: function (number_of_members) {
                    return number_of_members;
                }
            },
            {
                data: 'numberOfMeeting',
                render: function (numberOfMeeting) {
                    return numberOfMeeting;
                }
            },
            {
                data: 'id',
                orderable: false,
                render: function (data) {
                    view = '<a href="councilDefinition/' + data + '" class="btn btn-sm btn-success text-white ml-2"><i class="fas fa-eye"></i> </a>';
                    edit = '<a href="councilDefinition/' + data + '/edit" class="btn btn-sm btn-info text-white ml-2"><i class="fas fa-marker"></i> </a>';
                    remove = '<a  class="btn btn-sm btn-danger text-white" data-toggle="modal" data-target="#deleteModal" onclick="openModal(' + data + ')" > <i class="far fa-trash-alt"></i> </a>';
                    if(type == 0){
                        return view + '&nbsp;' + edit + '&nbsp;' + remove;
                    }
                    else{
                        return view;
                    }
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
    var targetURL = 'councilDefinition/' + id;

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
                $('#get-data').DataTable().ajax.reload(null, false);
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
