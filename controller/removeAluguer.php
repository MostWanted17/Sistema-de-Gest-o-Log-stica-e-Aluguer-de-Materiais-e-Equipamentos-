<?php
require '../lib/autoload.php';
    $aluguer = new Aluguer();
    $lista = $aluguer->removeAluguer($_POST[0]);
    echo json_encode(1);
