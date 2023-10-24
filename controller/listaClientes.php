<?php
require '../lib/autoload.php';
    $clientes = new Clientes();
    $lista = $clientes->getClientes();
    echo json_encode($lista);
