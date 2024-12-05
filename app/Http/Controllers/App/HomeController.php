<?php

namespace BolsaTrabajo\Http\Controllers\App;

use BolsaTrabajo\Alumno;
use BolsaTrabajo\Configuracion;
use BolsaTrabajo\App;
use BolsaTrabajo\Tipo;
use BolsaTrabajo\Asistencia;
use BolsaTrabajo\Empleado;
use BolsaTrabajo\Cargo;
use BolsaTrabajo\Distrito;
use BolsaTrabajo\Empresa;
use BolsaTrabajo\Provincia;
use BolsaTrabajo\User;
use BolsaTrabajo\Opinion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use BolsaTrabajo\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    private $alumno, $empresa;

    public function __construct(Alumno $alumno, Empresa $empresa)
    {
        $this->middleware('guest:alumnos', ['except' => ['filtro_distritos']]);
        $this->middleware('guest:empresasw', ['except' => ['filtro_distritos']]);

        $this->alumno = $alumno;
        $this->empresa = $empresa;
    }

    public function index()
    {
        $tipo = Tipo::all();
        return view('app.home.index', compact('tipo'));
    }

    /* public function store(Request $request)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'dni' => 'required|string|max:255',
            'tipo_id' => 'required|integer|between:1,2',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
        ]);

        // Capturar la dirección IP del cliente
        $ipAddress = $request->ip();

        // Verificar si el empleado existe
        $empleado = Empleado::where('dni', $validatedData['dni'])->first();

        if (!$empleado) {
            return back()->withErrors(['dni' => 'El empleado con el DNI proporcionado no existe.'])->withInput();
        }

        // Verificar si ya existe una asistencia para el empleado en el día actual
        $today = now()->format('Y-m-d');
        $existingAsistencia = Asistencia::where('dni', $validatedData['dni'])
            ->whereDate('created_at', $today)
            ->first();

        if ($validatedData['tipo_id'] == 1) {
            // Tipo 1: Registro de entrada
            if ($existingAsistencia && $existingAsistencia->hora_entrada) {
                return back()->withErrors(['tipo' => 'El empleado ya ha registrado su entrada hoy.'])->withInput();
            }

            // Crear una nueva instancia de asistencia si no existe
            $asistencia = $existingAsistencia ?: new Asistencia();
            $asistencia->fill($validatedData);
            $asistencia->dni = $empleado->dni; // Asignar el DNI del empleado
            $asistencia->hora_entrada = now(); // Registrar la hora de entrada
            $asistencia->latitud = $validatedData['latitud']; // Guardar latitud
            $asistencia->longitud = $validatedData['longitud']; // Guardar longitud
            $asistencia->ip_address = $ipAddress; // Guardar dirección IP
            $asistencia->save();
        } elseif ($validatedData['tipo_id'] == 2) {
            // Tipo 2: Registro de salida
            if (!$existingAsistencia || !$existingAsistencia->hora_entrada) {
                return back()->withErrors(['tipo' => 'El empleado debe registrar su entrada antes de la salida.'])->withInput();
            }

            // Actualizar la asistencia existente con la hora de salida
            $asistencia = $existingAsistencia;
            $asistencia->hora_salida = now(); // Actualizar la hora de salida
            $asistencia->latitud_salida = $validatedData['latitud']; // Guardar latitud de salida (opcional)
            $asistencia->longitud_salida = $validatedData['longitud']; // Guardar longitud de salida (opcional)
            $asistencia->ip_address_salida = $ipAddress; // Guardar dirección IP de salida (opcional)
            $asistencia->save();
        }

        return redirect('/')->with('success', 'Asistencia guardada exitosamente!');
    }
 */

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'dni' => 'required|string|max:255',
            'tipo_id' => 'required|integer|between:1,2',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
        ]);

        // Capturar la dirección IP del cliente
        $ipAddress = $request->ip();

        // Obtener las IPs permitidas desde la tabla configuracion
        $allowedIps = Configuracion::where('estado', 1)->pluck('numero')->toArray(); // Obtener todas las IPs como un array

        // Verificar si la IP del cliente está permitida
        if (!in_array($ipAddress, $allowedIps)) {
            return back()->withErrors(['ip' => 'No tienes permiso para registrar la asistencia desde esta IP.'])->withInput();
        }

        // Verificar si el empleado existe
        $empleado = Empleado::where('dni', $validatedData['dni'])->first();

        if (!$empleado) {
            return back()->withErrors(['dni' => 'El empleado con el DNI proporcionado no existe.'])->withInput();
        }

        // Verificar si ya existe una asistencia para el empleado en el día actual
        $today = now()->format('Y-m-d');
        $existingAsistencia = Asistencia::where('dni', $validatedData['dni'])
            ->whereDate('created_at', $today)
            ->first();

        if ($validatedData['tipo_id'] == 1) {
            // Tipo 1: Registro de entrada
            if ($existingAsistencia && $existingAsistencia->hora_entrada) {
                return back()->withErrors(['tipo' => 'El empleado ya ha registrado su entrada hoy.'])->withInput();
            }
            // Crear una nueva instancia de asistencia si no existe
            $asistencia = $existingAsistencia ?: new Asistencia();
            $asistencia->fill($validatedData);
            $asistencia->dni = $empleado->dni; // Asignar el DNI del empleado
            $asistencia->hora_entrada = now(); // Registrar la hora de entrada
            $asistencia->latitud = $validatedData['latitud']; // Guardar latitud
            $asistencia->longitud = $validatedData['longitud']; // Guardar longitud
            $asistencia->ip_address = $ipAddress; // Guardar dirección IP
            $asistencia->save();
            
        } elseif ($validatedData['tipo_id'] == 2) {
            // Tipo 2: Registro de salida
            if (!$existingAsistencia || !$existingAsistencia->hora_entrada) {
                return back()->withErrors(['tipo' => 'El empleado debe registrar su entrada antes de la salida.'])->withInput();
            }

            // Actualizar la asistencia existente con la hora de salida
            $asistencia = $existingAsistencia;
            $asistencia->hora_salida = now(); // Actualizar la hora de salida
            $asistencia->latitud_salida = $validatedData['latitud']; // Guardar latitud de salida (opcional)
            $asistencia->longitud_salida = $validatedData['longitud']; // Guardar longitud de salida (opcional)
            $asistencia->ip_address_salida = $ipAddress; // Guardar dirección IP de salida (opcional)
            $asistencia->save();
        }

        return redirect('/')->with('success', 'Asistencia guardada exitosamente!');
    }







}