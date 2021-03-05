<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\FoodCategory;
use Illuminate\Http\Request;

class FoodCategoryController extends Controller
{
    public function index()
    {
        return FoodCategory::all();
    }

    public function food(FoodCategory $foodCategory)
    {
        return $foodCategory->food;
    }
}
