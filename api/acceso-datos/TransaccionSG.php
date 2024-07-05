<?php
require_once __DIR__ . '/../../entidades/AutorizacionDTO.php';
require_once __DIR__ . '/../../entidades/Transaccion.php';

class TransaccionSG {
    private $url;


    function __construct(){
        $this->url = 'http://localhost/sistema-emisor-dos/servicio-gestion-transacciones/api/controlador/transaccion-controlador';
    }

    function registrarTransaccion(Transaccion $transaccion) {
        $data = [
            'cuentaIban' => $transaccion->cuentaIban,
            'pan' => $transaccion->pan,
            'marcaTarjeta' => $transaccion->marcaTarjeta,
            'monto' => $transaccion->monto,
            'tipoTransferencia' => $transaccion->tipoTransferencia,
            'estado' => $transaccion->estado,
            'numeroReferencia' => $transaccion->numeroReferenciaSeguimiento
        ];

        $opciones = [
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => json_encode($data),
            ],
        ];

        $contexto  = stream_context_create($opciones);
        $respuestaSync = file_get_contents($this->url.'/RegistrarTransaccion.php', false, $contexto);
        return json_decode($respuestaSync, true);
    }







}
?>