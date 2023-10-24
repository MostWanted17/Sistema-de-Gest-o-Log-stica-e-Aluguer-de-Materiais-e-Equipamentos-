// Classe Clientes
class Clientes {
    constructor() {
        // Inicializa a instância da classe InjectMysql para realizar chamadas AJAX
        this.injectMysql = new InjectMysql();
    }

    // Método para exibir clientes na tabela
    async clientes() {
        const tableBody = document.getElementById('table-body');
        const response = await this.injectMysql.ajaxCall(Config.clientes);
        const session = await this.injectMysql.ajaxCall(Config.getSession);
        let html = '';
        for (let i = 0; i < response.length; i++) {
            const { id_cliente, nome, endereco, contacto, email } = response[i];

            // Verifica se o usuário possui nível de acesso igual a 1 (administrador)
            if (session['id_nivel'] == 1) {
                html += `
                <tr class="tr-shadow">
                    <td>${id_cliente}</td>
                    <td>${nome}</td>
                    <td>${endereco}</td>
                    <td>
                        <span class="block-email">${contacto}</span>
                    </td>
                    <td>
                        <span class="block-email">${email}</span>
                    </td>
                    <td>
                        <div class="table-data-feature">
                            <!-- Botão para editar cliente -->
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" onclick="new Clientes().editClientes(${id_cliente},'${nome}', '${endereco}', '${contacto}','${email}')">
                                <i class="zmdi zmdi-edit"></i>
                            </button>
                            <!-- Botão para remover cliente -->
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="new Clientes().removeClientes(${id_cliente})">
                                <i class="zmdi zmdi-delete"></i>
                            </button>
                        </div>  
                    </td>
                </tr>
                `;
            } else {
                // Caso o usuário não seja administrador, não exibe os botões de ação (editar/remover)
                html += `
                <tr class="tr-shadow">
                    <td>${id_cliente}</td>
                    <td>${nome}</td>
                    <td>${endereco}</td>
                    <td>
                        <span class="block-email">${contacto}</span>
                    </td>
                    <td>
                        <span class="block-email">${email}</span>
                    </td>
                    <td>
                        <div class="table-data-feature">
                        </div>  
                    </td>
                </tr>
                `;
            }
        }
        tableBody.innerHTML = html;
    }

    // Método para remover cliente
    async removeClientes(id_cliente) {
        const response = await this.injectMysql.ajaxPOST(Config.removeClientes, [id_cliente]);
        if (response === 0) {
            await new InjectMysql().successCallback('Error', 'Erro ao remover o cliente!', 'sucess');
        } else {
            await new InjectMysql().successCallback('Removed', 'Cliente removido com sucesso!', 'success');
            window.location.reload();
            // Executar outras ações de sucesso, se necessário
        }
    }

