<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Council_meeting_subject;
use App\Subject_topic;
use Illuminate\Http\Request;
use App\Faculty_member;
use App\Position;
use Validator;
class SubjecttopicController extends Controller
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
            $topics = Subject_topic::oldest('id')->paginate($perPage);
        } else {
            $topics = Subject_topic::oldest('id')->paginate($perPage);
        }

        return view('admin.topics.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($id,$index,$app)
    {


        $councilSubjects = Council_meeting_subject::where('council_definition', $id)->where('council_meeting_id',$index)->get();
        $topic = Council_meeting_subject::where('id', $app)->first();
        $facultymember=Faculty_member::get();
        $positions=Position::get();
        $meeting=$index;
        return view('admin.topics.create',compact('councilSubjects','facultymember','positions','meeting','topic'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request,$id)
    {
        $validate = Validator::make($request->all(), [

            'list_of_member_order' => 'required|numeric|exists:position,id',
            'faculty_member'=>'required|string|min:4|max:50',
            'job' => 'required|numeric|min:0|max:2'
        ])->validate();
if(!$id)
{
    return redirect('topics')->with('error', 'url must not be muffiend with');

}
        $requestData = $request->all();

        Subject_topic::create($requestData+['council_meeting_subject_id'=>$id]);

        return redirect('topics')->with('flash_message', 'topic added!');
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
        $topic = Subject_topic::findOrFail($id);

        return view('admin.topics.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Subject_topic::destroy($id);

        return redirect('topics')->with('flash_message', 'topic deleted!');
    }

    /**
     * make the specified resource from storage as report.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function report($id,$index)
    {
        $doc=Council_meeting_subject::where('id',$id)->where('council_meeting_id',$index)->get();

        return view('admin.topics.report', compact('doc'));
  }
}
