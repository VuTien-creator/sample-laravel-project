<?php

namespace App\Http\Controllers;

use App\campaign;
use App\place;
use App\session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
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
        //
        if($campaign->organizer->id != Auth::user()->id){
            return abort(404);
        }

        return view('sessions.create',compact('campaign'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, campaign $campaign)
    {
        //
        if($campaign->organizer->id != Auth::user()->id){
            return abort(404);
        }

        $data = $request->validate([
            'type'=>'required',
            'title'=>'required',
            'vaccinator'=>'required',
            'place_id'=>'required',
            'start'=>'required|date_format:Y-m-d H:i:s',
            'end'=>'required|date_format:Y-m-d H:i:s',
            'description'=>'required',
            // 'type'=>'required',
        ]);
        if($data['type']=='service'){
            $data['cost'] = $request->validate([
                'cost'=>'required|numeric|min:1'
            ])['cost'];
        }

        if($data['start']>= $data['end']){
            return redirect()->back()->withInput()->withErrors([
                'start'=>'time not correct',
                'end'=>'time not correct',
            ]);
        }
        $place = place::where('id',$data['place_id'])->first();
        // dd($place->session);
        foreach($place->session as $session){
            if(!($data['start']>$session->end || $data['end']<$session->start)){
                return redirect()->back()->withInput()->withErrors([
                    'start'=>'Places already booked during this time',
                    'end'=>'Places already booked during this time',
                ]);
            }
        }
        // dd($data);
        $place->session()->create($data);
        return redirect()->route('campaign.show',$campaign)->with([
            'message'=>'Session successfully created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(campaign $campaign,session $session)
    {
        //
        if($campaign->organizer->id != Auth::user()->id){
            return abort(404);
        }

        return view('sessions.edit',compact(['campaign','session']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,campaign $campaign, session $session)
    {
        //
        if($campaign->organizer->id != Auth::user()->id){
            return abort(404);
        }
        $data = $request->validate([
            'type'=>'required',
            'title'=>'required',
            'vaccinator'=>'required',
            'place_id'=>'required',
            'start'=>'required|date_format:Y-m-d H:i:s',
            'end'=>'required|date_format:Y-m-d H:i:s',
            'description'=>'required',
            // 'type'=>'required',
        ]);
        if($data['type']=='service'){
            $data['cost'] = $request->validate([
                'cost'=>'required|numeric|min:1'
            ])['cost'];
        }

        if($data['start']>= $data['end']){
            return redirect()->back()->withInput()->withErrors([
                'start'=>'time not correct',
                'end'=>'time not correct',
            ]);
        }
        $place = place::where('id',$data['place_id'])->first();
        // dd($place->session);
        $sessions = $place->session->where('id','<>',$session->id);
        foreach($sessions as $session){
            if(!($data['start']>$session->end || $data['end']<$session->start)){
                return redirect()->back()->withInput()->withErrors([
                    'start'=>'Places already booked during this time',
                    'end'=>'Places already booked during this time',
                ]);
            }
        }
        // dd($data);
        $session->update($data);
        return redirect()->route('campaign.show',$campaign)->with([
            'message'=>'Session successfully updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(session $session)
    {
        //
    }
}
