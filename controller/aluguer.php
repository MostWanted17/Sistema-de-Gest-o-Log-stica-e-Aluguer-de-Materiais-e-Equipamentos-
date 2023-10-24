<?php
$smarty = new Template();
$smarty->assign('css', Rotas::get_CSS());
$smarty->assign('js', Rotas::get_JS());
$smarty->assign('vendor', Rotas::get_VENDOR());
$smarty->assign('images', Rotas::get_IMAGES());

$smarty->assign('relatorio', Rotas::get_RELATORIOALUGUER());
if (session_status() === PHP_SESSION_ACTIVE) {
    if (is_authenticated()) {
        $smarty->assign('id_nivel', $_SESSION['auth_session']['id_nivel']);
    }else{
        $smarty->assign('id_nivel', 0);
    }
} else {
    $smarty->assign('id_nivel', 0);
    echo 'Erro: Sessão não foi iniciada.';
}
$smarty->display('aluguer.tpl');