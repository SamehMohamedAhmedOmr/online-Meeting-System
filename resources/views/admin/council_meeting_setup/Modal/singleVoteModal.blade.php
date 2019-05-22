<!-- singleVote Modal -->
<div class="modal fade" id="singleVote{{ $subject->id }}" tabindex="-1" role="dialog" aria-labelledby="votes"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center justify-content-center">
                <h5 class="modal-title" id="votesTitle" style="font-size: 1.8rem; color: #2d4278;">
                    {{__("Staff.addvote")}}
                </h5>
            </div>
            <div class="modal-body">
                <form action="{{ url('addVote') }}" method="GET">
                    {{ csrf_field() }}

                    <input type="hidden" name="Council_meeting_subject_id" value="{{ $subject->id }}">

                    <div class="form-group">
                        @php
                           if($council_member){
                                $check = $subject->Votes->where('council_member_id',$council_member->id)->first();
                            }
                           else{
                               $check = null;
                            }
                        @endphp
                        <div class="row">
                            <div class="col-sm-3 {{ (App::getLocale() == 'ar')?'mr-sm-3 ml-sm-5':'ml-sm-3 mr-sm-5' }}">
                                <div class="form-check d-sm-flex text-sm-center ">
                                    <label class="form-check-label w-100">
                                        <input type="radio" class="form-check-input" name="vote"
                                            id="membershipRadios1" value="1" required
                                            @if ($check)
                                            {{ ($check->vote != 0) ? 'checked' : '' }}
                                            @endif >
                                            {{__("Staff.accept")}}

                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-check d-sm-flex text-sm-center">
                                    <label class="form-check-label w-100">
                                        <input type="radio" class="form-check-input" name="vote"
                                            id="membershipRadios2" value="0" required
                                            @if ($check)
                                                {{ ($check->vote == 0) ? 'checked' : '' }}
                                            @endif>
                                            {{__("Staff.reject")}}

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="voteComment" class="d-block">{{__("Staff.comment")}}
</label>
                        <textarea class="form-control" id="voteComment" rows="4"
                            name='commet'>@if ($check){{ $check->commet }}@endif</textarea>
                    </div>

                    <div class="form-group mt-4">
                        <input class="btn btn-primary" type="submit" value="{{__("home.Save")}}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
