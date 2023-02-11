<?php

namespace App\Http\Controllers\APi;

use DateTime;
use Carbon\Carbon;
use Faker\Factory;
use App\Models\User;
use App\Models\Appoinmet;
use App\Models\ParkingSlot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AppoinmetController extends Controller
{
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
    public function create(Request $request)
    {
        try {
         
       $data=$request->validate([
            "appoinment_start"=>'required',
            "appoinment_end"=>'required',
            'vehicle_number'=>"required",
        ]);
        $bookings= Appoinmet::where([['appoinment_start','<',new DateTime('now')]])->with('slot')->get();
        if($bookings->count()>0){
            foreach($bookings as $booking){
                $booking->slot->update(['status'=>"Available"]);
                
            }
        }

        $to = Carbon::createFromFormat('Y-m-d H:s:i', $request->appoinment_start);
        $from = Carbon::createFromFormat('Y-m-d H:s:i', $request->appoinment_end);
        if($to>$from){
            $response = [
                'success' => false,
                'message' => "Slot timing not matching",
            ];    
            return response()->json($response, 404);
        }
        $user=Auth::user();
        $slot=ParkingSlot::where('status','Available')->first();
        if($slot->count()==0){
            $response = [
                'success' => false,
                'message' => "All slots are booked",
            ];    
            return response()->json($response, 404);
        }
        $slot->update(['status'=>'booked']);
        $booked_user=Appoinmet::where([['user_id','=',$user->id],['appoinment_start','=',$request->appoinment_start]])->get();

        if($booked_user->count()!=0){
            $response = [
                'success' => false,
                'message' => "User Already booked a Slot",
            ];    
            return response()->json($response, 404);
        }
        $data['slot_id']=$slot->id;
        $data['user_id']=$user->id;

        $diff_in_hours = $to->diffInHours($from);
        if($diff_in_hours<=3){
            $amount=10;
        }else{
            $amount=10+(($diff_in_hours-3)*5);
        }
        $faker = Factory::create();
     $appoinment_id= $slot->name.strtoupper($faker->lexify('???'));
       $data['amount']= $amount;
       $data['hours']=$diff_in_hours;
       $data['appoinment_id']= $appoinment_id;
      
       Appoinmet::create($data);
      
        $response = [
            'success' => "success",
            'message' => "Slot booked successfully",
            'data'=>["appoinment_id"=> $appoinment_id,
                    "slot"=>$slot->name,
                    'parking_fee'=> "Rs".$amount,
                    ]
        ];    
        return response()->json($response, 404);

       // Should be $this->buildXMLHeader();
    } catch (\Exception $e) {
            return $e;
    }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   

  
}
