<div class="form-group {{ $errors->has('council_member_id') ? 'has-error' : ''}}">
    <label for="council_member_id" class="control-label">{{ 'Council Member Id' }}</label>
    <input class="form-control" name="council_member_id" type="number" id="council_member_id" value="{{ isset($vote->council_member_id) ? $vote->council_member_id : ''}}" >
    {!! $errors->first('council_member_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('vote') ? 'has-error' : ''}}">
    <label for="vote" class="control-label">{{ 'Vote' }}</label>
    <div class="radio">
    <label><input name="vote" type="radio" value="1" {{ (isset($vote) && 1 == $vote->vote) ? 'checked' : '' }}> Yes</label>
</div>
<div class="radio">
    <label><input name="vote" type="radio" value="0" @if (isset($vote)) {{ (0 == $vote->vote) ? 'checked' : '' }} @else {{ 'checked' }} @endif> No</label>
</div>
    {!! $errors->first('vote', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('subject_type_id') ? 'has-error' : ''}}">
    <label for="subject_type_id" class="control-label">{{ 'Subject Type Id' }}</label>
    <input class="form-control" name="subject_type_id" type="number" id="subject_type_id" value="{{ isset($vote->subject_type_id) ? $vote->subject_type_id : ''}}" >
    {!! $errors->first('subject_type_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('commet') ? 'has-error' : ''}}">
    <label for="commet" class="control-label">{{ 'Commet' }}</label>
    <input class="form-control" name="commet" type="text" id="commet" value="{{ isset($vote->commet) ? $vote->commet : ''}}" >
    {!! $errors->first('commet', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
