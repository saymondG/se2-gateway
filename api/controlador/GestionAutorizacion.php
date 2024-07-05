<?php
require_once __DIR__ . '/../negocios/GestionAutorizacionNegocios.php';
require_once __DIR__ . '/../../entidades/AutorizacionDTO.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS'); // Métodos permitidos
header('Access-Control-Allow-Headers: Content-Type, Authorization');


$putData = file_get_contents("php://input");
$data = json_decode($putData, true);

if (!$data) {
    echo json_encode(["error" => "JSON invalido"]);
    header("HTTP/1.1 400 Bad ");
    exit();
}

$identificadorComercio = isset($data['identificadorComercio']) ? $data['identificadorComercio'] : null;
$pan = isset($data['pan']) ? $data['pan'] : null;
$marcaTarjeta = isset($data['marcaTarjeta']) ? $data['marcaTarjeta'] : null;
$monto = isset($data['monto']) ? $data['monto'] : null;
$numeroReferenciaSeguimiento = isset($data['numeroReferenciaSeguimiento']) ? $data['numeroReferenciaSeguimiento'] : null;

$autorizacionDTO = new AutorizacionDTO($identificadorComercio, $pan, $marcaTarjeta, $monto, $numeroReferenciaSeguimiento);


$autorizacionesNegocios = new GestionAutorizacionNegocios();

$resultado = $autorizacionesNegocios->gestionarAutorizacion($autorizacionDTO);

header('Content-Type: application/json');
if ($resultado != "false") {
    header("HTTP/1.1 200 ok");
    echo json_encode($resultado);
} else {
    header("HTTP/1.1 500 Internal Server Error");
    echo $resultado;
}

exit();
?>