
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/selectize.bootstrap3.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/specialFileInput.css') }}" />
@endsection

<div class="form-group {{ $errors->has('position_name') ? 'has-error' : ''}} custom-form-group">
    <label for="position_name" class="control-label">{{__('Staff.Position Name') }} <span style="color:red !important;">*</span> </label>
    <input class="form-control" name="position_name" type="text" required
    placeholder="{{ __('placeholder.enter Position Name') }}"
     id="position_name" value="{{ isset($position->position_name) ? $position->position_name : old('position_name')}}" >
    {!! $errors->first('position_name', '<p class="help-block">:message</p>') !!}
</div>


    <div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? __('home.update') : __('home.Create') }}">
</div>


