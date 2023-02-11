<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\ParkingSlot;


class ParkingSlotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach( range('A', 'Z') as $elements) {
             for ($i=1; $i<= 5; $i++) {
                 ParkingSlot::create([ "name"=>$elements."0".$i, "status"=>'Available' ]); 
                } }
    }
}
