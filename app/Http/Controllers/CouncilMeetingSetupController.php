<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

use App\Council_meeting_setup;
use App\Council_definition;
use App\Meeting_attendance;
use App\Council_meeting_subject;
use App\Events\Councilcreated;

use Auth;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Subject_topic;
use App\CouncilMember;
class CouncilMeetingSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('admin.council_meeting_setup.index');
    }

    public function getCouncielMeetingAjax(){
        $members= Auth::user()->Faculty_member->CouncilMember;
        $ids = [];
        $i = 0;
        foreach ($members as $member) {
            $ids[$i] = $member->council_definition_id;
            $i++;
        }

        $meeting= Council_meeting_setup::whereIn('council_definition_id', $ids)->orderBy('meeting_date', 'DESC')->get();
        return Datatables::of($meeting)
        ->addColumn('definition', function ($meeting) {
            return $meeting->Council_definition->council_name;
        })
        ->addColumn('numberOfSubjects', function ($meeting) {
            return $meeting->Council_meeting_subject->count();
        })->addColumn('mergeColumn', function($meeting){
            return $meeting->id.'-'.$meeting->close;
        })->addIndexColumn()->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $facultyID = Auth::user()->Faculty_member->faculty_id;

        if(Auth::user()->Faculty_member == null){
            return redirect('meeting');
        }

        $councilDefintions = Council_definition::where('faculty_id', $facultyID)->get();
        return view('admin.council_meeting_setup.create',compact('councilDefintions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            // validating the meeting Data
            'meeting_number' => 'required|integer',
            'meeting_date' => 'required|date',
            'meeting_time' => ['required','regex:/^(0[\d]|1[0-2]|[\d]):([0-5][\d])( AM| PM)$/'],
            'council_definition_id' => 'required|numeric|exists:council_definition,id',
        ])->validate();

        $requestData = $request->all();
        $check = Council_meeting_setup::create($requestData);
        if($check){
            $definition = Council_definition::find($request->council_definition_id);
            $members = $definition->CouncilMember;
            foreach ($members as $member) {
                $attendence = new Meeting_attendance;
                $attendence->meeting_number = $check->id;
                $attendence->faculty_member_id = $member->Faculty_member->id;
                $attendence->attend = 1;
                $attendence->save();

                // add event of the new Notification
                $userID = $member->Faculty_member->User->id;
                $councilName = $definition->council_name;
                $msg = 'New Meeting at '.$councilName.' on '.$check->meeting_date.' at '.$check->meeting_time;
                $title = 'New Meeting at '.$councilName;

                $msg_ar = 'اجتماع جديد لـ '.$councilName.' يوم '.$check->meeting_date.' الساعة '.$check->meeting_time;
                $title_ar = 'اجتماع جديد لـ  '.$councilName;

                $page = 'meeting/'.$check->id;
                $icon = 'fas fa-handshake';
                $color = 'bg-primary';
                event(new Councilcreated($councilName,$userID,$title,$msg,$title_ar,$msg_ar,$page,$icon,$color));
            }
        }
        return redirect('meeting')->with('flash_message', __('flash_message.Meeting Added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {$topics=new Subject_topic;
        $council_meeting_setup = Council_meeting_setup::find($id);
        if(!$council_meeting_setup){return redirect('meeting');}
        $council_member = Auth::user()->Faculty_member->CouncilMember->where('council_definition_id',$council_meeting_setup->council_definition_id)->first();
        if(!$council_member){return redirect('meeting');}
        $subjects = Council_meeting_subject::where('council_meeting_id', $council_meeting_setup->id)->orderBy('additional_subject', 'ASC')->orderBy('subject_type_id', 'DESC')->get();
        $council_members=CouncilMember::where('council_definition_id',$council_meeting_setup->council_definition_id)->get();
        return view('admin.council_meeting_setup.show', compact('council_meeting_setup','council_member','subjects','council_members'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $council_meeting_setup = Council_meeting_setup::find($id);
        if(!$council_meeting_setup){return redirect('meeting');}

        $facultyID = Auth::user()->Faculty_member->id;

        if(Auth::user()->Faculty_member == null){
            return redirect('meeting');
        }

        $councilDefintions = Council_definition::where('faculty_id', $facultyID)->get();

        return view('admin.council_meeting_setup.edit', compact('council_meeting_setup','councilDefintions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'meeting_number' => 'required|integer',
            'meeting_date' => 'required|date',
            'meeting_time' => ['required','regex:/^(0[\d]|1[0-2]|[\d]):([0-5][\d])( AM| PM)$/'],
            'council_definition_id' => 'required|numeric|exists:council_definition,id',
        ])->validate();

        $requestData = $request->all();

        $council_meeting_setup = Council_meeting_setup::find($id);
        if(!$council_meeting_setup){
            return redirect('meeting')->with('errors', __('flash_message.Meeting Updated'));
        }
        $council_meeting_setup->update($requestData);

        return redirect('meeting')->with('flash_message', __('flash_message.Meeting Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $meeting = Council_meeting_setup::find($id);
        if($meeting)
        {
            $meeting->delete();
            return 1;
        }
        return 0;
    }

    public function attendence(Request $request,$id){

        $validate = Validator::make($request->all(), [
            // validating the meeting Data
            'excuse_description' => "nullable|array",
            'excuse_description.*' => "nullable|string|max:300",
        ])->validate();

        $meeting = Council_meeting_setup::find($id);
        if(!$meeting){return redirect('meeting');}
        foreach ($meeting->Meeting_attendance as $key => $attendance) {
            $req = 'attend'.$attendance->id;
            if($request->has($req)){
                $attendance->attend = 1;
                $attendance->excuse = 0;
                $attendance->excuse_description = null;
                $attendance->save();
            }
            else{
                $attendance->attend = 0;
                $attendance->excuse = 1;
                $attendance->excuse_description = $request->excuse_description[$key];
                $attendance->save();
            }
        }
        return redirect('meeting/'.$id)->with('flash_message', __('flash_message.Attendance Updated Successfully'));
    }

    public function closeMeeing($id)
    {
        $meeting = Council_meeting_setup::find($id);
        if($meeting)
        {
            $meeting->close = 1;
            $meeting->save();
            return 1;
        }
        return 0;
    }
}
