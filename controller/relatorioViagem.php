<?php

$smarty = new Template();
if(isset($_POST)){
    $relatorio = new Relatorios();
    $relatorio->getViagem($_POST['initial-date'],$_POST['final-date']);
}


