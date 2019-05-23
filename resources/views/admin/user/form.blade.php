<div class="row">

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="control-label">{{ __('home.Name') }} <span style="color:red !important;">*</span></label>
            <input class="form-control" name="name" type="text" required
                id="name" value="{{ isset($member->name) ? $member->name : old('name')}}"
                placeholder="{{ __('placeholder.enter Name') }}">
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
            <label for="type" class="control-label">{{ __('admin.type') }} <span style="color:red !important;">*</span></label>
            <select class="form-control specialSelect" name="type" required >
                <option selected hidden value="">{{ __('placeholder.Select User Type') }}</option>

                @if (isset($member))
                    <option value="0" {{ ($member->type == 0)?"selected":'' }}>
                        {{ __('home.admin') }}
                    </option>
                    <option value="1" {{ ($member->type == 1)?"selected":'' }}>
                        {{ __('home.Staff') }}
                    </option>
                    <option value="2" {{ ($member->type == 2)?"selected":'' }}>
                        {{ __('home.Council Member') }}
                    </option>
                @else
                    <option value="0" {{ (old('type') != null && old('type') == 0)?'selected':'' }}> {{ __('home.admin') }}</option>
                    <option value="1" {{ (old('type') != null && old('type') == 1)?'selected':'' }}>{{ __('home.Staff') }}</option>
                    <option value="2" {{ (old('type') != null && old('type') == 2)?'selected':'' }}>{{ __('home.Council Member') }}</option>
                @endif


            </select>
            {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
            <label for="email" class="control-label">{{ __('admin.Email') }} <span style="color:red !important;">*</span></label>
            <input class="form-control" name="email" type="email" id="email"
                value="{{ isset($member->email) ? $member->email : old('email')}}" required
                placeholder="{{ __('placeholder.enter email') }}">
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6 {{ ($formMode === 'edit') ? 'd-none': '' }}">
        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
            <label for="password" class="control-label">{{ __('admin.password') }} <span style="color:red !important;">*</span></label>
            <input class="form-control" name="password" type="password" id="password" {{ ($formMode === 'edit') ? '': 'required' }}
                placeholder="{{ __('placeholder.enter password') }}">
            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('faculty_id') ? 'has-error' : ''}}">
            <label for="faculty_id" class="control-label">{{ __('admin.faculty') }} <span style="color:red !important;">*</span></label>
            <select class="form-control specialSelect" name="faculty_id" required>
                <option selected hidden value="">{{ __('placeholder.Select Faculty') }}</option>

                @foreach ($faculty as $obj)
                    @if (isset($faculty_member))
                        <option value="{{ $obj->id}}" {{ ($faculty_member->faculty_id == $obj->id)?"selected":"" }}>
                            {{ $obj->faculty_name }}
                        </option>
                    @else
                        @if (old('faculty_id') != null && old('faculty_id') == $obj->id)
                            <option value="{{ $obj->id}}" selected>
                                {{ $obj->faculty_name }}
                            </option>
                        @else
                            <option value="{{ $obj->id}}">
                                {{ $obj->faculty_name }}
                            </option>
                        @endif
                    @endif
                @endforeach
            </select>
            {!! $errors->first('faculty_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('department_id') ? 'has-error' : ''}}">
            <label for="department_id" class="control-label">{{ __('admin.Department') }} <span style="color:red !important;">*</span></label>
            <select class="form-control specialSelect" name="department_id" required>
                <option selected hidden value="">{{ __('placeholder.Select Department') }}</option>

                @foreach ($department as $obj)
                    @if (isset($faculty_member))
                        <option value="{{ $obj->id}}" {{ ($faculty_member->department_id == $obj->id)?"selected":"" }}>
                            {{ $obj->department_name }}
                        </option>
                    @else
                        @if (old('department_id') != null && old('department_id') == $obj->id)
                            <option value="{{ $obj->id}}" selected>
                                {{ $obj->department_name }}
                            </option>
                        @else
                            <option value="{{ $obj->id}}">
                                {{ $obj->department_name }}
                            </option>
                        @endif
                    @endif
                @endforeach
            </select>
            {!! $errors->first('department_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('rank_id') ? 'has-error' : ''}}">
            <label for="rank_id" class="control-label">{{  __('admin.Rank') }} <span style="color:red !important;">*</span></label>
            <select class="form-control specialSelect" name="rank_id" required>
                <option selected hidden value="">{{ __('placeholder.Select Rank') }}</option>

                @foreach ($rank as $obj)
                    @if (isset($faculty_member))
                        <option value="{{ $obj->id}}" {{ ($faculty_member->rank_id == $obj->id)?"selected":"" }}>
                            {{ $obj->rank_name }}
                        </option>
                    @else
                        @if (old('rank_id') != null && old('rank_id') == $obj->id)
                            <option value="{{ $obj->id}}" selected>
                                {{ $obj->rank_name }}
                            </option>
                        @else
                            <option value="{{ $obj->id}}">
                                {{ $obj->rank_name }}
                            </option>
                        @endif
                    @endif
                @endforeach
            </select>
            {!! $errors->first('rank_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('position_id') ? 'has-error' : ''}}">
            <label for="position_id" class="control-label">{{  __('admin.Position') }} <span style="color:red !important;">*</span></label>
            <select class="form-control specialSelect" name="position_id" required>
                <option selected hidden value="">{{ __('placeholder.Select Position') }}</option>

                @foreach ($position as $obj)
                    @if (isset($faculty_member))
                        <option value="{{ $obj->id}}" {{ ($faculty_member->position_id == $obj->id)?"selected":"" }}>
                            {{ $obj->position_name }}
                        </option>
                    @else
                        @if (old('position_id') != null && old('position_id') == $obj->id)
                            <option value="{{ $obj->id}}" selected>
                                {{ $obj->position_name }}
                            </option>
                        @else
                            <option value="{{ $obj->id}}">
                                {{ $obj->position_name }}
                            </option>
                        @endif
                    @endif
                @endforeach

            </select>
            {!! $errors->first('position_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ __('admin.Image') }}</label>
    <input class="form-control" name="image" type="file" id="my-file-selector"
        value="{{ isset($faculty->image) ? $faculty->image : ''}}">
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? __('home.update') : __('home.Save') }}">
</div>
