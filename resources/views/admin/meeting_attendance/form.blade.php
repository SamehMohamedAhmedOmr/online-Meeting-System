<div class="form-group {{ $errors->has('meeting_number') ? 'has-error' : ''}}">
    <label for="meeting_number" class="control-label">{{ 'Meeting Number' }}</label>
    <input class="form-control" name="meeting_number" type="number" id="meeting_number" value="{{ isset($meeting_attendance->meeting_number) ? $meeting_attendance->meeting_number : ''}}" >
    {!! $errors->first('meeting_number', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('faculty_member_id') ? 'has-error' : ''}}">
    <label for="faculty_member_id" class="control-label">{{ 'Faculty Member Id' }}</label>
    <input class="form-control" name="faculty_member_id" type="number" id="faculty_member_id" value="{{ isset($meeting_attendance->faculty_member_id) ? $meeting_attendance->faculty_member_id : ''}}" >
    {!! $errors->first('faculty_member_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('attend') ? 'has-error' : ''}}">
    <label for="attend" class="control-label">{{ 'Attend' }}</label>
    <div class="radio">
    <label><input name="attend" type="radio" value="1" {{ (isset($meeting_attendance) && 1 == $meeting_attendance->attend) ? 'checked' : '' }}> Yes</label>
</div>
<div class="radio">
    <label><input name="attend" type="radio" value="0" @if (isset($meeting_attendance)) {{ (0 == $meeting_attendance->attend) ? 'checked' : '' }} @else {{ 'checked' }} @endif> No</label>
</div>
    {!! $errors->first('attend', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('excuse') ? 'has-error' : ''}}">
    <label for="excuse" class="control-label">{{ 'Excuse' }}</label>
    <div class="radio">
    <label><input name="excuse" type="radio" value="1" {{ (isset($meeting_attendance) && 1 == $meeting_attendance->excuse) ? 'checked' : '' }}> Yes</label>
</div>
<div class="radio">
    <label><input name="excuse" type="radio" value="0" @if (isset($meeting_attendance)) {{ (0 == $meeting_attendance->excuse) ? 'checked' : '' }} @else {{ 'checked' }} @endif> No</label>
</div>
    {!! $errors->first('excuse', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('excuse_description') ? 'has-error' : ''}}">
    <label for="excuse_description" class="control-label">{{ 'Excuse Descripition' }}</label>
    <input class="form-control" name="excuse_description" type="text" id="excuse_description" value="{{ isset($meeting_attendance->excuse_description) ? $meeting_attendance->excuse_description : ''}}" >
    {!! $errors->first('excuse_description', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
