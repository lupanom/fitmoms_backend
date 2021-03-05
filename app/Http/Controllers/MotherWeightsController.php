<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Mother;
use App\Models\Weight;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MotherWeightsController extends Controller
{
    public function store(Mother $mother, Request $request)
    {
        $day = Day::firstwhere('date', Carbon::today());

        return Weight::create([
            'mother_id' => $mother->id,
            'day_id' => $day->id,
            'weight' => $request->weight,
        ]);
    }
}
