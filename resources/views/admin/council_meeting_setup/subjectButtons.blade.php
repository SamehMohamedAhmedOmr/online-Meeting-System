@if (Auth::user()->type == 1)
    <!-- Staff -->
    @if ($council_meeting_setup->close == 0)
        <a href="#" class="btn btn-danger mb-2" data-toggle="modal" aria-label="deleteSubject"
            data-target="#deleteSubjectModal{{ $subject->id }}" data-id="{{ $council_meeting_setup->id }}">
            Delete <i class="mdi mdi-delete-forever inside-icon"></i>
        </a>

        <a href="{{ url('meetingSubject/edit/'.$subject->id.'') }}" class="btn btn-behance mb-2">
            Edit <i class="mdi mdi-pencil-box"></i>
        </a>

        <a href="{{ url('meetingSubject/finalDesicion/'.$subject->id.'') }}" class="btn btn-behance">
            Add final Descision <i class="mdi mdi-plus inside-icon"></i>
        </a>
    @endif

@else
    @if ($council_member->type == 0)
        <!-- Chairman -->
        <a href="#" id='openVotes' class="btn btn-github mb-2 voteslist" data-toggle="modal"
            data-target="#votes{{ $subject->id }}" data-id="{{ $subject->id }}" style="cursor: pointer;">
            Votes <i class="mdi mdi-view-list"></i>
        </a>
    @endif

    @if ($council_meeting_setup->close == 0)
        <a href="{{ url('chat/'.$subject->id.'') }}" class="btn btn-facebook mb-2">
            Chat <i class="mdi mdi-wechat inside-icon"></i>
        </a>

        <a href="#" class="btn btn-linkedin mb-2" data-toggle="modal" data-target="#singleVote{{ $subject->id }}"
            data-id="{{ $council_meeting_setup->id }}">
            Video Conference <i class="mdi mdi-message-video inside-icon"></i>
        </a>

        <a href="#" class="btn btn-google" data-toggle="modal" data-target="#singleVote{{ $subject->id }}"
            data-id="{{ $council_meeting_setup->id }}">
            Vote <i class="mdi mdi-plus-one inside-icon"></i>
        </a>
    @endif

@endif
