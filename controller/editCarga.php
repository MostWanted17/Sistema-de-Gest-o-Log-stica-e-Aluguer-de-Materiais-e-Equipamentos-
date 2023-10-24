<?php
require '../lib/autoload.php';
    $carga = new Carga();
    $lista = $carga->editCarga($_POST[0],$_POST[1]);
    echo json_encode(1);
