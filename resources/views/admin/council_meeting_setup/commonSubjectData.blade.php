<div aria-label="Faculty" class="row mb-3">
    <div class="col-md-4 subject-specific-data">
        <label class="btn btn-dark subject-title">
            <i class="fas fa-graduation-cap menu-icon"></i>
            <span class="{{ (App::getLocale() == 'ar')?'mr-3':'ml-3' }}">{{__("admin.faculty")}}</span>
        </label>
    </div>
    <div class="col-md-8 subject-specific-data">
        <label class="btn btn-outline-dark btn-fw subject-data">
            {{ $subject->Faculty->faculty_name }}
        </label>
    </div>
</div>

<div aria-label="Department" class="row mb-3">
    <div class="col-md-4 subject-specific-data">
        <label class="btn btn-dark subject-title">
            <i class="fas fa-server menu-icon"></i>
            <span
                class="{{ (App::getLocale() == 'ar')?'mr-3':'ml-3' }}">{{__("admin.Department")}}</span>
        </label>
    </div>
    <div class="col-md-8 subject-specific-data">
        <label class="btn btn-outline-dark btn-fw subject-data">
            {{ $subject->Department->department_name }}
        </label>
    </div>
</div>

<div aria-label="SubjectType" class="row mb-3">
    <div class="col-md-4 subject-specific-data">
        <label class="btn btn-dark subject-title">
            <i class="mdi mdi-book-open-page-variant menu-icon"></i>
            <span class="{{ (App::getLocale() == 'ar')?'mr-3':'ml-3' }}">{{__("Staff.Subject")}}</span>
        </label>
    </div>
    <div class="col-md-8 subject-specific-data">
        <label class="btn btn-outline-dark btn-fw subject-data">
            {{ $subject->Subject_type->subject_type_name }}
        </label>
    </div>
</div>

<div aria-label="Description" class="row mb-3">
    <div class="col-md-4 subject-specific-data">
        <label class="btn btn-dark subject-title">
            <i class="fas fa-edit menu-icon"></i>
            <span
                class="{{ (App::getLocale() == 'ar')?'mr-3':'ml-3' }}">{{__("home.Description")}}</span>
        </label>
    </div>
    <div class="col-md-8 subject-specific-data">
        <label class="btn btn-outline-dark btn-fw subject-data">
            {{ $subject->subject_description }}
        </label>
    </div>
</div>

<div aria-label="additional_subject" class="row mb-3">
    <div class="col-md-4 subject-specific-data">
        <label class="btn btn-dark subject-title">
            <i class="fas-fa-project-diagram menu-icon"></i>
            <span
                class="{{ (App::getLocale() == 'ar')?'mr-3':'ml-3' }}">{{__("Staff.Additionalsubject")}}</span>
        </label>
    </div>
    <div class="col-md-8 subject-specific-data">
        <label class="btn btn-outline-dark btn-fw subject-data">
            @if ($subject->additional_subject)
            <i class="mdi mdi-checkbox-marked-circle-outline green"></i>
            @else
            <i class="mdi mdi-close-circle-outline red"></i>
            @endif
        </label>
    </div>
</div>
