<?php

namespace BolsaTrabajo\Http\Controllers\Auth;

use BolsaTrabajo\Abonados;
use Illuminate\Http\Request;
use BolsaTrabajo\TipoDocumento;

use BolsaTrabajo\Planes;
use BolsaTrabajo\Estacionamiento;
use BolsaTrabajo\Vehiculos;
use BolsaTrabajo\Contratos;
use BolsaTrabajo\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AbonadosController extends Controller
{
    public function index()
    {
        return view('auth.abonados.index');
    }

    public function list_all()
    {
        return response()->json([
            'data' => Abonados::with('tipoDocumento:id,Nombre')
                ->orderby('id', 'desc')
                ->get()
        ]);
    }
    public function partialViewDetalle($id)
    {
        // Encuentra el abonado por su ID
        $entity = Abonados::find($id);
    
        // Obtener los estacionamientos, vehículos y planes de servicio
        $estacionamientos = Estacionamiento::all();  // Asumiendo que tienes un modelo de Estacionamiento
        $vehiculos = Vehiculos::all();  // Asumiendo que tienes un modelo de Vehículo
        $planes = Planes::all();  // Asumiendo que tienes un modelo de Plan de Servicio
    
        // Si no se encuentra el abonado, redirige a la lista de abonados
        if (!$entity) {
            return redirect()->route('auth.abonados')->with('error', 'Abonado no encontrado.');
        }
    
        // Obtener todos los tipos de documento
        $tipo = TipoDocumento::all();
    
        // Pasa los datos a la vista
        return view('auth.abonados.detalleAbonados', [
            'Entity' => $entity,
            'Tipo' => $tipo,
            'Estacionamientos' => $estacionamientos,
            'Vehiculos' => $vehiculos,
            'Planes' => $planes
        ]);
    }
    
    public function list_allContratos()
    {
        return response()->json(['data' => Contratos::orderby('id', 'desc')->get()]);
    }


    public function update(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'tipo_doc' => 'required|exists:tipodocumento,id',  // Asegúrate de que el tipo de documento existe
            'num_doc' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'tel' => 'required|string|max:15',  // Puedes ajustar la validación del teléfono según tus necesidades
            'email' => 'required|email|max:255',
            'observaciones' => 'nullable|string',
            'estado' => 'required|in:1,2',  // Asegúrate de que el estado sea 1 o 2
        ]);

        // Encuentra la entidad que vamos a actualizar
        $entity = Abonados::find($request->id);

        // Si no se encuentra la entidad, redirigir con un error
        if (!$entity) {
            return back()->with('error', 'Abonado no encontrado.');
        }

        // Actualizar los campos de la entidad
        $entity->tipo_doc = $request->tipo_doc;
        $entity->num_doc = $request->num_doc;
        $entity->razon_social = $request->razon_social;
        $entity->direccion = $request->direccion;
        $entity->tel = $request->tel;
        $entity->email = $request->email;
        $entity->observaciones = $request->observaciones;
        $entity->estado = $request->estado;

        // Guardar los cambios en la base de datos
        $entity->save();

        // Mantener al usuario en la misma página con un mensaje de éxito
        return back()->with('success', 'Datos actualizados correctamente.');
    }



    public function storeContrato(Request $request)
    {
        $status = false;

        // Determinar si es una actualización o creación
        $entity = $request->id != 0 ? Contratos::find($request->id) : new Contratos();

        // Validar los datos
        $validator = Validator::make($request->all(), [
            'abonado_id' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'vehiculo_id' => 'required',
            'estacionamiento_id' => 'required',
            'plan_id' => 'required',
            'nota' => 'required|string|max:255',
        ]);

        if (!$validator->fails()) {
            // Asignar los valores validados al modelo
            $entity->abonado_id = trim($request->abonado_id);
            $entity->fecha_inicio = $request->fecha_inicio;
            $entity->fecha_fin = $request->fecha_fin;
            $entity->vehiculo_id = $request->vehiculo_id;
            $entity->estacionamiento_id = $request->estacionamiento_id;
            $entity->plan_id = $request->plan_id;
            $entity->nota = $request->nota;

            // Intentar guardar
            if ($entity->save()) {
                $status = true;
            }
        }

        // Devolver respuesta JSON
        return response()->json(['Success' => $status, 'Errors' => $validator->errors()]);
    }






    /* public function delete(Request $request)
    {
        $status = false;

        $entity = Area::find($request->id);

        if($entity->delete()) $status = true;

        return response()->json(['Success' => $status]);
    } */
}
