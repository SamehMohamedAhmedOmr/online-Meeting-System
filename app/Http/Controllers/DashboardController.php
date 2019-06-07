<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Storage;
use App\Votes;
use App\User;
use App\Subject_topic;
use App\Subject_attachment;
use App\Rank;
use App\Position;
use App\Meeting_attendance;
use App\Faculty;
use App\Faculty_member;
use App\Department;
use App\Council_definition;
use App\Council_meeting_setup;
use App\CouncilMember;
use App\Subject_type;
use Illuminate\Support\Facades\Schema;
use App\Notification;
use App\Council_meeting_subject;
use Auth;
class DashboardController extends Controller
{
  public function welcome()
  {
if(Auth::user()->type==0)
{
    $usercount=User::count();
    $faculty=Faculty::count();
    $depratment=Department::count();
    $Council=Council_definition::count();
    $users=User::latest('id')->limit(10)->get();
    return view('pages.dashboard',compact('usercount','faculty','depratment','Council','users'));
}
if(Auth::user()->type==1)
{        $date = date('Y-m-d');

    $members= Auth::user()->Faculty_member->CouncilMember;
    $ids = [];
    $i = 0;
    foreach ($members as $member) {
        $ids[$i] = $member->council_definition_id;
        $i++;
    }
    $meetings= Council_meeting_setup::whereIn('council_definition_id', $ids)->orderBy('meeting_date', 'DESC')->get();
    $upcoming_birthdays= Council_meeting_setup::whereIn('council_definition_id', $ids)->whereRaw('DAYOFYEAR(curdate()) +1 <= DAYOFYEAR(meeting_date) and meeting_date not like \'%-' . $date . '\'')->orderBy('meeting_date', 'DESC')->where('close','0')->first();

    $openmeetingscount=0;
   $colsedmeetingscount=0;
   foreach ($meetings as $key => $value) {
       if($value->close==0)
       {
        $openmeetingscount++;
       }
       else
       {
        $colsedmeetingscount++;
       }
    }


   $total=$colsedmeetingscount+$openmeetingscount;
    $rank=Rank::count();
    $position=Position::count();
    $subjects=Subject_type::count();
    $last=$meetings->take(10);
    return view('pages.dashboard',compact('rank','position','subjects','i','openmeetingscount','colsedmeetingscount','total','upcoming_birthdays','last'));
}
if(Auth::user()->type==2)
{
    $members= Auth::user()->Faculty_member->CouncilMember;
        $ids = [];
        $i = 0;
        foreach ($members as $member) {
            $ids[$i] = $member->council_definition_id;
            $i++;
        }
        $date = date('Y-m-d');
      // return $date;
        $meetings= Council_meeting_setup::whereIn('council_definition_id', $ids)->orderBy('meeting_date', 'DESC')->get();
        $upcoming_birthdays= Council_meeting_setup::whereIn('council_definition_id', $ids)->whereRaw('DAYOFYEAR(curdate()) +1 <= DAYOFYEAR(meeting_date) and meeting_date not like \'%-' . $date . '\'')->orderBy('meeting_date', 'DESC')->where('close','0')->first();

   $openmeetingscount=0;
   $colsedmeetingscount=0;
   foreach ($meetings as $key => $value) {
       if($value->close==0)
       {
        $openmeetingscount++;
       }
       else
       {
        $colsedmeetingscount++;
       }
    }


   $total=$colsedmeetingscount+$openmeetingscount;
   $last=$meetings->take(10);

   return view('pages.dashboard',compact('openmeetingscount','colsedmeetingscount','total','upcoming_birthdays','last'));
}

  }
  public function CleanSlate()
  {
    Schema::disableForeignKeyConstraints();
    $user=User::all();
    foreach($user as $item)
    {
        $item->image='default_default.png';
        $item->save();
    }
      CouncilMember::truncate();
      Faculty_member::truncate();
      Subject_topic::truncate();
      Subject_type::truncate();
      Subject_attachment::truncate();
      Rank::truncate();
      Position::truncate();
      Notification::truncate();
      Meeting_attendance::truncate();
      Faculty::truncate();
      Department::truncate();
      Council_meeting_subject::truncate();
      Council_definition::truncate();
      Council_meeting_setup::truncate();
      Votes::truncate();
      Schema::enableForeignKeyConstraints();

      foreach( File::directories("storage/faculty_pic") as $file ) {
        if( strpos( $file,"default") === false) {
            File::deleteDirectory($file);
        }

    }
    foreach( File::directories("storage/subject_att") as $file ) {
        if( strpos( $file,"default") === false) {
            File::deleteDirectory($file);
        }

    }
    foreach( File::directories("storage/user_pic") as $file ) {
        if( strpos( $file,"default") === false) {
            File::deleteDirectory($file);
        }
        app('App\Http\Controllers\FirebaseController')->delete();
        return redirect('/dashboard')->with('flash_message','done');


    }
  }

  public function deletefirebase()
  {
    app('App\Http\Controllers\FirebaseController')->delete();
    return redirect('/dashboard')->with('flash_message','done');

  }
  public function deletenotification()
  {
    Notification::truncate();
    return redirect('/dashboard')->with('flash_message','done');

  }

}
