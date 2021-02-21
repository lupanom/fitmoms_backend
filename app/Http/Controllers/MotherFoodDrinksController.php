<?php

namespace App\Http\Controllers;

use App\Models\Mother;
use Illuminate\Http\Request;

class MotherFoodDrinksController extends Controller
{
    public function index(Mother $mother, Request $request)
    {
        if ($request->date) {
            return $mother->foodAndDrinksOfDate($request->date);
        }

        return $mother->foodAndDrinks();
    }
}
