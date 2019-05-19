@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/selectize.bootstrap3.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/specialFileInput.css') }}" />
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-header top-card">Create New user</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a class='back-button' href="{{ url('users') }}" title="Back">
                                <button class="btn btn-warning btn-sm">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
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

                        <form method="POST" action="{{ url('users') }}" accept-charset="UTF-8"
                            class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.user.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script id='scriptToFile' type="text/javascript" data-lang = "{{ (App::getLocale() == 'ar')?'ar':'en' }}" >
        $(function () {
            var lang = $('#scriptToFile').data('lang');
            $("#my-file-selector").fileinput({
                theme: "fas",
                maxFileCount: 1,
                allowedFileExtensions: ["JPEG", "JPG", "PNG"],
                language: lang
            });
        });
    </script>
     <script type="text/javascript" src="{{ URL::asset('js/selectize.min.js') }}"></script>
     <script type="text/javascript">
         $('.specialSelect').selectize();
     </script>
@endsection
