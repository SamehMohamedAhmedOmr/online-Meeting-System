<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use App\Council_meeting_subject;
use Auth;
use Validator;
class FirebaseController extends Controller
{
    public function chat($id)
    {
        $subject = Council_meeting_subject::find($id);
        if(!$subject){return redirect()->back();}
        $council_member = Auth::user()->Faculty_member->CouncilMember->where('council_definition_id',$subject->council_definition)->first();
        if(!$council_member){return redirect()->back();}

        return view('admin.council_definition.chatPage',compact('id','subject'));

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        $validate = Validator::make($request->all(), [
            'message' => 'required|string|min:1',
        ])->validate();

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/online-meeting-9d181-firebase-adminsdk-zqkyw-40a4722b8d.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://online-meeting-9d181.firebaseio.com/')
        ->create();

        $database = $firebase->getDatabase();

        $newPost = $database
        ->getReference($id)
        ->push([
        'message' => $request->message ,
        'user_id' => $request->user_id,
        'date'=>$request->date,
        'id'=>$request->id
        ]);
        echo '<pre>';
        print_r($newPost->getvalue());
    }
    public function delete()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/online-meeting-9d181-firebase-adminsdk-zqkyw-40a4722b8d.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://online-meeting-9d181.firebaseio.com/')
        ->create();

        $database = $firebase->getDatabase();

        $newPost = $database
        ->getReference('/')
        ->set('',null);
        print_r($newPost->getvalue());
    }

}
