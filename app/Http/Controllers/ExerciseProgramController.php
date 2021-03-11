<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\ExerciseProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExerciseProgramController extends Controller
{
    public function index()
    {
        if(Auth::user()) {
            return ExerciseProgram::all()->sortBy([
                function ($a, $b) {
                    return $a['sorting_score'] < $b['sorting_score'];
                }
            ])->load('exercises');
        }
        return ExerciseProgram::all()->load('exercises');
    }

    public function show(ExerciseProgram $exerciseProgram)
    {
        return $exerciseProgram;
    }

    public function exercises(ExerciseProgram $exerciseProgram)
    {
        return $exerciseProgram->exercises->splice(0,4);
    }

    public function next(ExerciseProgram $exerciseProgram, Exercise $exercise)
    {
        $actual= $exerciseProgram->exercises()->wherePivot('exercise_id', '=', $exercise->id)->withPivot('id_next')->get();
       return Exercise::firstWhere('id', $actual[0]->pivot->id_next);
    }
}
