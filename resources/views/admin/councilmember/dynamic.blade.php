
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/selectize.bootstrap3.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/specialFileInput.css') }}" />
@endsection
<div class="table-responsive">
    <table class="table table-bordered" id="dynamic_field">
        <tr>
            <td class="custom-form mb-3">
                <div class="custom-form-group d-flex justify-content-center mb-3">
                    <h3>Member Number 1</h3>
                </div>
                <div class="form-group {{ $errors->has('council_definition_id') ? 'has-error' : ''}}" hidden>
                    <label for="council_definition_id" class="control-label">{{ 'Council Definition' }}</label>
                    <input class="form-control" name="council_definition_id[]" type="number" id="council_definition_id" value="{{ $id}}" >
                    {!! $errors->first('council_definition_id', '<p class="help-block">:message</p>') !!}
                </div>

                <div class="form-group {{ $errors->has('faculty_member_id') ? 'has-error' : ''}} custom-form-group">
                    <label for="faculty_member_id" class="control-label">{{ 'Faculty Member' }}</label>
                    <select class="form-control specialSelect" name="faculty_member_id[]" required>
                            <option selected hidden value="">Select Faculty Member</option>

                            @foreach ($member as $obj)
                                @if (isset($obj->User))
                                    <option value="{{ $obj->id}}">
                                        {{ $obj->User->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    {!! $errors->first('faculty_member_id', '<p class="help-block">:message</p>') !!}
                </div>


                <div class="form-group {{ $errors->has('list_of_membership_order') ? 'has-error' : ''}} custom-form-group">
                    <label for="list_of_membership_order" class="control-label">{{ 'Membership Order' }}</label>
                    <select class="form-control specialSelect" name="list_of_membership_order[]" required style="width:100%;">
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
                    <input class="form-control" placeholder="Enter Start Date of membership" name="start_date_of_membership[]" type="text" id="datepicker" value="{{ isset($councilmember->start_date_of_membership) ? $councilmember->start_date_of_membership : ''}}" >
                    {!! $errors->first('start_date_of_membership', '<p class="help-block">:message</p>') !!}
                </div>

                <div class="form-group {{ $errors->has('end_date_of_membership') ? 'has-error' : ''}} custom-form-group d-block">
                    <label for="end_date_of_membership" class="control-label">{{ 'End Date Of Membership' }}</label>
                    <input class="form-control" placeholder="Enter End Date of membership" name="end_date_of_membership[]" type="text" id="datepicker2" value="{{ isset($councilmember->end_date_of_membership) ? $councilmember->end_date_of_membership : ''}}" >
                    {!! $errors->first('end_date_of_membership', '<p class="help-block">:message</p>') !!}
                </div>
            </td>
        </tr>

    </table>
    <div class="form-group d-flex justify-content-center mb-5">
    <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
    </div>
    <div class="form-group">
        <input class="btn btn-primary w-50" type="submit" value="Create">
    </div>
</div>
@section('scripts')

<script type="text/javascript" src="{{ URL::asset('js/selectize.min.js') }}"></script>

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
        });
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

