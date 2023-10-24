<?php
require '../lib/autoload.php';
    $aluguer = new Aluguer();
    $lista = $aluguer->addAluguer($_POST[0],$_POST[1],$_POST[2],$_POST[3],$_POST[4],$_POST[5]);
    echo json_encode(1);
