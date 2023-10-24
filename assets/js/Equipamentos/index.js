class Equipamentos {
    constructor() {
        this.injectMysql = new InjectMysql(); // Instância da classe InjectMysql para realizar chamadas AJAX
    }

    // Método para buscar e exibir os equipamentos na tabela
    async equipamentos() {
        const tableBody = document.getElementById('table-body');

        // Obter a sessão do usuário
        const session = await this.injectMysql.ajaxCall(Config.getSession);

        // Verifica o nível de acesso do usuário e oculta os botões de edição/exclusão se necessário
        if (session['id_nivel'] > 1) {
            const buttons = document.getElementsByClassName('au-btn au-btn-icon au-btn--blue');
            for (const button of buttons) {
                button.style.display = 'none';
            }
        }

        // Obter a lista de equipamentos
        const response = await this.injectMysql.ajaxCall(Config.equipamentos);

        let html = '';

        // Criar linhas da tabela para cada equipamento
        for (const { id_equipamento, nome, descricao, quantidade_estoque, valor } of response) {
            html += `
            <tr class="tr-shadow">
                <td>${id_equipamento}</td>
                <td>${nome}</td>
                <td class="desc">${descricao}</td>
                <td>${quantidade_estoque}</td>
                <td>${valor}</td>
                <td>
                    <div class="table-data-feature">
            `;

            // Adicionar botões de edição/exclusão se o nível for 1
            if (session['id_nivel'] == 1) {
                html += `
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" onclick="new Equipamentos().editEquipamentos(${id_equipamento},'${nome}','${descricao}','${quantidade_estoque}','${valor}')">
                            <i class="zmdi zmdi-edit"></i>
                        </button>
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="new Equipamentos().removeEquipamentos(${id_equipamento});">
                            <i class="zmdi zmdi-delete"></i>
                        </button>
                `;
            }

            html += `
                    </div>
                </td>
            </tr>
            `;
        }

        // Atualizar o conteúdo da tabela
        tableBody.innerHTML = html;
    }

    // Método para remover um equipamento
    async removeEquipamentos(id_equipamento) {
        const response = await this.injectMysql.ajaxPOST(Config.removeEquipamentos, [id_equipamento]);

        // Exibir mensagem de sucesso ou erro
        if (response === 0) {
            await new InjectMysql().successCallback('Error', 'Removed error!', 'sucess');
        } else {
            await new InjectMysql().successCallback('Removed', 'Removed with success!', 'success');
            window.location.reload();
            // Executar outras ações de sucesso, se necessário
        }
    }
    async searchEquipamento() {
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('#table-body tr');
        
        // Obtém o valor de pesquisa do campo de entrada
        const searchTerm = searchInput.value.toLowerCase().trim();

        // Remove as marcações de destaque dos resultados anteriores
        tableRows.forEach(row => {
            row.classList.remove('highlight');
        });

        if (searchTerm === '') {
            Swal.fire({
                icon: 'error',
                title: 'Campo de pesquisa vazio',
                text: 'Por favor, digite algo para pesquisar.',
            });
            return; // Encerra a função se o campo estiver vazio
        }

        // Realiza a pesquisa nos nomes dos clientes
        tableRows.forEach(row => {
            const nomeCell = row.querySelector('td:nth-child(2)');
            const nome = nomeCell.textContent.toLowerCase();

            if (nome.includes(searchTerm)) {
                row.classList.add('highlight');
            }
        });

        // Foca no primeiro resultado encontrado
        const firstHighlightedRow = document.querySelector('.highlight');
        if (firstHighlightedRow) {
            firstHighlightedRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }

    // Método para editar um equipamento
    async editEquipamentos(id_equipamento, nome, descricao, quantidade, valor) {
        // Abrir uma janela de diálogo (usando a biblioteca Swal) com os campos de edição preenchidos com os dados do equipamento
        Swal.fire({
            title: 'Editar informação',
            html:
                `<input id="nome" class="swal2-input" placeholder="Nome" value='${nome}'>` +
                `<input id="descricao" class="swal2-input" placeholder="Descricao" value='${descricao}'>` +
                `<input id="quantidade" class="swal2-input" placeholder="Quantidade" value='${quantidade}'>`+
                `<input id="valor" class="swal2-input" placeholder="Valor" value='${valor}'>`,
            showCancelButton: true,
            confirmButtonText: 'Enviar', // Change the text of the confirm button
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const input1Value = document.getElementById('nome').value.trim();
                const input2Value = document.getElementById('descricao').value;
                const input3Value = document.getElementById('quantidade').value.trim();
                const input4Value = document.getElementById('valor').value.trim();

                // Validar campos nome, descricao e quantidade
                if (!validator.isLength(input1Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('O nome deve ter entre 1 e 255 caracteres.');
                    return false;
                }

                if (!validator.isLength(input2Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('A descrição deve ter entre 1 e 255 caracteres.');
                    return false;
                }

                if (!validator.isInt(input3Value)) {
                    Swal.showValidationMessage('A quantidade deve ser um número inteiro.');
                    return false;
                }
                if (!validator.isFloat(input4Value)) {
                    Swal.showValidationMessage('A quantidade deve ser um número decimal.');
                    return false;
                }

                return [input1Value, input2Value, input3Value, input4Value];
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                const [input1Value, input2Value, input3Value, input4Value] = result.value;
                // Faça algo com os valores de entrada

                const response = await new InjectMysql().ajaxPOST(Config.editEquipamentos, [id_equipamento, input1Value, input2Value, input3Value, input4Value]);

                if (response === 0) {
                    await new InjectMysql().successCallback('Error', 'Error to edit!', 'sucess');
                } else {
                    await new InjectMysql().successCallback('Edit', 'Edit with success!', 'success');
                    window.location.reload();
                    // Executar outras ações de sucesso, se necessário
                }
            }
        });
    }

    // Método para adicionar um novo equipamento
    async addEquipamentos() {
        // Abrir uma janela de diálogo (usando a biblioteca Swal) com campos para adicionar um novo equipamento
        Swal.fire({
            title: 'Adicionar informação',
            html:
                `<input id="nome" class="swal2-input" placeholder="Nome">` +
                `<input id="descricao" class="swal2-input" placeholder="Descricao">` +
                `<input id="quantidade" class="swal2-input" placeholder="Quantidade">`+
                `<input id="valor" class="swal2-input" placeholder="Valor">`,
            showCancelButton: true,
            confirmButtonText: 'Enviar', // Change the text of the confirm button
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const input1Value = document.getElementById('nome').value.trim();
                const input2Value = document.getElementById('descricao').value;
                const input3Value = document.getElementById('quantidade').value.trim();
                const input4Value = document.getElementById('valor').value.trim();

                // Validar campos nome, descricao e quantidade
                if (!validator.isLength(input1Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('O nome deve ter entre 1 e 255 caracteres.');
                    return false;
                }

                if (!validator.isLength(input2Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('A descrição deve ter entre 1 e 255 caracteres.');
                    return false;
                }

                if (!validator.isInt(input3Value)) {
                    Swal.showValidationMessage('A quantidade deve ser um número inteiro.');
                    return false;
                }
                if (!validator.isFloat(input4Value)) {
                    Swal.showValidationMessage('A quantidade deve ser um número decimal.');
                    return false;
                }

                return [input1Value, input2Value, input3Value, input4Value];
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                const [input1Value, input2Value, input3Value, input4Value] = result.value;
                // Faça algo com os valores de entrada

                const response = await new InjectMysql().ajaxPOST(Config.addEquipamentos, [input1Value, input2Value, input3Value, input4Value]);

                if (response === 0) {
                    await new InjectMysql().successCallback('Error', 'Error to add!', 'sucess');
                } else {
                    await new InjectMysql().successCallback('Add', 'Add with success!', 'success');
                    window.location.reload();
                    // Executar outras ações de sucesso, se necessário
                }
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', async () => {
    try {
        const equipamentos = new Equipamentos();
        await equipamentos.equipamentos();
    } catch (error) {
        console.error(error);
    }
});
