<?php

namespace BolsaTrabajo\Http\Controllers\Auth;

use BolsaTrabajo\Abonados;
use Illuminate\Http\Request;
use BolsaTrabajo\TipoDocumento;

use BolsaTrabajo\Planes;
use BolsaTrabajo\Estacionamiento;
use BolsaTrabajo\Vehiculos;
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



    public function store(Request $request)
    {
        $status = false;

        if($request->id != 0)
            $entity = Area::find($request->id);
        else
            $entity = new Area();

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|unique:areas,nombre,'.($request->id != 0 ? $request->id : "NULL").',id,deleted_at,NULL'
        ]);

        if (!$validator->fails()){
            $entity->nombre = trim($request->nombre);
            if($entity->save()) $status = true;
        }

        return response()->json(['Success' => $status, 'Errors' => $validator->errors()]);
    }

    public function delete(Request $request)
    {
        $status = false;

        $entity = Area::find($request->id);

        if($entity->delete()) $status = true;

        return response()->json(['Success' => $status]);
    }
}
