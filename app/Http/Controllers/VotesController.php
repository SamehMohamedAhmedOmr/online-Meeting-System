<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Votes;
use App\Council_meeting_subject;

use Auth;

use Illuminate\Http\Request;

class VotesController extends Controller
{

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'Council_meeting_subject_id' => 'required|numeric|exists:council_meeting_subject,id',
            'vote' => 'required|boolean',
            'commet' => 'nullable|string|max:200',

        ])->validate();

        $subject = Council_meeting_subject::find($request->Council_meeting_subject_id);
        $definition = $subject->Council_meeting_setup->council_definition_id;
        $council_member = Auth::user()->Faculty_member->CouncilMember->where('council_definition_id', $definition)->first();

        if(!$council_member){
            return redirect()->back()->withErrors(['Fatel-Error']);
        }

        $council_member_id = $council_member->id;
        $request->request->add(['council_member_id' => $council_member_id]);

        $requestData = $request->all();

        $data = Votes::where([
            ['Council_meeting_subject_id', $request->Council_meeting_subject_id],
            ['council_member_id',$council_member_id]
        ])->first();

        if($data){
            $data->update($requestData);
        }
        else{
            Votes::create($requestData);
        }

        return redirect()->back()->with('flash_message', 'Votes added!');
    }

}
