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
        $array= $exerciseProgram->exercises()->wherePivot('exercise_id', '=', $exercise->id)->withPivot('id_next')->get();
        $actual = $array[0];
        $actual->id_next = $actual->pivot->id_next;
        if ($actual->pivot->id_next!== null) {
            return Exercise::firstWhere('id', $actual->pivot->id_next);
        }
        return null;
    }
}
