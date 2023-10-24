<?php
/* Smarty version 3.1.48, created on 2023-10-23 15:32:54
  from 'C:\xampp\htdocs\view\templates\carro.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_65367606b07d18_19399215',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c09f305e6dc9b2fbe2f864193ecb830eb5a11d5b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\view\\templates\\carro.tpl',
      1 => 1698067972,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:includes/footer.tpl' => 1,
  ),
),false)) {
function content_65367606b07d18_19399215 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1">Carro</h2>
                    <div class="overview-wrap mx-3">
                        <input id="searchInput" class="au-input au-input--xl" type="text"
                            placeholder="Procurar por Carro...">
                        <button id="searchButton" class="btn btn-primary" onclick="new Carro().searchCarro();">
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
                    <button class="au-btn au-btn-icon au-btn--blue" onclick="new Carro().addCarro()">
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
                                <th>ID_CARRO</th>
                                <th>MATRICULA</th>
                                <th>MODELO</th>
                                <th>COR</th>
                                <th>ESTADO</th>
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
/Carro/index.js"><?php echo '</script'; ?>
>
<?php }
}
