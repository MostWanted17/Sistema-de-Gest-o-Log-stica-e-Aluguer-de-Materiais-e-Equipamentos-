<?php
require '../lib/autoload.php';
    $carro = new Carro();
    $lista = $carro->getCarro();
    echo json_encode($lista);
