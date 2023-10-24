<?php
require '../lib/autoload.php';
    $aluguer = new Aluguer();
    $lista = $aluguer->getAluguer();
    echo json_encode($lista);
