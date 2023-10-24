<?php
/* Smarty version 3.1.48, created on 2023-10-17 08:24:13
  from 'C:\xampp\htdocs\view\templates\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_652e288d1b0465_07299005',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'db0474d99d1bd50b34754fabd6adb7d4df328d88' => 
    array (
      0 => 'C:\\xampp\\htdocs\\view\\templates\\login.tpl',
      1 => 1697523617,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_652e288d1b0465_07299005 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login</title>

    <!-- Fontfaces CSS -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
/font-face.css" rel="stylesheet" media="all">
    <link href="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/wow/animate.css" rel="stylesheet" media="all">
    <link href="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/slick/slick.css" rel="stylesheet" media="all">
    <link href="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">

    <!-- Main CSS -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition" style="background-image: url('../../assets/images/background.jpg') !important;
background-repeat: no-repeat;background-size: cover;
    background-position: center;">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="/">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['images']->value;?>
/icon/logo.png" alt="logo" width="250px">
                            </a>
                        </div>
                        <div class="login-form">
                            <div class="form-group">
                                <label for="username">Usuário</label>
                                <input class="au-input au-input--full" type="text" id="username" name="username"
                                    placeholder="Nome de Usuário">
                            </div>
                            <div class="form-group">
                                <label for="password">Senha</label>
                                <input class="au-input au-input--full" type="password" id="password" name="password"
                                    placeholder="Sua senha" autocomplete="current-password">
                            </div>
                            <div class="login-checkbox">
                                <label>
                                    <!-- Checkbox label if needed -->
                                </label>
                                <label>
                                    
                                </label>
                            </div>
                            <button class="au-btn au-btn--block au-btn--green m-b-20"
                                onclick="new Login().login(this);">Entrar</button>
                            <div id="error-message"></div>
                            <div class="register-link">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/jquery-3.2.1.min.js"><?php echo '</script'; ?>
>
    <!-- Bootstrap JS -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/bootstrap-4.1/popper.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/bootstrap-4.1/bootstrap.min.js"><?php echo '</script'; ?>
>
    <!-- Vendor JS -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/slick/slick.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/wow/wow.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/animsition/animsition.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/bootstrap-progressbar/bootstrap-progressbar.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/counter-up/jquery.waypoints.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/counter-up/jquery.counterup.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/circle-progress/circle-progress.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/perfect-scrollbar/perfect-scrollbar.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/chartjs/Chart.bundle.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/select2/select2.min.js"><?php echo '</script'; ?>
>

    <!-- Main JS -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
/main.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="node_modules/validator/validator.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
/config/index.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
/Requisicao/index.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
/Login/index.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
/sweetalert2@10.js"><?php echo '</script'; ?>
>

</body>

</html><?php }
}
