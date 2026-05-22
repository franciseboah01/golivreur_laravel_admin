<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Zone;

class ZoneController extends Controller
{
    public function liste()
    {
        return response()->json(Zone::where('actif', true)->orderBy('nom')->get());
    }
}