
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tables.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/selectize.bootstrap3.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/specialFileInput.css') }}" />
@endsection
<div class="table-responsive">
    <table class="table table-bordered" id="dynamic_field">
        <tr>
            <td class="mb-3">
                <div class="d-flex justify-content-center mb-3">
                    <h3>{{ __('admin.Member Number') }} 1</h3>
                </div>
                <div class="form-group {{ $errors->has('council_definition_id[]') ? 'has-error' : ''}}" hidden>
                    <label for="council_definition_id" class="control-label">{{ 'Council Definition' }}</label>
                    <input class="form-control" name="council_definition_id[]" type="number" id="council_definition_id" value="{{ $id}}" >
                    {!! $errors->first('council_definition_id[]', '<p class="help-block">:message</p>') !!}
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('faculty_member_id.0') ? 'has-error' : ''}}  ">
                            <label for="faculty_member_id" class="control-label">{{ __('admin.Member Name') }} <span style="color:red !important;">*</span></label>
                            <select class="form-control specialSelect" name="faculty_member_id[]" required>
                                    <option selected hidden value="">{{ __('placeholder.Select Council Member') }}</option>

                                    @foreach ($member as $obj)
                                        @if (old('faculty_member_id')[0] != null && old('faculty_member_id')[0] == $obj->id)
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
                                </select>
                            {!! $errors->first('faculty_member_id.0', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('list_of_membership_order.0') ? 'has-error' : ''}}  ">
                            <label for="list_of_membership_order" class="control-label">{{ __('admin.list_of_membership_order') }} <span style="color:red !important;">*</span></label>
                            <input class="form-control" name="list_of_membership_order[]" type="number" id="list_of_membership_order" required>
                           {!! $errors->first('faculty_member_id.0', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('start_date_of_membership.0') ? 'has-error' : ''}}  ">
                            <label for="start_date_of_membership" class="control-label">{{ __('admin.Start Date Of Membership') }} <span style="color:red !important;">*</span></label>
                            <input class="form-control" placeholder="{{ __('placeholder.enter start_date_of_membership') }}" required
                            name="start_date_of_membership[]" type="text" id="datepicker" value="{{ old('start_date_of_membership')[0] }}" >
                            {!! $errors->first('start_date_of_membership.0', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('end_date_of_membership.0') ? 'has-error' : ''}}   d-block">
                            <label for="end_date_of_membership" class="control-label">{{ __('admin.End Date Of Membership') }} <span style="color:red !important;">*</span></label>
                            <input class="form-control" placeholder="{{ __('placeholder.enter end_date_of_membership') }}" required
                             name="end_date_of_membership[]" type="text" id="datepicker2" value="{{ old('end_date_of_membership')[0] }}" >
                            {!! $errors->first('end_date_of_membership.0', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <div class="form-group d-flex justify-content-center mb-5 my-3">
        <button type="button" name="add" id="add" class="btn btn-success">{{ __('admin.Add More') }}</button>
    </div>
    <div class="form-group d-flex justify-content-center">
        <input class="btn btn-primary w-50" type="submit" value="{{  __('home.Save') }}">
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

    <script type="text/javascript" data-lang='{{ App::getLocale() }}' id='targetScript' data-allow="{{ $allowMembers }}"
        data-formID="{{$id}}">

        $(function(){
            var formID = $('#targetScript').data('formID');

            var postURL = "<?php echo url('addmore'); ?>";
            var i=1;
            var incremental=1;
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
                    incremental++;

                    var startTr = '<tr id="row'+i+'" class="dynamic-added"><td class="mb-3"><div class="d-flex justify-content-center mb-5"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"> <i class="fas fa-eye"></i> {{ __("admin.hide") }}</button></div><div class="  d-flex justify-content-center mb-3"><h3 class="memberNumber">{{ __("admin.Member Number") }} <span>'+incremental+'</span> </h3></div>'

                    var definitionName = '<div class="form-group {{ $errors->has("council_definition_id") ? "has-error" : ""}}" hidden><label for="council_definition_id" class="control-label">{{ "Council Definition" }}</label><input class="form-control" name="council_definition_id[]" type="number" id="council_definition_id" value="{{ $id}}" ></div>';

                    var startRow = '<div class="row">';
                    var startCol = '<div class="col-md-6">';
                    var endtCol = '</div>';
                    var endRow = '</div>';

                    // Member Template
                    var memberForeach = '@foreach ($member as $obj)<option value="{{ $obj->id}}">@if (isset($obj->User)){{ $obj->User->name }}@endif</option> @endforeach';
                    var memberName = '<div class="form-group ><label for="faculty_member_id" class="control-label">{{ __("admin.Member Name") }} <span style="color:red !important;">*</span></label><select class="form-control specialSelect" id="specialSelect'+i+'" name="faculty_member_id[]" required><option hidden value="">{{ __("placeholder.Select Council Member") }}</option>'+memberForeach+'</select> </div>';
                    var memberTag = startCol + memberName + endtCol;

                    // Membership Template
                    var memberShipOrderForeach = '@foreach ($positions as $obj) <option value="{{ $obj->id}}">{{ $obj->position_name }}</option> @endforeach';
                    var memberShipOrder = '<div class="form-group"><label for="list_of_membership_order" class="control-label">{{ __("admin.list_of_membership_order") }} <span style="color:red !important;">*</span></label><input class="form-control" name="list_of_membership_order[]" type="number" id="list_of_membership_order" required></div>';
                    var memberShipTag = startCol + memberShipOrder + endtCol;

                    // First Row
                    var firstRow = startRow + memberTag + memberShipTag + endRow;

                    // StartDate Template
                    var startMemberShipDate = '<div class="form-group"><label for="start_date_of_membership" class="control-label">{{ __("admin.Start Date Of Membership") }} <span style="color:red !important;">*</span></label><input class="form-control" placeholder="{{ __("placeholder.enter start_date_of_membership") }}" name="start_date_of_membership[]" type="text" id="start_date'+i+'" required value="" > </div>';

                    var startMemberShipTag = startCol + startMemberShipDate + endtCol;

                    // EndDate Template
                    var endMemberShipDate = '<div class="form-group d-block"><label for="end_date_of_membership" class="control-label">{{ __("admin.End Date Of Membership") }} <span style="color:red !important;">*</span></label><input class="form-control" placeholder="{{ __("placeholder.enter end_date_of_membership") }}" name="end_date_of_membership[]" type="text" id="end_date'+i+'" required  value="" >  </div>';

                    var endMemberShipTag = startCol + endMemberShipDate + endtCol;

                    // Second Row
                    var secondRow = startRow + startMemberShipTag + endMemberShipTag + endRow;

                    // End Tr
                    var endTr = '</td></tr>';

                    var newTr = startTr + definitionName + firstRow + secondRow + endTr;

                    $('#dynamic_field').append(newTr);
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
                incremental--;
                var MemberNumber = 2;
                $('.memberNumber span').each(function(){
                    $(this).text(MemberNumber);
                    MemberNumber++;
                });

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
