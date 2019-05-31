<!-- extraAttachment Modal -->
<div class="modal fade" id="extraAttachment{{ $subject->id }}" tabindex="-1" role="dialog" aria-labelledby="votes"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center justify-content-center">
                <h5 class="modal-title" id="votesTitle" style="font-size: 1.8rem; color: #2d4278;">
                    {{ __('Staff.AddExtraAttachment') }}
                </h5>
            </div>
            <div class="modal-body">
                <form action="{{ url('addSubjectAttachment') }}" method="POST" enctype="multipart/form-data"
                    accept-charset="UTF-8">
                    {{ csrf_field() }}

                    <input type="hidden" name="Council_meeting_subject_id" value="{{ $subject->id }}">

                    <div class="form-group {{ $errors->has('attachment_document') ? 'has-error' : ''}}">
                        <input multiple class="form-control" name="attachment_document[]" type="file" required
                            id="my-file-selector">
                        {!! $errors->first('attachment_document', '<p class="help-block">:message</p>') !!}
                    </div>

                    <div class="form-group mt-4">
                        <input class="btn btn-primary" type="submit" value="{{ __('home.Save') }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script id='scriptToFile' type="text/javascript" data-lang="{{ (App::getLocale() == 'ar')?'ar':'en' }}">
    $(function () {
        var lang = $('#scriptToFile').data('lang');
        $("#my-file-selector").fileinput({
            theme: "fas",
            allowedFileExtensions: ["JPEG", "JPG", "PNG", 'doc', 'docx', 'pdf', 'xls','xlsx'],
            language: lang
        });
    });

</script>
@endsection
