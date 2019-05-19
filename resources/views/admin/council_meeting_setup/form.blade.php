<div class="form-group {{ $errors->has('meeting_number') ? 'has-error' : ''}} custom-form-group">
    <label for="meeting_number" class="control-label">{{ 'Meeting Number' }}</label>
    <input class="form-control" name="meeting_number" type="number" id="meeting_number" min='1'
        value="{{ isset($council_meeting_setup->meeting_number) ? $council_meeting_setup->meeting_number : ''}}"
        required>
    {!! $errors->first('meeting_number', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('council_definition_id') ? 'has-error' : ''}} custom-form-group">
    <label for="council_definition_id" class="control-label">{{ 'Council Definition' }}</label>
    <select class="form-control specialSelect" name="council_definition_id" id='council_definition_id' required>
        <option selected hidden value="">Select Council</option>

        @foreach ($councilDefintions as $council)
        @if (isset($council_meeting_setup->council_definition_id))
        @if ($council_meeting_setup->council_definition_id == $council->id)
        <option value="{{ $council->id}}" selected>
            {{ $council->council_name }}
        </option>
        @else
        <option value="{{ $council->id}}">
            {{ $council->council_name }}
        </option>
        @endif
        @else
        <option value="{{ $council->id}}">
            {{ $council->council_name }}
        </option>
        @endif
        @endforeach
    </select>
    {!! $errors->first('faculty_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('meeting_date') ? 'has-error' : ''}} custom-form-group">
    <label for="datepicker" class="control-label">{{ 'Meeting Date' }}</label>
    <input class="form-control" name="meeting_date" type="text" id="datepicker"
        value="{{ isset($council_meeting_setup->meeting_date) ? $council_meeting_setup->meeting_date : ''}}" required>
    {!! $errors->first('meeting_date', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('meeting_time') ? 'has-error' : ''}} custom-form-group">
    <label for="meeting_time" class="control-label">{{ 'Meeting Time' }}</label>
    <input class="form-control" name="meeting_time" type="text" id="timepicker"
        value="{{ isset($council_meeting_setup->meeting_time) ? $council_meeting_setup->meeting_time : ''}}" required>
    {!! $errors->first('meeting_time', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
