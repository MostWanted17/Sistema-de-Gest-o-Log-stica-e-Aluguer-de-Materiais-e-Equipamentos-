<?php
require '../lib/autoload.php';
    $motorista = new Motorista();
    $lista = $motorista->removeMotorista($_POST[0]);
    echo json_encode(1);
