<?php

namespace App\Http\Controllers;

use App\Models\ExerciseCategory;
use Illuminate\Http\Request;

class ExerciseCategoryController extends Controller
{
    public function index()
    {
        return ExerciseCategory::all()->sortBy([
            function ($a, $b) {
                return $a['sorting_score'] < $b['sorting_score'];
            }
        ])->load('exercises');
    }
}
