<div class="form-group {{ $errors->has('rank_name') ? 'has-error' : ''}} custom-form-group">
    <label for="rank_name" class="control-label">{{ 'Rank Name' }}</label>
    <input class="form-control" name="rank_name" type="text" id="rank_name" value="{{ isset($rank->rank_name) ? $rank->rank_name : ''}}" >
    {!! $errors->first('rank_name', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
