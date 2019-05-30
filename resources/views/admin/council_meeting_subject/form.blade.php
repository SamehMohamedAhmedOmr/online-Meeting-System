<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('subject_type_id') ? 'has-error' : ''}}">
            <label for="subject_type_id" class="control-label">{{ __('Staff.Subject Type') }} <span style="color:red !important;">*</span></label>
            <select class="form-control specialSelect" name="subject_type_id" required>
                <option selected hidden value="">{{ __('placeholder.Select Subject Type') }}</option>

                @foreach ($subjectTypes as $types)
                    @if (isset($council_meeting_subject->subject_type_id))
                        @if ($council_meeting_subject->subject_type_id == $types->id)
                        <option value="{{ $types->id}}" selected>
                            {{ $types->subject_type_name }}
                        </option>
                        @else
                        <option value="{{ $types->id}}">
                            {{ $types->subject_type_name }}
                        </option>
                        @endif
                    @else
                        @if (old('subject_type_id') != null && old('subject_type_id') == $types->id)
                            <option value="{{ $types->id}}" selected>
                                {{ $types->subject_type_name }}
                            </option>
                        @else
                            <option value="{{ $types->id}}">
                                {{ $types->subject_type_name }}
                            </option>
                        @endif
                    @endif
                @endforeach
            </select>
            {!! $errors->first('subject_type_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('department_id') ? 'has-error' : ''}}">
            <label for="department_id" class="control-label">{{__("admin.Department")}}</label>
            <select class="form-control specialSelect" name="department_id">
                <option selected hidden value="">{{ __('placeholder.Select Department') }}</option>

                @foreach ($departments as $department)
                    @if (isset($council_meeting_subject->department_id))
                        @if ($council_meeting_subject->department_id == $department->id)
                        <option value="{{ $department->id}}" selected>
                            {{ $department->department_name }}
                        </option>
                        @else
                        <option value="{{ $department->id}}">
                            {{ $department->department_name }}
                        </option>
                        @endif
                    @else
                        @if (old('department_id') != null && old('department_id') == $department->id)
                            <option value="{{ $department->id}}" selected>
                                {{ $department->department_name }}
                            </option>
                        @else
                            <option value="{{ $department->id}}">
                                {{ $department->department_name }}
                            </option>
                        @endif
                    @endif
                @endforeach
            </select>
            {!! $errors->first('department_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('subject_description') ? 'has-error' : ''}}">
            <label for="subject_description">{{ __('Staff.Subject Description') }} <span style="color:red !important;">*</span></label>

            <textarea class="form-control" id="subject_description" rows="4" required placeholder="{{ __('placeholder.subject_description') }}"
                name='subject_description'>{{ isset($council_meeting_subject->subject_description) ? $council_meeting_subject->subject_description : old('subject_description')}}</textarea>

            {!! $errors->first('subject_description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row {{ $errors->has('additional_subject') ? 'has-error' : ''}}">
            <label class="col-form-label d-block w-100" for='additional_subject'>{{ __('Staff.Additional Subject') }} <span style="color:red !important;">*</span></label>

            <div class="row w-100">
                <div class="col-sm-2 {{ (App::getLocale() == 'ar')?'mr-sm-3 ml-sm-5':'ml-sm-3 mr-sm-5' }}">
                    <div class="form-check d-sm-flex text-sm-center ">
                        <label class="form-check-label w-100">
                            <input type="radio" class="form-check-input" name="additional_subject"
                                id="membershipRadios1" value="1" required
                                {{ (isset($council_meeting_subject) && 1 == $council_meeting_subject->additional_subject) ? 'checked' : '' }}
                                {{ (old('additional_subject') != null && old('additional_subject') == 1)? 'checked' : ''}} >
                            {{ __('home.Yes') }}
                        </label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-check d-sm-flex text-sm-center">
                        <label class="form-check-label w-100">
                            <input type="radio" class="form-check-input" name="additional_subject"
                                id="membershipRadios2" value="0"
                                {{ (isset($council_meeting_subject) && 0 == $council_meeting_subject->additional_subject) ? 'checked' : '' }}
                                {{ (old('additional_subject') != null && old('additional_subject') == 0)? 'checked' : ''}} >
                            {{ __('home.No') }}
                        </label>
                    </div>
                </div>
            </div>
            {!! $errors->first('additional_subject', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<input type="hidden" name="council_meeting_id" value="{{ $meeting->id }}">

@if ($formMode != 'edit')
<div class="form-group {{ $errors->has('attachment_document') ? 'has-error' : ''}}">
    <label for="logo" class="control-label">{{ __('home.Attachment') }}</label>
    <input multiple class="form-control" name="attachment_document[]" type="file" id="my-file-selector"
        value="{{ isset($faculty->logo) ? $faculty->logo : ''}}">
    {!! $errors->first('attachment_document', '<p class="help-block">:message</p>') !!}
</div>
@endif


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? __('home.update') : __('home.Save') }}">
</div>
