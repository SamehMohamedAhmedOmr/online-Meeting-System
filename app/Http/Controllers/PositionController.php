<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Position;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('admin.position.index');
    }

    public function getPositionAjax(){
        $position= Position::all();
        return Datatables::of($position)->addIndexColumn()->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.position.create');
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
            'position_name' => 'required|string|min:3|max:100',
            'priority' => 'required|numeric|min:0|max:2',
        ])->validate();

        $requestData = $request->all();

        Position::create($requestData);

        return redirect('position')->with('flash_message', __('flash_message.Position Added'));
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
        return redirect('position');
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
        $position = Position::find($id);
        if(!$position){return redirect('position');}
        return view('admin.position.edit', compact('position'));
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
            'position_name' => 'required|string|min:3|max:100',
            'priority' => 'required|numeric|min:0|max:2',
        ])->validate();

        $requestData = $request->all();

        $position = Position::findOrFail($id);
        $position->update($requestData);

        return redirect('position')->with('flash_message', __('flash_message.Position Updated'));
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
        $position = Position::find($id);
        if($position)
        {
            $position->delete();
            return 1;
        }
        return 0;
    }
}
