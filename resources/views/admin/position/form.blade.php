<div class="form-group {{ $errors->has('position_name') ? 'has-error' : ''}} custom-form-group">
    <label for="position_name" class="control-label">{{ 'Position Name' }}</label>
    <input class="form-control" name="position_name" type="text" id="position_name" value="{{ isset($position->position_name) ? $position->position_name : ''}}" >
    {!! $errors->first('position_name', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
