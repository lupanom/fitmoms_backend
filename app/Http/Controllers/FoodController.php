<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index()
    {
        return Food::all()->load('foodCategory');
    }

    public function show(Food $food)
    {
        return $food;
    }

    public function store(Request $request)
    {
        return Food::create($request->all());
    }
}
