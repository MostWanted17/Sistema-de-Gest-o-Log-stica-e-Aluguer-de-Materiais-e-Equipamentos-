class Carro {
    constructor() {
        this.injectMysql = new InjectMysql(); // Instância da classe InjectMysql para realizar chamadas AJAX
    }

    async carro() {
        const tableBody = document.getElementById('table-body');
        const session = await this.injectMysql.ajaxCall(Config.getSession);

        // Verifica o nível de acesso do usuário e oculta os botões de edição/exclusão se necessário
        if (session['id_nivel'] > 1) {
            const buttons = document.getElementsByClassName('au-btn au-btn-icon au-btn--blue');
            for (const button of buttons) {
                button.style.display = 'none';
            }
        }

        // Obtém os dados dos carros através de uma chamada AJAX
        const response = await this.injectMysql.ajaxCall(Config.carro);
        let html = '';

        // Percorre os carros e cria as linhas da tabela com as informações
        for (let i = 0; i < response.length; i++) {
            const { id_carro, matricula, modelo, cor, status } = response[i];

            // Verifica o nível de acesso do usuário para exibir os botões de edição/exclusão
            if (session['id_nivel'] == 1) {
                html += `
                <tr class="tr-shadow">
                    <td>${id_carro}</td>
                    <td>
                        <span class="block-email">${matricula}</span>
                    </td>
                    <td>${modelo}</td>
                    <td>${cor}</td>
                    <td class="desc">${status}</td>
                    <td>
                        <div class="table-data-feature">
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" onclick="new Carro().editCarro(${id_carro},'${matricula}','${modelo}','${cor}','${status}')">
                                <i class="zmdi zmdi-edit"></i>
                            </button>
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="new Carro().removeCarro(${id_carro})">
                                <i class="zmdi zmdi-delete"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                `;
            } else {
                html += `
                <tr class="tr-shadow">
                    <td>${id_carro}</td>
                    <td>
                        <span class="block-email">${matricula}</span>
                    </td>
                    <td>${modelo}</td>
                    <td>${cor}</td>
                    <td class="desc">${status}</td>
                    <td>
                        <div class="table-data-feature">
                           
                        </div>
                    </td>
                </tr>
                `;
            }
        }

        // Insere as linhas da tabela no corpo da tabela
        tableBody.innerHTML = html;
    }

    async removeCarro(id_carro) {
        // Realiza a remoção do carro através de uma chamada AJAX
        const response = await this.injectMysql.ajaxPOST(Config.removeCarro, [id_carro]);

        // Exibe uma mensagem de sucesso ou erro
        if (response === 0) {
            await new InjectMysql().successCallback('Erro', 'Existe algum erro!', 'error');
        } else {
            await new InjectMysql().successCallback('Removido', 'Removido com successo!', 'success');
            window.location.reload();
            // Executar outras ações de sucesso, se necessário
        }
    }
    async searchCarro() {
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

    async editCarro(id_carro, matricula, modelo, cor, status) {
        // Exibe um formulário de edição com os campos preenchidos
        Swal.fire({
            title: 'Editar informação',
            html:
                `<input id="matricula" class="swal2-input" placeholder="Matricula" value='${matricula}'>` +
                `<input id="modelo" class="swal2-input" placeholder="Modelo" value='${modelo}'>` +
                `<input id="cor" class="swal2-input" placeholder="Cor" value='${cor}'>` +
                `<select id="status" class="swal2-select">` +
                `  <option value="disponível" ${status === "disponível" ? 'selected' : ''}>Disponível</option>` +
                `  <option value="indisponível" ${status === "indisponível" ? 'selected' : ''}>Indisponível</option>` +
                `</select>`,
            showCancelButton: true,
            confirmButtonText: 'Enviar', // Change the text of the confirm button
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const input1Value = document.getElementById('matricula').value;
                const input2Value = document.getElementById('modelo').value;
                const input3Value = document.getElementById('cor').value;
                const select1Value = document.getElementById('status').value;

                // Validação dos campos de entrada
                if (!validator.isLength(input1Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('A matricula deve ter entre 1 e 255 caracteres.');
                    return false;
                }

                if (!validator.isLength(input2Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('O modelo deve ter entre 1 e 255 caracteres.');
                    return false;
                }

                if (!validator.isLength(input3Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('A cor deve ter entre 1 e 255 caracteres.');
                    return false;
                }

                return [input1Value, input2Value, input3Value, select1Value];
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                const [input1Value, input2Value, input3Value, select1Value] = result.value;
                // Faça algo com os valores de entrada

                // Realiza a edição do carro através de uma chamada AJAX
                const response = await new InjectMysql().ajaxPOST(Config.editCarro, [id_carro, input1Value, input2Value, input3Value, select1Value]);

                // Exibe uma mensagem de sucesso ou erro
                if (response === 0) {
                    await new InjectMysql().successCallback('Erro', 'Existe algum erro!', 'error');
                } else {
                    await new InjectMysql().successCallback('Editado', 'Editado com successo!', 'success');
                    window.location.reload();
                    // Executar outras ações de sucesso, se necessário
                }
            }
        });
    }

    async addCarro() {
        // Exibe um formulário de adição de carro
        Swal.fire({
            title: 'Adicionar informação',
            html:
                `<input id="matricula" class="swal2-input" placeholder="Matricula">` +
                `<input id="modelo" class="swal2-input" placeholder="Modelo">` +
                `<input id="cor" class="swal2-input" placeholder="Cor">` +
                `<select id="status" class="swal2-select">` +
                `  <option value="disponível">Disponível</option>` +
                `  <option value="indisponível">Indisponível</option>` +
                `</select>`,
            showCancelButton: true,
            confirmButtonText: 'Enviar', // Change the text of the confirm button
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const input1Value = document.getElementById('matricula').value;
                const input2Value = document.getElementById('modelo').value;
                const input3Value = document.getElementById('cor').value;
                const select1Value = document.getElementById('status').value;

                // Validação dos campos de entrada
                if (!validator.isLength(input1Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('A matricula deve ter entre 1 e 255 caracteres.');
                    return false;
                }

                if (!validator.isLength(input2Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('O modelo deve ter entre 1 e 255 caracteres.');
                    return false;
                }

                if (!validator.isLength(input3Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('A cor deve ter entre 1 e 255 caracteres.');
                    return false;
                }

                return [input1Value, input2Value, input3Value, select1Value];
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                const [input1Value, input2Value, input3Value, select1Value] = result.value;
                // Faça algo com os valores de entrada

                // Realiza a adição do carro através de uma chamada AJAX
                const response = await new InjectMysql().ajaxPOST(Config.addCarro, [input1Value, input2Value, input3Value, select1Value]);

                // Exibe uma mensagem de sucesso ou erro
                if (response === 0) {
                    await new InjectMysql().successCallback('Erro', 'Existe algum erro!', 'error');
                } else {
                    await new InjectMysql().successCallback('Adicionado', 'Adicionado com successo!', 'success');
                    window.location.reload();
                    // Executar outras ações de sucesso, se necessário
                }
            }
        });
    }
}

// Evento de carregamento do documento HTML
document.addEventListener('DOMContentLoaded', async () => {
    try {
        const carro = new Carro();
        await carro.carro();
    } catch (error) {
        console.error(error);
    }
});
