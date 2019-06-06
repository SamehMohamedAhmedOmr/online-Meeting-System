@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/specialFileInput.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/meeting.css') }}" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" />
@endsection

@section('pageTitle')
{{ __('home.Redirect Subject') }}
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
                        <span>{{ __('home.Redirect Subject') }} {{ __('home.From') }} {{ $subject->Council_definition->council_name }}</span>
                    </div>

                    <div class="card-body subject-accordion">

                        <div class="row mb-4" style="justify-content: space-evenly;">
                            <button class="btn btn-success">
                                {{ __('Staff.accept') }}
                            </button>
                            <button class="btn btn-danger">
                                {{ __('Staff.reject') }}
                            </button>
                        </div>

                        @include('admin.council_meeting_setup.commonSubjectData')

                        @include('admin.council_meeting_setup.subjectAttachment')


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


