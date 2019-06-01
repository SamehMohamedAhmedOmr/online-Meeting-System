@php
$check = $subject->Votes->where('council_member_id',$council_member->id)->first();
@endphp
@if (isset($check) && $check->vote !=2)
<div aria-label="My Vote" class="row mb-1">
    <div class="col-md-4 subject-specific-data">
        <label class="btn btn-info subject-title">
            <i class="fas-fa-project-diagram menu-icon"></i>
            <span class="{{ (App::getLocale() == 'ar')?'mr-3':'ml-3' }}">{{__("Staff.My Vote")}}</span>
        </label>
    </div>
    <div class="col-md-8 subject-specific-data">
        <label class="btn btn-outline-dark btn-fw subject-data">
            <div>
                @if ($check->vote)
                <i class="mdi mdi-checkbox-marked-circle-outline green"></i>
                @else
                <i class="mdi mdi-close-circle-outline red"></i>
                @endif
            </div>
            @if (isset($check->commet))
            <div style="border: 1px solid #b9bbbd !important;" class="mt-2">
                {{ $check->commet }}
            </div>
            @endif
        </label>
    </div>
</div>
@endif
