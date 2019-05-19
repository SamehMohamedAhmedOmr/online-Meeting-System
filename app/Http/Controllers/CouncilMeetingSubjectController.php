<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

use App\Council_meeting_subject;
use App\Subject_type;
use App\Department;
use App\Council_meeting_setup;
use App\Council_definition;
use App\Votes;
use App\User;

use Auth;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CouncilMeetingSubjectController extends Controller
{

    public function create($id)
    {
        $subjectTypes = Subject_type::all();
        $departments = Department::all();
        $meeting = Council_meeting_setup::find($id);
        return view('admin.council_meeting_subject.create',compact('subjectTypes','departments','meeting'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'council_meeting_id' => 'required|numeric|exists:council_meeting_setup,id',
            'subject_description' => 'required|string|max:255',
            'additional_subject' => 'required|boolean',
            'subject_type_id' => 'required|numeric|exists:subject_type,id',
            'department_id' => 'required|numeric|exists:department,id',
            "attachment_document"    => "nullable|array",
            'attachment_document.*'=>'nullable|file|distinct|mimes:jpg,jpeg,png,doc,docx,pdf,xls|max:20000',
        ])->validate();

        $faculty_id = Auth::user()->Faculty_member->id;

        $council_meeting = Council_meeting_setup::find($request->council_meeting_id);
        $council_definition = $council_meeting->council_definition_id;

        $request->request->add(['faculty_id' => $faculty_id]);
        $request->request->add(['council_definition' => $council_definition]);
        $request->request->add(['final_decision' => 2]);

        $requestData = $request->all();
        $check = Council_meeting_subject::create($requestData);

        if($check){
            $definition = Council_definition::find($request->council_definition);
            $members = $definition->CouncilMember;
            foreach ($members as $member) {
                if(isset($member->Faculty_member->User)){
                    $userType = $member->Faculty_member->User->type;
                    if($userType !=2){
                        continue;
                    }
                }
                else{
                    continue;
                }

                $vote = new Votes;
                $vote->vote = 2;
                $vote->council_member_id = $member->id;
                $vote->Council_meeting_subject_id = $check->id;
                $vote->save();
            }
            if($request->attachment_document){
                app('App\Http\Controllers\SubjectAttachmentController')->store($check->id,$request->council_meeting_id,$request);
            }
        }

        return redirect('meeting/'.$request->council_meeting_id.'')->with('flash_message', 'Council Meeting Subject added!');
    }


    public function addAttachment(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'Council_meeting_subject_id' => 'required|numeric|exists:council_meeting_subject,id',
            "attachment_document"    => "required|array",
            'attachment_document.*'=>'required|file|distinct|mimes:jpg,jpeg,png,css,csv,doc,docx,html,js,json,pdf,ppt,pptx,rar,tar,ts,vsd,xhtml,xls,xlsx,xml,zip,text,txt|max:20000'
            ,
        ])->validate();

        $subject = Council_meeting_subject::find($request->Council_meeting_subject_id);

        if($subject){
            if($request->attachment_document){
                app('App\Http\Controllers\SubjectAttachmentController')->store($subject->id,$subject->meeting_number,$request);
            }
        }

        return redirect('meeting/'.$subject->council_meeting_id.'')->with('flash_message', 'Council Meeting Subject Attachment added!');
    }

    public function edit($id)
    {
        $council_meeting_subject = Council_meeting_subject::find($id);
        if (!$council_meeting_subject) { return redirect()->back();}

        $subjectTypes = Subject_type::all();
        $departments = Department::all();
        $meeting = $council_meeting_subject->Council_meeting_setup;

        return view('admin.council_meeting_subject.edit', compact('council_meeting_subject','subjectTypes','departments','meeting'));
    }

    public function update(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'council_meeting_subject' => 'required|numeric|exists:council_meeting_subject,id',
            'subject_description' => 'required|string|max:255',
            'additional_subject' => 'required|boolean',
            'subject_type_id' => 'required|numeric|exists:subject_type,id',
            'department_id' => 'required|numeric|exists:department,id',
        ])->validate();

        $council_meeting_subject = Council_meeting_subject::find($request->council_meeting_subject);

        $council_meeting_subject->subject_description = $request->subject_description;
        $council_meeting_subject->additional_subject = $request->additional_subject;
        $council_meeting_subject->subject_type_id = $request->subject_type_id;
        $council_meeting_subject->department_id = $request->department_id;

        $council_meeting_subject->save();

        return redirect('meeting/'.$council_meeting_subject->council_meeting_id.'')->with('flash_message', 'Council Meeting Subject Updated!');
    }

    public function finalDecisionPage($id)
    {
        $council_meeting_subject = Council_meeting_subject::find($id);
        if (!$council_meeting_subject) { return redirect()->back();}

        $users = User::all();
        $definitions = Council_definition::all();
        $meeting = $council_meeting_subject->Council_meeting_setup;

        return view('admin.council_meeting_subject.finalDesicion', compact('council_meeting_subject','users','definitions','meeting'));
    }

    public function addFinalDecision(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'council_meeting_subject' => 'required|numeric|exists:council_meeting_subject,id',
            'final_decision_description' => 'nullable|string|max:255',
            'final_decision' => 'required|boolean',
            'person_redirected' => 'nullable|numeric|exists:users,id',
            'next_council_definition_id' => 'nullable|numeric|exists:council_definition,id',
        ])->validate();

        $council_meeting_subject = Council_meeting_subject::find($request->council_meeting_subject);

        $council_meeting_subject->final_decision_description = $request->final_decision_description;
        $council_meeting_subject->final_decision = $request->final_decision;
        $council_meeting_subject->person_redirected = $request->person_redirected;
        $council_meeting_subject->next_council_definition_id = $request->next_council_definition_id;

        $council_meeting_subject->save();

        return redirect('meeting/'.$council_meeting_subject->council_meeting_id.'')->with('flash_message', 'Final Decision Added!');
    }


    public function destroy(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id' => 'required|numeric|exists:council_meeting_subject,id',
        ])->validate();

        $subject = Council_meeting_subject::find($request->id);

        foreach ($subject->Subject_attachment as $key => $attechment) {
            app('App\Http\Controllers\SubjectAttachmentController')->destroy($attechment->id,1);
        }
        Council_meeting_subject::destroy($request->id);

        return redirect()->back()->with('flash_message', 'Council Meeting Subject deleted!');
    }
}
