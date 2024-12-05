<?php

namespace BolsaTrabajo\Http\Controllers\Auth;

use BolsaTrabajo\Memorandum;
use BolsaTrabajo\Empleado;
use Illuminate\Http\Request;
use BolsaTrabajo\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Dompdf\Dompdf;
use Dompdf\Options;

class MemorandumController extends Controller
{
    public function index()
    {
        return view('auth.memorandum.index');
    }

    public function list_all()
    {
        $memorandums = Memorandum::with('empleado') // Cargar la relación 'empleado'
            ->orderBy('id', 'desc')
            ->get();

        return response()->json(['data' => $memorandums]);
    }

    public function buscarDNI(Request $request)
    {
        $request->validate([
            'dni' => 'required|min:1|max:8',
        ]);
    
        $dni = $request->input('dni');
        $empleado = Empleado::where('dni', $dni)->first();
    
        if ($empleado) {
            return response()->json($empleado);
        }
    
        return response()->json(['error' => 'Empleado no encontrado'], 404);
    }


    public function delete(Request $request)
    {
        $status = false;

        $entity = Memorandum::find($request->id);

        if($entity->delete()) $status = true;

        return response()->json(['Success' => $status]);
    }

    public function generarPDF($id)
    {
        // Obtén los datos del memorandum
        $memorandum = Memorandum::findOrFail($id);
        
        // Configura Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isRemoteEnabled', true); // Habilita archivos remotos
        $options->set('isJavascriptEnabled', true); // Habilita JavaScript
        $options->set('isHtml5ParserEnabled', true); // Habilita el parser HTML5

        $dompdf = new Dompdf($options);

        // Crea el contenido HTML del PDF
        $html = view('auth.memorandum.pdf', compact('memorandum'))->render();
        
        // Carga el HTML y genera el PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Abre el PDF en el navegador
        return $dompdf->stream("memorandum_{$id}.pdf", ["Attachment" => false]);
    }


    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'dni' => 'required|string|min:1|max:8',
            'nombres' => 'required|string|max:255',
            'asunto' => 'required|string|max:1000',
        ]);

        // Crear un nuevo Memorandum
        $memorandum = new Memorandum();
        $memorandum->dni = $request->input('dni');
        $memorandum->nombres = $request->input('nombres');
        $memorandum->asunto = $request->input('asunto');

        // Guardar el Memorandum en la base de datos
        $memorandum->save();

        // Redirigir o devolver respuesta
        return redirect()->route('auth.memorandum')->with('success', 'Memorandum guardado exitosamente.');
    }




}