<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\alternatif;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('dashboard.Login.index');
    }

    public function store(Request $request)
    {
        $user = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($user)) {
            return view('dashboard.home', [
                'kriteria' => Kriteria::count(),
                'subKriteria' => SubKriteria::count(),
                'alternatif' => alternatif::count(),
                'user' => User::count()
            ]);
        } else {
            return back()->withErrors([
                'email' => 'Email Anda Salah'
            ]);
        }
    }

    public function keluar()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
