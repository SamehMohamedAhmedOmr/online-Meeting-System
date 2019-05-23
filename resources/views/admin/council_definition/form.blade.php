<div class="form-group {{ $errors->has('council_name') ? 'has-error' : ''}} custom-form-group">
    <label for="council_name" class="control-label">{{ __('admin.Council Name') }} <span style="color:red !important;">*</span></label>
    <input class="form-control" name="council_name" type="text" id="council_name" required
        placeholder="{{ __('placeholder.enter Council Name') }}"
        value="{{ isset($council_definition->council_name) ? $council_definition->council_name : old('council_name')}}">
    {!! $errors->first('council_name', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('faculty_id') ? 'has-error' : ''}} custom-form-group">
    <label for="faculty_id" class="control-label">{{ __('admin.Faculty Name') }} <span style="color:red !important;">*</span></label>
    <select class="form-control specialSelect" name="faculty_id" required>
        <option selected hidden value="">{{ __('placeholder.Select Faculty') }}</option>

        @foreach ($colleges as $faculty)
        @if (isset($council_definition->faculty_id))
            @if ($council_definition->faculty_id == $faculty->id)
            <option value="{{ $faculty->id}}" selected>
                {{ $faculty->faculty_name }}
            </option>
            @else
            <option value="{{ $faculty->id}}">
                {{ $faculty->faculty_name }}
            </option>
            @endif
        @else
            @if (old('faculty_id') != null && old('faculty_id') == $faculty->id)
                <option value="{{ $faculty->id}}" selected>
                    {{ $faculty->faculty_name }}
                </option>
            @else
                <option value="{{ $faculty->id}}">
                    {{ $faculty->faculty_name }}
                </option>
            @endif
        @endif
        @endforeach
    </select>
    {!! $errors->first('faculty_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('number_of_members') ? 'has-error' : ''}} custom-form-group">
    <label for="number_of_members" class="control-label">{{ __('admin.Number of Members') }} <span style="color:red !important;">*</span></label>
    <input class="form-control" name="number_of_members" type="number" id="number_of_members" required
        placeholder="{{ __('placeholder.enter Number of Members') }}"
        value="{{ isset($council_definition->number_of_members) ? $council_definition->number_of_members : old('number_of_members')}}">
    {!! $errors->first('number_of_members', '<p class="help-block">:message</p>') !!}
</div>



<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? __('home.update') : __('home.Save') }}">
</div>
