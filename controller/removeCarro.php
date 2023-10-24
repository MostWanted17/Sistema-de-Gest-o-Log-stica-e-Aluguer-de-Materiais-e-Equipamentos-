<?php
require '../lib/autoload.php';
    $carro = new Carro();
    $lista = $carro->removeCarro($_POST[0]);
    echo json_encode(1);
