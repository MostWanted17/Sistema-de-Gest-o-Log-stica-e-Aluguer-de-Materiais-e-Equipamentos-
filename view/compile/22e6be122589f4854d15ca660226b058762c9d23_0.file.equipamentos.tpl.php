<?php
/* Smarty version 3.1.48, created on 2023-10-23 15:38:57
  from 'C:\xampp\htdocs\view\templates\equipamentos.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_65367771af9de6_13766321',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '22e6be122589f4854d15ca660226b058762c9d23' => 
    array (
      0 => 'C:\\xampp\\htdocs\\view\\templates\\equipamentos.tpl',
      1 => 1698068335,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:includes/footer.tpl' => 1,
  ),
),false)) {
function content_65367771af9de6_13766321 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1">Equipamentos</h2>
                    <div class="overview-wrap mx-3">
                        <input id="searchInput" class="au-input au-input--xl" type="text"
                            placeholder="Buscar por equipamento...">
                        <button id="searchButton" class="btn btn-primary"
                            onclick="new Equipamentos().searchEquipamento();">
                            <i class="zmdi zmdi-search"></i> Buscar
                        </button>
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['id_nivel']->value == 1) {?>
                        <form class="row" action="<?php echo $_smarty_tpl->tpl_vars['relatorio']->value;?>
" method="POST" target="_blank">
                            <div class="overview-wrap mx-3">
                                <button class="au-btn au-btn-icon au-btn--blue">
                                    gerar pdf</button>
                            </div>
                        </form>
                    <?php }?>
                    <button class="au-btn au-btn-icon au-btn--blue" onclick="new Equipamentos().addEquipamentos();">
                        <i class="zmdi zmdi-plus"></i>adicionar</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-5 m-b-35"></h3>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>ID_EQUIPAMENTO</th>
                                <th>NOME</th>
                                <th>DESCRIÇÃO</th>
                                <th>QUANTIDADE</th>
                                <th>VALOR</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <tr class="spacer"></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php $_smarty_tpl->_subTemplateRender("file:includes/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    </div>
</div>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
/Equipamentos/index.js"><?php echo '</script'; ?>
><?php }
}
