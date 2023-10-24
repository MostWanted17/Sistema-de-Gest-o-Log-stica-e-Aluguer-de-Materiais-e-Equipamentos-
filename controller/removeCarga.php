<?php
require '../lib/autoload.php';
    $carga = new Carga();
    $lista = $carga->removeCarga($_POST[0]);
    echo json_encode(1);