<script type="text/javascript" data-lang='{{ App::getLocale() }}' id='targetScript' data-allow="{{ $allowMembers }}">
    $(function(){
        var postURL = "<?php echo url('addmore'); ?>";
        var i=1;
        $('.specialSelect').selectize();

        var allow = $('#targetScript').data('allow');

        if($('#dynamic_field tr').length >= allow){
            $('#add').hide();
        }
        else{
            $('#add').show();
        }

        $('#add').click(function(){
            if($('#dynamic_field tr').length <= allow){
                i++;

                $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td class="custom-form mb-3"><div class="d-flex justify-content-center mb-5"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"> <i class="fas fa-eye"></i> Hide</button></div><div class="custom-form-group d-flex justify-content-center mb-3"><h3>Member Number '+i+'</h3></div><div class="form-group custom-form-group {{ $errors->has("council_definition_id") ? "has-error" : ""}}" hidden><label for="council_definition_id" class="control-label">{{ "Council Definition" }}</label><input class="form-control" name="council_definition_id[]" type="number" id="council_definition_id" value="{{ $id}}" ></div><div class="form-group custom-form-group {{ $errors->has("faculty_member_id") ? "has-error" : ""}}"><label for="faculty_member_id" class="control-label">{{ "Faculty Member" }}</label><select class="form-control specialSelect" id="specialSelect'+i+'" name="faculty_member_id[]" required><option hidden value="">Select Faculty member</option>@foreach ($member as $obj) @if (isset($obj->User))<option value="{{ $obj->id}}">{{ $obj->User->name }}</option>@endif @endforeach</select></div> <div class="form-group custom-form-group {{ $errors->has("list_of_membership_order") ? "has-error" : ""}}"><label for="list_of_membership_order" class="control-label">{{ "Membership Order" }}</label><select class="form-control specialSelect" id="listSelect'+i+'" name="list_of_membership_order[]" required><option selected hidden value="">Select Membership Order</option>@foreach ($positions as $obj)<option value="{{ $obj->id}}">{{ $obj->position_name }}</option>@endforeach</select> </div><div class="form-group custom-form-group {{ $errors->has("start_date_of_membership") ? "has-error" : ""}}"><label for="start_date_of_membership" class="control-label">{{ "Start Date Of Membership" }}</label><input class="form-control" placeholder="Enter Start Date of membership" name="start_date_of_membership[]" type="text" id="start_date'+i+'" value="{{ isset($councilmember->start_date_of_membership) ? $councilmember->start_date_of_membership : ''}}" ></div><div class="form-group custom-form-group d-block {{ $errors->has("end_date_of_membership") ? "has-error" : ""}}"><label for="end_date_of_membership" class="control-label">{{ "End Date Of Membership" }}</label><input class="form-control" placeholder="Enter End Date of membership" name="end_date_of_membership[]" type="text" id="end_date'+i+'" value="{{ isset($councilmember->end_date_of_membership) ? $councilmember->end_date_of_membership : ''}}" ></div></td></tr>');
                $('#specialSelect'+i).selectize();
                $('#listSelect'+i).selectize();

                var lang = $('#targetScript').data('lang');
                if(lang == 'ar'){
                    $('#start_date'+i+',#end_date'+i).datepicker({
                        dateFormat: 'yy-mm-dd'
                    }, $.datepicker.regional["ar"]);

                    $('#start_date'+i+',#end_date'+i+', .ui-corner-all').on('click', function () {
                        $('.ui-icon-circle-triangle-w').text('');
                        $('.ui-icon-circle-triangle-e').text('');
                    });
                }
                else{
                    $('#start_date'+i+',#end_date'+i).datepicker({
                        dateFormat: 'yy-mm-dd'
                    });
                }
            }

            if($('#dynamic_field tr').length >= allow){
                $('#add').hide();
            }
            else{
                $('#add').show();
            }
        });

        $(document).on('click', '.btn_remove', function(){
           var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();

            if($('#dynamic_field tr').length >= allow){
                $('#add').hide();
            }
            else{
                $('#add').show();
            }
        });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#submit').click(function(){
            $.ajax({
                    url:postURL,
                    method:"POST",
                    data:$('#add_name').serialize(),
                    type:'json',
                    success:function(data)
                    {
                        if(data.error){
                            printErrorMsg(data.error);
                        }else{
                            i=1;
                            $('.dynamic-added').remove();
                            $('#add_name')[0].reset();
                            $(".print-success-msg").find("ul").html('');
                            $(".print-success-msg").css('display','block');
                            $(".print-error-msg").css('display','none');
                            $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                        }
                    }
            });
        });


        function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $(".print-success-msg").css('display','none');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
    });
</script>


@endsection
