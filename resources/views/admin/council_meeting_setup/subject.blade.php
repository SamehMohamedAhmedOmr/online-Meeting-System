<div class="subject-accordion accordion mt-3 {{ (App::getLocale() == 'ar')?'text-right':'' }}" id="subject">

    @foreach ($subjects as $indexKey => $subject)
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
                            <span> {{__("Staff.Subject Number")}} {{ ++$indexKey }} -
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
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical" style="font-size:1.4rem !important;"></i>
                        </button>
                        <div class="dropdown-menu" style="width:230px; padding:5px; top:14px !important;">
                            @include('admin.council_meeting_setup.subjectButtons')
                        </div>
                    </div>
                </div>
            </h2>
        </div>

        <div id="collapse{{ $subject->id }}" class="collapse show" aria-labelledby="heading{{ $subject->id }}"
            data-parent="#subject">
            <div class="card-body">


                @include('admin.council_meeting_setup.commonSubjectData')



                @include('admin.council_meeting_setup.subjectAttachment')


                @if (Auth::user()->type == 2)
                    <!-- Member -->
                    @include('admin.council_meeting_setup.myVoteonSubject')
                @endif

                @if ($subject->final_decision != 2)

                    @include('admin.council_meeting_setup.finalDecision')

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
