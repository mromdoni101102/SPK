<?php

namespace App\Http\Controllers;

use App\Models\criteria;
use App\Models\penilaian;
use App\Models\alternatif;
use Illuminate\Http\Request;

class HitungController extends Controller
{
    public function index()
    {
        $criterias = criteria::all();
        $alternatifs = alternatif::all();
        $penilaians = penilaian::with(['alternatif', 'criteria'])->get();

        // Normalisasi VIKOR
        $ranking = [];
        $normalizedValues = [];
        $weightedNormalization = [];

        $desiredDecimalPlaces = 3; // Ganti dengan jumlah desimal yang diinginkan

        foreach ($criterias as $keyColumn => $c) {

            //  get values from each column
            $values = $penilaians->where('id_criteria', $c->id);
            $nilai = $penilaians->where('id_criteria', $c->id)->map(function ($p) {
                return $p->nilai;
            })->toArray();

            // get the highest and lowest value in a column
            $maxVal = max($nilai);
            $minVal = min($nilai);

            foreach ($alternatifs as $keyRow => $a) {
                $temp = 0;
                $value = $values->where('id_criteria', $c->id)->where('id_alternatif', $a->id)->first();
                // normalization
                if ($value->criteria->criteria_type ==  'Cost') {
                    // cost
                    $temp = ($value->nilai - $minVal) / ($maxVal - $minVal);
                    $normalizedValues[$keyRow][$keyColumn] = round($temp, $desiredDecimalPlaces);
                } else {
                    // benefit
                    $temp = ($maxVal - $value->nilai) / ($maxVal - $minVal);
                    $normalizedValues[$keyRow][$keyColumn] = round($temp, $desiredDecimalPlaces);
                }
                // weighted normalization
                $temp = $value->criteria->weight * $normalizedValues[$keyRow][$keyColumn];
                if ($temp % 1 < 1) {
                    $temp = round($temp, 3);
                } else {
                    $temp = round($temp, 0);
                }
                $weightedNormalization[$keyRow][$keyColumn] = $temp;
            }
        }

        $sum = array_fill(0, count($alternatifs), 0);
        $max = array_fill(0, count($criterias), 0);

        foreach ($alternatifs as $keyRow => $a) {
            $sum[$keyRow] = array_sum($weightedNormalization[$keyRow]);
            $max[$keyRow] = max($weightedNormalization[$keyRow]);
        }

        $sumMax = max($sum);
        $sumMin = min($sum);
        $rMax = max($max);
        $rMin = min($max);

        $V = 0.5;
        $finalValues = [];
        $ranking = range(1, count($criterias));

        foreach ($alternatifs as $key => $value) {
            $val1 = $V * (($sum[$key] - $sumMin) / ($sumMax - $sumMin));
            $val2 = (1 - $V) * (($max[$key] - $rMin) / ($rMax - $rMin));

            $finalValues[$key] = $val1 + $val2;
            $ranking[$key] = $val1 + $val2;
        }

        array_multisort($ranking, SORT_DESC);

        return view('dashboard.hitung', [
            'criteria' => $criterias,
            'alternatif' => $alternatifs,
            'penilaian' => $penilaians,
            'normalisasi' => $normalizedValues,
            'weightedNormalization' => $weightedNormalization,
            'Si' => $sum,
            'Ri' => $max,
            'finalValues' => $finalValues,
            'ranking' => $ranking,
        ]);
    }
}
