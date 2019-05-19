<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Storage;
use Exception;
use App\Faculty;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use File;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('admin.faculty.index');
    }

    public function getFacultyAjax()
    {
        $faculty= Faculty::all();
        return Datatables::of($faculty)->addIndexColumn()->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.faculty.create');
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
            'faculty_name' => 'required|string|max:100',
            'logo' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
        ])->validate();

        $requestData = $request->all();
        if ($request->logo) {
            $faculty=Faculty::create($requestData);
            $requestData['logo']=$faculty->id.'_'.$request->file('logo')->getClientOriginalName();
            $faculty->update($requestData);

            if ($this->storeimage($request->file('logo'), $faculty->id)) {
                return redirect('faculty')->with('flash_message', 'Faculty added!');
            }
        } else {
            $requestData['logo']='default_default.png';

            Faculty::create($requestData);
            return redirect('faculty')->with('flash_message', 'Faculty added!');
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
        return redirect('faculty');
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
        $faculty = Faculty::find($id);
        if (!$faculty) {
            return redirect('faculty');
        }
        return view('admin.faculty.edit', compact('faculty'));
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
            'faculty_name' => 'required|string|max:100',
            'logo' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
        ])->validate();

        $requestData = $request->all();
        if ($request->logo) {
            $faculty = Faculty::findOrFail($id);
            $this->destroyimage($faculty->id, $faculty->logo);
            $requestData['logo'] = $id.'_'.$request->file('logo')->getClientOriginalName();
            $faculty->update($requestData);
            if ($this->storeimage($request->file('logo'), $id)) {
                return redirect('faculty')->with('flash_message', 'Faculty updated!');
            }
        } else {
            $faculty = Faculty::find($id);
            if (!$faculty) {
                return redirect('faculty');
            }
            $faculty->update($requestData);

            return redirect('faculty')->with('flash_message', 'Faculty updated!');
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
        $faculty = Faculty::find($id);
        if ($faculty->logo) {
            $this->destroyimage($faculty->id, $faculty->logo);
            if ($faculty) {
                $faculty->delete();
                return 1;
            }
            return 0;
        } else {
            if ($faculty) {
                $faculty->delete();
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
            'faculty_pic/'.$id,
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
            $imgPath = 'storage\faculty_pic\\'.$id.'\\'.$image;
            if (File::exists($imgPath)) {
                return unlink($imgPath);
            }
            return 1;
        } catch (Exception $ex) {
            return 0;
        }
    }
}
