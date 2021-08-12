<?php

namespace App\Http\Controllers;

use App\area;
use App\campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(campaign $campaign)
    {
        if($campaign->organizer->id != Auth::user()->id){
            return abort(404);
        }
        return view('areas.create',compact('campaign'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,campaign $campaign)
    {
        if($campaign->organizer->id != Auth::user()->id){
            return abort(404);
        }
        $data = $request->validate([
            'name'=>'required'
        ]);

        $campaign->area()->create($data);
        return redirect()->route('campaign.show',$campaign)->with([
            'message'=>'Area successfully created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, area $area)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(area $area)
    {
        //
    }
}
