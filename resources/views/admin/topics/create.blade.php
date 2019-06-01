@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>

            @endif
            @if(session()->has('flash_message'))
                <div class="alert alert-success">
                    {{ session()->get('flash_message') }}
                </div>
            @endif
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{__("Staff.Add Topic Responders")}}</div>
                    <div class="card-body">
                        <a  href="{{ url('meeting/'.$meeting.'') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{__("home.Back")}}</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{  url('topics/store/'.$topic->id)}}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.topics.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
