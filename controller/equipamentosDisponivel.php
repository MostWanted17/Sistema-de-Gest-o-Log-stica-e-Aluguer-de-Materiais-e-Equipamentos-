<?php
require '../lib/autoload.php';
    $equipamentos = new Equipamentos();
    $lista = $equipamentos->getEquipamentosDisponivel();
    echo json_encode($lista);
