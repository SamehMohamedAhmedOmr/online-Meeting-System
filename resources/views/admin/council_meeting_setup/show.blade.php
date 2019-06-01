@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/specialFileInput.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/meeting.css') }}" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" />
@endsection

@section('pageTitle')
{{ $council_meeting_setup->Council_definition->council_name }} | {{__("Staff.Meeting")}} {{__("home.Number")}} {{ $council_meeting_setup->meeting_number }}
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin">
                @include('messages')

                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                <div class="card">
                    <div class="card-header top-card">
                        <span>{{__("Staff.Meeting")}} {{__("home.Number")}}</span>
                        <span class="name"> {{ $council_meeting_setup->meeting_number }}</span>
                    </div>

                    <div class="card-body">

                        <div class="mb-3 {{ (Auth::user()->type == 1) ? 'row' : '' }}">
                            @if(Auth::user()->type == 1)
                                @if (Auth::user()->type == 1 && $council_meeting_setup->close == 0)
                                    <!-- Staff -->
                                    <div class="col-6 d-flex justify-content-center align-items-center {{ (App::getLocale() == 'ar')?'order-0':'order-1' }}">
                                        <a class="btn btn-facebook" href="{{ url('meetingSubject/create/'.$council_meeting_setup->id.'') }}">
                                            {{__("Staff.Addnewsubject")}}
                                        </a>
                                    </div>
                                @endif

                                <div class="col-6 {{ (App::getLocale() == 'ar')?'order-1':'order-0' }}">
                                    <a style='text-decoration:none;' href="{{ url('meeting') }}" title="{{__("home.Back")}}">
                                        <button class="btn btn-warning btn-sm" style="color:#fff;">
                                            <i class="fa fa-arrow-left" style="font-size: 0.875rem; position:relative; top:2px;" aria-hidden="true"></i> {{__("home.Back")}}
                                        </button>
                                    </a>
                                </div>
                            @else
                                <a style='text-decoration:none;' href="{{ url('meeting') }}" title="{{__("home.Back")}}">
                                    <button class="btn btn-warning btn-sm" style="color:#fff;">
                                        <i class="fa fa-arrow-left" style="font-size: 0.875rem; position:relative; top:2px;" aria-hidden="true"></i> {{__("home.Back")}}
                                    </button>
                                </a>
                            @endif
                        </div>

                        <div class="table-responsive view-data mb-3">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width: 30%; line-height: 20px;">{{__("Staff.CouncilName")}}</th>
                                        <td> {{ $council_meeting_setup->Council_definition->council_name }} </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%; line-height: 20px;"> {{__("home.Date")}} </th>
                                        <td> {{ $council_meeting_setup->meeting_date }} </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%; line-height: 20px;"> {{__("home.Time")}} </th>
                                        <td> {{ $council_meeting_setup->meeting_time }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <ul class="subject-nav nav nav-tabs px-4 d-flex justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="subject-tab" data-toggle="tab" href="#subject"
                                    role="tab" aria-controls="subject"
                                    aria-selected="true" style="font-size: 1.2rem !important;">
                                    <i class="mdi mdi-file-document-box"></i>
                                    <span>{{__("Staff.Subjects")}}</span>
                                </a>
                            </li>
                            @if (Auth::user()->type == 1)
                                <li class="nav-item">
                                    <a class="nav-link" id="attendence-tab" data-toggle="tab" href="#attendence" role="tab"
                                        aria-controls="attendence" style="font-size: 1.2rem !important;"
                                        aria-selected="false">
                                        <i class="mdi mdi-account-check"></i>
                                        <span>{{__("Staff.Attendence")}}</span>
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item">
                                    <a class="nav-link" id="topic-tab" data-toggle="tab" href="#topic" role="tab"
                                        aria-controls="topic" style="font-size: 1.2rem !important;"
                                        aria-selected="false">
                                        <i class="mdi mdi-file-document-box"></i>
                                        <span>{{__("Staff.Agenda")}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="memo-tab" data-toggle="tab" href="#memo" role="tab"
                                        aria-controls="memo" style="font-size: 1.2rem !important;"
                                        aria-selected="false">
                                        <i class="mdi mdi-file-document-box"></i>
                                        <span>{{__("Staff.Memo")}}</span>
                                    </a>
                                </li>

                        </ul>

                        <div class="tab-content py-0 px-0">
                            <div class="tab-pane fade show active" id="subject" role="tabpanel"
                                aria-labelledby="subject-tab">
                                @include('admin.council_meeting_setup.subject')
                            </div>
                            @if (Auth::user()->type == 1)
                                <div class="tab-pane fade" id="attendence" role="tabpanel" aria-labelledby="attendence-tab">
                                    @include('admin.council_meeting_setup.attendence')
                                </div>
                            @endif
                            @if (count($subjects) != 0)
                            <div class="tab-pane fade" id="topic" role="tabpanel" aria-labelledby="topic-tab">
                                    @include('admin.topics.report')
                                </div>


                                <div class="tab-pane fade" id="memo" role="tabpanel" aria-labelledby="memo-tab">
                                    @include('admin.topics.memo')
                                </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
