
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

<div class="form-group col-md-7 {{ $errors->has('priority') ? 'has-error' : ''}}" custom-form-group>
        <label for="priority" class="control-label">{{ __('Staff.priority') }}<span style="color:red !important;">*</span></label>
        <select class="form-control specialSelect" name="priority" class="form-control" id="priority" >
    @php
     $var=[
     "0"=>__("Staff.High"),
     "1"=>__("Staff.Medium"),
     "2"=>__("Staff.Low")
        ];
    @endphp
        @foreach ($var as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($position->priority) && $position->priority == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
        @endforeach
    </select>
        {!! $errors->first('priority', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? __('home.update') : __('home.Create') }}">
</div>


