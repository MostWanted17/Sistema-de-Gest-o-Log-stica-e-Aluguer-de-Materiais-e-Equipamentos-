<?php
/* Smarty version 3.1.48, created on 2023-10-17 08:33:40
  from 'C:\xampp\htdocs\view\templates\includes\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_652e2ac471d757_23600799',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '200ad18d88702d77d79f845e6183cc99664308ca' => 
    array (
      0 => 'C:\\xampp\\htdocs\\view\\templates\\includes\\header.tpl',
      1 => 1697523679,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_652e2ac471d757_23600799 (Smarty_Internal_Template $_smarty_tpl) {
?><header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <form class="form-header" action="" method="POST">

                </form>
                <div class="header-button">
                    <div class="noti-wrap">
                        
                    </div>
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['images']->value;?>
/icon/avatar-01.jpg" alt="John Doe" />
                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="#"><?php echo $_smarty_tpl->tpl_vars['nome']->value;?>
</a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a>
                                            <img src="<?php echo $_smarty_tpl->tpl_vars['images']->value;?>
/icon/avatar-01.jpg" alt="<?php echo $_smarty_tpl->tpl_vars['nome']->value;?>
" />
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a><?php echo $_smarty_tpl->tpl_vars['nome']->value;?>
</a>
                                        </h5>
                                        <span class="email"><?php echo $_smarty_tpl->tpl_vars['nome_nivel']->value;?>
</span>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__footer">
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['logout']->value;?>
">
                                            <i class="zmdi zmdi-power"></i>Sair
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header><?php }
}
