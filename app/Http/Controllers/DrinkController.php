<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use Illuminate\Http\Request;

class DrinkController extends Controller
{
    public function store(Request $request)
    {
        return Drink::create($request->all());
    }

    public function index()
    {
        return Drink::all();
    }
}
