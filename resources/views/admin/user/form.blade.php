<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="control-label">{{ 'Name' }}</label>
            <input class="form-control" name="name" type="text" id="name" value="{{ isset($member->name) ? $member->name : ''}}">
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
            <label for="type" class="control-label">{{ 'Type' }}</label>
            <select class="form-control specialSelect" name="type" required>
                <option selected hidden value="">Select Type</option>

                @if (isset($member))
                    <option value="0" {{ ($member->type == 0)?"selected":'' }}>
                        Admin
                    </option>
                    <option value="1" {{ ($member->type == 1)?"selected":'' }}>
                        Staff
                    </option>
                    <option value="2" {{ ($member->type == 2)?"selected":'' }}>
                        Council Member
                    </option>
                @else
                    <option value="0"> Admin</option>
                    <option value="1">Staff</option>
                    <option value="2">Council Member</option>
                @endif


            </select>
            {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
            <label for="email" class="control-label">{{ 'Email' }}</label>
            <input class="form-control" name="email" type="email" id="email"
                value="{{ isset($member->email) ? $member->email : ''}}">
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
            <label for="password" class="control-label">{{ 'Password' }}</label>
            <input class="form-control" name="password" type="password" id="password">
            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('faculty_id') ? 'has-error' : ''}}">
            <label for="faculty_id" class="control-label">{{ 'Faculty' }}</label>
            <select class="form-control specialSelect" name="faculty_id" required>
                <option selected hidden value="">Select Faculty</option>

                @foreach ($faculty as $obj)
                    @if (isset($faculty_member))
                        <option value="{{ $obj->id}}" {{ ($faculty_member->faculty_id == $obj->id)?"selected":"" }}>
                            {{ $obj->faculty_name }}
                        </option>
                    @else
                        <option value="{{ $obj->id}}">
                            {{ $obj->faculty_name }}
                        </option>
                    @endif
                @endforeach
            </select>
            {!! $errors->first('faculty_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('department_id') ? 'has-error' : ''}}">
            <label for="department_id" class="control-label">{{ 'Department' }}</label>
            <select class="form-control specialSelect" name="department_id" required>
                <option selected hidden value="">Select department</option>

                @foreach ($department as $obj)
                    @if (isset($faculty_member))
                        <option value="{{ $obj->id}}" {{ ($faculty_member->department_id == $obj->id)?"selected":"" }}>
                            {{ $obj->department_name }}
                        </option>
                    @else
                        <option value="{{ $obj->id}}">
                            {{ $obj->department_name }}
                        </option>
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
            <label for="rank_id" class="control-label">{{ 'Rank' }}</label>
            <select class="form-control specialSelect" name="rank_id" required>
                <option selected hidden value="">Select Rank</option>

                @foreach ($rank as $obj)
                    @if (isset($faculty_member))
                        <option value="{{ $obj->id}}" {{ ($faculty_member->rank_id == $obj->id)?"selected":"" }}>
                            {{ $obj->rank_name }}
                        </option>
                    @else
                        <option value="{{ $obj->id}}">
                            {{ $obj->rank_name }}
                        </option>
                    @endif
                @endforeach
            </select>
            {!! $errors->first('rank_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('position_id') ? 'has-error' : ''}}">
            <label for="position_id" class="control-label">{{ 'Position' }}</label>
            <select class="form-control specialSelect" name="position_id" required>
                <option selected hidden value="">Select position</option>

                @foreach ($position as $obj)
                    @if (isset($faculty_member))
                        <option value="{{ $obj->id}}" {{ ($faculty_member->position_id == $obj->id)?"selected":"" }}>
                            {{ $obj->position_name }}
                        </option>
                    @else
                        <option value="{{ $obj->id}}">
                            {{ $obj->position_name }}
                        </option>
                    @endif
                @endforeach

            </select>
            {!! $errors->first('position_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ 'Image' }}</label>
    <input class="form-control" name="image" type="file" id="my-file-selector"
        value="{{ isset($faculty->image) ? $faculty->image : ''}}">
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
