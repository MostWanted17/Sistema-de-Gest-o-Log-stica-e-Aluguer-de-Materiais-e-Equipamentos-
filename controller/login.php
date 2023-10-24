<?php
require '../lib/autoload.php';
if (isset($_POST)) {
    $login = new Login();
    echo json_encode($login->getLogin($_POST[0],$_POST[1]));
}