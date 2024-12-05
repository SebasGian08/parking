<?php

namespace BolsaTrabajo\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use BolsaTrabajo\Tickets;
use BolsaTrabajo\Vehiculos;
use BolsaTrabajo\Datos;
use BolsaTrabajo\Tipo;
use BolsaTrabajo\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use BolsaTrabajo\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class TicketsController extends Controller
{
    public function index()
    {
        return view('auth.tickets.index');
    }

    public function list_all(Request $request)
{
    // Verificar si las fechas están bien formateadas
    $desde = $request->has('desde') ? Carbon::parse($request->input('desde'))->startOfDay() : null;
    $hasta = $request->has('hasta') ? Carbon::parse($request->input('hasta'))->endOfDay() : null;

    // Obtener el estado del filtro, si está presente (1 para Activo, 2 para Cerrado)
    $estado = $request->has('estado') ? $request->input('estado') : null;

    // Inicializar la consulta de tickets
    $query = Tickets::with('vehiculo.tipo', 'user'); // Incluye las relaciones necesarias

    // Filtrar por estado si se proporciona
    if ($estado) {
        $query->where('estado', $estado); // Filtro por estado (1 o 2)
    } else {
        // Si no se envía estado, se filtra solo por estado = 1 (Activo)
        $query->where('estado', 1);
    }

    // Aplicar el filtro por fechas si están presentes
    if ($desde && $hasta) {
        // Validar y aplicar el filtro de fechas
        $query->whereBetween('created_at', [$desde, $hasta]);
    }

    // Ordenar y obtener los resultados
    $tickets = $query->orderBy('id', 'desc')->get()->map(function ($ticket) {
        // Convertir la fecha a Carbon
        $createdAt = Carbon::parse($ticket->created_at); // Convierte a Carbon
        return [
            'id' => $ticket->id,
            'vehiculo.placa' => $ticket->vehiculo->placa, // Accede al vehículo
            'vehiculo.tipo.nombre' => $ticket->vehiculo->tipo->nombre, // Accede al tipo del vehículo
            'vehiculo.tipo.montoxhora' => $ticket->vehiculo->tipo->montoxhora, // Accede a la tarifa
            'created_at' => $createdAt->format('Y-m-d H:i:s'),
            'tiempo_inicio' => $ticket->tiempo_inicio,
            'user.nombres' => $ticket->user->nombres,
            'tiempo_fin' => $ticket->tiempo_fin,
            'horas_servicio' => $ticket->horas_servicio,
            'monto' => $ticket->monto,
            'estado' => $ticket->estado,
        ];
    });

    return response()->json(['data' => $tickets]);
}


    

    public function partialView($id = null)
    {
        $entity = null;

        if ($id) {
            $entity = Tickets::find($id);
        }

        // Cargar los tipos de vehículos disponibles
        $tipos = Tipo::all();

        // Obtener los datos de la empresa (nombre y dirección)
        $empresa = Datos::select('nombre', 'direccion')->first();

        // USUARIO
        $User = Auth::guard('web')->user();
        $userId = $User->id; // Extraer el ID del usuario
        
        return view('auth.tickets._Mantenimiento', [
            'Entity' => $entity,
            'User' => $User,
            'userId' => $userId,
            'Tipos' => $tipos,
            'Empresa' => $empresa // Pasar los datos de la empresa a la vista
        ]);
    }


    public function buscarPorPlaca($placa)
    {
        $vehiculo = Vehiculos::with('tipo')->where('placa', $placa)->first();

        if (!$vehiculo) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró información para la placa ingresada.'
            ]);
        }

        return response()->json([
            'success' => true,
            'id' => $vehiculo->id,
            'tipo' => $vehiculo->tipo->nombre,
            'tarifa' => $vehiculo->tipo->montoxhora,
        ]);
    }


    public function store(Request $request)
    {
        $status = false;

        // Validación de los campos
        $validator = Validator::make($request->all(), [
            'id' => 'nullable|exists:tickets,id',
            'vehiculo_id' => 'required',
            'user_id' => 'required',
            'tiempo_inicio' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Success' => $status,
                'Errors' => $validator->errors()
            ]);
        }

        // Verifica si es actualización o creación
        $entity = Tickets::find($request->id) ?? new Tickets();

        // Convertir tiempo_inicio al formato deseado
        try {
            $tiempoInicio = \Carbon\Carbon::parse($request->tiempo_inicio)->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            return response()->json([
                'Success' => $status,
                'Errors' => ['El formato de tiempo_inicio no es válido.']
            ]);
        }

        // Asigna valores a la entidad
        $entity->vehiculo_id = trim($request->vehiculo_id);
        $entity->user_id = trim($request->user_id);
        $entity->tiempo_inicio = $tiempoInicio;

        // Guarda la entidad
        if ($entity->save()) {
            $status = true;
        }

        return response()->json([
            'Success' => $status,
            'Errors' => $status ? [] : ['Error al guardar los datos.']
        ]);
    }
    

    public function delete(Request $request)
    {
        $status = false;

        $entity = Tickets::find($request->id);

        if ($entity && $entity->delete()) {
            $status = true;
        }

        return response()->json(['Success' => $status]);
    }



    /* CALCULAR */
    public function partialViewCalculate($id)
    {
        $ticket = Tickets::with('vehiculo.tipo')->find($id);

        if ($ticket && $ticket->vehiculo) {
            $vehiculo = $ticket->vehiculo; // Extraer el vehículo
            $tiempo_inicio = $ticket->tiempo_inicio;
            $now = now();

            $duracion = $now->diff($tiempo_inicio);
            $horas_servicio = $duracion->h . 'h:' . $duracion->i . 'm';
            $tarifa = $vehiculo->tipo->montoxhora ?? 0;
            $monto = $tarifa * ceil($duracion->h + $duracion->i / 60);


            return view('auth.tickets._Calculate', compact('ticket', 'vehiculo', 'horas_servicio', 'tarifa', 'monto'));
        } else {
            return redirect()->route('auth.tickets')->with('error', 'Ticket o vehículo no encontrado');
        }
    }

    public function confirmar(Request $request)
    {
        $status = false;
        $ticket = Tickets::find($request->id);
        
        if ($ticket) {
            $vehiculo = $ticket->vehiculo;
            if ($vehiculo) {
                $created_at = $ticket->created_at;
                $now = now();
                
                $duracion = $now->diff($created_at);
                $horas_servicio = $duracion->h + ($duracion->i / 60);
                $tarifa = $vehiculo->tipo->montoxhora ?? 0;
                $monto = $tarifa * ceil($horas_servicio); // Asegura que redondee correctamente

                // Actualizar los campos
                $ticket->tiempo_fin = $now;
                $ticket->monto = $monto;
                $ticket->estado = 2; // Establecer el estado a 2

                if ($ticket->save()) {
                    $status = true;
                }
            }
        }
        return response()->json(['Success' => $status]);
    }
    /* FIN */


    /* PARA BUSCAR EN TICKET */
    public function listarPlacasMasFrecuentes()
    {
        // Obtener las placas con más registros en la tabla tickets
        $placas = DB::table('tickets')
            ->select('vehiculos.placa', DB::raw('COUNT(tickets.id) as cantidad'))
            ->join('vehiculos', 'tickets.vehiculo_id', '=', 'vehiculos.id') // Relación con la tabla vehículos
            ->groupBy('vehiculos.placa') // Agrupar por placa
            ->orderByDesc('cantidad') // Ordenar de mayor a menor
            ->take(50) // Opcional: limitar a las 50 placas más frecuentes
            ->get();

        return response()->json($placas);
    }


        
}
