<?php
/* Smarty version 3.1.48, created on 2023-10-24 08:52:51
  from 'C:\xampp\htdocs\view\templates\pendentes.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_653769c302aa64_18579784',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd34d713cdcc4e6e08ae35754169c5d3d251e774a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\view\\templates\\pendentes.tpl',
      1 => 1698130149,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:includes/footer.tpl' => 1,
  ),
),false)) {
function content_653769c302aa64_18579784 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1">Pendentes de Viagem</h2>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-5 m-b-35"></h3>
                <div class="table-responsive table-responsive-data2" style="overflow-x: auto;">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>ID_VIAGEM</th>
                                <th>MATRICULA DO CARRO</th>
                                <th>MOTORISTA</th>
                                <th>CARGA</th>
                                <th>ORIGEM</th>
                                <th>DESTINO</th>
                                <th>DESCRIÇÃO</th>
                                <th>PESO DA CARGA</th>
                                <th>VALOR DA CARGA</th>
                                <th>SAIDA</th>
                                <th>PREVISAO DE CHEGADA</th>
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
        <div class="row">
            <div class="col-md-12">
                <div class="copyright">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1">Pendentes de Aluguer</h2>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-5 m-b-35"></h3>
                <div class="table-responsive table-responsive-data2" style="overflow-x: auto;">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>ID_ALUGUER</th>
                                <th>NOME</th>
                                <th>EQUIPAMENTO</th>
                                <th>DATA DE ALUGUER</th>
                                <th>DATA DE TERMINO</th>
                                <th>QUANTIDADE</th>
                                <th>VALOR</th>
                                <th>ESTADO</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="table-body-aluguer">

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
/Pendentes/viagem/index.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
/Pendentes/aluguer/index.js"><?php echo '</script'; ?>
><?php }
}
