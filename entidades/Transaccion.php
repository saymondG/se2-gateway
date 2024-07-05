<?php
class Transaccion {
    public $id;
    public $cuentaIban;
    public $pan;
    public $marcaTarjeta;
    public $monto;
    public $numeroSecuencia;
    public $identificadorAutorizacion;
    public $numeroReferenciaSeguimiento;
    public $tipoTransferencia;
    public $estado;
    public $fechaCreacion;
    public $fechaModificacion;

     function __construct($id = null, $cuentaIban = null, $pan = null, $marcaTarjeta = null, $monto = null,
                                $numeroSecuencia = null, $identificadorAutorizacion = null, $numeroReferenciaSeguimiento = null,
                                $tipoTransferencia = null, $estado = null, $fechaCreacion = null, $fechaModificacion = null) {
        $this->id = $id;
        $this->cuentaIban = $cuentaIban;
        $this->pan = $pan;
        $this->marcaTarjeta = $marcaTarjeta;
        $this->monto = $monto;
        $this->numeroSecuencia = $numeroSecuencia;
        $this->identificadorAutorizacion = $identificadorAutorizacion;
        $this->numeroReferenciaSeguimiento = $numeroReferenciaSeguimiento;
        $this->tipoTransferencia = $tipoTransferencia;
        $this->estado = $estado;
        $this->fechaCreacion = $fechaCreacion;
        $this->fechaModificacion = $fechaModificacion;
    }
}
