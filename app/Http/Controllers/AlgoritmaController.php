<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\Crips;

class AlgoritmaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $alternatif = Alternatif::with('penilaian.crips')->get();
        $kriteria = Kriteria::with('crips')->orderBy('nama_kriteria','ASC')->get();
        $penilaian = Penilaian::with('crips','alternatif')->get();
        
        if (count($penilaian) == 0)
        {
            return redirect(route('penilaian.index'));
        }

        // Mencari min max
        foreach ($kriteria as $key => $value)
        {
            foreach ($penilaian as $key_1 => $value_1)
            {
                if ($value->id == $value_1->crips->kriteria_id)
                {
                    if ($value->attribut == 'Benefit')
                    {
                        $minMax[$value->id][] = $value_1->crips->bobot;
                    } elseif ($value->attribut == 'Cost') {
                        $minMax[$value->id][] = $value_1->crips->bobot;
                    }
                }
            }
        }
        // dd($minMax);

        // Normalisasi
        foreach ($penilaian as $key_1 => $value_1)
        {
            foreach ($kriteria as $key => $value)
            {
                if ($value->id == $value_1->crips->kriteria_id)
                {
                    if ($value->attribut == 'Benefit')
                    {
                        $normalisasi[$value_1->alternatif->nama_alternatif][$value->id] = $value_1->crips->bobot / max ($minMax[$value->id]);
                    } elseif ($value->attribut == 'Cost') {
                        $normalisasi[$value_1->alternatif->nama_alternatif][$value->id] = min ($minMax[$value->id]) / $value_1->crips->bobot;
                    }
                }
            }
        }
        // dd($normalisasi);

        // Ranking
       foreach ($normalisasi as $key => $value) {
           foreach ($kriteria as $key_1 => $value_1) {
               $rank[$key][] = $value[$value_1->id] * $value_1->bobot;
           }
        }
        // dd($rank);

        $ranking = $normalisasi;
        foreach ($normalisasi as $key => $value) {
            $ranking[$key][] = array_sum($rank[$key]);
        }

        arsort($ranking);
        // dd($normalisasi);

        return view ('admin.perhitungan.index', compact('alternatif','kriteria','normalisasi','ranking'));
    }
}
