class Funcionarios {
    constructor() {
        this.injectMysql = new InjectMysql(); // Instância da classe InjectMysql para realizar chamadas AJAX
    }

    // Método para buscar e exibir os funcionários na tabela
    async funcionarios() {
        const tableBody = document.getElementById('table-body');
        const response = await this.injectMysql.ajaxCall(Config.funcionarios);
        let html = '';
        for (let i = 0; i < response.length; i++) {
            const { id_credencial, nome, apelido, username, password, id_nivel, nome_nivel } = response[i];
            html += `
            <tr class="tr-shadow">
                <td>${id_credencial}</td>
                <td>${nome}</td>
                <td>${apelido}</td>
                <td style="display: none;">
                    <span class="block-email">${username}</span>
                </td>
                <td style="display: none;">
                    <input type="password" class="block-email" value="${password}" readonly>
                </td>
                <td class="desc">${nome_nivel}</td>
                <td>
                    <div class="table-data-feature">
                    <form class="item" action="/relatorioPorFuncionario" method="post" target="_blank">
    <input type="hidden" name="id_credencial" value="${id_credencial}">
    <button title="history" type="submit">
        <i class="fa fa-bar-chart-o"></i>
    </button>
</form>
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" onclick="new Funcionarios().editFuncionarios(${id_credencial},'${nome}','${apelido}','${username}',${id_nivel})">
                            <i class="zmdi zmdi-edit"></i>
                        </button>
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="new Funcionarios().removeFuncionarios(${id_credencial})">
                            <i class="zmdi zmdi-delete"></i>
                        </button>
                    </div>
                </td>
            </tr>
            `;
        }
        tableBody.innerHTML = html;
    }

    // Método para remover um funcionário
    async removeFuncionarios(id_credencial) {
        const response = await this.injectMysql.ajaxPOST(Config.removeFuncionarios, [id_credencial]);
        if (response === 0) {
            await new InjectMysql().successCallback('Error', 'Removed error!', 'sucess');
        } else {
            await new InjectMysql().successCallback('Removed', 'Removed with sucess!', 'success');
            window.location.reload();
            // Executar outras ações de sucesso, se necessário
        }
    }
    async searchFuncionario() {
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

    // Método para editar um funcionário
    async editFuncionarios(id_credencial, nome, apelido, username, nivel_acesso) {
        // Abrir um modal (usando a biblioteca Swal) com os campos de edição preenchidos com os dados do funcionário
        Swal.fire({
            title: 'Editar informação',
            html:
                `<input id="nome" class="swal2-input" placeholder="Nome" value='${nome}'>` +
                `<input id="apelido" class="swal2-input" placeholder="Apelido" value='${apelido}'>` +
                `<input id="username" class="swal2-input" placeholder="Username" value='${username}'>` +
                `<input id="password" class="swal2-input" placeholder="Password">` +
                `<select id="nivel_acesso" class="swal2-select">` +
                `  <option value="1" ${nivel_acesso === 1 ? 'selected' : ''}>Administrador</option>` +
                `  <option value="2" ${nivel_acesso === 2 ? 'selected' : ''}>Funcionarios</option>` +
                `</select>`,
            showCancelButton: true,
            confirmButtonText: 'Enviar', // Change the text of the confirm button
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const input1Value = document.getElementById('nome').value.toString().trim();
                const input2Value = document.getElementById('apelido').value.toString().trim();
                const input3Value = document.getElementById('username').value.toString().trim();
                const input4Value = document.getElementById('password').value.toString(); // Password input should not be trimmed
                const select1Value = document.getElementById('nivel_acesso').value.toString(); // Convert to string

                // Validar os campos para garantir que estão corretos
                if (!validator.isLength(input1Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('Nome deve ter entre 1 e 255 caracteres.');
                    return false;
                }
                if (!validator.isLength(input2Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('Apelido deve ter entre 1 e 255 caracteres.');
                    return false;
                }
                if (!validator.isLength(input3Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('Username deve ter entre 1 e 255 caracteres.');
                    return false;
                }

                return [input1Value, input2Value, input3Value, input4Value, select1Value];
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                const [input1Value, input2Value, input3Value, input4Value, select1Value] = result.value;
                // Faça algo com os valores de entrada
                const response = await new InjectMysql().ajaxPOST(Config.editFuncionarios, [id_credencial, input1Value, input2Value, input3Value, input4Value, select1Value]);

                if (response === 0) {
                    await new InjectMysql().successCallback('Error', 'Error to edit!', 'sucess');
                } else {
                    await new InjectMysql().successCallback('Edit', 'Edit with sucess!', 'success');
                    window.location.reload();
                    // Executar outras ações de sucesso, se necessário
                }
            }
        });
    }

    // Método para adicionar um novo funcionário
    async addFuncionarios() {
        // Abrir um modal (usando a biblioteca Swal) com campos para adicionar um novo funcionário
        Swal.fire({
            title: 'Adicionar informação',
            html:
                `<input id="nome" class="swal2-input" placeholder="Nome">` +
                `<input id="apelido" class="swal2-input" placeholder="Apelido">` +
                `<input id="username" class="swal2-input" placeholder="Username">` +
                `<input id="password" class="swal2-input" placeholder="Password">` +
                `<select id="nivel_acesso" class="swal2-select">` +
                `  <option value="1">Administrador</option>` +
                `  <option value="2">Funcionarios</option>` +
                `</select>`,
            showCancelButton: true,
            confirmButtonText: 'Enviar', // Change the text of the confirm button
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const input1Value = document.getElementById('nome').value.toString().trim();
                const input2Value = document.getElementById('apelido').value.toString().trim();
                const input3Value = document.getElementById('username').value.toString().trim();
                const input4Value = document.getElementById('password').value.toString(); // Password input should not be trimmed
                const select1Value = document.getElementById('nivel_acesso').value.toString(); // Convert to string

                // Validar os campos para garantir que estão corretos
                if (!validator.isLength(input1Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('Nome deve ter entre 1 e 255 caracteres.');
                    return false;
                }
                if (!validator.isLength(input2Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('Apelido deve ter entre 1 e 255 caracteres.');
                    return false;
                }
                if (!validator.isLength(input3Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('Username deve ter entre 1 e 255 caracteres.');
                    return false;
                }

                return [input1Value, input2Value, input3Value, input4Value, select1Value];
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                const [input1Value, input2Value, input3Value, input4Value, select1Value] = result.value;
                // Faça algo com os valores de entrada
                const response = await new InjectMysql().ajaxPOST(Config.addFuncionarios, [input1Value, input2Value, input3Value, input4Value, select1Value]);

                if (response === 0) {
                    await new InjectMysql().successCallback('Error', 'Error to add!', 'sucess');
                } else {
                    await new InjectMysql().successCallback('Add', 'Add with sucess!', 'success');
                    window.location.reload();
                    // Executar outras ações de sucesso, se necessário
                }
            }
        });
    }

}

document.addEventListener('DOMContentLoaded', async () => {
    try {
        const funcionarios = new Funcionarios();
        await funcionarios.funcionarios();
    } catch (error) {
        console.error(error);
    }
});
