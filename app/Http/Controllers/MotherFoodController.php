<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Food;
use App\Models\Mother;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MotherFoodController extends Controller
{
    public function store(Mother $mother, Food $food, Request $request)
    {
        $day = Day::firstwhere(['date' => Carbon::today(), 'mother_id' => $mother->id]);

        if (!$day) {
            $day = Day::create([
                'mother_id' => $mother->id,
                'date' => Carbon::today(),
            ]);
        }

        if ($mother->food->contains($food)) {
            $existingFood = $mother->food->first(function ($value, $key) use ($food) {
                return $value->id === $food->id;
            });;

            if($request->grams) {

                $existingFood->pivot->grams += $request->grams;
                $existingFood->pivot->save();

                $day->taken_cal += ($food->cal_grams * ($request->grams / 100));
                $day->save();
            }

            if($request->pieces) {
                $existingFood->pivot->pieces += $request->pieces;
                $existingFood->pivot->save();

                $day->taken_cal  += ($food->cal_piece * $request->pieces);
                $day->save();
            }
        }else {
            if($request->grams) {
                $mother->food()->attach($food, [
                    'day_id' => $day->id,
                    'grams' => $request->grams,
                ]);

                $day->taken_cal += ($food->cal_grams * ($request->grams / 100));
                $day->save();
            }

            if($request->pieces) {
                $mother->food()->attach($food, [
                    'day_id' => $day->id,
                    'pieces' => $request->pieces,
                ]);

                $day->taken_cal += ($food->cal_piece * $request->pieces);
                $day->save();
            }
        }


    }

    public function index(Mother $mother, Request $request)
    {
        if($request->date) {
            return $mother->foodOfDate($request->date);
        }

        return $mother->food;
    }

    public function today(Mother $mother)
    {
        return $mother->todayFood;
    }

    public function delete(Mother $mother, Food $food)
    {
        $mother->food()->detach($food);
    }
}
