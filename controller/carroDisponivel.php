<?php
require '../lib/autoload.php';
    $carro = new Carro();
    $lista = $carro->getCarroDisponviel();
    echo json_encode($lista);
