$(function() {
    'use strict';

    $('.specialSelect').selectize();

    $('#timepicker').timepicker({
        defaultTime:'00:00 AM'
    });

    $('#timepicker').on('click',function(){
        $('.bootstrap-timepicker-widget tr td a span').addClass('mdi');
        $('.bootstrap-timepicker-widget tr:first-of-type td a span').addClass('mdi-chevron-up');
        $('.bootstrap-timepicker-widget tr:last-of-type td a span').addClass('mdi-chevron-down');

    });


    $('.specialSelect').on('change',function(){
        var councilID = $('.specialSelect option').attr('value');

        if(councilID != null){
            var targetURL = '/suggetMeetingNumber';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: targetURL,
                type: "post",
                data: {
                    "id": councilID,
                },
                success: function (response) {
                    $('#meeting_number').val(response)
                },
                error: function (err) {
                    console.log(err);
                }
            });
        }
    });

});
