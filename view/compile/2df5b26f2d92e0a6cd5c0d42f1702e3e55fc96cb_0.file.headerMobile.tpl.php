<?php
/* Smarty version 3.1.48, created on 2023-08-15 09:12:40
  from 'C:\xampp\htdocs\view\templates\includes\headerMobile.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_64db2568252539_28822543',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2df5b26f2d92e0a6cd5c0d42f1702e3e55fc96cb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\view\\templates\\includes\\headerMobile.tpl',
      1 => 1692083532,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64db2568252539_28822543 (Smarty_Internal_Template $_smarty_tpl) {
?><header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="/">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['images']->value;?>
/icon/logo.png" alt="logo" width="200px"/>
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
            <?php if ($_smarty_tpl->tpl_vars['id_nivel']->value == 1) {?>
            <li class="<?php if ($_smarty_tpl->tpl_vars['activePage']->value == 'pendentes') {?>active<?php }
if ($_smarty_tpl->tpl_vars['activePage']->value == '') {?>active<?php }?> has-sub">
                    <a class="js-arrow" href="<?php echo $_smarty_tpl->tpl_vars['pendentes']->value;?>
">
                        <i class="fa fa-tasks"></i>Pendentes</a>
                </li>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['id_nivel']->value != 1) {?>
            <li class="<?php if ($_smarty_tpl->tpl_vars['activePage']->value == 'viagem') {?>active<?php }
if ($_smarty_tpl->tpl_vars['activePage']->value == '') {?>active<?php }?> has-sub">
                <a class="js-arrow" href="<?php echo $_smarty_tpl->tpl_vars['viagem']->value;?>
">
                    <i class="fa fa-road"></i>Viagem</a>
            </li>
            <?php } else { ?>
                <li class="<?php if ($_smarty_tpl->tpl_vars['activePage']->value == 'viagem') {?>active<?php }?> has-sub">
                <a class="js-arrow" href="<?php echo $_smarty_tpl->tpl_vars['viagem']->value;?>
">
                    <i class="fa fa-road"></i>Viagem</a>
            </li>
            <?php }?>
            <li class="<?php if ($_smarty_tpl->tpl_vars['activePage']->value == 'aluguer') {?>active<?php }?> has-sub">
                <a class="js-arrow" href="<?php echo $_smarty_tpl->tpl_vars['aluguer']->value;?>
">
                    <i class="fa fa-briefcase"></i>Aluguer</a>
            </li>
            <li class="has-sub">
                <a href="#" onclick="event.preventDefault();">
                    <i class=""></i>
                </a>
            </li>
            <li class="<?php if ($_smarty_tpl->tpl_vars['activePage']->value == 'carga') {?>active<?php }?> has-sub">
                <a class="js-arrow" href="<?php echo $_smarty_tpl->tpl_vars['carga']->value;?>
">
                    <i class="fa fa-archive"></i>Carga</a>
            </li>
            <li class="<?php if ($_smarty_tpl->tpl_vars['activePage']->value == 'carro') {?>active<?php }?> has-sub">
                <a class="js-arrow" href="<?php echo $_smarty_tpl->tpl_vars['carro']->value;?>
">
                    <i class="fa fa-truck"></i>Carros</a>
            </li>
            <li class="<?php if ($_smarty_tpl->tpl_vars['activePage']->value == 'motorista') {?>active<?php }?> has-sub">
                <a class="js-arrow" href="<?php echo $_smarty_tpl->tpl_vars['motorista']->value;?>
">
                    <i class="fa fa-user"></i>Motoristas</a>
            </li>
            <li class="<?php if ($_smarty_tpl->tpl_vars['activePage']->value == 'equipamentos') {?>active<?php }?> has-sub">
                <a class="js-arrow" href="<?php echo $_smarty_tpl->tpl_vars['equipamentos']->value;?>
">
                    <i class="fa fa-cogs"></i>Equipamentos</a>
            </li>
            <?php if ($_smarty_tpl->tpl_vars['id_nivel']->value == 1) {?>
                <li class="<?php if ($_smarty_tpl->tpl_vars['activePage']->value == 'funcionarios') {?>active<?php }?> has-sub">
                    <a class="js-arrow" href="<?php echo $_smarty_tpl->tpl_vars['funcionarios']->value;?>
">
                        <i class="fa fa-group"></i>Funcionários</a>
                </li>
            <?php }?>
            <li class="<?php if ($_smarty_tpl->tpl_vars['activePage']->value == 'clientes') {?>active<?php }?> has-sub">
                <a class="js-arrow" href="<?php echo $_smarty_tpl->tpl_vars['clientes']->value;?>
">
                    <i class="fa fa-group"></i>Clientes</a>
            </li>
            </ul>
        </div>
    </nav>
</header><?php }
}
