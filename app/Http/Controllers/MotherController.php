<?php

namespace App\Http\Controllers;

use App\Models\Mother;
use Illuminate\Http\Request;

class MotherController extends Controller
{
    public function index()
    {
        return Mother::all();
    }

    public function update(Mother $mother, Request $request)
    {
        $mother->update($request->all());
        $mother->save();

        return $mother;
    }
}
