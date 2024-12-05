<?php

namespace BolsaTrabajo\Http\Controllers\Auth;


use Illuminate\Support\Facades\Auth; // Importa la clase Auth
use Illuminate\Http\Request;
use BolsaTrabajo\Empleado;
use BolsaTrabajo\Tipo;
use BolsaTrabajo\Asistencia;
use BolsaTrabajo\Cargo;
use BolsaTrabajo\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AsistenciaController extends Controller
{
    public function index()
    {
        /* $celulas = Celula::where('estado', 1)
                 ->whereNull('deleted_at')
                 ->get(); */
        $cargo = Cargo::all();
        return view('auth.asistencia.index' , compact('cargo'));
    }

    public function verlistado(){
        $celulas = Celula::where('estado', 1) // Solo estado 1
                 ->whereNull('deleted_at') // Excluir registros eliminados
                 ->get();


        return view('auth.asistencia.listado' , compact('celulas'));
    }

    public function list_all(Request $request)
    {
        $query = Asistencia::orderby('id', 'desc');

        // Filtrar por rango de fechas
        if ($request->has('desde') && $request->has('hasta') && !empty($request->input('desde')) && !empty($request->input('hasta'))) {
            $query->whereBetween('created_at', [$request->input('desde'), $request->input('hasta')]);
        }


        if ($request->has('dni') && !empty($request->input('dni'))) {
            $query->where('dni', $request->input('dni'));
        }

        // Obtención de datos
        $asistencias = $query->get()->map(function ($asistencia) {
            $empleado = Empleado::with('horario')->where('dni', $asistencia->dni)->first();

            return [
                'id' => $asistencia->id,
                'empleado' => $empleado ? [
                    'dni' => $empleado->dni,
                    'nombre' => $empleado->nombre,
                    'apellido' => $empleado->apellido,
                    'horario_id' => $empleado->horario_id,
                    'horario' => $empleado->horario ? $empleado->horario->ingreso : null,
                    'cargo_id' => $empleado->cargo_id,
                    'cargo' => $empleado->cargo ? $empleado->cargo->nombre : null,
                ] : null,

                'hora_entrada' => $asistencia->hora_entrada,
                'hora_salida' => $asistencia->hora_salida,
                'total_horas' => $asistencia->total_horas,
                'created_at' => $asistencia->created_at,
                'latitud' => $asistencia->latitud,
                'longitud' => $asistencia->longitud,
                'latitud_salida' => $asistencia->latitud_salida,
                'longitud_salida' => $asistencia->longitud_salida,
                'ip_address' => $asistencia->ip_address,
                'ip_address_salida' => $asistencia->ip_address_salida,
            ];
        });

        return response()->json(['data' => $asistencias]);
    }



    


    public function delete(Request $request)
    {
        $status = false;

        $entity = Asistencia::find($request->id);

        if($entity->delete()) $status = true;

        return response()->json(['Success' => $status]);
    }


    
        public function partialView($id)
        {
            $entity = null;
    
            if($id != 0) $entity = Asistencia::find($id);
    
            return view('auth.asistencia._Mantenimiento', ['Entity' => $entity]);
        }

        public function storeAsistencia(Request $request)
        {
            $status = false;

            // Validación
            $validator = Validator::make($request->all(), [
                'dni' => 'required|string|max:255',
                'created_at' => 'required|date',
                'hora_entrada' => 'required|date_format:H:i',
                'hora_salida' => 'required|date_format:H:i',
            ]);

            // Verificar si el DNI existe en empleados
            $empleado = Empleado::where('dni', $request->dni)->first();
            if (!$empleado) {
                return response()->json(['Success' => false, 'Errors' => ['dni' => ['El DNI no existe en la base de empleados.']]]);
            }

            // Verificar si ya existe una asistencia con el mismo DNI en la misma fecha
            $existingAsistencia = Asistencia::where('dni', $request->dni)
                ->whereDate('created_at', $request->created_at)
                ->first();
            
            if ($existingAsistencia) {
                return response()->json(['Success' => false, 'Errors' => ['dni' => ['Ya existe una entrada de asistencia para este DNI en la fecha especificada.']]]);
            }

            // Buscar la entidad o crear una nueva
            $entity = $request->id != 0 ? Asistencia::find($request->id) : new Asistencia();

            // Asignar valores
            $entity->dni = trim($request->dni);
            $entity->created_at = $request->created_at . ' ' . now()->format('H:i:s'); // O solo la fecha si es necesario
            $entity->hora_entrada = $request->hora_entrada;
            $entity->hora_salida = $request->hora_salida;

            if ($entity->save()) {
                $status = true;
                return response()->json(['Success' => $status, 'Errors' => $validator->errors()]);
            } else {
                return response()->json(['Success' => false, 'Errors' => ['general' => ['Error al guardar la entidad.']]]);
            }
        }


         

}