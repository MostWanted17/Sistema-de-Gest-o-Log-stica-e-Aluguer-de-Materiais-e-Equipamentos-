<?php
require '../lib/autoload.php';
    $pendentes = new Pendentes();
    $lista = $pendentes->getAluguer();
    echo json_encode($lista);
