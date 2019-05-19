<div class="form-group {{ $errors->has('faculty_name') ? 'has-error' : ''}} custom-form-group">
    <label for="faculty_name" class="control-label">{{ 'Faculty Name' }}</label>
    <input class="form-control" name="faculty_name" type="text" id="faculty_name" value="{{ isset($faculty->faculty_name) ? $faculty->faculty_name : ''}}" >
    {!! $errors->first('faculty_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('logo') ? 'has-error' : ''}} custom-form-group">
    <label for="logo" class="control-label">{{ 'Logo' }}</label>
    <input class="form-control" name="logo" type="file" id="my-file-selector" value="{{ isset($faculty->logo) ? $faculty->logo : ''}}" >
    {!! $errors->first('logo', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
