<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contactos;

class contactosController extends Controller
{
    public function index()
    {
        $contactos = Contactos::all();
        if($contactos->isEmpty()) {
            $data = [
                'message' => 'No se encontaron contactos',
                'status' => 200
            ];
            return response()->json($data,200);
        }
        
    return response()->json($contactos,200);
    }
}
