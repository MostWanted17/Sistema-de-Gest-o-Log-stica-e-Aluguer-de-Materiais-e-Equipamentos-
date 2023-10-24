<?php
require '../lib/autoload.php';
    $equipamentos = new Equipamentos();
    $lista = $equipamentos->getEquipamentos();
    echo json_encode($lista);
