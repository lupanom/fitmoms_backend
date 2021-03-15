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

    public function week(Mother $mother)
    {
        return $mother->days->splice(sizeof($mother->days)-7,7)->sortByDesc('date')->values();
    }

    public function month(Mother $mother)
    {
        return $mother->days->splice(sizeof($mother->days)-30,30)->sortBy('date');
    }
}
