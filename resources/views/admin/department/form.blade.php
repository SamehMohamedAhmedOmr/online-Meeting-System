<div class="form-group {{ $errors->has('department_name') ? 'has-error' : ''}} custom-form-group">
    <label for="department_name" class="control-label">{{ __('admin.department_name') }} <span style="color:red !important;">*</span></label>
    <input class="form-control" name="department_name" required
        placeholder="{{ __('placeholder.enter Department Name') }}" type="text" id="department_name"
        value="{{ isset($department->department_name) ? $department->department_name : old('department_name')}}" >
    {!! $errors->first('department_name', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? __('home.update') : __('home.Save') }}">
</div>
