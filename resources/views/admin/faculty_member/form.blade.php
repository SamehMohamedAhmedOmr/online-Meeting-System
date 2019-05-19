<div class="form-group {{ $errors->has('member_name') ? 'has-error' : ''}}">
    <label for="member_name" class="control-label">{{ 'Member Name' }}</label>
    <input class="form-control" name="member_name" type="text" id="member_name" value="{{ isset($faculty_member->member_name) ? $faculty_member->member_name : ''}}" >
    {!! $errors->first('member_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('faculty_id') ? 'has-error' : ''}}">
    <label for="faculty_id" class="control-label">{{ 'Faculty Id' }}</label>
    <input class="form-control" name="faculty_id" type="number" id="faculty_id" value="{{ isset($faculty_member->faculty_id) ? $faculty_member->faculty_id : ''}}" >
    {!! $errors->first('faculty_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('department_id') ? 'has-error' : ''}}">
    <label for="department_id" class="control-label">{{ 'Department Id' }}</label>
    <input class="form-control" name="department_id" type="number" id="department_id" value="{{ isset($faculty_member->department_id) ? $faculty_member->department_id : ''}}" >
    {!! $errors->first('department_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('rank_id') ? 'has-error' : ''}}">
    <label for="rank_id" class="control-label">{{ 'Rank Id' }}</label>
    <input class="form-control" name="rank_id" type="number" id="rank_id" value="{{ isset($faculty_member->rank_id) ? $faculty_member->rank_id : ''}}" >
    {!! $errors->first('rank_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('position_id') ? 'has-error' : ''}}">
    <label for="position_id" class="control-label">{{ 'Position Id' }}</label>
    <input class="form-control" name="position_id" type="number" id="position_id" value="{{ isset($faculty_member->position_id) ? $faculty_member->position_id : ''}}" >
    {!! $errors->first('position_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
