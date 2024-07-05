<?php
class GestionAutorizacionRN
{
    function __construct() {
    }

    function validarIdentificadorComercio($data) {
        if(is_null($data)) {
            return ['status' => false, 'message' => 'El identificador de comercio es nulo'];
        }
        if(empty($data)) {
            return ['status' => false, 'message' => 'El identificador de comercio esta vacio'];
        }
        return ['status' => true];
    }

    function validarPAN($data) {

        if(is_null($data)) {
            return ['status' => false, 'message' => 'El PAN es nula'];
        }
        if(empty($data)) {
            return ['status' => false, 'message' => 'El PAN esta vacio'];
        }
        if (!(strlen($data) == 16)) {
            return ['status' => false, 'message' => 'El Número de Tarjeta debe de tener 16 digitos'];
        }

        $digits = str_split($data);
        $digits = array_reverse($digits);

        $sum = 0;
        for ($i = 0; $i < count($digits); $i++) {
            $digit = (int)$digits[$i];

            if (!($i % 2 == 0)) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $sum += $digit;
        }

        if (($sum % 10) == 0) {
            return ['status' => true];
        } else {
            return ['status' => false, 'message' => 'El Número de Tarjeta no es válido'];
        }
    }

    function validarMarcaTarjeta($data) {
        if(is_null($data)) {
            return ['status' => false, 'message' => 'La marca de la tarjeta es nula'];
        }
        if(empty($data)) {
            return ['status' => false, 'message' => 'La marca de la tarjeta esta vacia'];
        }

        if(!($data == 'VISA') && !($data == 'Mastercard') && !($data == 'American Express')) {
            return ['status' => false, 'message' => 'La marca de tarjeta debe ser VISA, Mastercard o American Express.'];
        }
        return ['status' => true];
    }

    function validarMonto($data) {
        if(is_null($data)) {
            return ['status' => false, 'message' => 'El monto es nulo'];
        }
        if(empty($data)) {
            return ['status' => false, 'message' => 'El monto esta vacio'];
        }
        if(!is_numeric($data)) {
            return ['status' => false, 'message' => 'El monto debe ser un numero'];
        }
        return ['status' => true];
    }

    function validarNumeroReferenciaSeguimiento($data) {
        if(is_null($data)) {
            return ['status' => false, 'message' => 'El numero de referencia de seguimiento es nulo'];
        }
        if(empty($data)) {
            return ['status' => false, 'message' => 'El numero de referencia de seguimiento esta vacio'];
        }
        if (!(strlen($data) == 12)) {
            return ['status' => false, 'message' => 'El numero de referencia de seguimiento debe ser de 12 caracteres'];
        }
        return ['status' => true];
    }

    function validarTipoTransferencia($data) {
        if(is_null($data)) {
            return ['status' => false, 'message' => 'El tipo de transferencia es nulo'];
        }
        if(empty($data)) {
            return ['status' => false, 'message' => 'El tipo de transferencia esta vacio'];
        }

        if(!($data == 'Debito') && !($data == 'Credito')) {
            return ['status' => false, 'message' => 'El tipo de transferencia debe ser Débito o Crédito.'];
        }
        return ['status' => true];
    }
}

?>