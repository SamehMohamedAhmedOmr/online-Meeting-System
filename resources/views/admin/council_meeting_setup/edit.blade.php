@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ URL::asset('css/selectize.bootstrap3.css') }}">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css" />
@endsection

@section('pageTitle')
    {{__("home.Meeting")}} | {{ __('pageTitle.Edit Meeting') }}
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-header top-card">{{ __('Staff.Edit Meeting Number') }}
                        <span class="name">{{ $council_meeting_setup->meeting_number }}</span>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a class='back-button' href="{{ url('meeting') }}" title="{{__("home.Back")}}">
                                <button class="btn btn-warning btn-sm" >
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i> {{__("home.Back")}}
                                </button>
                            </a>
                        </div>

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('meeting/' . $council_meeting_setup->id) }}"
                            accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.council_meeting_setup.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script type="text/javascript" src="{{ URL::asset('js/selectize.min.js') }}"></script>
    <script type="text/javascript">
        $('.specialSelect').selectize();
    </script>

    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    @if (App::getLocale() == 'ar')
        <script type="text/javascript" src="{{ URL::asset('js/JQ-UL-ar.js') }}"></script>
        <script type="text/javascript">
            $(function() {
                $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' },$.datepicker.regional[ "ar" ]);
                $("#datepicker, .ui-corner-all").on('click',function(){
                    $('.ui-icon-circle-triangle-w').text('');
                    $('.ui-icon-circle-triangle-e').text('');
                })
            });
        </script>
    @else
        <script type="text/javascript">
            $(function() {
                $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
            });
        </script>
    @endif

    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js">
    </script>

    <script type="text/javascript">
        $(function(){
            $('#timepicker').timepicker({
                defaultTime:'00:00 AM'
            });

            $('#timepicker').on('click',function(){
                $('.bootstrap-timepicker-widget tr td a span').addClass('mdi');
                $('.bootstrap-timepicker-widget tr:first-of-type td a span').addClass('mdi-chevron-up');
                $('.bootstrap-timepicker-widget tr:last-of-type td a span').addClass('mdi-chevron-down');

            });
        })
    </script>
@endsection
