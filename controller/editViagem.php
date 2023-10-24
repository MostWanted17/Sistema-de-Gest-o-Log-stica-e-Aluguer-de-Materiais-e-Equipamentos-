<?php
require '../lib/autoload.php';
    $viagem = new Viagem();
    $viagem->editViagem($_POST[0],$_POST[1]);
    echo json_encode(1);
