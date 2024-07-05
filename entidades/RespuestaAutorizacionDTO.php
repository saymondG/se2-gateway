<?php
class RespuestaAutorizacionDTO {
    public $codigoProcesamiento;
    public $montoTransaccion;
    public $numeroTarjeta;
    public $numeroSecuenciaSistema;
    public $numeroReferenciaSeguimiento;
    public $identificadorAutorizacion;
    public $identificadorComercio;

    function __construct($codigoProcesamiento = null, $montoTransaccion = null, $numeroTarjeta = null, $numeroSecuenciaSistema = null,
                         $numeroReferenciaSeguimiento = null, $identificadorAutorizacion = null, $identificadorComercio = null) {
        $this->codigoProcesamiento = $codigoProcesamiento;
        $this->montoTransaccion = $montoTransaccion;
        $this->numeroTarjeta = $numeroTarjeta;
        $this->numeroSecuenciaSistema = $numeroSecuenciaSistema;
        $this->numeroReferenciaSeguimiento = $numeroReferenciaSeguimiento;
        $this->identificadorAutorizacion = $identificadorAutorizacion;
        $this->identificadorComercio = $identificadorComercio;
    }
}