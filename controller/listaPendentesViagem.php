<?php
require '../lib/autoload.php';
    $pendentes = new Pendentes();
    $lista = $pendentes->getViagem();
    echo json_encode($lista);
