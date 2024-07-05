<?php
class AutorizacionDTO {
    public $identificadorComercio;
    public $pan;
    public $marcaTarjeta;
    public $monto;
    public $numeroReferenciaSeguimiento;

    function __construct($identificadorComercio = null, $pan = null, $marcaTarjeta = null, $monto = null,
                         $numeroReferenciaSeguimiento = null) {
        $this->identificadorComercio = $identificadorComercio;
        $this->pan = $pan;
        $this->marcaTarjeta = $marcaTarjeta;
        $this->monto = $monto;
        $this->numeroReferenciaSeguimiento = $numeroReferenciaSeguimiento;
    }
}
