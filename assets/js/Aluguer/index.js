class Aluguer {
    constructor() {
        this.injectMysql = new InjectMysql(); // Instância da classe InjectMysql para realizar chamadas AJAX
    }

    async aluguer() {
        const tableBody = document.getElementById('table-body');
        const session = await this.injectMysql.ajaxCall(Config.getSession);
        const response = await this.injectMysql.ajaxCall(Config.aluguer);
        let html = '';

        for (let i = 0; i < response.length; i++) {
            const { id_aluguel, cliente, equipamento, data_inicio, data_fim, quantidade, valor, status } = response[i];

            // Verifica o nível de permissão do usuário
            if (session['id_nivel'] == 1) {
                if (status === 'em processo') {
                    html += `
                        <!-- Exibe informações de aluguel em processo -->
                        <tr class="tr-shadow">
                            <td>${id_aluguel}</td>
                            <td>${cliente}</td>
                            <td>${equipamento}</td>
                            <td>${data_inicio}</td>
                            <td>${data_fim}</td>
                            <td>${quantidade}</td>
                            <td>${valor}</td>
                            <td>${status}</td>
                            <td>
                                <div class="table-data-feature">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Concluido" onclick="new Aluguer().finishedAluguer(${id_aluguel})">
                                        <i class="fa fa-check"></i>
                                    </button>
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" onclick="new Aluguer().editAluguer(${id_aluguel},'${equipamento}', '${data_inicio}', '${data_fim}', ${quantidade}, '${valor}');">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="new Aluguer().removeAluguer(${id_aluguel})">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                } else {
                    html += `
                        <!-- Exibe informações de aluguel concluído -->
                        <tr class="tr-shadow">
                            <td>${id_aluguel}</td>
                            <td>${cliente}</td>
                            <td>${equipamento}</td>
                            <td>${data_inicio}</td>
                            <td>${data_fim}</td>
                            <td>${quantidade}</td>
                            <td>${valor}</td>
                            <td>${status}</td>
                            <td>
                                <div class="table-data-feature">
                                </div>
                            </td>
                        </tr>
                    `;
                }
            } else {
                if (status === 'em processo') {
                    html += `
                        <!-- Exibe informações de aluguel em processo para usuários não administradores -->
                        <tr class="tr-shadow">
                            <td>${id_aluguel}</td>
                            <td>${cliente}</td>
                            <td>${equipamento}</td>
                            <td>${data_inicio}</td>
                            <td>${data_fim}</td>
                            <td>${quantidade}</td>
                            <td>${valor}</td>
                            <td>${status}</td>
                            <td>
                                <div class="table-data-feature">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Concluido" onclick="new Aluguer().finishedAluguer(${id_aluguel})">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                } else {
                    html += `
                        <!-- Exibe informações de aluguel concluído para usuários não administradores -->
                        <tr class="tr-shadow">
                            <td>${id_aluguel}</td>
                            <td>${cliente}</td>
                            <td>${equipamento}</td>
                            <td>${data_inicio}</td>
                            <td>${data_fim}</td>
                            <td>${quantidade}</td>
                            <td>${valor}</td>
                            <td>${status}</td>
                            <td>
                                <div class="table-data-feature">
                                </div>
                            </td>
                        </tr>
                    `;
                }
            }
        }

        tableBody.innerHTML = html;
    }

    // Método chamado ao concluir um aluguel
    async finishedAluguer(id_aluguel) {
        const response = await this.injectMysql.ajaxPOST(Config.finishedAluguer, [id_aluguel]);

        if (response === 0) {
            await new InjectMysql().successCallback('Erro', 'Existe algum erro!', 'error');
        } else {
            await new InjectMysql().successCallback('Finalizado', 'Terminado com Sucesso!', 'success');
            window.location.reload();
            // Executar outras ações de sucesso, se necessário
        }
    }

    // Método chamado ao remover um aluguel
    async removeAluguer(id_aluguel) {
        const response = await this.injectMysql.ajaxPOST(Config.removeAluguer, [id_aluguel]);

        if (response === 0) {
            await new InjectMysql().successCallback('Erro', 'Existe algum erro!', 'error');
        } else {
            await new InjectMysql().successCallback('Removido', 'Removido com successo!', 'success');
            window.location.reload();
            // Executar outras ações de sucesso, se necessário
        }
    }

    async addAluguer() {
        const listaEquipamento = await this.injectMysql.ajaxCall(Config.equipamentosDisponivel);
        const listaCliente = await this.injectMysql.ajaxCall(Config.clientes);

        let selectOptionsEquipamentos = '';
        let selectOptionsClientes = '';

        for (let i = 0; i < listaEquipamento.length; i++) {
            const { id_equipamento, nome } = listaEquipamento[i];
            selectOptionsEquipamentos += `<option value="${id_equipamento}">${nome}</option>`;
        }

        const selectHTMLEquipamentos = `
            <!-- Seleção do equipamento -->
            <div class="form-group form-group-1">
                <label class="descricao-label" for="equipamento">Descrição do Equipamento:</label>
                <select id="equipamento" class="swal2-select custom-select">${selectOptionsEquipamentos}</select>
            </div>
        `;

        for (let i = 0; i < listaCliente.length; i++) {
            const { id_cliente, nome } = listaCliente[i];
            selectOptionsClientes += `<option value="${id_cliente}">${nome}</option>`;
        }

        const selectHTMLCliente = `
            <!-- Seleção do cliente -->
            <div class="form-group form-group-1">
                <label class="descricao-label" for="cliente">Descrição do Cliente:</label>
                <select id="cliente" class="swal2-select custom-select">${selectOptionsClientes}</select>
            </div>
        `;


        Swal.fire({
            title: 'Adicionar informação',
            html:
                selectHTMLCliente + selectHTMLEquipamentos +
                '<div class="form-group form-group-1">' +
                '    <label class="descricao-label" for="saida">Data e Hora de Saída:</label>' +
                '    <input id="saida" class="swal2-input flatpickr" type="text" data-input>' +
                '</div>' +
                '<div class="form-group form-group-1">' +
                '    <label class="descricao-label" for="previsao">Previsão de Devolução:</label>' +
                '    <input id="previsao" class="swal2-input flatpickr" type="text" data-input>' +
                '</div>' +
                `<div class="form-group form-group-1">
                    <input id="quantidade" class="swal2-input" placeholder="Quantidade">
                    <input id="valor" class="swal2-input" placeholder="Valor" disabled>
                </div>`,
            showCancelButton: true,
            confirmButtonText: 'Enviar', // Change the text of the confirm button
            cancelButtonText: 'Cancelar',
            onOpen: () => {
                flatpickr('.flatpickr', {
                    enableTime: true,
                    dateFormat: 'Y-m-d H:i:s', // Formato da data e hora
                });
                const equipamentoSelect = document.getElementById('equipamento');
                const valorInput = document.getElementById('valor');
                const quantidadeInput = document.getElementById('quantidade');
                const selectedEquipamentoId = equipamentoSelect.value;

                // Encontre o equipamento selecionado na lista de equipamentos
                const selectedEquipamento = listaEquipamento.find(equipamento => equipamento.id_equipamento == selectedEquipamentoId);
                valorInput.value = parseFloat(selectedEquipamento.valor).toFixed(2);

                // Adicione um ouvinte de evento "change" ao campo "equipamento"
                equipamentoSelect.addEventListener('change', () => {
                    const selectedEquipamentoId = equipamentoSelect.value;

                    // Encontre o equipamento selecionado na lista de equipamentos
                    const selectedEquipamento = listaEquipamento.find(equipamento => equipamento.id_equipamento == selectedEquipamentoId);

                    if (selectedEquipamento) {
                        // Atualize o campo "valor" com o valor do equipamento selecionado
                        valorInput.value = parseFloat(selectedEquipamento.valor).toFixed(2);
                        const quantidade = parseInt(quantidadeInput.value);
                        if (!isNaN(quantidade)) {
                            const valorDoEquipamento = parseFloat(selectedEquipamento.valor);
                            valorInput.value = (valorDoEquipamento * quantidade).toFixed(2);
                        }
                    }
                });

                // Adicione um ouvinte de evento "input" ao campo "quantidade"
                quantidadeInput.addEventListener('input', () => {
                    const selectedEquipamentoId = equipamentoSelect.value;

                    // Encontre o equipamento selecionado na lista de equipamentos
                    const selectedEquipamento = listaEquipamento.find(equipamento => equipamento.id_equipamento == selectedEquipamentoId);

                    const valorDoEquipamento = parseFloat(selectedEquipamento.valor);
                    const quantidade = parseInt(quantidadeInput.value);

                    if (!isNaN(valorDoEquipamento) && !isNaN(quantidade)) {
                        // Realize o cálculo e atualize o campo "valor" multiplicando pela quantidade
                        valorInput.value = (valorDoEquipamento * quantidade).toFixed(2);
                    }
                });
            },
            preConfirm: () => {
                const input1Value = document.getElementById('cliente').value;
                const input2Value = document.getElementById('equipamento').value;
                const input3Value = document.getElementById('saida').value;
                const input4Value = document.getElementById('previsao').value;
                const input5Value = document.getElementById('quantidade').value;
                const input6Value = document.getElementById('valor').value;

                const currentDate = new Date();
                const saidaDate = new Date(input3Value);
                const previsaoDate = new Date(input4Value);

                let equipamentoSelecionado = null;

                for (let i = 0; i < listaEquipamento.length; i++) {
                    if (parseInt(listaEquipamento[i].id_equipamento) == parseInt(input2Value)) {
                        equipamentoSelecionado = listaEquipamento[i];
                        break;
                    }
                }

                if (equipamentoSelecionado && parseInt(equipamentoSelecionado.quantidade_estoque) < parseInt(input5Value)) {
                    Swal.showValidationMessage('A quantidade selecionada excede o estoque disponível para este equipamento.');
                    return false;
                }

                if (validator.isEmpty(input3Value)) {
                    Swal.showValidationMessage('O campo de saída deve ser preenchido.');
                    return false;
                }

                if (validator.isEmpty(input4Value)) {
                    Swal.showValidationMessage('O campo de previsão deve ser preenchido.');
                    return false;
                }

                if (isNaN(parseInt(input5Value)) || parseInt(input5Value) < 0 || !validator.isLength(input5Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('O valor deve ser um número positivo e ter entre 1 e 255 caracteres.');
                    return false;
                }

                if (isNaN(parseInt(input6Value)) || parseInt(input6Value) < 0 || !validator.isLength(input6Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('O valor deve ser um número positivo e ter entre 1 e 255 caracteres.');
                    return false;
                }

                if (saidaDate < currentDate) {
                    Swal.showValidationMessage('A data de saída deve ser igual ou superior à data atual.');
                    return false;
                }

                if (previsaoDate < currentDate) {
                    Swal.showValidationMessage('A data de previsão deve ser igual ou superior à data atual.');
                    return false;
                }

                return [input1Value, input2Value, input3Value, input4Value, input5Value, input6Value];
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                const [input1Value, input2Value, input3Value, input4Value, input5Value, input6Value] = result.value;
                const response = await this.injectMysql.ajaxPOST(Config.addAluguer, [input1Value, input2Value, input3Value, input4Value, input5Value, input6Value]);

                if (response === 0) {
                    await new InjectMysql().successCallback('Erro', 'Existe algum erro!', 'error');
                } else {
                    await new InjectMysql().successCallback('Adicionado', 'Adicionado com Sucesso!', 'success');
                    window.location.reload();
                    // Executar outras ações de sucesso, se necessário
                }
            }
        });
    }

    async editAluguer(id_aluguel, equipamento, saida, previsao, quantidade, valor) {
        const listaEquipamento = await this.injectMysql.ajaxCall(Config.equipamentos);
        Swal.fire({
            title: 'Editar informação',
            html:
                `<div class="form-group form-group-1">
                    <label class="descricao-label" for="saida">Data de Saída:</label>
                    <input id="saida" class="swal2-input" type="date" value="${saida}">
                </div>` +
                `<div class="form-group form-group-1">
                    <label class="descricao-label" for="previsao">Previsão de Devolução:</label>
                    <input id="previsao" class="swal2-input" type="date" value="${previsao}">
                </div>` +
                `<div class="form-group form-group-1">
                    <input id="quantidade" class="swal2-input" placeholder="Quantidade" value="${quantidade}">
                    <input id="valor" class="swal2-input" placeholder="Valor" value="${valor}">
                </div>`,
            showCancelButton: true,
            confirmButtonText: 'Enviar', // Change the text of the confirm button
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const input3Value = document.getElementById('saida').value;
                const input4Value = document.getElementById('previsao').value;
                const input5Value = document.getElementById('quantidade').value;
                const input6Value = document.getElementById('valor').value;

                const currentDate = new Date();
                const saidaDate = new Date(input3Value);
                const previsaoDate = new Date(input4Value);
                saidaDate.setHours(0, 0, 0, 0);
                currentDate.setHours(0, 0, 0, 0);
                previsaoDate.setHours(0, 0, 0, 0);

                let equipamentoSelecionado = null;
                for (let i = 0; i < listaEquipamento.length; i++) {
                    if (listaEquipamento[i].nome == equipamento) {
                        equipamentoSelecionado = listaEquipamento[i];
                        break;
                    }
                }
                if (equipamentoSelecionado && (parseInt(equipamentoSelecionado.quantidade_estoque) + quantidade) < parseInt(input5Value)) {
                    Swal.showValidationMessage('A quantidade selecionada excede o estoque disponível para este equipamento.');
                    return false;
                }

                if (validator.isEmpty(input3Value)) {
                    Swal.showValidationMessage('O campo de saída deve ser preenchido.');
                    return false;
                }

                if (validator.isEmpty(input4Value)) {
                    Swal.showValidationMessage('O campo de previsão deve ser preenchido.');
                    return false;
                }

                if (isNaN(parseInt(input5Value)) || parseInt(input5Value) < 0 || !validator.isLength(input5Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('O valor deve ser um número positivo e ter entre 1 e 255 caracteres.');
                    return false;
                }

                if (isNaN(parseInt(input6Value)) || parseInt(input6Value) < 0 || !validator.isLength(input6Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('O valor deve ser um número positivo e ter entre 1 e 255 caracteres.');
                    return false;
                }

                if (saidaDate < currentDate) {
                    Swal.showValidationMessage('A data de saída deve ser igual ou superior à data atual.');
                    return false;
                }

                if (previsaoDate < currentDate) {
                    Swal.showValidationMessage('A data de previsão deve ser igual ou superior à data atual.');
                    return false;
                }

                return [input3Value, input4Value, input5Value, input6Value];
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                const [input3Value, input4Value, input5Value, input6Value] = result.value;
                const response = await this.injectMysql.ajaxPOST(Config.editAluguer, [id_aluguel, input3Value, input4Value, input5Value, input6Value]);

                if (response === 0) {
                    await new InjectMysql().successCallback('Erro', 'Error to edit!', 'error');
                } else {
                    await new InjectMysql().successCallback('Editado', 'Editado com successo!', 'success');
                    window.location.reload();
                    // Executar outras ações de sucesso, se necessário
                }
            }
        });
    }
}

// Evento disparado quando o DOM é carregado
document.addEventListener('DOMContentLoaded', async () => {
    try {
        const aluguer = new Aluguer();
        await aluguer.aluguer();
    } catch (error) {
        console.error(error);
    }
});

