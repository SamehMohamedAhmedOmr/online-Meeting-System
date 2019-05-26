@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
@endsection

@section('pageTitle')
    {{ __('home.Subject') }} | {{__("Staff.Create New Subject Type")}}
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                <div class="card-header top-card">{{__("Staff.Create New Subject Type")}}</div>
                    <div class="card-body">
                        <div class="p-3">
                            <a class='back-button' href="{{ url('subjectType') }}" title="Back">
                                <button class="btn btn-warning btn-sm">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i> {{__("home.Back")}}</button>
                            </a>
                        </div>

                        @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif

                        <form method="POST" action="{{ url('subjectType') }}" accept-charset="UTF-8"
                            class="form-horizontal custom-form" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.subject_type.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
