<?php
/* Smarty version 3.1.48, created on 2023-10-09 14:05:04
  from 'C:\xampp\htdocs\view\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6523ec70198558_48295800',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '09d432aedf8270136d2f53ae8a8ed06a48cbd0c8' => 
    array (
      0 => 'C:\\xampp\\htdocs\\view\\templates\\index.tpl',
      1 => 1696853091,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:includes/headerMobile.tpl' => 1,
    'file:includes/menu_sidebar.tpl' => 1,
    'file:includes/header.tpl' => 1,
  ),
),false)) {
function content_6523ec70198558_48295800 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
/font-face.css" rel="stylesheet" media="all">
    <link href="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
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


    <!-- Main CSS-->
    <link href="<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
/theme.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        body {
            opacity: 0.95 !important;

        }

        #map {
            height: 400px;
            width: 100%;
        }
    </style>
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
/leaflet.css" />
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
/leaflet-routing-machine.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
/lrm-graphhopper-1.2.0.min.js"><?php echo '</script'; ?>
>


</head>

<body class="animsition" style="background-image: url('../../assets/images/background.jpg') !important;
background-repeat: no-repeat;background-size: cover;
    background-position: center;">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <?php $_smarty_tpl->_subTemplateRender("file:includes/headerMobile.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <?php $_smarty_tpl->_subTemplateRender("file:includes/menu_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <?php $_smarty_tpl->_subTemplateRender("file:includes/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <?php 

                Rotas::get_Pagina();

                ?>
            </div>

        </div>

        <!-- Jquery JS-->
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/jquery-3.2.1.min.js"><?php echo '</script'; ?>
>
        <!-- Bootstrap JS-->
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/bootstrap-4.1/popper.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/bootstrap-4.1/bootstrap.min.js"><?php echo '</script'; ?>
>
        <!-- Vendor JS       -->
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/slick/slick.min.js">
        <?php echo '</script'; ?>
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
/bootstrap-progressbar/bootstrap-progressbar.min.js">
        <?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/counter-up/jquery.waypoints.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['vendor']->value;?>
/counter-up/jquery.counterup.min.js">
        <?php echo '</script'; ?>
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
/select2/select2.min.js">
        <?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="node_modules/validator/validator.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
/sweetalert2@10.js"><?php echo '</script'; ?>
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
/Relatorios/index.js"><?php echo '</script'; ?>
>


        <!-- Main JS-->
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
/main.js"><?php echo '</script'; ?>
>

</body>

</html>
<!-- end document--><?php }
}
