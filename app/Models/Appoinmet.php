<?php

namespace App\Models;

use App\Models\User;
use App\Models\ParkingSlot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appoinmet extends Model
{
    use HasFactory;
    protected $fillable=["appoinment_start",
                        "appoinment_end",
                        "vehicle_number",
                        "slot_id",
                        "user_id",
                        "amount",
                        "hours",
                        "appoinment_id"];
 public function user(){
    return $this->belongsTo(User::class);
  }   
 public function slot(){
    return $this->belongsTo(ParkingSlot::class);
  }   
}
