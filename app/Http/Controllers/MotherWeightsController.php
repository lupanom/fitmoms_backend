<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Mother;
use App\Models\Weight;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MotherWeightsController extends Controller
{
    public function store(Mother $mother, Request $request)
    {
        $day = Day::firstwhere(['date' => Carbon::today(), 'mother_id' => $mother->id]);

        $peso = $request->weight;
        $isPrimoTrimestre = false;
        $isSecondoTrimestre = false;
        $isTerzoTrimestre = false;

        if ($mother->is_pregnant) {
            if ($mother->pregnancy_months <= 3) {
                $isPrimoTrimestre = true;
            }
            if ($mother->pregnancy_months > 3 && $mother->pregnancy_months <=6) {
                $peso = $peso - $mother->pregnancy_months + 3;
                $isSecondoTrimestre = true;
            }
            if ($mother->pregnancy_months > 6) {
                $peso = $peso - $mother->pregnancy_months + 3;
                $isTerzoTrimestre = true;
            }
        }

        if ($peso > ((2/3) * $mother->height)-60 && $peso <= ((2/3) * $mother->height)-45) {
            $mother->stato_pesoforma = "pesoforma";
        }
        if ($peso > ((2/3) * $mother->height)-75 && $peso <= ((2/3) * $mother->height)-60) {
            $mother->stato_pesoforma = "sottopeso";
        }
        if ($peso > ((2/3) * $mother->height)-45 && $peso <= ((2/3) * $mother->height)-30) {
            $mother->stato_pesoforma = "sovrappeso";
        }
        if ($peso > ((2/3) * $mother->height)-30) {
            $mother->stato_pesoforma = "oltre_sovrappeso";
        }
        if ($peso <= ((2/3) * $mother->height)-75) {
            $mother->stato_pesoforma = "oltre_sottopeso";
        }

        $fabbisogno = round(1680 + (($mother->height - 150) * 20));

        $mother->fabbisogno_energetico = $fabbisogno;

        if ($isPrimoTrimestre) {
            $mother->fabbisogno_energetico = round($fabbisogno + ($fabbisogno * 5 / 100));
        }

        if ($isSecondoTrimestre) {
            $mother->fabbisogno_energetico = round($fabbisogno + ($fabbisogno * 10 / 100));
        }

        if ($isTerzoTrimestre) {
            $mother->fabbisogno_energetico = round($fabbisogno + ($fabbisogno * 25 / 100));
        }

        Log::info('Nuovo peso salvato per '+$mother->name+': '+$request->weight);

        if ($day->weight_id !== null) {
            $day->weight()->update([
                'weight' => round($request->weight),
            ]);
        } else {
            $weight = $day->weight()->create([
                'mother_id' => $mother->id,
                'day_id' => $day->id,
                'weight' => round($request->weight),
            ]);

        }

        $mother->save();

        return $weight;
    }
}
