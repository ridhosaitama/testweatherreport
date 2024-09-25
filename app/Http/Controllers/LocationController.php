<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Simpan data ke dalam session
        session(['latitude' => $request->latitude, 'longitude' => $request->longitude]);

        return response()->json(['message' => 'Location stored in session successfully!']);
    }

    public function showLocation()
    {
        $latitude = session('latitude');
        $longitude = session('longitude');

        return response()->json(['latitude' => $latitude, 'longitude' => $longitude]);
    }

}


