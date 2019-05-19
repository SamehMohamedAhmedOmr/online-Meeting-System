<div class="form-group {{ $errors->has('subject_type_id') ? 'has-error' : ''}}">
    <label for="subject_type_id" class="control-label">{{ 'Subject Type' }}</label>
    <select class="form-control specialSelect" name="subject_type_id" required>
        <option selected hidden value="">Select Subject Type</option>

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
        <option value="{{ $types->id}}">
            {{ $types->subject_type_name }}
        </option>
        @endif
        @endforeach
    </select>
    {!! $errors->first('subject_type_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('department_id') ? 'has-error' : ''}}">
    <label for="department_id" class="control-label">{{ 'Department' }}</label>
    <select class="form-control specialSelect" name="department_id" required>
        <option selected hidden value="">Select Subject Type</option>

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
        <option value="{{ $department->id}}">
            {{ $department->department_name }}
        </option>
        @endif
        @endforeach
    </select>
    {!! $errors->first('department_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('subject_description') ? 'has-error' : ''}}">
    <label for="subject_description">{{ 'Subject Description' }}</label>

    <textarea class="form-control" id="subject_description" rows="4" required
        name='subject_description'>{{ isset($council_meeting_subject->subject_description) ? $council_meeting_subject->subject_description : ''}}</textarea>

    {!! $errors->first('subject_description', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group row {{ $errors->has('additional_subject') ? 'has-error' : ''}}">
    <label class="col-form-label d-block w-100" for='additional_subject'>Additional Subject</label>

    <div class="row w-100">
        <div class="col-sm-2 {{ (App::getLocale() == 'ar')?'mr-sm-3 ml-sm-5':'ml-sm-3 mr-sm-5' }}">
            <div class="form-check d-sm-flex text-sm-center ">
                <label class="form-check-label w-100">
                    <input type="radio" class="form-check-input" name="additional_subject" id="membershipRadios1"
                        value="1"
                        {{ (isset($council_meeting_subject) && 1 == $council_meeting_subject->additional_subject) ? 'checked' : '' }}>
                    Yes
                </label>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-check d-sm-flex text-sm-center">
                <label class="form-check-label w-100">
                    <input type="radio" class="form-check-input" name="additional_subject" id="membershipRadios2"
                        value="0"
                        {{ (isset($council_meeting_subject) && 0 == $council_meeting_subject->additional_subject) ? 'checked' : '' }}>
                    No
                </label>
            </div>
        </div>
    </div>
    {!! $errors->first('additional_subject', '<p class="help-block">:message</p>') !!}
</div>

<input type="hidden" name="council_meeting_id" value="{{ $meeting->id }}">

@if ($formMode != 'edit')
<div class="form-group {{ $errors->has('attachment_document') ? 'has-error' : ''}}">
    <label for="logo" class="control-label">{{ 'Attachement' }}</label>
    <input multiple class="form-control" name="attachment_document[]" type="file" id="my-file-selector"
        value="{{ isset($faculty->logo) ? $faculty->logo : ''}}">
    {!! $errors->first('attachment_document', '<p class="help-block">:message</p>') !!}
</div>
@endif


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
