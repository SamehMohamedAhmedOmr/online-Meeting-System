<div class="subject-accordion accordion mt-3 {{ (App::getLocale() == 'ar')?'text-right':'' }}" id="subject">

    @if (Auth::user()->type == 1 && $council_meeting_setup->close == 0) <!-- Staff -->
        <div class="d-flex justify-content-center align-items-center my-4">
            <a class="btn btn-facebook" href="{{ url('meetingSubject/create/'.$council_meeting_setup->id.'') }}">
                {{__("Staff.Addnewsubject")}}
            </a>
        </div>
    @endif

    @foreach ($subjects  as $indexKey => $subject)
    <div class="card mb-5">
        <div class="card-header" id="heading{{ $subject->id }}">
            <h2 class="mb-0 row">

                <div aria-label="header"
                    class="col-md-10 col-12 {{ (App::getLocale() == 'ar')?'text-md-right':'text-md-left' }} text-center d-flex justify-content-md-start justify-content-center">
                    <button class="btn btn-link" type="button" data-toggle="collapse"
                        data-target="#collapse{{ $subject->id }}" aria-expanded="true" aria-controls="collapseOne"
                        style="text-align: right; line-height: 25px;">
                        <div class="title">
                            <i class="mdi mdi-library-plus"></i>
                            <span>  {{__("Staff.Subject")}} {{ ++$indexKey }} -
                                <span style="color: #E91E63; !important">
                                    {{ $subject->Subject_type->subject_type_name }}
                                </span>
                            </span>
                        </div>
                    </button>
                </div>

                <div aria-label="Buttons"
                    class="buttons-holders justify-content-md-end justify-content-center col-md-2 col-12 mt-md-0 mt-3 {{ (App::getLocale() == 'ar')?'text-md-left':'text-md-right' }} text-center">

                    <!-- Default dropright button -->
                    <div class="btn-group subject-dropdown">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical" style="font-size:1.4rem !important;"></i>
                        </button>
                        <div class="dropdown-menu" style="width:230px; padding:5px">
                            @include('admin.council_meeting_setup.subjectButtons')
                        </div>
                    </div>
                </div>
            </h2>
        </div>

        <div id="collapse{{ $subject->id }}" class="collapse show" aria-labelledby="heading{{ $subject->id }}"
            data-parent="#subject">
            <div class="card-body">

                <div aria-label="Faculty" class="row mb-3">
                    <div class="col-md-4 subject-specific-data">
                        <label class="btn btn-dark subject-title">
                            <i class="fas fa-graduation-cap menu-icon"></i>
                            <span class="{{ (App::getLocale() == 'ar')?'mr-3':'ml-3' }}">{{__("admin.faculty")}}</span>
                        </label>
                    </div>
                    <div class="col-md-8 subject-specific-data">
                        <label class="btn btn-outline-dark btn-fw subject-data">
                            {{ $subject->Faculty->faculty_name }}
                        </label>
                    </div>
                </div>

                <div aria-label="Department" class="row mb-3">
                    <div class="col-md-4 subject-specific-data">
                        <label class="btn btn-dark subject-title">
                            <i class="fas fa-server menu-icon"></i>
                            <span class="{{ (App::getLocale() == 'ar')?'mr-3':'ml-3' }}">{{__("admin.Department")}}</span>
                        </label>
                    </div>
                    <div class="col-md-8 subject-specific-data">
                        <label class="btn btn-outline-dark btn-fw subject-data">
                            {{ $subject->Department->department_name }}
                        </label>
                    </div>
                </div>

                <div aria-label="SubjectType" class="row mb-3">
                    <div class="col-md-4 subject-specific-data">
                        <label class="btn btn-dark subject-title">
                            <i class="mdi mdi-book-open-page-variant menu-icon"></i>
                            <span class="{{ (App::getLocale() == 'ar')?'mr-3':'ml-3' }}">{{__("Staff.Subject")}}</span>
                        </label>
                    </div>
                    <div class="col-md-8 subject-specific-data">
                        <label class="btn btn-outline-dark btn-fw subject-data">
                            {{ $subject->Subject_type->subject_type_name }}
                        </label>
                    </div>
                </div>

                <div aria-label="Description" class="row mb-3">
                    <div class="col-md-4 subject-specific-data">
                        <label class="btn btn-dark subject-title">
                            <i class="fas fa-edit menu-icon"></i>
                            <span class="{{ (App::getLocale() == 'ar')?'mr-3':'ml-3' }}">{{__("home.Description")}}</span>
                        </label>
                    </div>
                    <div class="col-md-8 subject-specific-data">
                        <label class="btn btn-outline-dark btn-fw subject-data">
                            {{ $subject->subject_description }}
                        </label>
                    </div>
                </div>

                <div aria-label="additional_subject" class="row mb-3">
                    <div class="col-md-4 subject-specific-data">
                        <label class="btn btn-dark subject-title">
                            <i class="fas-fa-project-diagram menu-icon"></i>
                            <span class="{{ (App::getLocale() == 'ar')?'mr-3':'ml-3' }}">{{__("Staff.Additionalsubject")}}</span>
                        </label>
                    </div>
                    <div class="col-md-8 subject-specific-data">
                        <label class="btn btn-outline-dark btn-fw subject-data">
                            @if ($subject->additional_subject)
                            <i class="mdi mdi-checkbox-marked-circle-outline green"></i>
                            @else
                            <i class="mdi mdi-close-circle-outline red"></i>
                            @endif
                        </label>
                    </div>
                </div>

                <div aria-label="Attachment" class="row mb-3">
                    <div class="col-md-4 subject-specific-data">
                        <label class="btn btn-dribbble subject-title">
                            <i class="mdi mdi-attachment menu-icon" style="font-size: 1.3rem !important;"></i>
                            <span class="{{ (App::getLocale() == 'ar')?'mr-3':'ml-3' }}">
                                {{__("home.Attachment")}}
                            </span>
                        </label>
                    </div>
                    <div class="col-md-8 subject-specific-data">
                        <label class="btn btn-outline-dark btn-fw subject-data">

                            @if (Auth::user()->type == 1 && $council_meeting_setup->close == 0) <!-- Staff -->
                                <div class="d-flex justify-content-end mb-4">
                                    <a class="btn btn-sm btn-dribbble" data-toggle="modal"
                                        style="color:#fff !important; cursor: pointer;"
                                        data-target="#extraAttachment{{ $subject->id }}"
                                        data-id="{{ $council_meeting_setup->id }}">
                                        {{__("Staff.AddExtraAttachment")}} <i class="mdi mdi-plus inside-icon"></i>
                                    </a>
                                </div>
                            @endif

                            <ul class="list-unstyled mb-0">
                                @foreach ($subject->Subject_attachment as $attachment)
                                <li class="m-2 row" style="border: 1px solid #b9bbbd !important;">

                                    @if (Auth::user()->type == 1 && $council_meeting_setup->close == 0)
                                        <div class="col-2 d-flex justify-content-center align-items-center position-relative"
                                            style="top:-3px;">
                                            <a style="text-decoration:none; cursor:pointer;" data-toggle="modal"
                                                data-target="#deleteAttachmentModal{{ $attachment->id }}"
                                                data-id="{{ $attachment->id }}">
                                                <i class="mdi mdi-delete-forever inside-icon"
                                                    style="font-size:1.5rem !important; cursor:pointer; color:#ff4747;">
                                                </i>
                                            </a>
                                        </div>
                                    @endif

                                    <div class="{{ (Auth::user()->type == 1 && $council_meeting_setup->close == 0)?'col-10 justify-content-start':'justify-content-center w-100' }} d-flex  align-items-center p-1">
                                        <a class='d-flex justify-content-start align-items-center'
                                            {{-- href="{{ url('downloadAttachment/'.$subject->id.'/'.$attachment->id.'') }}" --}}
                                            style="text-decoration:none; cursor: pointer;"
                                            data-toggle="modal" data-target="#viewAttachment{{ $attachment->id }}">
                                            <span>{{  $attachment->attachment_document}}</span>
                                            <i class="fas fa-download mx-2" style="color:#2ecc71;"></i>
                                        </a>
                                        @include('admin.council_meeting_setup.Modal.viewAttachmentModal')
                                    </div>
                                </li>
                                    @if(Auth::user()->type == 1 && $council_meeting_setup->close == 0)
                                        @include('admin.council_meeting_setup.Modal.deleteSpecificAttachment')
                                    @endif

                                @endforeach

                                @if (count($subject->Subject_attachment) == 0)
                                <li>
                                    {{__("Staff.Noattachment")}}
                                </li>
                                @endif
                            </ul>
                        </label>
                    </div>
                </div>

                @if (Auth::user()->type == 2) <!-- Member -->
                    @php
                        $check = $subject->Votes->where('council_member_id',$council_member->id)->first();
                    @endphp
                    @if (isset($check) && $check->vote !=2)
                        <div aria-label="additional_subject" class="row mb-3">
                            <div class="col-md-4 subject-specific-data">
                                <label class="btn btn-info subject-title">
                                    <i class="fas-fa-project-diagram menu-icon"></i>
                                    <span class="{{ (App::getLocale() == 'ar')?'mr-3':'ml-3' }}">{{__("Staff.My Vote")}}</span>
                                </label>
                            </div>
                            <div class="col-md-8 subject-specific-data">
                                <label class="btn btn-outline-dark btn-fw subject-data">
                                    <div>
                                        @if ($check->vote)
                                        <i class="mdi mdi-checkbox-marked-circle-outline green"></i>
                                        @else
                                        <i class="mdi mdi-close-circle-outline red"></i>
                                        @endif
                                    </div>
                                    <div style="border: 1px solid #b9bbbd !important;" class="mt-2">
                                        {{ $check->commet }}
                                    </div>
                                </label>
                            </div>
                        </div>
                    @endif
                @endif

                @if ($subject->final_decision != 2)
                    <div aria-label="finalDecision" class="row mb-3">
                        <div class="col-md-4 subject-specific-data">
                            <label class="btn subject-title
                                    @if ($subject->final_decision == 2) {{ 'btn-secondary'}}
                                    @elseif ($subject->final_decision == 1) {{ 'btn-success'}}
                                    @elseif ($subject->final_decision == 0) {{ 'btn-danger' }}
                                    @endif">

                                <i class="fas fa-balance-scale menu-icon"></i>
                                <span class="{{ (App::getLocale() == 'ar')?'mr-3':'ml-3' }}">{{__("Staff.Finaldecision")}}</span>
                            </label>
                        </div>
                        <div class="col-md-8 subject-specific-data">
                            <label class="btn btn-outline-dark btn-fw subject-data">
                                <span class="p-2
                                    @if ($subject->final_decision == 2) {{ 'btn-secondary'}}
                                    @elseif ($subject->final_decision == 1) {{ 'btn-success'}}
                                    @elseif ($subject->final_decision == 0) {{ 'btn-danger' }}
                                    @endif">

                                    @if ($subject->final_decision == 2) {{ 'Waiting'}}
                                    @elseif ($subject->final_decision == 1) {{ 'Accepted'}}
                                    @elseif ($subject->final_decision == 0) {{ 'Rejected' }}
                                    @endif

                                </span>
                            </label>
                        </div>
                    </div>

                    <div aria-label="finalDecisionDescription" class="row mb-3">
                        <div class="col-md-4 subject-specific-data">
                            <label class="btn subject-title
                                        @if ($subject->final_decision == 2) {{ 'btn-secondary'}}
                                        @elseif ($subject->final_decision == 1) {{ 'btn-success'}}
                                        @elseif ($subject->final_decision == 0) {{ 'btn-danger' }}
                                        @endif">

                                <i class="fas fa-edit menu-icon"></i>
                                <span class="{{ (App::getLocale() == 'ar')?'mr-3':'ml-3' }}">{{__("Staff.Finaldecision")}}
                                    {{__("home.Description")}}</span>
                            </label>
                        </div>
                        <div class="col-md-8 subject-specific-data">
                            <label class="btn btn-outline-dark btn-fw subject-data">
                                <span class="p-2">
                                    {{ $subject->final_decision_description }}
                                </span>
                            </label>
                        </div>
                    </div>

                    <div aria-label="personRedirect" class="row mb-3">
                        <div class="col-md-4 subject-specific-data">
                            <label class="btn btn-primary subject-title">
                                <i class="fas fa-user-tie  menu-icon"></i>
                                <span class="{{ (App::getLocale() == 'ar')?'mr-3':'ml-3' }}">{{__("Staff.Personredirected")}}</span>
                            </label>
                        </div>
                        <div class="col-md-8 subject-specific-data">
                            <label class="btn btn-outline-dark btn-fw subject-data">
                                {{ (isset($subject->PersonRedirect)?$subject->PersonRedirect->name :'none') }}
                            </label>
                        </div>
                    </div>

                    <div aria-label="next_council_definition" class="row mb-3">
                        <div class="col-md-4 subject-specific-data">
                            <label class="btn btn-primary subject-title">
                                <i class="fas fa-clipboard-list menu-icon"></i>
                                <span class="{{ (App::getLocale() == 'ar')?'mr-3':'ml-3' }}">{{__("Staff.Nextcouncildefinition")}}</span>
                            </label>
                        </div>
                        <div class="col-md-8 subject-specific-data">
                            <label class="btn btn-outline-dark btn-fw subject-data">
                                {{ (isset($subject->next_council_definition)?$subject->next_council_definition->council_name :'none') }}
                            </label>
                        </div>
                    </div>
                @endif

            </div>
        </div>



        @if (Auth::user()->type == 1 && $council_meeting_setup->close == 0)
            @include('admin.council_meeting_setup.Modal.deleteSubjectModal')

            @include('admin.council_meeting_setup.Modal.extraAttachmentModal')
        @endif


        @if (Auth::user()->type == 2)
            @if ($council_member->type == 0)
                @include('admin.council_meeting_setup.Modal.votesModal')
            @endif
            @include('admin.council_meeting_setup.Modal.singleVoteModal')
        @endif
    </div>
    @endforeach

</div>
