<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1">Funcionários</h2>
                    <div class="overview-wrap mx-3">
                        <input id="searchInput" class="au-input au-input--xl" type="text"
                            placeholder="Buscar por Funcionário...">
                        <button id="searchButton" class="btn btn-primary"
                            onclick="new Funcionarios().searchFuncionario();">
                            <i class="zmdi zmdi-search"></i> Buscar
                        </button>
                    </div>
                    {if $id_nivel eq 1}
                        <form class="row" action="{$relatorio}" method="POST" target="_blank">
                            <div class="overview-wrap mx-3">
                                <button class="au-btn au-btn-icon au-btn--blue">
                                    gerar pdf</button>
                            </div>
                        </form>
                    {/if}
                    <button class="au-btn au-btn-icon au-btn--blue" onclick="new Funcionarios().addFuncionarios()">
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
                                <th>ID_CREDENCIAL</th>
                                <th>NOME</th>
                                <th>APELIDO</th>
                                <th style="display: none;">USERNAME</th>
                                <th style="display: none;">PASSWORD</th>
                                <th>NIVEL DE ACESSO</th>
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
        {include file="includes/footer.tpl"}
    </div>
</div>

<script src="{$js}/Funcionarios/index.js"></script>