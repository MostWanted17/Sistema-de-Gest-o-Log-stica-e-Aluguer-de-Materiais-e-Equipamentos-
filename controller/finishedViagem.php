<?php
require '../lib/autoload.php';
    $viagem = new Viagem();
    $lista = $viagem->finishedViagem($_POST[0]);
    echo json_encode(1);
