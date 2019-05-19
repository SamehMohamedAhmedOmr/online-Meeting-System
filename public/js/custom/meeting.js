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

});
