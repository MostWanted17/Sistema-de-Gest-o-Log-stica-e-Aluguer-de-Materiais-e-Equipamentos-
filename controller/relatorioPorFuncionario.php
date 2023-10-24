<?php

$smarty = new Template();
if(isset($_POST)){
    $relatorio = new Relatorios();
    $relatorio->getPorFuncionario($_POST['id_credencial']);
}