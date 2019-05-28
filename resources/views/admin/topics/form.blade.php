@section('styles')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/selectize.bootstrap3.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/specialFileInput.css') }}" />
@endsection

<div class="form-group col-md-6 {{ $errors->has('council_meeting_subject_id') ? 'has-error' : ''}}" >
    <label for="council_meeting_subject_id" class="control-label">{{ 'Council Meeting Subject Description' }}<span style="color:red !important;">*</span></label>
    <select class="form-control specialSelect" name="council_meeting_subject_id" id='council_meeting_subject_id' required>
            <option selected hidden value="">{{ __('placeholder.Select Subject') }}</option>

            @foreach ($councilSubjects as $council)

                        <option value="{{ $council->id}}">
                            {{ $council->subject_description }}
                        </option>
            @endforeach
        </select>

         {!! $errors->first('council_meeting_subject_id', '<p class="help-block">:message</p>') !!}

        </div>
<div class="row">
        <label class="form-check-label w-100  col-md-6" >
                <input type="radio" class="form-check-input" name="choose" value='yes'>
                Already a Member

            </label>
            <label class="form-check-label w-100  col-md-6">
                    <input type="radio" class="form-check-input" name="choose" value='no'  checked>
                    Not a Member


                </label>
                <br>
            </div>
            <br>
            <div class="row">

<div class="form-group  col-md-6 {{ $errors->has('council_member_ID') ? 'has-error' : ''}}" id="optional">
    <label for="council_member_ID" class="control-label">{{ 'Faculty Member Name' }}<span style="color:red !important;">*</span></label>
    <select class="form-control specialSelect" name="council_member_ID" id='council_member_ID' >
            <option selected hidden value="">{{ __('placeholder.Select Member') }}</option>

            @foreach ($facultymember as $member)

                        <option value="{{ $member->id}}">
                            {{ $member->member_name }}
                        </option>
            @endforeach
        </select>
    {!! $errors->first('faculty_member', '<p class="help-block">:message</p>') !!}
</div>
<div class="col-md-6">
<div class="form-group  {{ $errors->has('faculty_member') ? 'has-error' : ''}}" id="optional2">
    <label for="faculty_member" class="control-label">{{ 'Member Name ' }} <span style="color:red !important;">*</span></label>
    <input class="form-control" name="faculty_member" type="text" id="faculty_member" value="{{ isset($topic->faculty_member) ? $topic->faculty_member : ''}}" >
    {!! $errors->first('faculty_member', '<p class="help-block">:message</p>') !!}
</div>
</div>
</div>
<div class="col-md-6">
        <div class="form-group {{ $errors->has('list_of_membership_order') ? 'has-error' : ''}}  ">
            <label for="list_of_membership_order" class="control-label">{{ __('admin.list_of_membership_order') }} <span style="color:red !important;">*</span></label>
            <select class="form-control specialSelect" name="list_of_member_order" required >
                <option selected hidden value="">{{ __('placeholder.Select Membership Order') }}</option>

                @foreach ($positions as $obj)

                <option value="{{ $obj->id}}" id="asd">
                    {{ $obj->position_name }}
                </option>
                @endforeach
            </select> {!! $errors->first('faculty_member_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
<div class="form-group col-md-6 {{ $errors->has('job') ? 'has-error' : ''}}">
    <label for="job" class="control-label">{{ 'Job' }}<span style="color:red !important;">*</span></label>
    <select class="form-control specialSelect" name="job" class="form-control" id="job" >
    @foreach (json_decode('{"0":"Supervisor","1":"Rapporteur","2":"Member"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($topic->job) && $topic->job == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('job', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
@section('scripts')

<script type="text/javascript" src="{{ URL::asset('js/selectize.min.js') }}"></script>
<script type="text/javascript">
    $('.specialSelect').selectize();

</script>

<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

$('input[name="choose"]').click(function(e) {
  if(e.target.value === 'yes') {
    $('#optional').show();
    $('#optional2').hide();
    $('#faculty_member').val(null);

  } else {
    $('#optional').hide();
    $('#council_member_ID').val(null);
    $('#optional2').show();
  }
})

$('#optional').hide();

</script>
@endsection
