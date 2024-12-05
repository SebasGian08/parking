<div id="modalMantenimientoCalculo" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg" style="width:40% !important;">
        <form enctype="multipart/form-data" action="{{ route('auth.vehiculos.store') }}" id="registroCalculo" method="POST"
            data-ajax="true" data-close-modal="true" data-ajax-loading="#loading"
            data-ajax-success="OnSuccessRegistroCalculo" data-ajax-failure="OnFailureRegistroCalculo">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cálculo Previo</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="padding: 8px !important; font-weight: bold; text-align: left; font-size: 15px;">
                                Placa
                            </td>
                            <td style="padding: 8px !important; text-align: center; font-size: 15px;">:</td>
                            <td style="padding: 8px !important; text-align: left; font-size: 15px;">
                                {{ $ticket->vehiculo->placa ?? 'Sin vehículo asociado' }}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 8px !important; font-weight: bold; text-align: left; font-size: 15px;">
                                Horas de servicio
                            </td>
                            <td style="padding: 8px !important; text-align: center; font-size: 15px;">:</td>
                            <td style="padding: 8px !important; text-align: left; font-size: 15px;">
                                {{ $horas_servicio }}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 8px !important; font-weight: bold; text-align: left; font-size: 15px;">
                                Tarifa
                            </td>
                            <td style="padding: 8px !important; text-align: center; font-size: 15px;">:</td>
                            <td style="padding: 8px !important; text-align: left; font-size: 15px;">
                                {{ $tarifa }}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 8px !important; font-weight: bold; text-align: left; font-size: 15px;">
                                Monto
                            </td>
                            <td style="padding: 8px !important; text-align: center; font-size: 15px;">:</td>
                            <td style="padding: 8px !important; text-align: left; font-size: 15px;">
                                {{ $monto }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="background-color:#3ce797; border-color:#20a366; color:#fff;">
                        <i class="fa fa-times"></i> Ok
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
