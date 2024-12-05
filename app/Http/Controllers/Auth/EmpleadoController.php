<?php

namespace BolsaTrabajo\Http\Controllers\Auth;

use BolsaTrabajo\Empleado;
use BolsaTrabajo\Cargo;
use BolsaTrabajo\Asistencia;
use BolsaTrabajo\Horario;
use BolsaTrabajo\Avatar;
use Illuminate\Http\Request;
use BolsaTrabajo\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image; // Asegúrate de importar esto

class EmpleadoController extends Controller
{
    public function index()
    {
        $cargo = Cargo::all();
        $horario = Horario::all();
        return view('auth.empleado.index' , compact('cargo','horario'));
    }

    public function list_all()
    {
        try {
            // Obtener todos los empleados, incluyendo la información del cargo
            $empleados = Empleado::with('cargo', 'horario', 'avatar')->orderBy('id', 'desc')->get();
    
            // Mapear los empleados para agregar la URL del avatar
            $empleados = $empleados->map(function ($empleado) {
                $empleado->avatar_url = $empleado->avatar ? asset($empleado->avatar->file_name) : null; // Verifica si existe el avatar
                return $empleado;
            });
    
            return response()->json(['data' => $empleados], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los empleados.'], 500);
        }
    }
    


    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'dni' => 'required|string|max:20|unique:empleados,dni',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'cargo_id' => 'required|exists:cargos,id',
        ]);

        // Crear un nuevo empleado
        $empleado = Empleado::create($request->only([
            'dni', 'nombre', 'apellido', 'cargo_id', 'tel', 'email','horario_id'
        ]));

        // Redirigir o responder con éxito
        return redirect()->route('auth.empleado')->with('success', 'Empleado creado exitosamente.');
    }

    public function delete(Request $request)
    {
        $status = false;
    
        // Encuentra el evento con el dni proporcionado
        $event = Empleado::where('id', $request->id)->first();
    
        if (!$event) {
            return response()->json(['Success' => $status, 'Message' => 'Empleado no encontrado.']);
        }
    
        // Verifica si hay asistentes asociados al empleado
        $hasParticipants = Asistencia::where('dni', $event->dni)->exists();
    
        if ($hasParticipants) {
            return response()->json(['Success' => $status, 'Message' => 'No se puede eliminar el empleado porque tiene registros asociados.']);
        }
    
        // Elimina el empleado si no tiene asistentes asociados
        if ($event->delete()) {
            $status = true;
            return response()->json(['Success' => $status, 'Message' => 'Empleado eliminado exitosamente.']);
        } else {
            // Error al intentar eliminar
            return response()->json(['Success' => $status, 'Message' => 'Error al intentar eliminar el empleado.']);
        }
    }

    public function partialView($id)
    {
        $cargo = Cargo::all();
        $Entity = Empleado::find($id);
        $horarios = Horario::all();
        $avatars = Avatar::all(); // Recuperar todos los avatares

        return view('auth.empleado._Editar', [
            'cargo' => $cargo,
            'Entity' => $Entity,
            'horarios' => $horarios,
            'avatars' => $avatars // Agregar avatares a la vista
        ]);
    }


    public function partialViewCarnet($id)
    {
        $Entity = Empleado::with('cargo', 'avatar')->find($id);

        // Asegúrate de que el empleado existe
        if (!$Entity) {
            return response()->json(['error' => 'Empleado no encontrado.'], 404);
        }

        return view('auth.empleado._Carnet', [
            'Entity' => $Entity,
            'horarios' => Horario::all(),
            'avatars' => Avatar::all()
        ]);
    }





    public function get($id)
    {
        try {
            $empleado = Empleado::with('cargo')->findOrFail($id);
            return response()->json($empleado, 200);
        } catch (\ModelNotFoundException $e) {
            return response()->json(['error' => 'Empleado no encontrado.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener el empleado.'], 500);
        }
    }


    public function update(Request $request)
    {
        $status = false;
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if (!$validator->fails()){
            $entity = Empleado::find($request->id);
            $entity->dni = $request->dni;
            $entity->nombre = $request->nombre;
            $entity->apellido = $request->apellido;
            $entity->cargo_id = $request->cargo_id;
            $entity->tel = $request->tel;
            $entity->email = $request->email;
            $entity->estado = $request->estado;
            $entity->horario_id = $request->horario_id;
            $entity->avatar_id = $request->avatar_id;


            if($entity->save()) $status = true;            
        }
        return response()->json(['Success' => $status, 'Errors' => $validator->errors()]);
    }



}
