<?php
require '../lib/autoload.php';
    $viagem = new Viagem();
    $lista = $viagem->removeViagem($_POST[0]);
    echo json_encode(1);
