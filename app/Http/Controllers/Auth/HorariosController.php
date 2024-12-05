<?php

namespace BolsaTrabajo\Http\Controllers\Auth;

use BolsaTrabajo\Horario;
use BolsaTrabajo\Empleado;
use Illuminate\Http\Request;
use BolsaTrabajo\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HorariosController extends Controller
{
    public function index()
    {
        return view('auth.horarios.index');
    }

    public function list_all()
    {
        return response()->json(['data' => Horario::orderby('id', 'desc')->get()]);
    }

    public function partialView($id)
    {
        $entity = null;

        if($id != 0) $entity = Area::find($id);

        return view('auth.area._Mantenimiento', ['Entity' => $entity]);
    }

    public function store(Request $request)
    {
        $status = false;
    
        // Verifica si se está editando o creando un nuevo horario
        if ($request->id != 0) {
            $entity = Horario::find($request->id);
        } else {
            $entity = new Horario();
        }
    
        // Validación de los campos de entrada
        $validator = Validator::make($request->all(), [
            'ingreso' => 'required|date_format:H:i',
            'salida' => 'required|date_format:H:i',
        ]);
    
        // Validar si ya existe el par de horarios
        if (!$validator->fails()) {
            $existing = Horario::where('ingreso', trim($request->ingreso))
                               ->where('salida', trim($request->salida))
                               ->first();
    
            if ($existing && (!$entity->exists || $existing->id !== $entity->id)) {
                return redirect()->route('auth.horarios')->with('error', 'El horario de ingreso y salida ya existe.');
            }
    
            // Asignar los valores y guardar
            $entity->ingreso = trim($request->ingreso);
            $entity->salida = trim($request->salida);
    
            if ($entity->save()) {
                $status = true;
            }
        }
    
        return redirect()->route('auth.horarios')->with('success', 'Horario registrado exitosamente.');
    }
    

    public function delete(Request $request)
    {
        $status = false;

        // Encuentra el evento con el id proporcionado
        $event = Horario::find($request->id);

        if (!$event) {
            return response()->json(['Success' => $status, 'Message' => 'Horario no encontrado.']);
        }

        // Verifica si hay asistentes asociados a la célula del evento
        $hasParticipants = Empleado::where('horario_id', $event->id)->exists();

        if ($hasParticipants) {
            return response()->json(['Success' => $status, 'Message' => 'No se puede eliminar el horario porque tiene empleados asociados.']);
        }

        // Elimina el evento si no tiene asistentes asociados
        if ($event->delete()) {
            $status = true;
            return response()->json(['Success' => $status, 'Message' => 'Horario eliminado exitosamente.']);
        } else {
            // Error al intentar eliminar
            return response()->json(['Success' => $status, 'Message' => 'Error al intentar eliminar el horario.']);
        }
    }


}
