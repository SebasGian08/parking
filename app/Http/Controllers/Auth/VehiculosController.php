<?php

namespace BolsaTrabajo\Http\Controllers\Auth;

use BolsaTrabajo\Vehiculos;
use BolsaTrabajo\Tipo;  // Asegúrate de tener este modelo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use BolsaTrabajo\Http\Controllers\Controller;
use Illuminate\Validation\Rule;


class VehiculosController extends Controller
{
    public function index()
    {
        return view('auth.vehiculos.index');
    }

    public function list_all()
    {
        return response()->json(['data' => Vehiculos::with('tipo')->orderby('id', 'desc')->get()]);
    }

    public function partialView($id = null)
    {
        $entity = null;

        if ($id) {
            $entity = Vehiculos::find($id);
        }

        // Cargar los tipos de vehículos disponibles
        $tipos = Tipo::all();
        
        return view('auth.vehiculos._Mantenimiento', [
            'Entity' => $entity,
            'Tipos' => $tipos
        ]);
    }

    public function store(Request $request)
    {
        $status = false;
    
        // Determinar si es creación o edición
        $isEditing = $request->id ? true : false;
    
        // Validación de la placa para que no exista ya en la base de datos
        $rules = [
            'placa' => [
                'required',
                Rule::unique('vehiculos', 'placa')->ignore($request->id), // Ignora la misma placa al editar
            ],
            'tipo_id' => 'required',
            'estado' => 'required',
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json([
                'Success' => $status,
                'Errors' => $validator->errors()
            ]);
        }
    
        // Verifica si es creación o actualización
        $entity = $isEditing ? Vehiculos::find($request->id) : new Vehiculos();
    
        if ($isEditing && !$entity) {
            return response()->json([
                'Success' => $status,
                'Errors' => ['Vehículo no encontrado.']
            ]);
        }
    
        // Asigna valores
        $entity->placa = trim($request->placa);
        $entity->tipo_id = trim($request->tipo_id);
        $entity->modelo = trim($request->modelo);
        $entity->marca = trim($request->marca);
        $entity->color = trim($request->color);
        $entity->observaciones = trim($request->observaciones);
        $entity->estado = trim($request->estado);
    
        // Guarda la entidad
        if ($entity->save()) {
            $status = true;
        }
    
        return response()->json([
            'Success' => $status,
            'Errors' => $status ? [] : ['Error al guardar el vehículo.']
        ]);
    }
    


    public function delete(Request $request)
    {
        $status = false;

        $entity = Vehiculos::find($request->id);

        if ($entity && $entity->delete()) {
            $status = true;
        }

        return response()->json(['Success' => $status]);
    }
}
