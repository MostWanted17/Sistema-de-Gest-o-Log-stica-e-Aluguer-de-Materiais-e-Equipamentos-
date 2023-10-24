<?php
require '../lib/autoload.php';
    $funcionarios = new Funcionarios();
    $lista = $funcionarios->getFuncionarios();
    echo json_encode($lista);
