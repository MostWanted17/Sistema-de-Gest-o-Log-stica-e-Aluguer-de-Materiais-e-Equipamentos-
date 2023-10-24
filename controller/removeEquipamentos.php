<?php
require '../lib/autoload.php';
    $equipamentos = new Equipamentos();
    $lista = $equipamentos->removeEquipamentos($_POST[0]);
    echo json_encode(1);
