<?php
require '../lib/autoload.php';
    $viagem = new Viagem();
    $lista = $viagem->getViagem();
    echo json_encode($lista);
