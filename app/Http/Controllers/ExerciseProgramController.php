<?php

namespace App\Http\Controllers;

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
}
