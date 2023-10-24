<?php
require '../lib/autoload.php';
    $carga = new Carga();
    $lista = $carga->getCarga();
    echo json_encode($lista);
