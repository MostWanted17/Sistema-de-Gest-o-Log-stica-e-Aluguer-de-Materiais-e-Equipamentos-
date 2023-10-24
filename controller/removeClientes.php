<?php
require '../lib/autoload.php';
    $clientes = new Clientes();
    $lista = $clientes->removeClientes($_POST[0]);
    echo json_encode(1);
