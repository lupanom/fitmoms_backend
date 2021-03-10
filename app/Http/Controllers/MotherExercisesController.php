<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Exercise;
use App\Models\Mother;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MotherExercisesController extends Controller
{
    public function store(Mother $mother, Exercise $exercise)
    {
        $day = Day::firstwhere(['date' => Carbon::today(), 'mother_id' => $mother->id]);

        if (!$day) {
            $day = Day::create([
                'mother_id' => $mother->id,
                'date' => Carbon::today(),
            ]);
        }

        $mother->exercises()->attach($exercise, [
            'day_id' => $day->id,
        ]);

    }

    public function index(Mother $mother, Request $request)
    {
        if($request->date) {
            return $mother->exerciseOfDate($request->date);
        }

        return $mother->exercises;
    }

    public function today(Mother $mother)
    {
        return $mother->todayExercises;
    }
}
