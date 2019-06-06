<div class="subject-accordion accordion mt-3 {{ (App::getLocale() == 'ar')?'text-right':'' }}" id="subject">

    @foreach ($subjects as $indexKey => $subject)

    <div id='voteSuccess{{ $subject->id }}'
            class='message d-none' style="width: 100%; text-align: center; color:#fff;">
        <ul class="list-unstyled">
            <li class='alert alert-success' style="direction:ltr">
                <strong style="color:#fff;">{{ __('flash_message.Votes added') }}</strong>
            </li>
        </ul>
    </div>

    <div class="card mb-3" style="overflow:initial;">

        <div class="card-header" id="heading{{ $subject->id }}">

            <h2 class="mb-0 row">

                <div aria-label="header"
                    class="col-md-10 col-12 {{ (App::getLocale() == 'ar')?'text-md-right':'text-md-left' }} text-center d-flex justify-content-md-start justify-content-center">
                    <button class="btn btn-link" type="button" data-toggle="collapse"
                        data-target="#collapse{{ $subject->id }}" aria-expanded="true" aria-controls="collapseOne"
                        style="text-align: right; line-height: 25px;">
                        <div class="title">
                            <i class="mdi mdi-library-plus"></i>
                            <span> {{__("Staff.Subject Number")}} {{ ++$indexKey }}</span>
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

                @if (Auth::user()->type == 2)
                <div aria-label="Member-Only text-center d-flex justify-content-center" class="col-12">
                    <p class="p-3 {{ (App::getLocale() == 'ar')?'pr-4':'pl-4' }}"> {{ $subject->subject_description }}
                    </p>

                    <div class="d-flex justify-content-center row">
                        <div class="col-lg-3 col-6 text-center mb-lg-0 mb-3" style="color:#71C016;">
                            <h4>{{__("home.Accepted")}}</h4>
                            <h4 class="acceptedVotes{{ $subject->id }}">{{ $subject->Votes->where('vote', 1)->count() }}
                            </h4>
                        </div>
                        <div class="col-lg-3 col-6 text-center" style="color:#FF2121;">
                            <h4>{{__("home.Rejected")}}</h4>
                            <h4 class="rejectedVotes{{ $subject->id }}">{{ $subject->Votes->where('vote', 0)->count() }}
                            </h4>
                        </div>
                        <div class="col-lg-3 col-6 text-center" style="color:#555555;">
                            <h4>{{__("home.NotVoted")}}</h4>
                            <h4 class="notVotedVotes{{ $subject->id }}">{{ $subject->Votes->where('vote', 2)->count() }}
                            </h4>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mt-3 flex-column">
                        <p class="mt-2" data-toggle="collapse" data-target="#collapse{{ $subject->id }}"
                            aria-expanded="true" aria-controls="collapseOne">
                            <i class="mdi mdi-arrow-down-bold-circle-outline icon-details"
                                style="font-size:1.8rem; color:#da3232; cursor:pointer;">
                            </i>
                        </p>
                    </div>
                </div>
                @endif

            </h2>
        </div>

        <div id="collapse{{ $subject->id }}"
            class="collapse {{ ($lastSubjectID == $subject->id && Auth::user()->type == 1)?'show':'' }}"
            aria-labelledby="heading{{ $subject->id }}" data-parent="#subject">
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

    @if (count($subjects) == 0)
    <div style="display: flex; justify-content: center; padding: 20px;">
        {{ __('home.No Subject yet.') }}
    </div>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="finalDecisionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" width="500" height="500">
          <div class="modal-body">
              <iframe  width="480" height="480" frameborder="0" allowtransparency="true" id="frame"></iframe>
          </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>

<script>
function setupVar(idea){
    var base_url = window.location.origin;
    document.getElementById("frame").src=base_url+"/meetingSubject/finalDesicion/"+idea;
}
</script>



