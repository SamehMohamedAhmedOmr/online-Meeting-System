<div class="attendence-accordion accordion mt-3 {{ (App::getLocale() == 'ar')?'text-right':'' }}" id="subject">

    @if ($council_meeting_setup->close == 0)
        <div class="d-flex justify-content-center align-items-center my-4">
            <button type='button' class="btn btn-facebook" data-toggle="modal" data-target="#memberAttendence">
                Update Attendance
            </button>
        </div>
    @endif


    @foreach ($council_meeting_setup->Meeting_attendance as $indexKey => $attendance)
    <div class="card mb-5">
        <div class="card-header" id="heading{{ $attendance->id }}">
            <h2 class="mb-0 row">

                <div class="col-lg-6 col-md-8 col-9 {{ (App::getLocale() == 'ar')?'text-right':'text-left' }}">
                    <button class="btn btn-link w-100 {{ (App::getLocale() == 'ar')?'text-right':'text-left' }}"
                        type="button" data-toggle="collapse" data-target="#collapse{{ $attendance->id }}"
                        aria-expanded="true" aria-controls="collapseOne">
                        <div class="title">
                            <span style="line-height:30px;">
                                {{ $attendance->Faculty_member->User->name }}
                            </span>
                        </div>
                    </button>
                </div>
                <div class="col-lg-6 col-md-4 col-3 d-flex align-items-center">
                    <label class="p-2 mb-0
                                @if ($attendance->attend == 1) {{ 'btn-success'}}
                                @elseif ($attendance->attend == 0) {{ 'btn-danger' }}
                                @endif"
                        style="border-radius: 50%; width: 40px; height: 40px !important; line-height: 25px;">

                        @if ($attendance->attend == 1)
                        <i class="mdi mdi-check" style="font-size: 1.5rem !important;"></i>
                        @elseif ($attendance->attend == 0)
                        <i class="mdi mdi-close" style="font-size: 1.5rem !important;"></i>
                        @endif

                    </label>
                </div>
            </h2>
        </div>

        @if ($attendance->attend == 0 && isset($attendance->excuse_description))
        <div id="collapse{{ $attendance->id }}" class="collapse show" aria-labelledby="heading{{ $attendance->id }}"
            data-parent="#subject">
            <div class="card-body">
                <div aria-label="members" class="row mb-3">
                    <div class="col-12 subject-specific-data">
                        <label
                            class="btn btn-outline-dark btn-fw subject-data d-flex justify-content-center align-items-center flex-column">

                            <span class="d-block">
                                {{ $attendance->excuse_description }}
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
    @endforeach

</div>

@if ($council_meeting_setup->close == 0)
    @include('admin.council_meeting_setup.Modal.attendenceModal')
    @section('AttendenceScripts')
        <script type="text/javascript">
            $(function() {

                $(".attend-check").on('change',function(){
                    var execuse = $(this).data('execuse');
                    var execuseDis = $('.' + execuse);
                    if($(this).prop("checked") == true){ // hide
                        execuseDis.addClass('d-none');
                    }
                    else if($(this).prop("checked") == false){ // show
                        execuseDis.removeClass('d-none');
                    }
                });
            });
        </script>
    @endsection
@endif


