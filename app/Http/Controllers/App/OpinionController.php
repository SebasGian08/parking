<?php

namespace BolsaTrabajo\Http\Controllers\App;

use BolsaTrabajo\Opinion;
use Illuminate\Http\Request;
use BolsaTrabajo\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OpinionController extends Controller
{


    public function index()
    {
        return view('app.opinion.index'); // Asegúrate de que la ruta sea correcta
    }


    public function store(Request $request)
    {
        $request->validate([
            'opinion' => 'required|string|max:255',
            'rating' => 'required|integer|between:1,5',
        ]);

        // Preparar los datos para guardar
        $data = [
            'opinion' => $request->input('opinion'),
            'rating' => $request->input('rating'),
        ];
    
        // Crear una nueva instancia del modelo
        $opinion = new Opinion();
        $opinion->fill($data); 
        $opinion->save(); 
    
        // Redirigir con mensaje de éxito
        return redirect()->route('app.aniversario.index')->with('success', 'Asistente registrado exitosamente.');
    }
    


}