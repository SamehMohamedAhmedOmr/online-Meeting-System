<div class="form-group {{ $errors->has('meeting_number') ? 'has-error' : ''}}">
    <label for="meeting_number" class="control-label">{{ 'Meeting Number' }}</label>
    <input class="form-control" name="meeting_number" type="number" id="meeting_number" value="{{ isset($subject_attachment->meeting_number) ? $subject_attachment->meeting_number : ''}}" >
    {!! $errors->first('meeting_number', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('subject_id') ? 'has-error' : ''}}">
    <label for="subject_id" class="control-label">{{ 'Subject Id' }}</label>
    <input class="form-control" name="subject_id" type="number" id="subject_id" value="{{ isset($subject_attachment->subject_id) ? $subject_attachment->subject_id : ''}}" >
    {!! $errors->first('subject_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('attachment_document') ? 'has-error' : ''}}">
    <label for="attachment_document" class="control-label">{{ 'Attachment Document' }}</label>
    <input class="form-control" name="attachment_document" type="file" id="attachment_document" value="{{ isset($subject_attachment->attachment_document) ? $subject_attachment->attachment_document : ''}}" >
    {!! $errors->first('attachment_document', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
