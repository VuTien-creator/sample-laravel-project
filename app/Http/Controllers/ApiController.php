<?php

namespace App\Http\Controllers;

use App\campaign;
use App\citizen;
use App\Http\Resources\B1\CampaignRS;
use App\Http\Resources\B2\AreaRS;
use App\Http\Resources\B2\TicketRS;
use App\Http\Resources\B4\RegistrationRS;
use App\organizer;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function b1Read(){
        $campaigns = campaign::where('date','>','2021-07-01')->orderBy('date')->get();

        return response()->json([
            'campaigns'=>CampaignRS::collection($campaigns)
        ],200);
    }
    public function b2Read($orsl,$cpsl){
        $organizer = organizer::where('slug',$orsl)->first();
        if($organizer == null){
            return response()->json([
                "message"=> "Organizer not found"
            ],404);
        }

        $campaign = $organizer->campaign->where('slug',$cpsl)->first();
        if($campaign == null){
            return response()->json([
                "message"=> "Campaign not found"
            ],404);
        }

        return response()->json([
            'id' => $campaign->id,
         'name' => $campaign->name,
         'slug' => $campaign->slug,
         'date' => $campaign->date,
         'areas'=>AreaRS::collection($campaign->area),
            'tickets'=>TicketRS::collection($campaign->ticket)
        ],200);
    }
    public function b3Login(Request $request){
        $citizen = citizen::where('lastname',$request->lastname)->where('registration_code',$request->registration_code)->first();
        if($citizen == null){
            return response()->json([
                "message"=> "Invalid login"
            ],401);
        }
        $citizen->login_token = md5($citizen->username);
        $citizen->update();
        return response()->json([
            'firstname' => $citizen->firstname,
            'lastname' => $citizen->lastname,
            'username' => $citizen->username,
            'email' => $citizen->email,
            'token' =>$citizen->login_token
        ],200);
    }
    public function b3Logout(){
        if(!isset($_GET['token'])){
            return response()->json([
                "message"=> "Invalid token"
            ],401);
        }

        $citizen = citizen::where('login_token',$_GET['token'])->first();
        if($citizen == null){
            return response()->json([
                "message"=> "Invalid token"
            ],401);
        }

        $citizen->login_token= null;
        $citizen->update();
        return response()->json([
            "message"=> "Logout success"
        ],200);
    }
    public function b4New($orsl,$cpsl,Request $request){
        $organizer = organizer::where('slug',$orsl)->first();
        if($organizer == null){
            return response()->json([
                "message"=> "Organizer not found"
            ],404);
        }

        $campaign = $organizer->campaign->where('slug',$cpsl)->first();
        if($campaign == null){
            return response()->json([
                "message"=> "Campaign not found"
            ],404);
        }
        if(!isset($_GET['token'])){
            return response()->json([
                "message"=> "User not logged in"
            ],401);
        }
        $citizen = citizen::where('login_token',$_GET['token'])->first();
        if($citizen == null){
            return response()->json([
                "message"=> "User not logged in"
            ],401);
        }
        $ticket = $campaign->ticket->where('id',$request->ticket_id)->first();
        if($ticket == null){
            return response()->json([
                "message"=> "Invalid ticket"
            ],401);
        }
        $ticket->special();
        if($ticket->available === false){
            return response()->json([
                "message"=> "Ticket is no longer available"
            ],401);
        }
        $registrations = $campaign->registration;

        foreach($registrations as $registration){
            if($registration->citizen_id == $citizen->id){
                return response()->json([
                    "message"=> "User already registered"
                ],401);
            }
        }

        $registration=$citizen->registration()->create([
            'ticket_id'=>$ticket->id
        ]);

        if($request->session_ids != null){
            foreach($request->session_ids as $id){
                $registration->session_registration()->create([
                    'session_id'=>$id
                ]);
            }
        }

        return response()->json([
            'message'=>'Registration successful'
        ],200);
    }
    public function b4Get(){
        if(!isset($_GET['token'])){
            return response()->json([
                "message"=> "User not logged in"
            ],401);
        }
        $citizen = citizen::where('login_token',$_GET['token'])->first();
        if($citizen == null){
            return response()->json([
                "message"=> "User not logged in"
            ],401);
        }

        return response()->json([
            'registrations'=>RegistrationRS::collection($citizen->registration)
        ],200);
    }
}

