@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/specialFileInput.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/meeting.css') }}" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" />
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
                        <span>{{__("Staff.Meeting")}}</span>
                        <span class="name">{{__("home.Number")}} {{ $council_meeting_setup->meeting_number }}</span>
                        <span>{{__("home.details")}}</span>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <a style='text-decoration:none;' href="{{ url('meeting') }}" title="Back">
                                <button class="btn btn-warning btn-sm" style="color:#fff;">
                                    <i class="fa fa-arrow-left" style="font-size: 0.875rem" aria-hidden="true"></i> {{__("home.Back")}}
                                </button>
                            </a>
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
                                    <span>{{__("home.Subject")}}</span>
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
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
