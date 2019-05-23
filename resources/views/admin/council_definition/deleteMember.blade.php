<!-- Delete Modal -->
<div class="modal fade" id="deleteMemberModal{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h5 class="modal-title text-sm-center text-secondary" style="font-size: 14px;" id="exampleModalLabel">
                    {{ __('admin.delete Council Member') }}
                </h5>
                <input type="hidden" value="" id="RemoveItem">
            </div>
            <div class="modal-footer d-flex justify-content-center" style="border:none">
                <button type="button" class="btn btn-info" data-dismiss="modal">{{ __('home.Close') }}</button>
                <form action="{{ url('deleteMember') }}" method="POST">
                    @csrf
                    <input id="" type="hidden" value="{{ $item->id }}" name='id'>
                    <button type="submit" class="btn btn-danger mx-2">{{ __('home.Delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
