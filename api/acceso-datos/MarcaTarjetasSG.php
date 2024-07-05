<?php
require_once __DIR__ . '/../../entidades/AutorizacionDTO.php';
require_once __DIR__ . '/../../entidades/RespuestaAutorizacionDTO.php';

class MarcaTarjetasSG {
    private $url;


    function __construct(){
        $this->url = 'http://25.48.47.93:8083/api/gateway2/sendJson';
    }

    function enviarRespuestaAutorizacion(RespuestaAutorizacionDTO $respuestaAutorizacionDTO) {
        $data = [
            'codigo_procesamiento' => $respuestaAutorizacionDTO->codigoProcesamiento,
            'monto' => $respuestaAutorizacionDTO->montoTransaccion,
            'num_secuencia' => $respuestaAutorizacionDTO->numeroSecuenciaSistema,
            'num_seguimiento' => $respuestaAutorizacionDTO->numeroReferenciaSeguimiento,
            'identificador' => $respuestaAutorizacionDTO->identificadorAutorizacion,
            'comercio' => $respuestaAutorizacionDTO->identificadorComercio
        ];

        // Prepare POST data
        $opciones = [
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => json_encode($data),
            ],
        ];

        $contexto  = stream_context_create($opciones);
        $respuestaSync = file_get_contents($this->url, false, $contexto);
        return json_decode($respuestaSync, true);
    }


}
?>