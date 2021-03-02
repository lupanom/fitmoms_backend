<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FoodController extends Controller
{
    public function index()
    {
        return Food::all();
    }

    public function show(Food $food)
    {
        return $food;
    }

    public function store(Request $request)
    {
        Log::info('Qualcuno vuole aggiungere un cibo', ['dati inseriti:' => $request->all()]);
        return Food::create($request->all());
    }
}
