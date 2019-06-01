@section('styles')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/selectize.bootstrap3.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/specialFileInput.css') }}" />
@endsection


<div class="col-md-12">
<div class="form-group  {{ $errors->has('faculty_member') ? 'has-error' : ''}}" id="optional2">
    <label for="faculty_member" class="control-label">{{ __("Staff.Member Name") }} <span style="color:red !important;">*</span></label>
    <input class="form-control" name="faculty_member" type="text" id="faculty_member" value="{{ isset($topic->faculty_member) ? $topic->faculty_member : ''}}" >
    {!! $errors->first('faculty_member', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-md-12">
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
<div class="form-group col-md-12 {{ $errors->has('job') ? 'has-error' : ''}}">
    <label for="job" class="control-label">{{ 'Job' }}<span style="color:red !important;">*</span></label>
    <select class="form-control specialSelect" name="job" class="form-control" id="job" >
@php
 $var=[
 "0"=>__("Staff.Supervisor"),
 "1"=>__("Staff.Rapporteur"),
 "2"=>__("Staff.Member")
    ];
@endphp
    @foreach ($var as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($topic->job) && $topic->job == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('job', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group col-md-12">
    <input class="btn btn-primary " type="submit" value="{{ __("home.Create") }}">
</div>
@section('scripts')

<script type="text/javascript" src="{{ URL::asset('js/selectize.min.js') }}"></script>
<script type="text/javascript">
    $('.specialSelect').selectize();

</script>

<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

@endsection
