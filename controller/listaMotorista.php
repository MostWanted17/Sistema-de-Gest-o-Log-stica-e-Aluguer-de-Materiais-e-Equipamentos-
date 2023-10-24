<?php
require '../lib/autoload.php';
    $motorista = new Motorista();
    $lista = $motorista->getMotorista();
    echo json_encode($lista);
