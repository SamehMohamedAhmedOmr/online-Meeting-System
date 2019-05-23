<div class="form-group {{ $errors->has('faculty_name') ? 'has-error' : ''}} custom-form-group">
    <label for="faculty_name" class="control-label">{{ __('admin.Faculty Name') }} <span style="color:red !important;">*</span></label>
    <input class="form-control" name="faculty_name" required
        type="text" id="faculty_name" placeholder="{{ __('placeholder.enter Faculty Name') }}"
        value="{{ isset($faculty->faculty_name) ? $faculty->faculty_name : old('faculty_name')}}" >
    {!! $errors->first('faculty_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('logo') ? 'has-error' : ''}} custom-form-group">
    <label for="logo" class="control-label">{{ __('admin.logo') }} <span style="color:red !important;">*</span></label>
    <input class="form-control" name="logo" type="file" required
        id="my-file-selector">
    {!! $errors->first('logo', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? __('home.update') : __('home.Save') }}">
</div>
