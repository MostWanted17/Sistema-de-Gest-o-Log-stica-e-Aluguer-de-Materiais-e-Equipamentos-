<?php
/* Smarty version 3.1.48, created on 2023-08-15 09:12:59
  from 'C:\xampp\htdocs\view\templates\includes\menu_sidebar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_64db257b326180_43056860',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd201c3a884faad9c9125692a82296ac09048217e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\view\\templates\\includes\\menu_sidebar.tpl',
      1 => 1692083574,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64db257b326180_43056860 (Smarty_Internal_Template $_smarty_tpl) {
?><aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="/">
            <img src="<?php echo $_smarty_tpl->tpl_vars['images']->value;?>
/icon/logo.png" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
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
        </nav>
    </div>
</aside>

<?php }
}
