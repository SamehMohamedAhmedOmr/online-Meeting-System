<div class="form-group {{ $errors->has('subject_type_name') ? 'has-error' : ''}} custom-form-group">
    <label for="subject_type_name" class="control-label">{{ __("Staff.Subject Type Name") }}</label>
    <input class="form-control" name="subject_type_name" type="text" id="subject_type_name" value="{{ isset($subjectType->subject_type_name) ? $subjectType->subject_type_name : ''}}" >
    {!! $errors->first('subject_type_name', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? __("home.update") : __("home.Create") }}">
</div>
