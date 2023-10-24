<?php
require '../lib/autoload.php';
    $viagem = new Viagem();
    $lista = $viagem->addViagem($_POST[0],$_POST[1],$_POST[2],$_POST[3],$_POST[4],$_POST[5],$_POST[6],$_POST[7],$_POST[8],$_POST[9]);
    echo json_encode(1);
