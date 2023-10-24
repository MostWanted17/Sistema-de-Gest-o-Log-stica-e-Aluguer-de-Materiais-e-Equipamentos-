<?php
$smarty = new Template();
$smarty->assign('css', Rotas::get_CSS());
$smarty->assign('js', Rotas::get_JS());
$smarty->assign('vendor', Rotas::get_VENDOR());
$smarty->assign('images', Rotas::get_IMAGES());
$smarty->display('maps.tpl');