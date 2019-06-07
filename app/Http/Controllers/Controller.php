<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Yajra\DataTables\Utilities\Request;
use App\Notification;
use Auth;
use View;
use Searchy;
use DB;
use App\Council_meeting_subject;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home(Request $request)
    {
        return view('Pages.dashboard');
    }
    public function updateseen(Request $request)
    {
        $data=Notification::where('id', $request->seen)->first();
        $data->seen=1;
        $data->update();
    }

    public function watchNotification()
    {
        try {
            $notifications = Notification::where('user_id', Auth::user()->id)->get();
            foreach ($notifications as $notification) {
                $notification->watch=1;
                $notification->save();
            }

            return response()->json(['data' => $notifications]);

            return $notifications;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function files()
    {
        return view('pdf');
    }
    public function search(Request $request)
    {
        //$data = Searchy::council_meeting_subject('subject_description')->query($request->text)->get();
       // $data = DB::table('council_meeting_subject')
        //->where('subject_description', 'like', '%'.urldecode($request->text).'%')->get();

        $defintions = Auth::user()->Faculty_member->CouncilMember->pluck('council_definition_id');

        $data = Council_meeting_subject::whereIn('council_definition',$defintions)->where('subject_description' , 'LIKE' , "%{$request->text}%")->limit(5)->get();

        if (count($data) > 0) {
            foreach($data as $d){
                $d->url = url('meeting/'.$d->council_meeting_id);
                $d->Council_definition;
                $d->Council_meeting_setup;
            }
            return $data;
        } else {
            return 0;
        }
    }


}
