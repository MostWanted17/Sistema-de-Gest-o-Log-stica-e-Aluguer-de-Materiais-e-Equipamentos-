<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1">Aluguer</h2>
                    {if $id_nivel eq 1}
                        <form id="relatorioForm" class="row" action="{$relatorio}" method="POST" target="_blank">
                            <div class="form-group mx-3">
                                <label for="initial-date" class="control-label mb-1">Data de Inicio</label>
                                <input id="initial-date" name="initial-date" type="date" class="form-control cc-exp">
                            </div>
                            <div class="form-group mx-3">
                                <label for="final-date" class="control-label mb-1">Ate a Data</label>
                                <input id="final-date" name="final-date" type="date" class="form-control cc-exp">
                            </div>
                            <div class="overview-wrap mx-3">
                                <button id="gerarPdfBtn" type="submit" class="au-btn au-btn-icon au-btn--blue">
                                    gerar pdf
                                </button>
                            </div>
                        </form>
                        {/if}                       
                    <button class="au-btn au-btn-icon au-btn--blue" onclick="new Aluguer().addAluguer()">
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

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="{$js}/Aluguer/index.js"></script>
<script>
    document.getElementById("relatorioForm").addEventListener("submit", function (event) {
        const initialDateInput = document.getElementById("initial-date");
        const finalDateInput = document.getElementById("final-date");
        const initialDateValue = initialDateInput.value;
        const finalDateValue = finalDateInput.value;

        if (!initialDateValue.trim() || !finalDateValue.trim()) {
            alert("As datas de início e fim devem ser preenchidas.");
            event.preventDefault(); // Impede a submissão do formulário
        }
    });
</script>