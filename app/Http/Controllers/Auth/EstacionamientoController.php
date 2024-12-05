<?php

namespace BolsaTrabajo\Http\Controllers\Auth;

use BolsaTrabajo\Estacionamiento;
use BolsaTrabajo\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa la clase Auth
use BolsaTrabajo\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EstacionamientoController extends Controller

{
    public function index()
    {
            return view('auth.estacionamiento.index');
    }
    
    public function list_all()
    {
        return response()->json(['data' => Estacionamiento::orderby('id', 'desc')->get()]);
    }



    public function partialView($id = null)
    {
        $entity = null;

        if ($id) {
            $entity = Estacionamiento::find($id);
        }

        return view('auth.estacionamiento._Mantenimiento', ['Entity' => $entity]);
    }


    public function store(Request $request)
    {
        $status = false;
    
        // Validaciones simplificadas
        $validator = Validator::make($request->all(), [
            'codigo' => 'required',
            'numero' => 'required',
            'piso' => 'required',
            'observaciones' => 'required',
            'estado' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'Success' => $status,
                'Errors' => $validator->errors()
            ]);
        }
    
        // Verifica si es creación o actualización
        if ($request->id) {
            $entity = Estacionamiento::find($request->id);
            if (!$entity) {
                return response()->json([
                    'Success' => $status,
                    'Errors' => ['Estacionamiento no encontrado.']
                ]);
            }
        } else {
            $entity = new Estacionamiento();
        }
    
        // Asigna valores
        $entity->codigo = trim($request->codigo);
        $entity->numero = trim($request->numero);
        $entity->piso = trim($request->piso);
        $entity->observaciones = trim($request->observaciones);
        $entity->estado = trim($request->estado);
    
        // Guarda la entidad
        if ($entity->save()) {
            $status = true;
        }
    
        return response()->json([
            'Success' => $status,
            'Errors' => $status ? [] : $validator->errors()
        ]);
    }
    
    

    public function delete(Request $request)
    {
        $status = false;

        $entity = Estacionamiento::find($request->id);

        if($entity->delete()) $status = true;

        return response()->json(['Success' => $status]);
    }

    
}