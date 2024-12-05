<?php

namespace BolsaTrabajo\Http\Controllers\Auth;

use BolsaTrabajo\Extras;
use BolsaTrabajo\Empleado;
use Illuminate\Http\Request;
use BolsaTrabajo\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ExtrasController extends Controller
{
    public function index()
    {
        return view('auth.extras.index');
    }

    public function list_all()
    {
        $extras = Extras::with('empleado:id,dni,nombre,apellido')
            ->orderby('id', 'desc')
            ->get();

        return response()->json(['data' => $extras]);
    }


    public function partialView($id)
    {
        $entity = null;

        if($id != 0) $entity = Extras::find($id);

        return view('auth.extras._Editar', ['Entity' => $entity]);
    }


    public function delete(Request $request)
    {
        $status = false;

        $entity = Extras::find($request->id);

        if($entity->delete()) $status = true;

        return response()->json(['Success' => $status]);
    }

    public function update(Request $request)
    {
        $status = false;

        // Validar la solicitud entrante
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:extras,id',
            'estado' => 'required|in:0,1,2',
            'documento' => 'nullable|file|mimes:pdf,doc,docx,jpeg,png,jpg,gif|max:2048', // Validar el documento
        ]);

        if (!$validator->fails()) {
            $entity = Extras::find($request->id);
            $entity->estado = $request->estado;

            // Manejar la carga del documento
            if ($request->file('documento')) {
                // Generar un nombre de archivo único
                $random = rand(1000, 9999); // Personaliza esta generación si lo deseas
                $documento = uniqid($random . "_") . '.' . $request->file('documento')->getClientOriginalExtension();
                $documentoPath = 'uploads/documentos/' . $documento;

                // Mover el documento al directorio adecuado
                $request->file('documento')->move(public_path('uploads/documentos'), $documento);

                // Guardar la ruta del documento en la entidad
                $entity->documento = $documentoPath; // Suponiendo que 'documento' es una columna en tu modelo Extras
            }

            // Guardar la entidad
            if ($entity->save()) {
                $status = true;
            }
        }

        return response()->json(['Success' => $status, 'Errors' => $validator->errors()]);
    }



    public function partialViewAgregar($id)
    {
        $entity = null;

        if($id != 0) $entity = Extras::find($id);

        return view('auth.extras._Agregar', ['Entity' => $entity]);
    }

    public function store(Request $request)
        {
            $status = false;

            // Validación
            $validator = Validator::make($request->all(), [
                'dni' => 'required|string|max:255',
                'created_at' => 'required|date',
                'horas' => 'required|date_format:H:i',
                'minutos' => 'required|date_format:H:i',
            ]);

            // Verificar si el DNI existe en empleados
            $empleado = Empleado::where('dni', $request->dni)->first();
            if (!$empleado) {
                return response()->json(['Success' => false, 'Errors' => ['dni' => ['El DNI no existe en la base de empleados.']]]);
            }

            // Verificar si ya existe una asistencia con el mismo DNI en la misma fecha
            $existingExtras = Extras::where('dni', $request->dni)
                ->whereDate('created_at', $request->created_at)
                ->first();
            
            if ($existingExtras) {
                return response()->json(['Success' => false, 'Errors' => ['dni' => ['Ya existe un registro para este DNI en la fecha especificada.']]]);
            }

            // Buscar la entidad o crear una nueva
            $entity = $request->id != 0 ? Extras::find($request->id) : new Extras();

            // Asignar valores
            $entity->dni = trim($request->dni);
            $entity->created_at = $request->created_at . ' ' . now()->format('H:i:s'); // O solo la fecha si es necesario
            $entity->horas = $request->horas;
            $entity->minutos = $request->minutos;

            if ($entity->save()) {
                $status = true;
                return response()->json(['Success' => $status, 'Errors' => $validator->errors()]);
            } else {
                return response()->json(['Success' => false, 'Errors' => ['general' => ['Error al guardar la entidad.']]]);
            }
        }

}
