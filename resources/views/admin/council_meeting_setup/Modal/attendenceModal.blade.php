<!-- Modal -->
<div class="modal fade" id="memberAttendence" tabindex="-1" role="dialog" aria-labelledby="attendence"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center justify-content-center">
                <h5 class="modal-title" id="attendenceLabel" style="font-size: 1.8rem; color: #2d4278;">
                    {{__("Staff.UpdateAttendance")}}

                </h5>
            </div>
            <div class="modal-body">

                @if (count($council_meeting_setup->Council_definition->CouncilMember) > 0)
                <form action="{{ url('meetingAttendence/' . $council_meeting_setup->id) }}" method="POST">
                    {{ csrf_field() }}

                    <div class="row w-100" style=" padding: 13px;">
                        <div class="col-lg-6 col-md-8 col-10">
                            <h3 style="color:#34495e;">
                                <span class="badge badge-dark" style="font-size: 1.5rem; padding: 15px;">
                                    {{__("Staff.Councilmembers")}}
                                </span>
                            </h3>
                        </div>
                    </div>

                    @foreach ($council_meeting_setup->Meeting_attendance as $key => $attendance)
                    <div class="card-header mb-2" style="background-color: #fbfbfb !important;">
                        <div class="form-group attendence-update">
                            <div class="row w-100">
                                <div class="col-lg-6 col-md-8 col-10 d-flex align-items-center">
                                    {{ $attendance->Faculty_member->User->name }}
                                </div>

                                <div class="col-lg-6 col-md-4 col-2 d-flex align-items-center">
                                    <div class="form-check form-check-primary">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input attend-check"
                                                name='attend{{ $attendance->id }}' id="ExampleRadio1"
                                                data-execuse='excuse_description{{ $attendance->id }}'
                                                {{ ($attendance->attend == 1) ? 'checked' : ''}}>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="form-group excuse_description{{ $attendance->id }} {{ ($attendance->attend == 1) ? 'd-none' : ''}}">
                            <textarea class="form-control" id="Execusedescription" rows="4" name='excuse_description[]'
                                placeholder="{{ __('placeholder.Execuse Reason') }}">{{ $attendance->excuse_description }}</textarea>
                        </div>
                    </div>
                    @endforeach
                    <div class="form-group mt-4">
                        <input class="btn btn-primary" type="submit" value="Save">
                    </div>
                </form>
                @else
                <div class="d-flex justify-content-center m-3">
                    {{__("Staff.No Council Member for this Council")}}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
