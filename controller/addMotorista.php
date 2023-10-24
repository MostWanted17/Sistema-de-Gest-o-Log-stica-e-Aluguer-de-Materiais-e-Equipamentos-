<?php
require '../lib/autoload.php';
    $motorista = new Motorista();
    $lista = $motorista->addMotorista($_POST[0],$_POST[1],$_POST[2],$_POST[3],$_POST[4]);
    echo json_encode(1);
