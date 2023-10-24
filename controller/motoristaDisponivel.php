<?php
require '../lib/autoload.php';
    $motorista = new Motorista();
    $lista = $motorista->getMotoristaDisponivel();
    echo json_encode($lista);
