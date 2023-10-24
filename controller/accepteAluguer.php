<?php
require '../lib/autoload.php';
    $pendentes = new Pendentes();
    $lista = $pendentes->accepteAluguer($_POST[0]);
    echo json_encode(1);
