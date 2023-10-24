<?php

$smarty = new Template();
if(isset($_POST)){
    $relatorio = new Relatorios();
    $relatorio->getFuncionarios();
}


