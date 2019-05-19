<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Rank;
use Illuminate\Http\Request;
use Validator;
use Yajra\Datatables\Datatables;

class RankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('admin.rank.index');
    }

    public function getRankAjax(){

        $ranks= Rank::all();
        return Datatables::of($ranks)->addIndexColumn()->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.rank.create');
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
            'rank_name' => 'required|string|max:35',
        ])->validate();

        $requestData = $request->all();

        Rank::create($requestData);

        return redirect('rank')->with('flash_message', 'Rank added!');
    }

    public function show($id)
    {
        return redirect('rank');
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
        $rank = Rank::find($id);
        if(!$rank){return redirect('rank');}
        return view('admin.rank.edit', compact('rank'));
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
            'rank_name' => 'required|string|max:35',
        ])->validate();;

        $requestData = $request->all();

        $rank = Rank::findOrFail($id);
        $rank->update($requestData);

        return redirect('rank')->with('flash_message', 'Rank updated!');
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
        $rank = Rank::find($id);
        if($rank)
        {
            $rank->delete();
            return 1;
        }
        return 0;
    }
}
