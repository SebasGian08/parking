<?php

namespace BolsaTrabajo\Http\Controllers\Auth;

use BolsaTrabajo\Datos;
use Illuminate\Http\Request;
use BolsaTrabajo\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DatosController extends Controller
{
    public function index()
    {
        // Obtener los datos de la empresa
        $empresa = Datos::first(); // o encontrar por ID si es necesario
    
        // Pasar los datos a la vista
        return view('auth.datos.index', compact('empresa'));
    }
    public function list_all()
    {
        return response()->json(['data' => Datos::orderby('id', 'desc')->get()]);
    }


    public function update(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ruc' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'web' => 'nullable|url|max:255',
            'tel' => 'required|string|max:20',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Obtener el modelo de la empresa
        $empresa = Datos::first(); // o encontrar por ID si es necesario

        // Actualizar los datos
        $empresa->nombre = $request->nombre;
        $empresa->ruc = $request->ruc;
        $empresa->direccion = $request->direccion;
        $empresa->email = $request->email;
        $empresa->web = $request->web;
        $empresa->tel = $request->tel;

        // Manejar la subida del logo si se proporciona
        if ($request->file('logo')) {
            // Generar un nombre único para el logo
            $random = 'prefix'; // Cambia esto a lo que necesites
            $logo = uniqid($random . "_") . '.' . $request->file('logo')->getClientOriginalExtension();
            $logoPath = 'uploads/fotos/' . $logo; // Construir la ruta

            // Mover el logo al directorio adecuado
            $request->file('logo')->move(public_path('uploads/fotos'), $logo);

            // Guardar la ruta del logo en el modelo
            $empresa->logo = $logoPath; // Actualiza el campo correspondiente en tu modelo
        }

        // Guardar los cambios
        $empresa->save();

        // Redireccionar o retornar con un mensaje de éxito
        return redirect()->route('auth.datos')->with('success', 'Datos actualizados correctamente.');
    }


}
