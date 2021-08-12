<?php

namespace App\Http\Controllers;

use App\campaign;
use App\campaign_ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
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
        return view('tickets.create', compact('campaign'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, campaign $campaign)
    {
        $data = $request->validate([
            'name' => 'required',
            'cost' => 'required|numeric|min:1',
            'special_validity' => '',
        ]);

        if ($data['special_validity'] == 'date') {
            $data['special_validity'] = json_encode([
                'type' => 'date',
                'date' => $request->validate([
                    'valid_until' => 'required|date_format:Y-m-d'
                ])['valid_until']

            ]);
        // dd($data);

        } elseif ($data['special_validity'] == 'amount') {
            $data['special_validity'] = json_encode([
                'type' => 'amount',
                'amount' => $request->validate([
                    'amount' => 'required|numeric|min:1'
                ])['amount']
            ]);
        // dd($data);

        }

        $campaign->ticket()->create($data);
        return redirect()->route('campaign.show',$campaign)->with([
            'message'=>'Ticket successfully created'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\campaign_ticket  $campaign_ticket
     * @return \Illuminate\Http\Response
     */
    public function show(campaign_ticket $campaign_ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\campaign_ticket  $campaign_ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(campaign_ticket $campaign_ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\campaign_ticket  $campaign_ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, campaign_ticket $campaign_ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\campaign_ticket  $campaign_ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(campaign_ticket $campaign_ticket)
    {
        //
    }
}
