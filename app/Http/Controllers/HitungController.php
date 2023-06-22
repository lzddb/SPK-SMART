<?php

namespace App\Http\Controllers;

use App\Models\alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HitungController extends Controller
{
    public function hitung()
    {
        //table data kriteria
        $kriteria = DB::table('kriterias')->get();
        $alternatif = alternatif::all();
        $total_bobot = DB::table('kriterias')->sum('bobot_kriteria');

        // table normalisasi data kriteria
        $n = DB::table('kriterias')->select('bobot_kriteria')->get();
        $normalisasi = array();
        for ($i = 0; $i < sizeof($n); $i++) {
            $m = $n[$i]->bobot_kriteria / $total_bobot;
            array_push($normalisasi, $m);
        }

        //total normalisasi data kriteria
        $total_normalisasi = array_sum($normalisasi);

        //tabel penilaian alternatif
        $bobot_alternatif1 = alternatif::with(['subKriteria'])->get();

        //tabel nilai utility
        $countKriteria = Kriteria::all()->count();

        // get min number
        $minNumberAll = [];
        for ($i = 0; $i < $countKriteria; $i++) {
            $minNumber = 0;
            foreach ($bobot_alternatif1 as $item) {
                if ($minNumber != 0) {
                    if ($item->subKriteria[$i]->bobot_sub <= $minNumber) {
                        $minNumber = $item->subKriteria[$i]->bobot_sub;
                    } else {
                        $minNumber = $minNumber;
                    }
                } else {
                    $minNumber = $item->subKriteria[$i]->bobot_sub;
                }
            }
            array_push($minNumberAll, $minNumber);
        }

        // get max number
        $maxNumberAll = [];
        for ($i = 0; $i < $countKriteria; $i++) {
            $maxNumber = 0;
            foreach ($bobot_alternatif1 as $item) {
                if ($maxNumber != 0) {
                    if ($item->subKriteria[$i]->bobot_sub >= $maxNumber) {
                        $maxNumber = $item->subKriteria[$i]->bobot_sub;
                    } else {
                        $maxNumber = $maxNumber;
                    }
                } else {
                    $maxNumber = $item->subKriteria[$i]->bobot_sub;
                }
            }
            array_push($maxNumberAll, $maxNumber);
        }

        //per yang di atas
        $minResult = [];
        for ($i = 0; $i < sizeof($alternatif); $i++) {
            foreach ($minNumberAll as $key => $min) {
                array_push($minResult, ($bobot_alternatif1[$i]->subKriteria[$key]->bobot_sub - $min));
            }
        }

        //per yang dibawah
        $bawah = [];
        for ($i = 0; $i < sizeof($alternatif); $i++) {
            foreach ($minNumberAll as $key => $min) {
                array_push($bawah, ($maxNumberAll[$key] - $minNumberAll[$key]));
            }
        }

        //membagi antar hasil per atas dan per bawah
        $finalResult = [];
        $iter = 0;
        $iter = 0;
        foreach ($minResult as $min) {
            if ($minResult[$iter] != 0) {
                array_push($finalResult, ($minResult[$iter] / $bawah[0]));
            } else {
                array_push($finalResult, 0);
            }
            $iter++;
        }

        //pecahkan array nilai utility jadi array dua dimensi berdasarkan jumblah kriteria
        $utility = [];
        $count = 0;
        for ($i = 0; $i < sizeof($alternatif); $i++) {
            for ($j = 0; $j < sizeof($kriteria); $j++) {
                $utility[$i][$j] = $finalResult[$count];
                $count++;
            }
        }

        // mengambil data alternati dan dijadikan sebuah array
        $da = DB::table('alternatifs')->select('alternatif')->get();
        $arr_da = [];
        $arr = 0;
        for ($i = 0; $i < sizeof($da); $i++) {
            $arr_da[$i] = $da[$arr];
            $arr++;
        }

        $n = DB::table('kriterias')->select('bobot_kriteria')->get();
        $normalisasi = array();
        for ($i = 0; $i < sizeof($n); $i++) {
            $m = $n[$i]->bobot_kriteria / $total_bobot;
            array_push($normalisasi, $m);
        }

        //operasi perhitungan table hasil
        $hasil = [];
        for ($i = 0; $i < sizeof($arr_da); $i++) {
            for ($j = 0; $j < sizeof($kriteria); $j++) {
                $hasil[$i][$j] = $utility[$i][$j] * $normalisasi[$j];
            }
        }

        //table total hasil dari tabel hasil
        $hasil_akhir = [];
        for ($j = 0; $j < sizeof($utility); $j++) {
            $hasil_akhir[$j] = array_sum($hasil[$j]);
        }

        //tabel hasil akhir
        $rangking = [];
        $data = [];
        for ($i = 0; $i < count($arr_da); $i++) {
            $data[] = $arr_da[$i]->alternatif;
            $data[] = $hasil_akhir[$i];
            $rangking[] = $data;
            $data = [];
        }

        return view(
            'dashboard.Hitung.index',
            compact(
                'kriteria',
                'total_bobot',
                'normalisasi',
                'total_normalisasi',
                'bobot_alternatif1',
                'finalResult',
                'utility',
                'arr_da',
                'hasil',
                'hasil_akhir',
                'rangking'
            )
        );
    }

    public function rangking()
    {
        //table data kriteria
        $kriteria = DB::table('kriterias')->get();
        $alternatif = alternatif::all();
        $total_bobot = DB::table('kriterias')->sum('bobot_kriteria');

        // table normalisasi data kriteria
        $n = DB::table('kriterias')->select('bobot_kriteria')->get();
        $normalisasi = array();
        for ($i = 0; $i < sizeof($n); $i++) {
            $m = $n[$i]->bobot_kriteria / $total_bobot;
            array_push($normalisasi, $m);
        }

        //total normalisasi data kriteria
        $total_normalisasi = array_sum($normalisasi);

        //tabel penilaian alternatif
        $bobot_alternatif1 = alternatif::with(['subKriteria'])->get();

        //tabel nilai utility
        $countKriteria = Kriteria::all()->count();

        // get min number
        $minNumberAll = [];
        for ($i = 0; $i < $countKriteria; $i++) {
            $minNumber = 0;
            foreach ($bobot_alternatif1 as $item) {
                if ($minNumber != 0) {
                    if ($item->subKriteria[$i]->bobot_sub <= $minNumber) {
                        $minNumber = $item->subKriteria[$i]->bobot_sub;
                    } else {
                        $minNumber = $minNumber;
                    }
                } else {
                    $minNumber = $item->subKriteria[$i]->bobot_sub;
                }
            }
            array_push($minNumberAll, $minNumber);
        }

        // get max number
        $maxNumberAll = [];
        for ($i = 0; $i < $countKriteria; $i++) {
            $maxNumber = 0;
            foreach ($bobot_alternatif1 as $item) {
                if ($maxNumber != 0) {
                    if ($item->subKriteria[$i]->bobot_sub >= $maxNumber) {
                        $maxNumber = $item->subKriteria[$i]->bobot_sub;
                    } else {
                        $maxNumber = $maxNumber;
                    }
                } else {
                    $maxNumber = $item->subKriteria[$i]->bobot_sub;
                }
            }
            array_push($maxNumberAll, $maxNumber);
        }

        //per yang di atas
        $minResult = [];
        for ($i = 0; $i < sizeof($alternatif); $i++) {
            foreach ($minNumberAll as $key => $min) {
                array_push($minResult, ($bobot_alternatif1[$i]->subKriteria[$key]->bobot_sub - $min));
            }
        }

        //per yang dibawah
        $bawah = [];
        for ($i = 0; $i < sizeof($alternatif); $i++) {
            foreach ($minNumberAll as $key => $min) {
                array_push($bawah, ($maxNumberAll[$key] - $minNumberAll[$key]));
            }
        }

        //membagi antar hasil per atas dan per bawah
        $finalResult = [];
        $iter = 0;
        $iter = 0;
        foreach ($minResult as $min) {
            if ($minResult[$iter] != 0) {
                array_push($finalResult, ($minResult[$iter] / $bawah[0]));
            } else {
                array_push($finalResult, 0);
            }
            $iter++;
        }

        //pecahkan array nilai utility jadi array dua dimensi berdasarkan jumblah kriteria
        $utility = [];
        $count = 0;
        for ($i = 0; $i < sizeof($alternatif); $i++) {
            for ($j = 0; $j < sizeof($kriteria); $j++) {
                $utility[$i][$j] = $finalResult[$count];
                $count++;
            }
        }

        // mengambil data alternati dan dijadikan sebuah array
        $da = DB::table('alternatifs')->select('alternatif')->get();
        $arr_da = [];
        $arr = 0;
        for ($i = 0; $i < sizeof($da); $i++) {
            $arr_da[$i] = $da[$arr];
            $arr++;
        }

        $n = DB::table('kriterias')->select('bobot_kriteria')->get();
        $normalisasi = array();
        for ($i = 0; $i < sizeof($n); $i++) {
            $m = $n[$i]->bobot_kriteria / $total_bobot;
            array_push($normalisasi, $m);
        }

        //operasi perhitungan table hasil
        $hasil = [];
        for ($i = 0; $i < sizeof($arr_da); $i++) {
            for ($j = 0; $j < sizeof($kriteria); $j++) {
                $hasil[$i][$j] = $utility[$i][$j] * $normalisasi[$j];
            }
        }

        //table total hasil dari tabel hasil
        $hasil_akhir = [];
        for ($j = 0; $j < sizeof($utility); $j++) {
            $hasil_akhir[$j] = array_sum($hasil[$j]);
        }

        //tabel hasil akhir
        $rangking = [];
        $data = [];
        for ($i = 0; $i < count($arr_da); $i++) {
            $data[] = $arr_da[$i]->alternatif;
            $data[] = $hasil_akhir[$i];
            $rangking[] = $data;
            $data = [];
        }

        //sort alternatif berdasarkan nilai hasil akhir
        $r = $rangking;
        usort($r, function ($x, $y) {
            return $y[1] <=> $x[1];
        });

        return view(
            'dashboard.Rangking.index',
            compact(
                'kriteria',
                'total_bobot',
                'normalisasi',
                'total_normalisasi',
                'bobot_alternatif1',
                'finalResult',
                'utility',
                'arr_da',
                'hasil',
                'hasil_akhir',
                'rangking',
                'r'
            )
        );
    }
}
