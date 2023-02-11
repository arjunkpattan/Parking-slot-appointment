<?php
namespace App\Http\Controllers;

use DateTime;
use App\Models\Appoinmet;
use App\Models\ParkingSlot;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function customerList(Request $request)
    {
       $customers= Appoinmet::with("user")->get();
       $total_amount= Appoinmet::sum('amount');

        return view("customer_list",['customers'=>$customers,'total'=>$total_amount]);
    }
    public function upcomingBooking(Request $request)
    {
       $bookings= Appoinmet::where([['appoinment_start','>',new DateTime('now')]])->with('user', 'slot')->get();
       
        return view("upcoming-list",compact('bookings'));
    }
}