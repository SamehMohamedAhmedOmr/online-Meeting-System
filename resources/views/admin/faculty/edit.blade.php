@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/specialFileInput.css') }}" />
@endsection

@section('pageTitle')
{{ __('admin.faculties') }} | {{ __('admin.Edit Faculty') }}
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-header top-card">{{ __('admin.Edit Faculty') }}
                        <span class="name">{{ $faculty->faculty_name }}</span>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a class='back-button' href="{{ url('faculty') }}" title="Back">
                                <button class="btn btn-warning btn-sm" >
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

                        <form method="POST" action="{{ url('faculty/' . $faculty->id) }}" accept-charset="UTF-8" class="form-horizontal custom-form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.faculty.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script id='scriptToFile' type="text/javascript" data-lang = "{{ (App::getLocale() == 'ar')?'ar':'en' }}"
    data-img = '<img src="{{ URL::asset('storage/faculty_pic/'.$faculty->id.'/'.$faculty->logo.'') }}" > '>
        $(function () {
            var dom = $('#scriptToFile');
            var lang = dom.data('lang');
            var img = dom.data('img');
            $("#my-file-selector").fileinput({
                theme: "fas",
                maxFileCount: 1,
                allowedFileExtensions: ["JPEG", "JPG", "PNG"],
                language: lang,
                initialPreview: [
                    img,
                ],
            });
        });
    </script>
@endsection