    // Método para editar informações do cliente
    async editClientes(id_cliente, nome, endereco, contacto, email) {
        // Sanitizar os valores de entrada para evitar HTML ou JavaScript malicioso
        const sanitizedNome = validator.escape(nome);
        const sanitizedEndereco = validator.escape(endereco);
        const sanitizedContacto = validator.escape(contacto);
        const sanitizedEmail = validator.normalizeEmail(email);

        Swal.fire({
            title: 'Editar informações',
            html:
                `<input id="nome" class="swal2-input" placeholder="Nome" value='${sanitizedNome}'>` +
                `<input id="endereco" class="swal2-input" placeholder="Endereco" value='${sanitizedEndereco}'>` +
                `<input id="contacto" class="swal2-input" placeholder="Contacto" value='${sanitizedContacto}'>` +
                `<input id="email" class="swal2-input" placeholder="Email" value='${sanitizedEmail}'>`,
            showCancelButton: true,
            confirmButtonText: 'Enviar', // Change the text of the confirm button
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const input1Value = document.getElementById('nome').value;
                const input2Value = document.getElementById('endereco').value;
                const input3Value = document.getElementById('contacto').value;
                const input4Value = document.getElementById('email').value;

                // Validar os campos para garantir que estão corretos
                if (!validator.isLength(input1Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('Nome deve ter entre 1 e 255 caracteres.');
                    return false;
                }
                if (!validator.isLength(input2Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('Endereço deve ter entre 1 e 255 caracteres.');
                    return false;
                }
                if (!validator.isMobilePhone(input3Value, 'any', { strictMode: false })) {
                    Swal.showValidationMessage('Contacto inválido.');
                    return false;
                }
                if (!validator.isEmail(input4Value)) {
                    Swal.showValidationMessage('E-mail inválido.');
                    return false;
                }

                return [input1Value, input2Value, input3Value, input4Value];
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                const [input1Value, input2Value, input3Value, input4Value] = result.value;
                // Faça algo com os valores de entrada

                const response = await new InjectMysql().ajaxPOST(Config.editClientes, [id_cliente, input1Value, input2Value, input3Value, input4Value]);

                if (response === 0) {
                    await new InjectMysql().successCallback('Error', 'Erro ao editar o cliente!', 'sucess');
                } else {
                    await new InjectMysql().successCallback('Edit', 'Cliente editado com sucesso!', 'success');
                    window.location.reload();
                    // Executar outras ações de sucesso, se necessário
                }
            }
        });
    }
    // Método para pesquisa de clientes
    // Método para pesquisa de clientes
    async searchClients() {
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

    // Método para adicionar novo cliente
    async addClientes() {
        Swal.fire({
            title: 'Adicionar informações',
            html:
                `<input id="nome" class="swal2-input" placeholder="Nome">` +
                `<input id="endereco" class="swal2-input" placeholder="Endereco">` +
                `<input id="contacto" class="swal2-input" placeholder="Contacto">` +
                `<input id="email" class="swal2-input" placeholder="Email">`,
            showCancelButton: true,
            confirmButtonText: 'Enviar', // Change the text of the confirm button
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const input1Value = document.getElementById('nome').value;
                const input2Value = document.getElementById('endereco').value;
                const input3Value = document.getElementById('contacto').value;
                const input4Value = document.getElementById('email').value;

                // Sanitizar os valores de entrada
                const sanitizedNome = validator.escape(input1Value);
                const sanitizedEndereco = validator.escape(input2Value);
                const sanitizedContacto = validator.escape(input3Value);
                const sanitizedEmail = validator.normalizeEmail(input4Value);

                // Validar os campos para garantir que estão corretos
                if (!validator.isLength(sanitizedNome, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('Nome deve ter entre 1 e 255 caracteres.');
                    return false;
                }
                if (!validator.isLength(sanitizedEndereco, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('Endereço deve ter entre 1 e 255 caracteres.');
                    return false;
                }
                if (!validator.isMobilePhone(sanitizedContacto, 'any', { strictMode: false })) {
                    Swal.showValidationMessage('Contacto inválido.');
                    return false;
                }
                if (!validator.isEmail(sanitizedEmail)) {
                    Swal.showValidationMessage('E-mail inválido.');
                    return false;
                }

                return [sanitizedNome, sanitizedEndereco, sanitizedContacto, sanitizedEmail];
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                const [input1Value, input2Value, input3Value, input4Value] = result.value;
                // Faça algo com os valores de entrada

                const response = await new InjectMysql().ajaxPOST(Config.addClientes, [input1Value, input2Value, input3Value, input4Value]);

                if (response === 0) {
                    await new InjectMysql().successCallback('Error', 'Erro ao adicionar o cliente!', 'sucess');
                } else {
                    await new InjectMysql().successCallback('Add', 'Cliente adicionado com sucesso!', 'success');
                    window.location.reload();
                    // Executar outras ações de sucesso, se necessário
                }
            }
        });
    }
    

}

// Evento DOMContentLoaded para chamar o método de exibir clientes após o carregamento da página
document.addEventListener('DOMContentLoaded', async () => {
    try {
        const clientes = new Clientes();
        await clientes.clientes();
    } catch (error) {
        console.error(error);
    }
});
