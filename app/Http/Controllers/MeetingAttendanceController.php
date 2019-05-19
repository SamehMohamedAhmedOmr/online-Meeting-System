<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Meeting_attendance;
use Illuminate\Http\Request;
use Validator;
use Yajra\Datatables\Datatables;

class MeetingAttendanceController extends Controller
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
            $meeting_attendance = Meeting_attendance::latest('id')->paginate($perPage);
        } else {
            $meeting_attendance = Meeting_attendance::latest('id')->paginate($perPage);
        }

        return view('admin.meeting_attendance.index', compact('meeting_attendance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.meeting_attendance.create');
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
            'meeting_number' => 'required|numeric|exists:council_meeting_setup,id',
            'faculty_member_id' => 'required|numeric|exists:faculty_member,id',
            'attend' => 'required|boolean',
            'excuse' => 'required|boolean',
            'excuse_description' => 'required|string|max:150',
        ]);
        if ($validate->fails()) {
            $errors = $validate->errors();
            return $errors;
        }

        $requestData = $request->all();

        Meeting_attendance::create($requestData);

        return redirect('admin/meeting_attendance')->with('flash_message', 'Meeting_attendance added!');
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
        $meeting_attendance = Meeting_attendance::findOrFail($id);

        return view('admin.meeting_attendance.show', compact('meeting_attendance'));
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
        $meeting_attendance = Meeting_attendance::findOrFail($id);

        return view('admin.meeting_attendance.edit', compact('meeting_attendance'));
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
            'meeting_number' => 'required|numeric|exists:council_meeting_setup,id',
            'faculty_member_id' => 'required|numeric|exists:faculty_member,id',
            'attend' => 'required|boolean',
            'excuse' => 'required|boolean',
            'excuse_description' => 'required|string|max:150',
        ]);
        if ($validate->fails()) {
            $errors = $validate->errors();
            return $errors;
        }
        $requestData = $request->all();

        $meeting_attendance = Meeting_attendance::findOrFail($id);
        $meeting_attendance->update($requestData);

        return redirect('admin/meeting_attendance')->with('flash_message', 'Meeting_attendance updated!');
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
        Meeting_attendance::destroy($id);

        return redirect('admin/meeting_attendance')->with('flash_message', 'Meeting_attendance deleted!');
    }
}
