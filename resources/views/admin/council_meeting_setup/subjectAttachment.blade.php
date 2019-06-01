<div aria-label="Attachment" class="row mb-1">
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

            @if (Auth::user()->type == 1 && $council_meeting_setup->close == 0)
            <!-- Staff -->
            <div class="d-flex justify-content-end mb-4">
                <a class="btn btn-sm btn-dribbble" data-toggle="modal" style="color:#fff !important; cursor: pointer;"
                    data-target="#extraAttachment{{ $subject->id }}" data-id="{{ $council_meeting_setup->id }}">
                    {{__("Staff.AddExtraAttachment")}} <i class="mdi mdi-plus inside-icon"></i>
                </a>
            </div>
            @endif

            <ul class="list-unstyled mb-0">
                @foreach ($subject->Subject_attachment as $index => $attachment)
                <li class="m-2 row" style="border: 1px solid #b9bbbd !important;">
                    @php
                    if(strpos($attachment->attachment_document, '.docx') == true ||
                    strpos($attachment->attachment_document, '.doc') == true || strpos($attachment->attachment_document,
                    '.xls') == true || strpos($attachment->attachment_document, '.xlsx') == true){
                    $checkview = true;
                    }
                    else{
                    $checkview = false;
                    }
                    @endphp

                    <div
                        class="{{ (Auth::user()->type == 1 && $council_meeting_setup->close == 0)?'col-10 justify-content-start':'justify-content-center w-100' }} d-flex  align-items-center p-1 {{ (App::getLocale() == 'ar')?'pr-3' : 'pl-3' }}">
                        <a class='d-flex justify-content-start align-items-center' @if ($checkview==true)
                            href="{{ url('downloadAttachment/'.$subject->id.'/'.$attachment->id.'') }}" @else
                            data-toggle="modal" data-target="#viewAttachment{{ $attachment->id }}" @endif
                            {{-- href="{{ url('downloadAttachment/'.$subject->id.'/'.$attachment->id.'') }}" --}}
                            style="text-decoration:none; cursor: pointer; color:#000;">
                            <span>
                                {{ __('Staff.Attachment Number') }} {{ $index+1 }}
                                @if( strpos($attachment->attachment_document, '.png') !==
                                false||strpos($attachment->attachment_document, '.jpg') !==
                                false||strpos($attachment->attachment_document, '.jpeg') !== false)
                                | {{ __('Staff.Image') }}
                                @else
                                | {{ __('Staff.File') }}
                                @endif
                            </span>
                            <i class="fas fa-eye mx-2" style="color:#2ecc71;"></i>
                        </a>
                        @if ($checkview == false)
                        @include('admin.council_meeting_setup.Modal.viewAttachmentModal')
                        @endif
                    </div>

                    @if (Auth::user()->type == 1 && $council_meeting_setup->close == 0)
                    <div class="col-2 d-flex justify-content-center align-items-center position-relative"
                        style="top:-3px;">
                        <a style="text-decoration:none; cursor:pointer;" data-toggle="modal"
                            data-target="#deleteAttachmentModal{{ $attachment->id }}" data-id="{{ $attachment->id }}">
                            <i class="mdi mdi-delete-forever inside-icon"
                                style="font-size:1.5rem !important; cursor:pointer; color:#ff4747;">
                            </i>
                        </a>
                    </div>
                    @endif



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
