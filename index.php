<?php
require './lib/autoload.php';
define('AUTH_SESSION_KEY', 'auth_session');

session_start();

function is_authenticated(): bool
{
    return isset($_SESSION[AUTH_SESSION_KEY]);
}

$smarty = new Template();
$smarty->assign('css', Rotas::get_CSS());
$smarty->assign('js', Rotas::get_JS());
$smarty->assign('vendor', Rotas::get_VENDOR());
$smarty->assign('images', Rotas::get_IMAGES());
$smarty->assign('firstpage', Rotas::get_WebSite());
$smarty->assign('funcionarios', Rotas::get_FUNCIONARIOS());
$smarty->assign('carga', Rotas::get_CARGA());
$smarty->assign('carro', Rotas::get_CARRO());
$smarty->assign('maps', Rotas::get_MAPS());
$smarty->assign('viagem', Rotas::get_VIAGEM());
$smarty->assign('motorista', Rotas::get_MOTORISTA());
$smarty->assign('pendentes', Rotas::get_PENDENTES());
$smarty->assign('equipamentos', Rotas::get_EQUIPAMENTOS());
$smarty->assign('clientes', Rotas::get_CLIENTES());
$smarty->assign('aluguer', Rotas::get_ALUGUER());
$smarty->assign('logout', Rotas::get_LOGOUT());



if (session_status() === PHP_SESSION_ACTIVE) {
    if (is_authenticated()) {
        $smarty->assign('nome', $_SESSION['auth_session']['nome']);
        $smarty->assign('nome_nivel', $_SESSION['auth_session']['nome_nivel']);
        $smarty->assign('id_nivel', $_SESSION['auth_session']['id_nivel']);
        if(isset($_GET['pag'])){
            $smarty->assign('activePage', $_GET['pag']);
        }else{
            $smarty->assign('activePage', "");
        }
        
        $smarty->display('index.tpl');
    } else {
        $smarty->display('login.tpl');
    }
} else {
    echo 'Erro: Sessão não foi iniciada.';
}