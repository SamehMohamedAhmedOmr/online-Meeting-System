<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('council_definition_id') ? 'has-error' : ''}}  ">
            <label for="council_definition_id" class="control-label">{{__("Staff.Definition Name")}} <span
                    style="color:red !important;">*</span></label>
            <select class="form-control specialSelect" name="council_definition_id" id='council_definition_id' required>
                <option selected hidden value="">{{ __('placeholder.Select Council') }}</option>

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
                @if (old('council_definition_id') != null && old('council_definition_id') == $council->id)
                <option value="{{ $council->id}}" selected>
                    {{ $council->council_name }}
                </option>
                @else
                <option value="{{ $council->id}}">
                    {{ $council->council_name }}
                </option>
                @endif
                @endif
                @endforeach
            </select>
            {!! $errors->first('council_definition_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('meeting_number') ? 'has-error' : ''}}  ">
            <label for="meeting_number" class="control-label">{{__("Staff.Meetingnumber")}}
                <span style="color:red !important;">*</span>
            </label>
            <input class="form-control" name="meeting_number" type="number" id="meeting_number" min='1' readonly
                placeholder="{{ __('placeholder.enter meeting Number') }}"
                value="{{ isset($council_meeting_setup->meeting_number) ? $council_meeting_setup->meeting_number : old('meeting_number')}}"
                required>
            {!! $errors->first('meeting_number', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('meeting_date') ? 'has-error' : ''}}">
            <label for="datepicker" class="control-label">{{__("Staff.Meetingdate")}} <span
                    style="color:red !important;">*</span></label>
            <input class="form-control" name="meeting_date" type="text" id="datepicker"
                placeholder="{{ __('placeholder.enter Meeting Date') }}"
                value="{{ isset($council_meeting_setup->meeting_date) ? $council_meeting_setup->meeting_date : old('meeting_date')}}"
                required>
            {!! $errors->first('meeting_date', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('meeting_time') ? 'has-error' : ''}}  ">
            <label for="meeting_time" class="control-label">{{__("Staff.Meetingtime")}} <span
                    style="color:red !important;">*</span></label>
            <input class="form-control" name="meeting_time" type="text" id="timepicker"
                placeholder="{{ __('placeholder.enter Meeting Time') }}"
                value="{{ isset($council_meeting_setup->meeting_time) ? $council_meeting_setup->meeting_time : old('meeting_time')}}"
                required>
            {!! $errors->first('meeting_time', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit"
        value="{{ $formMode === 'edit' ? __('home.update') : __('home.Save') }}">
</div>
