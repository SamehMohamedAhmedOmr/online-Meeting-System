@section('styles')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/selectize.bootstrap3.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/specialFileInput.css') }}" />
@endsection

<div class="form-group {{ $errors->has('council_definition_id') ? 'has-error' : ''}}" hidden>
    <label for="council_definition_id" class="control-label">{{ 'Council Definition' }}</label>
    <input class="form-control" name="council_definition_id" type="number" id="council_definition_id"
        value="{{ $id}}">
    {!! $errors->first('council_definition_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('faculty_member_id') ? 'has-error' : ''}}  ">
            <label for="faculty_member_id" class="control-label">{{ __('admin.Member Name') }} <span style="color:red !important;">*</span></label>
            <select class="form-control specialSelect" name="faculty_member_id" required>
                <option selected hidden value="">{{ __('placeholder.Select Council Member') }}</option>

                @foreach ($member as $obj)
                    @if (old('faculty_member_id') != null && old('faculty_member_id') == $obj->id)
                        <option value="{{ $obj->id}}" selected>
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
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('list_of_membership_order') ? 'has-error' : ''}}  ">
            <label for="list_of_membership_order" class="control-label">{{ __('admin.list_of_membership_order') }} <span style="color:red !important;">*</span></label>
            <select class="form-control specialSelect" name="list_of_membership_order" required>
                <option selected hidden value="">{{ __('placeholder.Select Membership Order') }}</option>

                @foreach ($positions as $obj)
                    @if (old('list_of_membership_order') != null && old('list_of_membership_order') == $obj->id)
                        <option value="{{ $obj->id}}" selected>
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
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('start_date_of_membership') ? 'has-error' : ''}}  ">
            <label for="start_date_of_membership" class="control-label">{{ __('admin.Start Date Of Membership') }} <span style="color:red !important;">*</span></label>
            <input class="form-control" name="start_date_of_membership" type="text" id="datepicker" required
                placeholder="{{ __('placeholder.enter start_date_of_membership') }}"
                value="{{ old('start_date_of_membership') }}">
            {!! $errors->first('start_date_of_membership', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('end_date_of_membership') ? 'has-error' : ''}}  ">
            <label for="end_date_of_membership" class="control-label">{{ __('admin.End Date Of Membership') }} <span style="color:red !important;">*</span></label>
            <input class="form-control" name="end_date_of_membership" type="text" id="datepicker2" required
                placeholder="{{ __('placeholder.enter end_date_of_membership') }}"
                value="{{ old('end_date_of_membership') }}">
            {!! $errors->first('end_date_of_membership', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ __('home.Save') }}">
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
