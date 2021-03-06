$(function () {
    // when docs ready call data table
    var targetURL = 'getCouncielMeetingAjax';
    var type = $('#scriptMeeting').data('type');

    var lang = $('#scriptMeeting').data('lang');
    if(lang == 'ar'){
        var arabicLanguage = {
            "sProcessing": "جارٍ التحميل...",
            "sLengthMenu": "أظهر _MENU_ مدخلات",
            "sZeroRecords": "لم يعثر على أية سجلات",
            "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
            "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
            "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
            "sInfoPostFix": "",
            "sSearch": "ابحث:",
            "sUrl": "",
            "oPaginate": {
            "sFirst": "الأول",
            "sPrevious": "السابق",
            "sNext": "التالي",
            "sLast": "الأخير"
            }
        };
    }
    else{
        var arabicLanguage = {};
    }

    $('#get-data').DataTable({
        "language": arabicLanguage,
        processing: true,
        serverSide: true,
        ajax: {
            url: targetURL,
            type: "GET",
        },
        columns: [
            {
                data:'meeting_number',
                orderable: false,
            },
            {
                data: 'definition',
                render: function (definition) {
                    return definition;
                }
            },
            {
                data: 'meeting_date',
                orderable: false,
                render: function (meeting_date) {
                    return meeting_date;
                }
            },
            {
                data: 'meeting_time',
                orderable: false,
                render: function (meeting_time) {
                    return meeting_time;
                }
            },
            {
                data: 'numberOfSubjects',
                render: function (numberOfSubjects) {
                    return numberOfSubjects;
                }
            },
            {
                data: 'mergeColumn',
                orderable: false,
                render: function (data) {
                    var arr = data.split('-');
                    // arr[0] = id
                    // arr[1] = close
                    if(lang == 'ar'){
                        unlock = '<a data-toggle="modal" title="مفتوح" data-target="#closeMeetingModal" onclick="CloseMeetingModal(' + arr[0] + ')" class="btn btn-sm text-white ml-2" style="background-color:#57c7d4;"><i class="fas fa-lock-open"></i> </a>';
                        lock = '<a data-toggle="modal" data-target="#openMeetingModal" onclick="CloseMeetingModal(' + arr[0] + ')" class="btn btn-sm text-white ml-2" style="background-color:#f96868;" title="مغلق"><i class="fas fa-lock"></i> </a>';

                        unlockFoCustomer = '<a class="btn btn-sm text-white ml-2" title="مفتوح" style="background-color:#57c7d4; cursor: initial;"><i class="fas fa-lock-open"></i> </a>';
                        lockForCustomer = '<a class="btn btn-sm text-white ml-2" style="background-color:#f96868; cursor: initial;" title="مغلق"><i class="fas fa-lock"></i> </a>';

                    }
                    else{
                        unlock = '<a data-toggle="modal" title="open" data-target="#closeMeetingModal" onclick="CloseMeetingModal(' + arr[0] + ')" class="btn btn-sm text-white ml-2" style="background-color:#57c7d4;"><i class="fas fa-lock-open"></i> </a>';
                        lock = '<a data-toggle="modal" data-target="#openMeetingModal" onclick="CloseMeetingModal(' + arr[0] + ')" class="btn btn-sm text-white ml-2" style="background-color:#f96868;" title="close"><i class="fas fa-lock"></i> </a>';

                        unlockFoCustomer = '<a class="btn btn-sm text-white ml-2" title="open" style="background-color:#57c7d4; cursor: initial;"><i class="fas fa-lock-open"></i> </a>';
                        lockForCustomer = '<a class="btn btn-sm text-white ml-2" style="background-color:#f96868; cursor: initial;" title="close"><i class="fas fa-lock"></i> </a>';
                    }

                    if(type == 1){ // staff Only
                        if(arr[1] == 0){ // to be locked
                            return unlock;
                        }
                        else if(arr[1] == 1){
                            return lock;
                        }
                    }
                    else{
                        if(arr[1] == 0){ // to view only
                            return unlockFoCustomer;
                        }
                        else if(arr[1] == 1){
                            return lockForCustomer;
                        }
                    }
                }
            },
            {
                data: 'mergeColumn',
                orderable: false,
                render: function (data) {
                    var arr = data.split('-');
                    // arr[0] = id
                    // arr[1] = close
                    view = '<a href="meeting/' + arr[0] + '" class="btn btn-sm btn-success text-white ml-2"><i class="fas fa-eye"></i> </a>';
                    Onlyview = '<a href="meeting/' + arr[0] + '" class="btn btn-sm btn-success text-white mr-1"><i class="fas fa-eye"></i> </a>';

                    edit = '<a href="meeting/' + arr[0] + '/edit" class="btn btn-sm btn-info text-white ml-2"><i class="fas fa-marker"></i> </a>';
                    remove = '<a  class="btn btn-sm btn-danger text-white" data-toggle="modal" data-target="#deleteModal" onclick="openModal(' + arr[0] + ')" > <i class="far fa-trash-alt"></i> </a>';
                    if(type == 1){ // staff Only
                        if(arr[1] == 1){
                            return Onlyview;
                        }
                        else if(arr[1] == 0){
                            return view + '&nbsp;' + edit + '&nbsp;' + remove;
                        }
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

function DeleteItem() {
    var id = $('#RemoveItem').val();
    // ajax delete data to database
    var targetURL = 'meeting/' + id;

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

// open modal to delete item
function CloseMeetingModal(id) {
    $('#closeModal').val(id);
}

function CloseMeeting() {
    var id = $('#closeModal').val();
    // ajax delete data to database
    var targetURL = 'closeMeeting/' + id;

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: targetURL,
        type: "POST",
        data: {
            "id": id,
        },
        success: function (response) {
            if (response == 1) {
                $('#SuccessClose').fadeIn(200);
                $('#get-data').DataTable().ajax.reload(null, false);
                setTimeout(function () {
                    $('#SuccessClose').fadeOut('fast');
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

function openMeeting() {
    var id = $('#closeModal').val();
    // ajax delete data to database
    var targetURL = 'openMeeting/' + id;

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: targetURL,
        type: "POST",
        data: {
            "id": id,
        },
        success: function (response) {
            if (response == 1) {
                $('#SuccessOpen').fadeIn(200);
                $('#get-data').DataTable().ajax.reload(null, false);
                setTimeout(function () {
                    $('#SuccessOpen').fadeOut('fast');
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
