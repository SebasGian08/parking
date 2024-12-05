<?php

namespace BolsaTrabajo\Http\Controllers\Auth;

use BolsaTrabajo\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa la clase Auth
use BolsaTrabajo\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TipoController extends Controller

{
    public function index()
    {
            return view('auth.tipo.index');
    }
    
    public function list_all()
    {
        return response()->json(['data' => Tipo::orderby('id', 'desc')->get()]);
    }



    public function partialView($id = null)
    {
        $entity = null;

        if ($id) {
            $entity = Tipo::find($id);
        }

        return view('auth.tipo._Mantenimiento', ['Entity' => $entity]);
    }


    public function store(Request $request)
    {
        $status = false;
    
        // Validaciones simplificadas
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'montoxhora' => 'required',
            'montoxfraccion' => 'required',
            'descripcion' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'Success' => $status,
                'Errors' => $validator->errors()
            ]);
        }
    
        // Verifica si es creación o actualización
        if ($request->id) {
            $entity = Tipo::find($request->id);
            if (!$entity) {
                return response()->json([
                    'Success' => $status,
                    'Errors' => ['Tipo no encontrado.']
                ]);
            }
        } else {
            $entity = new Tipo();
        }
    
        // Asigna valores
        $entity->nombre = trim($request->nombre);
        $entity->montoxhora = trim($request->montoxhora);
        $entity->montoxfraccion = trim($request->montoxfraccion);
        $entity->descripcion = trim($request->descripcion);
    
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

        $entity = Tipo::find($request->id);

        if($entity->delete()) $status = true;

        return response()->json(['Success' => $status]);
    }

    
}