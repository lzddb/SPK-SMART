<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = Kriteria::all();
        return view('dashboard.Kriteria.index', compact('kriteria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_kriteria' => 'required',
            'kriteria' => 'required',
            'jenis' => 'required',
            'bobot_kriteria' => 'required'
        ]);

        $kriteria = Kriteria::create([
            'kode_kriteria' => $request->kode_kriteria,
            'kriteria' => $request->kriteria,
            'jenis' => $request->jenis,
            'bobot_kriteria' => $request->bobot_kriteria,
        ]);

        return redirect('kriteria')->with('toast_success', 'Kriteria Berhasil Ditambahkan');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_kriteria' => 'required',
            'kriteria' => 'required',
            'jenis' => 'required',
            'bobot_kriteria' => 'required'
        ]);

        $kriteria = Kriteria::findOrFail($id);

        $kriteria->update([
            'kode_kriteria' => $request->kode_kriteria,
            'kriteria' => $request->kriteria,
            'jenis' => $request->jenis,
            'bobot_kriteria' => $request->bobot_kriteria,
        ]);

        return redirect('kriteria')->with('toast_success', 'Kriteria Berhasil Di Update');
        // return view('dashboard.Kriteria.index', compact('kriteria'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id);

        $data = $kriteria->delete();

        return redirect('kriteria')->with('toast_success', 'Kriteria Berhasil Dihapus');
    }
}
