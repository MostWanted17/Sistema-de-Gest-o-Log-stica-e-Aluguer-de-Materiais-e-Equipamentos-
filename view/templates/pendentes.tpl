<div class="section__content section__content--p30">
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
        {include file="includes/footer.tpl"}
    </div>
</div>

<script src="{$js}/Pendentes/viagem/index.js"></script>
<script src="{$js}/Pendentes/aluguer/index.js"></script>