@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
@endsection

@section('pageTitle')
    {{ __('Staff.Ranks') }} | {{ __('Staff.Edit Rank') }}
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-header top-card">{{ __('Staff.Edit Rank') }}
                        <span class="name">{{ $rank->rank_name }}</span>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a class='back-button' href="{{ url('rank') }}" title="{{ __('home.Back') }}">
                                <button class="btn btn-warning btn-sm">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i> {{ __('home.Back') }}
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

                        <form method="POST" action="{{ url('rank/' . $rank->id) }}" accept-charset="UTF-8" class="form-horizontal custom-form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.rank.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
