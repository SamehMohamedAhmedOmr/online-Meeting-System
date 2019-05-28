@if (Auth::user()->type == 1)
    <!-- Staff -->
    @if ($council_meeting_setup->close == 0)

        <a href="{{ url('meetingSubject/finalDesicion/'.$subject->id.'') }}" class="btn btn-github mb-2">
            {{ ($subject->final_decision != 2) ? __("Staff.edit Final Decision") : __("Staff.Addfinaldescision") }}  <i class="mdi mdi-plus inside-icon"></i>
        </a>

        <a href="{{ url('meetingSubject/edit/'.$subject->id.'') }}" class="btn btn-linkedin mb-2">
            {{__("home.Edit")}}  <i class="mdi mdi-pencil-box"></i>
        </a>

        <a href="#" class="btn btn-danger" data-toggle="modal" aria-label="deleteSubject"
            data-target="#deleteSubjectModal{{ $subject->id }}" data-id="{{ $council_meeting_setup->id }}">
            {{__("home.Delete")}}  <i class="mdi mdi-delete-forever inside-icon"></i>
        </a>
<br>
        <a href="{{ url('/topics/create/'.$council_meeting_setup->Council_definition->id.'/'.$council_meeting_setup->id) }}" class="btn btn-facebook mb-2">
          Add Topic Responders  <i class="mdi mdi-plus inside-icon"></i>
        </a>

    @endif

@else
    @if ($council_member->type == 0)
        <!-- Chairman -->
        <a href="#" id='openVotes' class="btn btn-github mb-2 voteslist" data-toggle="modal"
            data-target="#votes{{ $subject->id }}" data-id="{{ $subject->id }}" style="cursor: pointer;">
            {{__("Staff.Votes")}} <i class="mdi mdi-view-list"></i>
        </a>
    @endif

    @if ($council_meeting_setup->close == 0)
        <a href="{{ url('chat/'.$subject->id.'') }}" class="btn btn-facebook mb-2">
            {{__("Staff.Chat")}} <i class="mdi mdi-wechat inside-icon"></i>
        </a>

        <a href="#" class="btn btn-linkedin mb-2" data-toggle="modal" data-target="#singleVote{{ $subject->id }}"
            data-id="{{ $council_meeting_setup->id }}">
            {{ __('Staff.video conference') }} <i class="mdi mdi-message-video inside-icon" style="position: relative; top:2px;"></i>
        </a>

        <a href="#" class="btn btn-google" data-toggle="modal" data-target="#singleVote{{ $subject->id }}"
            data-id="{{ $council_meeting_setup->id }}">
            {{__("Staff.Votes")}} <i class="mdi mdi-plus-one inside-icon"></i>
        </a>
    @endif

@endif
