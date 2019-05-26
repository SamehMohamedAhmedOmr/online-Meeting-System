<div aria-label="finalDecision" class="row mb-3">
    <div class="col-md-4 subject-specific-data">
        <label class="btn subject-title
                    @if ($subject->final_decision == 2) {{ 'btn-secondary'}}
                    @elseif ($subject->final_decision == 1) {{ 'btn-success'}}
                    @elseif ($subject->final_decision == 0) {{ 'btn-danger' }}
                    @endif">

            <i class="fas fa-balance-scale menu-icon"></i>
            <span
                class="{{ (App::getLocale() == 'ar')?'mr-3':'ml-3' }}">{{__("Staff.Finaldecision")}}</span>
        </label>
    </div>
    <div class="col-md-8 subject-specific-data">
        <label class="btn btn-outline-dark btn-fw subject-data">
            <span class="p-2
                    @if ($subject->final_decision == 2) {{ 'btn-secondary'}}
                    @elseif ($subject->final_decision == 1) {{ 'btn-success'}}
                    @elseif ($subject->final_decision == 0) {{ 'btn-danger' }}
                    @endif">

                @if ($subject->final_decision == 2) {{ __('Staff.Waiting')}}
                @elseif ($subject->final_decision == 1) {{ __('Staff.accept') }}
                @elseif ($subject->final_decision == 0) {{ __('Staff.reject') }}
                @endif

            </span>
        </label>
    </div>
</div>

<div aria-label="finalDecisionDescription" class="row mb-3">
    <div class="col-md-4 subject-specific-data">
        <label class="btn subject-title
                        @if ($subject->final_decision == 2) {{ 'btn-secondary'}}
                        @elseif ($subject->final_decision == 1) {{ 'btn-success'}}
                        @elseif ($subject->final_decision == 0) {{ 'btn-danger' }}
                        @endif">

            <i class="fas fa-edit menu-icon"></i>
            <span class="{{ (App::getLocale() == 'ar')?'mr-3':'ml-3' }}">
                    {{ __('Staff.Final Decision Description') }}
            </span>
        </label>
    </div>
    <div class="col-md-8 subject-specific-data">
        <label class="btn btn-outline-dark btn-fw subject-data">
            <span class="p-2">
                {{ $subject->final_decision_description }}
            </span>
        </label>
    </div>
</div>

<div aria-label="personRedirect" class="row mb-3">
    <div class="col-md-4 subject-specific-data">
        <label class="btn btn-primary subject-title">
            <i class="fas fa-user-tie  menu-icon"></i>
            <span
                class="{{ (App::getLocale() == 'ar')?'mr-3':'ml-3' }}">{{__("Staff.Personredirected")}}</span>
        </label>
    </div>
    <div class="col-md-8 subject-specific-data">
        <label class="btn btn-outline-dark btn-fw subject-data">
            {{ (isset($subject->PersonRedirect)?$subject->PersonRedirect->name :'none') }}
        </label>
    </div>
</div>

<div aria-label="next_council_definition" class="row mb-3">
    <div class="col-md-4 subject-specific-data">
        <label class="btn btn-primary subject-title">
            <i class="fas fa-clipboard-list menu-icon"></i>
            <span
                class="{{ (App::getLocale() == 'ar')?'mr-3':'ml-3' }}">{{__("Staff.Nextcouncildefinition")}}</span>
        </label>
    </div>
    <div class="col-md-8 subject-specific-data">
        <label class="btn btn-outline-dark btn-fw subject-data">
            {{ (isset($subject->next_council_definition)?$subject->next_council_definition->council_name :'none') }}
        </label>
    </div>
</div>
