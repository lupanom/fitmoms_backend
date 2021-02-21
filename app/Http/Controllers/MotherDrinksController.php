<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Drink;
use App\Models\Mother;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MotherDrinksController extends Controller
{
    public function store(Mother $mother, Drink $drink, Request $request)
    {
        $day = Day::firstwhere('date', Carbon::today());

        if (!$day) {
            $day = Day::create([
                'mother_id' => $mother->id,
                'date' => Carbon::today(),
            ]);
        }

        if ($mother->drinks->contains($drink)) {
            $existingDrink = $mother->drinks->first(function ($value, $key) use ($drink) {
                return $value->id === $drink->id;
            });;

            $existingDrink->pivot->ml += $request->ml;
            $existingDrink->pivot->save();

        }else {

            $mother->drinks()->attach($drink, [
                'day_id' => $day->id,
                'ml' => $request->ml,
            ]);
        }

        $day->taken_cal = $day->taken_cal + (($request->ml / 100) * $drink->cal_ml);
        $day->save();

    }

    public function index(Mother $mother, Request $request)
    {
        if ($request->date) {
            return $mother->drinksOfDate($request->date);
        }

        return $mother->drinks;
    }
}
