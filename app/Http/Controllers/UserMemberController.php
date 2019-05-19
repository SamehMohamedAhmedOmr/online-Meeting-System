<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Faculty;
use App\Position;
use App\Rank;
use App\Department;

use App\Faculty_member;

use Illuminate\Http\Request;
use Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use Storage;
use File;
class UserMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('admin.user.index');
    }

    public function getUsersAjax()
    {
        $users= User::all();
        return Datatables::of($users)
        ->addColumn('Position', function ($user) {
            if($user->Faculty_member){
                return $user->Faculty_member->Position->position_name;
            }
            return null;
        })->addIndexColumn()->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $faculty=Faculty::all();
        $department=Department::all();
        $rank=Rank::all();
        $position=Position::all();

        return view('admin.user.create',compact('faculty','department','rank','position'));
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

            'name' => 'required|string|max:25',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|string|min:8|max:25',
            'type' => 'required|alphanum',
            'image' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'rank_id' => 'required|numeric|exists:rank,id',
            'faculty_id' => 'required|numeric|exists:faculty,id',
            'position_id' => 'required|numeric|exists:position,id',
            'department_id' => 'required|numeric|exists:department,id',

        ])->validate();

        $requestData = $request->all();
        if ($request->image) {
            $requestData['password'] = Hash::make($request->password);

                $user=User::create($requestData);
                $requestData['member_name']=$user->name;
                Faculty_member::create($requestData + ['user_id'=>$user->id]);
            if ($this->storeimage($request->file('image'), $user->id)) {

                $requestData['image']=$user->id.'_'.$request->file('image')->getClientOriginalName();
                $user->update($requestData);
                return redirect('users')->with('flash_message', 'User added!');
            }
        } else {
            $requestData['password'] = Hash::make($request->password);
            $requestData['image']='default_default.png';
            $user= User::create($requestData);
            $requestData['member_name']=$user->name;
            Faculty_member::create($requestData + ['user_id'=>$user->id]);

            return redirect('users')->with('flash_message', 'User added!');
        }
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
        $member = User::find($id);
        if(!$member){return redirect()->back();}
        $faculty_member = Faculty_member::where('user_id',$id)->first();
        $cas = 'CEO';
        switch ($member->type) {
            case '0':
            $cas = 'Admin';
                break;
            case '1':
            $cas = 'Staff';
                break;
            case '2':
            $cas = 'Faculty Member';
                break;
            default:
            $cas = 'Undefined';
                break;
        }

        return view('admin.user.show', compact('member','cas','faculty_member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {   $member = User::find($id);
        if(!$member){return redirect()->back();}
        $faculty=Faculty::all();
        $department=Department::all();
        $rank=Rank::all();
        $position=Position::all();
        $faculty_member = Faculty_member::where('user_id',$id)->first();
        return view('admin.user.edit', compact('member','faculty_member','faculty','department','rank','position'));
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

            'name' => 'required|string|max:25',
            'email' => 'required|email',
            'password' => 'max:25',
            'type' => 'required|alphanum',
            'image' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'rank_id' => 'required|numeric|exists:rank,id',
            'faculty_id' => 'required|numeric|exists:faculty,id',
            'position_id' => 'required|numeric|exists:position,id',
            'department_id' => 'required|numeric|exists:department,id',
        ])->validate();

        $requestData = $request->all();

        if($request->password == null){
            unset($requestData['password']);
        }
        else{
            $requestData['password'] = Hash::make($request->password);
        }

        if ($request->image) {
            $user = User::find($id);
            if ($this->storeimage($request->file('image'), $id)) {
                $requestData['image']=$id.'_'.$request->file('image')->getClientOriginalName();


                $this->destroyimage($user->id, $user->image);
                if (!$user) { return redirect('users');}
                $user->update($requestData);
                $requestData['member_name']=$user->name;
                $faculty_member = Faculty_member::where('user_id',$id)->first();
                $faculty_member->update($requestData);
                return redirect('users')->with('flash_message', 'User updated!');
            }
        } else {
            $user = User::find($id);
            if (!$user) { return redirect('users');}
            $user->update($requestData);
            $requestData['member_name']=$user->name;
            $faculty_member = Faculty_member::where('user_id',$id)->first();

            $faculty_member->update($requestData);
            return redirect('users')->with('flash_message', 'User updated!');
        }
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
        $user = User::find($id);
        if ($this->destroyimage($user->id, $user->image)) {
            if ($user) {
                $user->delete();
                return 1;
            }
            return 0;
        } else {
            if ($user) {
                $user->delete();
                return 1;
            }
            return 0;
        }
    }
     /**
     * add the specified resource to storage.
     *
     * @param  int  $image,$id
     *
     * @return state
     */
    public function storeimage($image, $id)
    {
        return Storage::disk('public')->putFileAs(
            'user_pic/'.$id,
            $image,
            $id.'_'.$image->getClientOriginalName()
        );
    }
    /**
     * remove the specified resource from storage.
     *
     * @param  int  $id,$image
     *
     * @return state
     */
    public function destroyimage($id, $image)
    {
        try {
            $imgPath = 'storage\user_pic\\'.$id.'\\'.$image;
            if (File::exists($imgPath)) {
                return unlink($imgPath);
            }
            return 1;
        } catch (Exception $ex) {
            return 0;
        }
    }
}
