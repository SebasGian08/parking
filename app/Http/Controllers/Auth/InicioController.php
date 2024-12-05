<?php

namespace BolsaTrabajo\Http\Controllers\Auth;

use BolsaTrabajo\Inicio;
use BolsaTrabajo\Anuncio;
use BolsaTrabajo\Cargo;
use BolsaTrabajo\Condicion;
use Illuminate\Http\Request;
use BolsaTrabajo\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use BolsaTrabajo\Empresa;
use BolsaTrabajo\Programa;
use BolsaTrabajo\Participantes;
use BolsaTrabajo\Alumno;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class InicioController extends Controller
{
        public function index(Request $request)
        {
            $fechaDesde = $request->input('fecha_desde', "2000-01-01");
            $fechaHasta = $request->input('fecha_hasta', Carbon::now()->addDay()->format('Y-m-d'));
        
            // Obtener datos filtrados por fechas
            $totalVehiculos = $this->getTotalDeVehiculos($fechaDesde, $fechaHasta);
            $totalCarrosActivos = $this->getTotalCarrosActivos($fechaDesde, $fechaHasta);
            $totalTickets = $this->getTotalTickets($fechaDesde, $fechaHasta);
        
            $TotalTicketsPorDia = $this->getTotalTicketsPorDia($fechaDesde, $fechaHasta);
            $getTopFaltas = $this->getTopFaltas($fechaDesde,$fechaHasta);

        
            // Pasar los datos a la vista 'auth.inicio.index'
            if (Auth::guard('web')->user()->profile_id == \BolsaTrabajo\App::$PERFIL_DESARROLLADOR ||
                Auth::guard('web')->user()->profile_id == \BolsaTrabajo\App::$PERFIL_ADMINISTRADOR ||
                Auth::guard('web')->user()->profile_id == \BolsaTrabajo\App::$PERFIL_SUPERVISOR
                ) {
                return view('auth.inicio.index', compact('totalVehiculos','totalCarrosActivos','totalTickets','TotalTicketsPorDia','getTopFaltas',
                    'fechaDesde', 'fechaHasta'));
            }
        
            return redirect('/auth/error'); // Redirige a una página predeterminada si la condición no se cumple
        }
    

        /* Indicadores */
        private function getTotalDeVehiculos($fecha_desde, $fecha_hasta)
        {
            return DB::table('vehiculos')
                ->whereBetween('created_at', [$fecha_desde, $fecha_hasta])
                ->where('estado', '1') 
                ->whereNull('deleted_at') // no contar con los eliminados
                ->count();
        }
    
        private function getTotalCarrosActivos($fecha_desde, $fecha_hasta)
        {
            return DB::table('tickets')
                ->whereBetween('created_at', [$fecha_desde, $fecha_hasta])
                ->where('estado', '1') 
                ->whereNull('deleted_at') // no contar con los eliminadoss
                ->count();
        }
    
    
        private function getTotalTickets($fecha_desde, $fecha_hasta)
        {
            return DB::table('tickets')
                ->whereBetween('created_at', [$fecha_desde, $fecha_hasta])
                ->whereNull('deleted_at') // no contar con los eliminados
                ->count();
        }
    
        private function getTotalTicketsPorDia($fecha_desde, $fecha_hasta)
        {
            return DB::table(DB::raw('
                (SELECT "Lunes" AS dia, 2 AS numero_dia UNION ALL
                SELECT "Martes", 3 UNION ALL
                SELECT "Miércoles", 4 UNION ALL
                SELECT "Jueves", 5 UNION ALL
                SELECT "Viernes", 6 UNION ALL
                SELECT "Sábado", 7 UNION ALL
                SELECT "Domingo", 1) AS dias_semana
            '))
            ->select(DB::raw('
                dias_semana.dia, 
                IFNULL(COUNT(t.id), 0) AS total_tickets
            '))
            ->leftJoin('tickets as t', function ($join) use ($fecha_desde, $fecha_hasta) {
                $join->on(DB::raw('DAYOFWEEK(t.created_at)'), '=', 'dias_semana.numero_dia')
                    ->whereBetween('t.created_at', [$fecha_desde, $fecha_hasta]);
            })
            ->groupBy('dias_semana.dia')
            ->orderByRaw('FIELD(dias_semana.dia, "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo")')
            ->get();
        }

        



        // segundo grafico tardanzas
        private function getTopFaltas($fecha_desde, $fecha_hasta)
        {
            return DB::table('asistencias as a')
                ->whereBetween('a.created_at', [$fecha_desde, $fecha_hasta])
                ->join('empleados as e', 'a.dni', '=', 'e.dni')
                ->whereNull('a.hora_entrada') // Considerar solo faltas cuando hora_entrada es NULL
                ->where('estado', '1') 
                ->whereNull('a.deleted_at') // Excluye asistencias eliminadas
                ->selectRaw('e.dni as empleado, e.nombre, COUNT(*) as faltas')
                ->groupBy('e.dni', 'e.nombre')
                ->orderBy('faltas', 'desc')
                ->limit(10)
                ->get();
        }
        

        




        


        


        
}