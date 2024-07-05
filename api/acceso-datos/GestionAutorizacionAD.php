<?php
//require_once __DIR__ . '/../../utilidades/ConexionBaseDatos.php';
require_once __DIR__ . '/../../entidades/AutorizacionDTO.php';
require_once __DIR__ . '/../../entidades/RespuestaAutorizacionDTO.php';

require_once __DIR__ . '/../../entidades/Transaccion.php';
require_once __DIR__ . '/CuentaBancariaSG.php';
require_once __DIR__ . '/TransaccionSG.php';
require_once __DIR__ . '/MarcaTarjetasSG.php';




class GestionAutorizacionAD {

    private $cuentaBancariaSG;
    private $transaccionSG;
    private $marcaTarjetasSG;

    function __construct(){
        $this->cuentaBancariaSG = new CuentaBancariaSG();
        $this->transaccionSG = new TransaccionSG();
        $this->marcaTarjetasSG = new MarcaTarjetasSG();
    }

    function gestionAutorizacion(AutorizacionDTO $autorizacionDTO) {

        $cuentaBanco = $this->buscarCuentaBanco($autorizacionDTO->identificadorComercio);
        if(is_null($cuentaBanco)) {
            return ["error" => "La cuenta donde se quiere depositar los fondos no existe"];
        }

        $cuentaIban = $cuentaBanco['cuenta_iban'];

        if(!$this->consultarFondos($autorizacionDTO->pan, $autorizacionDTO->monto)) {
            $respuestaTransaccion = $this->registrarTransaccion($autorizacionDTO, $cuentaIban, 'Declinado');

            $numero_secuencia = $respuestaTransaccion['data']['numero_secuencia'];
            $identificador_autorizacion = $respuestaTransaccion['data']['identificador_autorizacion'];
            $numero_referencia_seguimiento = $respuestaTransaccion['data']['numero_referencia_seguimiento'];

            $respuestaAutorizacion = new RespuestaAutorizacionDTO("Declinado", $autorizacionDTO->monto, $autorizacionDTO->pan,
                $numero_secuencia, $numero_referencia_seguimiento, $identificador_autorizacion, $autorizacionDTO->identificadorComercio);
            $this->marcaTarjetasSG->enviarRespuestaAutorizacion($respuestaAutorizacion);
            return ["resultado" => "Declinado"];
        }

        if (!$this->debitarFondos($autorizacionDTO->pan, $autorizacionDTO->monto)) {
            return $this->createErrorResponse("Hubo un problema al debitar los fondos");
        }

        $respuestaTransaccion = $this->registrarTransaccion($autorizacionDTO, $cuentaIban, 'Aprobado');

        $numero_secuencia = $respuestaTransaccion['data']['numero_secuencia'];
        $identificador_autorizacion = $respuestaTransaccion['data']['identificador_autorizacion'];
        $numero_referencia_seguimiento = $respuestaTransaccion['data']['numero_referencia_seguimiento'];

        $respuestaAutorizacion = new RespuestaAutorizacionDTO("Aprobado", $autorizacionDTO->monto, $autorizacionDTO->pan,
            $numero_secuencia, $numero_referencia_seguimiento, $identificador_autorizacion, $autorizacionDTO->identificadorComercio);
        $this->marcaTarjetasSG->enviarRespuestaAutorizacion($respuestaAutorizacion);
        return ["resultado" => "Aprobado"];

    }

    public function buscarCuentaBanco($identificadorComercio) {
        $cuentaBanco = $this->cuentaBancariaSG->buscarCuentaPorIdComercio($identificadorComercio);
        return empty($cuentaBanco['resultado']) ? null : $cuentaBanco['resultado'][0];
    }

    public function consultarFondos($pan, $monto) {
        $autorizacion = $this->cuentaBancariaSG->consultarFondos($pan, $monto);
        return isset($autorizacion['resultado']) && $autorizacion['resultado'] === "true";
    }

    private function debitarFondos($pan, $monto) {
        return $this->cuentaBancariaSG->debitar($pan, $monto);
    }

    private function registrarTransaccion($autorizacionDTO, $cuentaIban, $estado) {
        $transaccion = new Transaccion(null, $cuentaIban, $autorizacionDTO->pan, $autorizacionDTO->marcaTarjeta, $autorizacionDTO->monto, null, null,
            $autorizacionDTO->numeroReferenciaSeguimiento, "Debito", $estado, null, null);
        return $this->transaccionSG->registrarTransaccion($transaccion);
    }




}
?>