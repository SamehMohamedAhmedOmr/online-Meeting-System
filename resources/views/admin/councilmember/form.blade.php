@section('styles')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/selectize.bootstrap3.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/specialFileInput.css') }}" />
@endsection

<div class="form-group {{ $errors->has('faculty_member_id') ? 'has-error' : ''}} custom-form-group">
    <label for="faculty_member_id" class="control-label">{{ 'Member' }}</label>
    <select class="form-control specialSelect" name="faculty_member_id" required>
        <option selected hidden value="">Select Faculty member</option>

        @foreach ($member as $obj)
        @if (isset($councilmember))
        <option value="{{ $obj->id}}" {{ ($obj->id == $councilmember->faculty_member_id)?'selected':'' }}>
            @if (isset($obj->User))
            {{ $obj->User->name }}
            @endif
        </option>
        @else
        <option value="{{ $obj->id}}">
            @if (isset($obj->User))
            {{ $obj->User->name }}
            @endif
        </option>
        @endif
        @endforeach
    </select> {!! $errors->first('faculty_member_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('list_of_membership_order') ? 'has-error' : ''}} custom-form-group">
    <label for="list_of_membership_order" class="control-label">{{ 'Membership Order' }}</label>
    <select class="form-control specialSelect" name="list_of_membership_order" required>
        <option selected hidden value="">Select Membership Order</option>

        @foreach ($positions as $obj)
        @if (isset($councilmember))
        <option value="{{ $obj->id}}" {{ ($obj->id == $councilmember->list_of_membership_order)?'selected':'' }}>
            {{ $obj->position_name }}
        </option>
        @else
        <option value="{{ $obj->id}}">
            {{ $obj->position_name }}
        </option>
        @endif
        @endforeach
    </select> {!! $errors->first('faculty_member_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('start_date_of_membership') ? 'has-error' : ''}} custom-form-group">
    <label for="start_date_of_membership" class="control-label">{{ 'Start Date Of Membership' }}</label>
    <input class="form-control" name="start_date_of_membership" type="text" id="datepicker"
        value="{{ isset($councilmember->start_date_of_membership) ? $councilmember->start_date_of_membership : ''}}">
    {!! $errors->first('start_date_of_membership', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('end_date_of_membership') ? 'has-error' : ''}} custom-form-group">
    <label for="end_date_of_membership" class="control-label">{{ 'End Date Of Membership' }}</label>
    <input class="form-control" name="end_date_of_membership" type="text" id="datepicker2"
        value="{{ isset($councilmember->end_date_of_membership) ? $councilmember->end_date_of_membership : ''}}">
    {!! $errors->first('end_date_of_membership', '<p class="help-block">:message</p>') !!}
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

@if (App::getLocale() == 'ar')
<script type="text/javascript" src="{{ URL::asset('js/JQ-UL-ar.js') }}"></script>
<script type="text/javascript">
    $(function () {
        $("#datepicker, #datepicker2").datepicker({
            dateFormat: 'yy-mm-dd'
        }, $.datepicker.regional["ar"]);
        $("#datepicker, #datepicker2, .ui-corner-all").on('click', function () {
            $('.ui-icon-circle-triangle-w').text('');
            $('.ui-icon-circle-triangle-e').text('');
        })
    });

</script>
@else
<script type="text/javascript">
    $(function () {
        $("#datepicker, #datepicker2").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });

</script>
@endif

@endsection
