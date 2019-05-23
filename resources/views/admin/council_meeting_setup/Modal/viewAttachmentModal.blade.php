<!-- Votes Modal -->
<div class="modal fade votes-modal" id="viewAttachment{{ $attachment->id }}" tabindex="-1" role="dialog" aria-labelledby="votes"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center justify-content-center">
                <h5 class="modal-title" id="votesTitle" style="font-size: 1.8rem; color: #2d4278;">
                    {{__("Staff.Attachment View")}}  {{ $attachment->id }}
                </h5>
            </div>
            <div class="modal-body">

            @if( strpos($attachment->attachment_document, '.png') !== false||strpos($attachment->attachment_document, '.jpg') !== false||strpos($attachment->attachment_document, '.jpeg') !== false)
            <img src ="{{ asset('/storage/subject_att/'.$attachment->id.'/'.$attachment->attachment_document) }}" ></img>
            @elseif( strpos($attachment->attachment_document, '.pdf') !== false)
            <iframe src ="{{ asset('/storage/subject_att/'.$attachment->id.'/'.$attachment->attachment_document) }}" width="1000px" height="600px"></iframe>
            @else
            <iframe src ="{{ asset('/storage/subject_att/'.$attachment->id.'/'.$attachment->attachment_document) }}"></iframe>
            @endif
            </div>
        </div>
    </div>
</div>


