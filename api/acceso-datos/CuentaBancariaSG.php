<?php
require_once __DIR__ . '/../../entidades/AutorizacionDTO.php';

class CuentaBancariaSG {
    private $url;


    function __construct(){
        $this->url = 'http://localhost/sistema-emisor-dos/servicio-gestion-cuentas/api/controlador/cuenta-bancaria-controlador';
    }

    function consultarFondos($pan, $monto) {
        $data = ['pan' => $pan, 'monto' => $monto];

        // Prepare POST data
        $opciones = [
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => json_encode($data),
            ],
        ];

        $contexto  = stream_context_create($opciones);
        $respuestaSync = file_get_contents($this->url.'/ConsultarFondos.php', false, $contexto);
        return json_decode($respuestaSync, true);
    }

    function debitar($pan, $monto) {
        $data = ['pan' => $pan, 'monto' => $monto];

        // Prepare POST data
        $opciones = [
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => json_encode($data),
            ],
        ];

        $contexto  = stream_context_create($opciones);
        $respuestaSync = file_get_contents($this->url.'/Debitar.php', false, $contexto);
        return json_decode($respuestaSync, true);
    }

    function creditar($iban, $monto) {
        $data = ['cuentaIban' => $iban, 'monto' => $monto];

        // Prepare POST data
        $opciones = [
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => json_encode($data),
            ],
        ];

        $contexto  = stream_context_create($opciones);
        $respuestaSync = file_get_contents($this->url.'/Creditar.php', false, $contexto);
        return json_decode($respuestaSync, true);
    }
    function buscarCuentaPorIdComercio($id) {
        $data = ['id' => $id];

        // Prepare POST data
        $opciones = [
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => json_encode($data),
            ],
        ];

        $contexto  = stream_context_create($opciones);
        $respuestaSync = file_get_contents($this->url.'/BuscarCuentaPorIdentificadorComercio.php', false, $contexto);
        return json_decode($respuestaSync, true);
    }



}
?>