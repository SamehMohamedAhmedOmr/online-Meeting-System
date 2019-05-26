@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/selectize.bootstrap3.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/specialFileInput.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
@endsection

@section('pageTitle')
    {{ __('Staff.Meeting Number') }} {{ $meeting->meeting_number }} | {{ __('Staff.Edit Subject') }}
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-header top-card">{{ __('Staff.Edit Subject') }}</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a class='back-button' href="{{ url('meeting/'.$meeting->id.'') }}" title="{{__("home.Back")}}">
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

                        <form method="POST" action="{{ url('updateMeetingSubject') }}"
                            accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.council_meeting_subject.form', ['formMode' => 'edit'])
                            <input type="hidden" name="council_meeting_subject" value="{{ $council_meeting_subject->id }}">
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
    @endsection
