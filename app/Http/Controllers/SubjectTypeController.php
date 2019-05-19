<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Subject_type;
use Illuminate\Http\Request;
use Validator;
use Yajra\Datatables\Datatables;

class SubjectTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('admin.subject_type.index');
    }

    public function getSubjectTypeAjax(){
        $subjecType= Subject_type::all();
        return Datatables::of($subjecType)->addIndexColumn()->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.subject_type.create');
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
            'subject_type_name' => 'required|string|max:50',
        ])->validate();

        $requestData = $request->all();

        Subject_type::create($requestData);

        return redirect('subjectType')->with('flash_message', 'Subject Type added!');
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
        return redirect('subjectType');
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
        $subjectType = Subject_type::find($id);
        if(!$subjectType){return redirect('subjectType');}
        return view('admin.subject_type.edit', compact('subjectType'));
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
            'subject_type_name' => 'required|string|max:50',
        ])->validate();

        $requestData = $request->all();

        $subject_type = Subject_type::findOrFail($id);
        $subject_type->update($requestData);

        return redirect('subjectType')->with('flash_message', 'Subject Type updated!');
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
        $position = Subject_type::find($id);
        if($position)
        {
            $position->delete();
            return 1;
        }
        return 0;
    }
}
