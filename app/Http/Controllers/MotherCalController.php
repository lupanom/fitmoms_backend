<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Mother;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MotherCalController extends Controller
{
    public function show(Mother $mother)
    {
        $day = Day::firstwhere(['date' => Carbon::today(), 'mother_id' => $mother->id]);

        return $day->burned_cal;
    }
}
