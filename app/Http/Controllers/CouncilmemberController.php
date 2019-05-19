<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\CouncilMember;
use Illuminate\Http\Request;
use Faker\Provider\el_CY\Person;
use App\Faculty_member;
use App\Position;
use App\Council_definition;


class CouncilmemberController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
        $member =Faculty_member::all();
        $positions =Position::all();
        $councilDefinition = Council_definition::find($id);
        if(!$councilDefinition){ return redirect()->back();}
        $members = $councilDefinition->CouncilMember->count();
        $originalMembers = $councilDefinition->number_of_members -1;
        $allowMembers = $originalMembers - $members;
        return view('admin.councilmember.create',compact('id','member','positions','allowMembers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function createCouncilMember($id)
    {
        $member =Faculty_member::all();
        $positions =Position::all();
        return view('admin.councilmember.createCouncilMember',compact('id','member','positions'));
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
            'council_definition_id' => "required|array",
            'council_definition_id.*' => 'required|numeric|exists:council_definition,id',

            'faculty_member_id' => "required|array",
            'faculty_member_id.*' => 'required|numeric|exists:faculty_member,id',

            'start_date_of_membership' => "required|array",
            'start_date_of_membership.*' => 'required|date',

            'end_date_of_membership' => "required|array",
            'end_date_of_membership.*' => 'required|date',

            'list_of_membership_order' => "required|array",
            'list_of_membership_order.*' => 'required|numeric',

        ])->validate();

        $councilDefinition = Council_definition::find($request->council_definition_id[0]);
        if(!$councilDefinition){ return redirect()->back();}
        $members = $councilDefinition->CouncilMember->count();
        $originalMembers = $councilDefinition->number_of_members -1;
        $allowMembers = $originalMembers - $members;

        $numberOfRequestedMembers = count($request->input('faculty_member_id'));
        if($numberOfRequestedMembers > $allowMembers){
            return redirect()->back()->withErrors('Number of Member is large than '.$allowMembers.' Members');
        }

        foreach($request->input('council_definition_id') as $key => $value) {
            $call=new CouncilMember();

            $call->council_definition_id= $request->council_definition_id[$key];
            $call->faculty_member_id= $request->faculty_member_id[$key];
            $call->end_date_of_membership= $request->end_date_of_membership[$key];
            $call->start_date_of_membership= $request->start_date_of_membership[$key];
            $call->list_of_membership_order= $request->list_of_membership_order[$key];
            $call->type = 1;
            $call->save();
        }


        return redirect('councilDefinition/'.$request->council_definition_id[0])->with('flash_message', 'Council Member added!');
    }

    public function StoreChairman(Request $request,$id)
    {
        $validate = Validator::make($request->all(), [
            'council_definition_id' => 'required|numeric|exists:council_definition,id',
            'faculty_member_id' => 'required|numeric|exists:faculty_member,id',
            'start_date_of_membership' => 'required|date',
            'end_date_of_membership' => 'required|date',
            'list_of_membership_order' => 'required|numeric',

        ])->validate();
            $call=new CouncilMember();

            $call->council_definition_id= $request->council_definition_id;
            $call->faculty_member_id= $request->faculty_member_id;
            $call->end_date_of_membership= $request->end_date_of_membership;
            $call->start_date_of_membership= $request->start_date_of_membership;
            $call->list_of_membership_order= $request->list_of_membership_order;
            $call->type = 0;
            $call->save();

        return redirect('councilDefinition/'.$request->council_definition_id)->with('flash_message', 'Council Chairman added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $councilmember = CouncilMember::findOrFail($id);

        return view('admin.councilmember.show', compact('councilmember'));
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
        $councilmember = CouncilMember::findOrFail($id);
        if(!$councilmember){return redirect()->back();}
        $member =Faculty_member::all();
        $positions =Position::all();

        return view('admin.councilmember.edit', compact('councilmember','member','positions'));
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
            'faculty_member_id' => 'required|numeric|exists:faculty_member,id',
            'start_date_of_membership' => 'required|date',
            'end_date_of_membership' => 'required|date',
            'list_of_membership_order' => 'required|numeric',
        ])->validate();

        $requestData = $request->all();

        $councilmember = CouncilMember::findOrFail($id);
        if(!$councilmember){return redirect()->back();}
        $check = $councilmember->update($requestData);

        return redirect('councilDefinition/'.$councilmember->council_definition_id)->with('flash_message', 'Council Member updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id' => 'required|numeric|exists:council_member,id',
        ])->validate();

        $councilmember = CouncilMember::find($request->id);

        CouncilMember::destroy($request->id);

        return redirect('councilDefinition/'.$councilmember->council_definition_id)->with('flash_message', 'Council Member Deleted!');
    }

}
