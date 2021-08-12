<?php

namespace App\Http\Controllers;

use App\campaign;
use App\place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
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
    public function index(campaign $campaign)
    {
        //
        if($campaign->organizer->id != Auth::user()->id){
            return abort(404);
        }
        $sessions = $campaign->place->map(function($place){
            return $place->session;
        })->collapse()->sortBy('start')->values();

        $count= $campaign->registration->count();
        foreach($sessions as $session){
            $session->capacity = $session->place->capacity;
            if($session->type == 'normal'){
                $session->citizen = $count;
            }else{
                $session->citizen = $session->session_registration->count();
            }
        }

        return view('reports.index',compact(['campaign','sessions']));
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
        return view('places.create',compact('campaign'));
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
        $data= $request->validate([
            'name'=>'required',
            'area_id'=>'required|numeric',
            'capacity'=>'required|numeric|min:1',
        ]);

        $campaign->place()->create($data);

        return redirect()->route('campaign.show',$campaign)->with([
            'message'=>'Place successfully created'
        ]);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\place  $place
     * @return \Illuminate\Http\Response
     */
    public function show(place $place)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\place  $place
     * @return \Illuminate\Http\Response
     */
    public function edit(place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\place  $place
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, place $place)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\place  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(place $place)
    {
        //
    }
}
