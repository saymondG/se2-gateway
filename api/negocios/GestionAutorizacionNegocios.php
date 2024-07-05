<?php
require_once __DIR__ . '/../acceso-datos/GestionAutorizacionAD.php';
require_once __DIR__ . '/../../entidades/AutorizacionDTO.php';
require_once __DIR__ . '/../../utilidades/GestionAutorizacionRN.php';

class GestionAutorizacionNegocios
{

    private $autorizacionAD;
    private $autorizacionRN;

    function __construct() {
        $this->autorizacionAD = new GestionAutorizacionAD();
        $this->autorizacionRN = new GestionAutorizacionRN();
    }

    function gestionarAutorizacion(AutorizacionDTO $autorizacionDTO) {
        $validarIdentificadorComercio = $this->autorizacionRN->validarIdentificadorComercio($autorizacionDTO->identificadorComercio);
        if(!$validarIdentificadorComercio['status']) {
            return $validarIdentificadorComercio['message'];
        }

        $validarPAN = $this->autorizacionRN->validarPAN($autorizacionDTO->pan);
        if(!$validarPAN['status']) {
            return $validarPAN['message'];
        }

        $validarMarcaTarjeta = $this->autorizacionRN->validarMarcaTarjeta($autorizacionDTO->marcaTarjeta);
        if(!$validarMarcaTarjeta['status']) {
            return $validarMarcaTarjeta['message'];
        }

        $validarMonto = $this->autorizacionRN->validarMonto($autorizacionDTO->monto);
        if(!$validarMonto['status']) {
            return $validarMonto['message'];
        }

        $validarNumeroReferenciaSeguimiento = $this->autorizacionRN->validarNumeroReferenciaSeguimiento($autorizacionDTO->numeroReferenciaSeguimiento);
        if(!$validarNumeroReferenciaSeguimiento['status']) {
            return $validarNumeroReferenciaSeguimiento['message'];
        }

        return $this->autorizacionAD->gestionAutorizacion($autorizacionDTO);
    }


}

?>