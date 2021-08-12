<?php

namespace App\Http\Controllers;

use App\campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampaignController extends Controller
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
        $campaigns= Auth::user()->campaign;
        // dd($campaigns);
        return view('campaigns.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('campaigns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required',
            'slug'=>'required|regex:/^([a-z0-9]+(-[a-z0-9]+)*)$/',
            'date'=>'required|date_format:Y-m-d'
        ],[
            'slug.regex'=>"Slug must not be empty and only contain a-z, 0-9 and '-' "
        ]);
        // dd(1);

        $slugUsed = campaign::where('slug',$data['slug'])->first();
        if($slugUsed != null){
            return redirect()->back()->withInput()->withErrors([
                'slug'=>'Slug is already used'
            ]);
        }

        $campaign = Auth::user()->campaign()->create($data);
        return redirect()->route('campaign.show',$campaign)->with([
            'message'=>'Campaign successfully created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(campaign $campaign)
    {
        return view('campaigns.detail',compact('campaign'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(campaign $campaign)
    {
        return view('campaigns.edit',compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, campaign $campaign)
    {
        $data = $request->validate([
            'name'=>'required',
            'slug'=>'required|regex:/^([a-z0-9]+(-[a-z0-9]+)*)$/',
            'date'=>'required|date_format:Y-m-d'
        ],[
            'slug.regex'=>"Slug must not be empty and only contain a-z, 0-9 and '-' "
        ]);
        // dd(1);

        $slugUsed = campaign::where('slug',$data['slug'])->where('id','<>',$campaign->id)->first();
        if($slugUsed != null){
            return redirect()->back()->withInput()->withErrors([
                'slug'=>'Slug is already used'
            ]);
        }

        $campaign->update($data);
        return redirect()->route('campaign.show',$campaign)->with([
            'message'=>'Campaign successfully updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(campaign $campaign)
    {
        //
    }
}
