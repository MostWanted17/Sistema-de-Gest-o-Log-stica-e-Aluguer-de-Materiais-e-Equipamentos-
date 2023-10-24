<?php
require '../lib/autoload.php';
    $funcionarios = new Funcionarios();
    $lista = $funcionarios->removeFuncionarios($_POST[0]);
    echo json_encode(1);
