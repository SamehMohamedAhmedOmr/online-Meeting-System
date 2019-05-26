<!-- Delete Modal -->
<div class="modal fade" id="deleteSubjectModal{{ $subject->id }}" tabindex="-1" role="dialog"
    aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h5 class="modal-title text-sm-center text-secondary" style="font-size: 14px;" id="exampleModalLabel">
                    {{__("Staff.Subject will Delete Permanently , Are you sure ?")}}
                </h5>
                <input type="hidden" value="" id="RemoveItem">
            </div>
            <div class="modal-footer d-flex justify-content-center" style="border:none">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                <form action="{{ url('meetingSubject/delete') }}" method="POST">
                    @csrf
                    <input id="" type="hidden" value="{{ $subject->id }}" name='id'>
                    <button type="submit" class="btn btn-danger mx-2">{{__("home.Delete")}}
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
