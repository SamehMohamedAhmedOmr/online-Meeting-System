@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ URL::asset('css/selectize.bootstrap3.css') }}">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css" />
@endsection

@section('pageTitle')
    {{__("home.Meeting")}} | {{__("Staff.Add New Meeting")}}
@endsection


@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-header top-card">{{__("Staff.Add New Meeting")}}</div>
                    <div class="card-body">
                        <div class="p-3">
                            <a class='back-button' href="{{ url('meeting') }}" title="{{__("home.Back")}}">
                                <button class="btn btn-warning btn-sm">
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

                        <form method="POST" action="{{ url('meeting') }}" accept-charset="UTF-8"
                            class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.council_meeting_setup.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ URL::asset('js/selectize.min.js') }}"></script>

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

<script type="text/javascript" src="{{ URL::asset('js/custom/meeting.js') }}"></script>

@endsection
