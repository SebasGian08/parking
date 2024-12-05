<?php

namespace BolsaTrabajo\Http\Controllers\Auth;

use BolsaTrabajo\Cargo;
use BolsaTrabajo\Empleado;
use Illuminate\Http\Request;
use BolsaTrabajo\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CargoController extends Controller
{
    public function index()
    {
        return view('auth.cargo.index');
    }

    public function list_all()
    {
        return response()->json(['data' => Cargo::orderby('id', 'desc')->get()]);
    }

    public function partialView($id)
    {
        $entity = null;

        if($id != 0) $entity = Cargo::find($id);

        return view('auth.cargo._Editar', ['Entity' => $entity]);
    }

    public function store(Request $request)
    {
        $status = false;

        if($request->id != 0)
            $entity = Cargo::find($request->id);
        else
            $entity = new Cargo();

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
        ]);

        if (!$validator->fails()){
            $entity->nombre = trim($request->nombre);
            if($entity->save()) $status = true;
        }

        return redirect()->route('auth.cargo')->with('success', 'Cargo registrado exitosamente.');
    }

    public function delete(Request $request)
    {
        $status = false;

        // Encuentra el evento con el id proporcionado
        $event = Cargo::find($request->id);

        if ($event) {
            // Verifica si hay asistentes asociados a la célula del evento
            $hasParticipants = Empleado::where('cargo_id', $event->id)->exists();

            if (!$hasParticipants) {
                // Elimina el evento si no tiene asistentes asociados
                if ($event->delete()) {
                    $status = true;
                } else {
                    // Error al intentar eliminar
                    return response()->json(['Success' => $status, 'Message' => 'Error al intentar eliminar la celula.']);
                }
            } else {
                // El evento tiene asistentes asociados
                return response()->json(['Success' => $status, 'Message' => 'No se puede eliminar el cargo porque tiene empleados asociados.']);
            }
        } else {
            // El evento no se encuentra
            return response()->json(['Success' => $status, 'Message' => 'Cargo no encontrado.']);
        }

        return response()->json(['Success' => $status]);
    }


    public function update(Request $request)
    {
        $status = false;
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if (!$validator->fails()){
            $entity = Cargo::find($request->id);
            $entity->nombre = $request->nombre;

            if($entity->save()) $status = true;            
        }
        return response()->json(['Success' => $status, 'Errors' => $validator->errors()]);
    }


}
