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
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home(Request $request)
    {
         return view('Pages.dashboard');
    }
    public function updateseen(Request $request)
    {
        $data=Notification::where('id',$request->seen)->first();
        $data->seen=1;
        $data->update();

    }

    public function files()
    {
        return view('pdf');
    }
}
