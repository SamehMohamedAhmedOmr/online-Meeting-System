<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('setlocale/{locale}', function ($locale) {
    if (in_array($locale, \Config::get('app.locales'))) {
        //Session::put('locale', $locale);
        return redirect()->back()->withCookie(cookie()->forever('locale', $locale));
    }
    return redirect()->back()->withCookie(cookie()->forever('locale', 'en')); // default
});

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });
    Route::get('login', function () {
        return view('auth.login');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('Pages.dashboard');
    });
    Route::get('login', function () {
        return view('Pages.dashboard');
    });

    // both Staff & admin $ members

    Route::middleware('AdminStaff')->group(function () {

        Route::get('councilDefinition', 'CouncilDefinitionController@index');
        Route::get('councilDefinition/{id}', 'CouncilDefinitionController@show');
        Route::get('getCouncielDefinitionAjax', 'CouncilDefinitionController@getCouncielDefinitionAjax');
    });
    // Admin
    Route::middleware('admin')->group(function () { //type = 0
        Route::resource('users', 'UserMemberController');
        Route::get('getUsersAjax', 'UserMemberController@getUsersAjax');

        Route::resource('department', 'DepartmentController');
        Route::get('getDepartmentAjax', 'DepartmentController@getDepartmentAjax');

        Route::resource('faculty', 'FacultyController');
        Route::get('getFacultyAjax', 'FacultyController@getFacultyAjax');

        // Council-Definition
        Route::get('createCouncilDefinition', 'CouncilDefinitionController@create');
        Route::post('councilDefinition', 'CouncilDefinitionController@store');
        Route::get('councilDefinition/{id}/edit', 'CouncilDefinitionController@edit');
        Route::patch('councilDefinition/{id}', 'CouncilDefinitionController@update');
        Route::delete('councilDefinition/{id}', 'CouncilDefinitionController@destroy');

        // Council-member
        Route::get('councilmember/{id}/edit', 'CouncilmemberController@edit');
        Route::post('updateCouncilMember/{id}', 'CouncilmemberController@update');
        Route::get('councilmember/create/{id}', 'CouncilmemberController@create');
        Route::post('addCouncilMember/{id}', 'CouncilmemberController@store');
        Route::post('deleteMember', 'CouncilmemberController@destroy');

        // Council-Chairman
        Route::get('councilChairman/create/{id}', 'CouncilmemberController@createCouncilMember');
        Route::post('addCouncilChairman/{id}', 'CouncilmemberController@StoreChairman');
    });


    // Staff
    Route::middleware('Staff')->group(function () { // type = 1
        Route::resource('position', 'PositionController');
        Route::get('getPositionAjax', 'PositionController@getPositionAjax');

        Route::resource('rank', 'RankController');
        Route::get('getRankAjax', 'RankController@getRankAjax');

        Route::resource('subjectType', 'SubjectTypeController');
        Route::get('getSubjectTypeAjax', 'SubjectTypeController@getSubjectTypeAjax');

        // meeting Controller
        Route::get('meeting/create', 'CouncilMeetingSetupController@create');
        Route::post('meeting', 'CouncilMeetingSetupController@store');
        Route::get('meeting/{id}/edit', 'CouncilMeetingSetupController@edit');
        Route::patch('meeting/{id}', 'CouncilMeetingSetupController@update');
        Route::delete('meeting/{id}', 'CouncilMeetingSetupController@destroy');
        Route::post('closeMeeting/{id}', 'CouncilMeetingSetupController@closeMeeing');


        // meeting Attendence
        Route::post('meetingAttendence/{id}', 'CouncilMeetingSetupController@attendence');

        // meeting Subject
        Route::get('meetingSubject/create/{id}','CouncilMeetingSubjectController@create');
        Route::post('meetingSubject/store','CouncilMeetingSubjectController@store');
        Route::post('meetingSubject/delete','CouncilMeetingSubjectController@destroy');
        Route::post('addSubjectAttachment','CouncilMeetingSubjectController@addAttachment');
        Route::post('meetingAttachment/delete/{id}/{type}','SubjectAttachmentController@destroy');
        Route::get('meetingSubject/edit/{id}','CouncilMeetingSubjectController@edit');
        Route::post('updateMeetingSubject','CouncilMeetingSubjectController@update');

        Route::get('meetingSubject/finalDesicion/{id}','CouncilMeetingSubjectController@finalDecisionPage');
        Route::post('addFinalDecision','CouncilMeetingSubjectController@addFinalDecision');
    });


    // members
    Route::middleware('members')->group(function () { // members , type = 2

        Route::get('addVote', 'VotesController@store');
    });


    Route::middleware('MemberStaff')->group(function () {
        Route::get('meeting', 'CouncilMeetingSetupController@index');
        Route::get('meeting/{id}', 'CouncilMeetingSetupController@show');
        Route::get('getCouncielMeetingAjax', 'CouncilMeetingSetupController@getCouncielMeetingAjax');
        Route::get('downloadAttachment/{subjectID}/{attachmentID}', 'SubjectAttachmentController@downloadAttachment');
    });

    /*  DONE ROUTES */
    Route::get('firebase/{id}','FirebaseController@index');
    Route::get('chat/{id}','FirebaseController@chat');

    // Route::get('test', function () {
    //     return event(new App\Events\Councilcreated('Someone has added u to group',101,'Event','home'));
    // });

    Route::get('updateseen', 'Controller@updateseen');
    Route::get('watchNotification', 'Controller@watchNotification');

    Route::get('pdf', 'Controller@files');

});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');



/** **/
Route::get('dashboard', function () {
    return view('Pages.dashboard');
});

// Route::get('chartjs', function () {
//     return view('Pages.charts.chartjs');
// });

// Route::get('buttons', function () {
//     return view('Pages.ui-features.buttons');
// });

// Route::get('typography', function () {
//     return view('Pages.ui-features.typography');
// });

// Route::get('basic_elements', function () {
//     return view('Pages.forms.basic_elements');
// });

Route::get('mdi', function () {
    return view('Pages.icons.mdi');
});

// Route::get('basic-table', function () {
//     return view('Pages.tables.basic-table');
// });

Route::get('translations', function () {
    return view('vendor.translation-manager.index');
});
