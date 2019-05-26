@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ URL::asset('css/selectize.bootstrap3.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/specialFileInput.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
@endsection

@section('pageTitle')
{{ $meeting->Council_definition->council_name }} | {{__("Staff.Meeting")}} {{__("home.Number")}} {{ $meeting->meeting_number }} | {{ ($council_meeting_subject->final_decision != 2) ? __("Staff.edit Final Decision") : __("Staff.Addfinaldescision") }}
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-header top-card">
                        {{ ($council_meeting_subject->final_decision != 2) ? __("Staff.edit Final Decision") : __("Staff.Addfinaldescision") }}
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a class='back-button' href="{{ url('meeting/'.$meeting->id.'') }}"
                                title="{{__("home.Back")}}">
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

                        <form method="POST" action="{{ url('addFinalDecision') }}" accept-charset="UTF-8"
                            class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <input type="hidden" name="council_meeting_subject" value="{{ $council_meeting_subject->id }}">

                            <div class="form-group {{ $errors->has('final_decision') ? 'has-error' : ''}}">
                                <label for="membershipRadios1" class="control-label">{{ __('Staff.Finaldecision') }} <span style="color:red !important;">*</span></label>
                                <div class="row">
                                    <div class="col-sm-3 {{ (App::getLocale() == 'ar')?'mr-sm-3 ml-sm-5':'ml-sm-3 mr-sm-5' }}">
                                        <div class="form-check d-sm-flex text-sm-center ">
                                            <label class="form-check-label w-100">
                                                <input type="radio" class="form-check-input" name="final_decision"
                                                    id="membershipRadios1" value="1" required
                                                    {{ (1 == $council_meeting_subject->final_decision) ? 'checked' : '' }}
                                                    {{ (old('final_decision') != null && old('final_decision') == 1) ? 'checked' : '' }}>
                                                {{ __('Staff.accept') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-check d-sm-flex text-sm-center">
                                            <label class="form-check-label w-100">
                                                <input type="radio" class="form-check-input" name="final_decision"
                                                    id="membershipRadios2" value="0" required
                                                    {{ (0 == $council_meeting_subject->final_decision) ? 'checked' : '' }}
                                                    {{ (old('final_decision') != null && old('final_decision') == 0) ? 'checked' : '' }}>
                                                {{ __('Staff.reject') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {!! $errors->first('final_decision', '<p class="help-block">:message</p>') !!}
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('person_redirected') ? 'has-error' : ''}}">
                                        <label for="person_redirected"
                                            class="control-label">{{ __('Staff.Personredirected') }} <span style="color:red !important;">*</span></label>

                                        <select class="form-control specialSelect" name="person_redirected"
                                            id='council_definition_id' required>
                                            <option selected hidden value="">{{ __('placeholder.Select person to redirect') }}</option>

                                            @foreach ($users as $user)
                                                @if (isset($council_meeting_subject->person_redirected))
                                                    @if ($council_meeting_subject->person_redirected == $user->id)
                                                        <option value="{{ $user->id}}" selected>
                                                            {{ $user->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $user->id}}">
                                                            {{ $user->name }}
                                                        </option>
                                                    @endif
                                                @else
                                                    @if (old('person_redirected') != null && old('person_redirected') == $user->id)
                                                        <option value="{{ $user->id}}">
                                                            {{ $user->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $user->id}}">
                                                            {{ $user->name }}
                                                        </option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                        {!! $errors->first('person_redirected', '<p class="help-block">:message</p>')
                                        !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('next_council_definition_id') ? 'has-error' : ''}}">
                                        <label for="next_council_definition_id"
                                            class="control-label">{{ __('Staff.Nextcouncildefinition') }} <span style="color:red !important;">*</span></label>
                                        <select class="form-control specialSelect" name="next_council_definition_id"
                                            id='council_definition_id' required>
                                            <option selected hidden value="">{{ __('placeholder.Select Council') }}</option>

                                            @foreach ($definitions as $council)
                                                @if (isset($council_meeting_subject->next_council_definition_id))
                                                    @if ($council_meeting_subject->next_council_definition_id == $council->id)
                                                        <option value="{{ $council->id}}" selected>
                                                            {{ $council->council_name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $council->id}}">
                                                            {{ $council->council_name }}
                                                        </option>
                                                    @endif
                                                @else
                                                    @if (old('next_council_definition_id') != null && old('next_council_definition_id') == $council->id)
                                                        <option value="{{ $council->id}}" selected>
                                                            {{ $council->council_name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $council->id}}">
                                                            {{ $council->council_name }}
                                                        </option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                        {!! $errors->first('next_council_definition_id', '<p class="help-block">:message
                                        </p>')
                                        !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('final_decision_description') ? 'has-error' : ''}}">
                                <label for="final_decision_description"
                                    class="control-label">{{ __('Staff.Final Decision Description') }} <span style="color:red !important;">*</span></label>
                                <textarea class="form-control" id="final_decision_description" rows="4" required
                                    placeholder="{{ __('placeholder.enter final decision description') }}"
                                    name='final_decision_description'>{{ (isset($council_meeting_subject->final_decision_description)) ? $council_meeting_subject->final_decision_description : old('final_decision_description') }}</textarea>
                                {!! $errors->first('final_decision_description', '<p class="help-block">:message</p>')
                                !!}
                            </div>


                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="{{ __('home.Save') }}">
                            </div>

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
