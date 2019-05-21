<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Faculty;
use App\Council_definition;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Auth;
use App\Notifications\Councilcreation;
class CouncilDefinitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('admin.council_definition.index');
    }

    public function getCouncielDefinitionAjax(){
        if (Auth::user()->type == 1) { // staff
            $members= Auth::user()->Faculty_member->CouncilMember;
            $ids = [];
            $i = 0;
            foreach ($members as $member) {
                $ids[$i] = $member->council_definition_id;
                $i++;
            }
            $defintions= Council_definition::whereIn('id', $ids)->get();
        }
        elseif(Auth::user()->type ==0){ // Admin
            $defintions= Council_definition::all();
        }

        return Datatables::of($defintions)
        ->addColumn('faculty', function ($defintion) {
            return $defintion->Faculty->faculty_name;
        })
        ->addColumn('numberOfMeeting', function ($defintion) {
            return $defintion->Council_meeting_setup->count();
        })->addIndexColumn()->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $colleges = Faculty::all();
        return view('admin.council_definition.create',compact('colleges'));
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
            'council_name' => 'required|string|max:30',
            'faculty_id' => 'required|numeric|exists:faculty,id',
        ])->validate();

        $requestData = $request->all();

        Council_definition::create($requestData);

        return redirect('councilDefinition')->with('flash_message', 'Council Definition added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request,$id)
    {
        $council_definition = Council_definition::find($id);
        if(!$council_definition){ return redirect()->back();}
        $councilmember=$council_definition->CouncilMember;

        if(Auth::user()->type != 0){
            $council_member = Auth::user()->Faculty_member->CouncilMember->where('council_definition_id',$council_definition->id)->first();
            if(!$council_member){return redirect()->back();}
        }

        $members = $councilmember->count();
        $originalMembers = $council_definition->number_of_members -1;
        $allowMembers = $originalMembers - $members;
        $chairman = $councilmember->where('type',0)->count();

        return view('admin.council_definition.show', compact('council_definition','councilmember','allowMembers','chairman'));
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
        $council_definition = Council_definition::find($id);
        if(!$council_definition){return redirect('councilDefinition');}
        $colleges = Faculty::all();
        return view('admin.council_definition.edit', compact('council_definition','colleges'));
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
            'council_name' => 'required|string|max:30',
            'faculty_id' => 'required|numeric|exists:faculty,id',
        ])->validate();

        $requestData = $request->all();

        $council_definition = Council_definition::findOrFail($id);
        $council_definition->update($requestData);

        return redirect('councilDefinition')->with('flash_message', 'Council Definition updated!');
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
        $defintion = Council_definition::find($id);
        if($defintion)
        {
            $defintion->delete();
            return 1;
        }
        return 0;
    }
}
