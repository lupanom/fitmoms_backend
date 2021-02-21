<?php

namespace App\Http\Controllers;

use App\Models\Mother;
use Illuminate\Http\Request;

class MotherDaysController extends Controller
{
    public function index(Mother $mother)
    {
        return $mother->days;
    }
}
