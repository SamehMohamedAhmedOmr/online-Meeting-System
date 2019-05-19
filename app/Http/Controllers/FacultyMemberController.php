<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

use App\Faculty_member;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class FacultyMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $faculty_member = Faculty_member::latest('id')->paginate($perPage);
        } else {
            $faculty_member = Faculty_member::latest('id')->paginate($perPage);
        }

        return view('admin.faculty_member.index', compact('faculty_member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.faculty_member.create');
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
            'member_name' => 'required|string|max:60',
            'rank_id' => 'required|numeric|exists:rank,id',
            'faculty_id' => 'required|numeric|exists:faculty,id',
            'position_id' => 'required|numeric|exists:position,id',
            'department_id' => 'required|numeric|exists:department,id',
            'user_id' => 'required|numeric|exists:user,id',
        ]);
        if ($validate->fails()) {
            $errors = $validate->errors();
            return $errors;
        }
        $requestData = $request->all();

        Faculty_member::create($requestData);

        return redirect('admin/faculty_member')->with('flash_message', 'Faculty_member added!');
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
        $faculty_member = Faculty_member::findOrFail($id);

        return view('admin.faculty_member.show', compact('faculty_member'));
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
        $faculty_member = Faculty_member::findOrFail($id);

        return view('admin.faculty_member.edit', compact('faculty_member'));
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
            'member_name' => 'required|string|max:60',
            'rank_id' => 'required|numeric|exists:rank,id',
            'faculty_id' => 'required|numeric|exists:faculty,id',
            'position_id' => 'required|numeric|exists:position,id',
            'department_id' => 'required|numeric|exists:department,id',
            'user_id' => 'required|numeric|exists:user,id',

        ]);
        if ($validate->fails()) {
            $errors = $validate->errors();
            return $errors;
        }
        $requestData = $request->all();

        $faculty_member = Faculty_member::findOrFail($id);
        $faculty_member->update($requestData);

        return redirect('admin/faculty_member')->with('flash_message', 'Faculty_member updated!');
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
        Faculty_member::destroy($id);

        return redirect('admin/faculty_member')->with('flash_message', 'Faculty_member deleted!');
    }
}
