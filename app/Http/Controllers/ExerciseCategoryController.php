<?php

namespace App\Http\Controllers;

use App\Models\ExerciseCategory;
use App\Models\Mother;
use Illuminate\Http\Request;

class ExerciseCategoryController extends Controller
{
    public function index(Mother $mother)
    {
        return ExerciseCategory::all()->sortBy([
            function ($a, $b) use ($mother) {
                return $a->getSortingScoreAttribute($mother) < $b->getSortingScoreAttribute($mother);
            }
        ])->values();
    }

    public function show(ExerciseCategory $exerciseCategory)
    {
        return $exerciseCategory;
    }

    public function exercises(ExerciseCategory $exerciseCategory)
    {
        return $exerciseCategory->exercises->splice(0,4);
    }
}
