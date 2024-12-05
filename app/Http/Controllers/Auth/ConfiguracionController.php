<?php

namespace BolsaTrabajo\Http\Controllers\Auth;

use BolsaTrabajo\Configuracion;
use Illuminate\Http\Request;
use BolsaTrabajo\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ConfiguracionController extends Controller
{
    public function index()
    {
        return view('auth.configuracion.index');
    }

    public function list_all()
    {
        return response()->json(['data' => Configuracion::orderby('id', 'desc')->get()]);
    }

    public function partialView($id)
    {
        $entity = null;

        if($id != 0) $entity = Configuracion::find($id);

        return view('auth.configuracion._Mantenimiento', ['Entity' => $entity]);
    }

    public function store(Request $request)
    {
        $status = false;
    
        // Buscar la entidad si se proporciona un ID, de lo contrario, crear una nueva
        $entity = $request->id != 0 ? Configuracion::find($request->id) : new Configuracion();
    
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'numero' => 'required|unique:configuracions,numero,' . ($request->id ?? 'NULL'),
        ]);        
    
        if ($validator->fails()) {
            // Redirigir de nuevo con los errores de validación
            return redirect()->route('auth.configuracion')
                ->withErrors($validator)
                ->withInput();
        }
    
        // Asignar y guardar el número
        $entity->numero = trim($request->numero);
        if ($entity->save()) {
            $status = true;
        }
    
        // Mensaje de éxito
        return redirect()->route('auth.configuracion')
            ->with('success', 'IP guardada exitosamente.');
    }
    

    public function delete(Request $request)
    {
        $status = false;

        $entity = Configuracion::find($request->id);

        if($entity->delete()) $status = true;

        return response()->json(['Success' => $status]);
    }

    public function update(Request $request)
    {
        $status = false;

        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'numero' => 'required|unique:configuracions,numero,' . $request->id,
            'estado' => 'required', // Asumiendo que 'estado' también necesita validación
        ]);

        if ($validator->fails()) {
            return response()->json(['Success' => false, 'Errors' => $validator->errors()], 422);
        }

        // Buscar la entidad
        $entity = Configuracion::find($request->id);
        if (!$entity) {
            return response()->json(['Success' => false, 'Message' => 'Entidad no encontrada'], 404);
        }

        // Asignar valores
        $entity->numero = trim($request->numero);
        $entity->estado = $request->estado;

        if ($entity->save()) {
            $status = true;
        }

        return response()->json(['Success' => $status]);
    }
}
