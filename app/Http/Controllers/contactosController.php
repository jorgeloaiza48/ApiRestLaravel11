<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contactos;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request){ 
            $validator = Validator::make($request->all(),[
            'nombre' => 'required|max:15', //hasta 15 caracteres
            'direccion' => 'required|max:25', //hasta 25 caracteres
            'telefono' => 'required|digits:10', //deben ser diez dígitos
            'correo' => 'required|email|unique:contactos', //no se puede enviar un email que ya exista en la BD
        ]);
        if($validator->fails()){
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data,400);
        }
        $contacto = Contactos::create([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
        ]);
        if(!$contacto){
            $data = [
                'message' => 'Error al crear el registro',
                'status' => 500
            ];
            return response()->json($data,500);
        }
        $data = [
            'contacto' => $contacto,
            'status' => 201
        ];
        return response()->json($data,201);
    }

    public function show($id){
        $contacto = Contactos::find($id);

        if(!$contacto){
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data,404);
        }
        $data = [
            'contacto' => $contacto,
            'status' => 200
        ];
        return response()->json($data,200);
    }

    public function eliminar($id){
        $contacto = Contactos::find($id);
        if(!$contacto){
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data,404);
        }
        $contacto->delete();
        $data = [
            'message' => 'Contacto eliminado',
            'status' => 200
        ];
        return response()->json($data);
    }

    public function actualizar(Request $request, $id){
        $contacto = Contactos::find($id);
        if(!$contacto){
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data,404);
        }
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|max:15', //hasta 15 caracteres
            'direccion' => 'required|max:25', //hasta 25 caracteres
            'telefono' => 'required|digits:10', //deben ser diez dígitos
            'correo' => 'required|email|unique:contactos', //no se puede enviar un email que ya exista en la BD
        ]);
        if($validator->fails()){
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data,400);
        }
        $contacto->nombre = $request->nombre;
        $contacto->direccion = $request->direccion;
        $contacto->telefono = $request->telefono;
        $contacto->correo = $request->correo;

        $contacto->save();

        $data = [
            'Mensaje' => 'Contacto actualizado',
            'contacto' => $contacto,
            'status' => 200
        ];

        return response()->json($data,200);
    }
}
