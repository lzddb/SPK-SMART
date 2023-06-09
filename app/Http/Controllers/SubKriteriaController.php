<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = Kriteria::all();
        $subKriteria = SubKriteria::all();

        // dd($subKriteria);
        return view('dashboard.SubKriteria.index', compact('kriteria', 'subKriteria'));
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
            'id_kriteria' => 'required',
            'sub_kriteria' => 'required',
            'bobot_sub' => 'required'
        ]);

        $subKriteria = SubKriteria::create([
            'id_kriteria' => $request->id_kriteria,
            'sub_kriteria' => $request->sub_kriteria,
            'bobot_sub' => $request->bobot_sub
        ]);

        // dd($subKriteria);

        return redirect('sub-kriteria')->with('toast_success', 'Sub Kriteria Berhasil Ditambahkan');
        // return view('dashboard.SubKriteria.index', compact('subKriteria'));
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
            'id_kriteria' => 'required',
            'sub_kriteria' => 'required',
            'bobot_sub' => 'required'
        ]);

        $subKriteria = SubKriteria::findOrFail($id);

        $subKriteria->update([
            'id_kriteria' => $request->id_kriteria,
            'sub_kriteria' => $request->sub_kriteria,
            'bobot_sub' => $request->bobot_sub
        ]);

        return redirect('sub-kriteria')->with('toast_success', 'Sub Kriteria Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subKriteria = SubKriteria::findOrFail($id);

        $data = $subKriteria->delete();

        return redirect('sub-kriteria')->with('toast_success', 'Sub Kriteria Berhasil Dihapus');
    }
}
