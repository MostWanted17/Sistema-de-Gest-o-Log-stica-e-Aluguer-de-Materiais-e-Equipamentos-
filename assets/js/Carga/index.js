class Carga {
    constructor() {
        this.injectMysql = new InjectMysql(); // Instância da classe InjectMysql para realizar chamadas AJAX
    }

    async carga() {
        const tableBody = document.getElementById('table-body');
        const session = await this.injectMysql.ajaxCall(Config.getSession);

        // Verifica o nível de acesso do usuário e oculta os botões de edição/exclusão se necessário
        if (session['id_nivel'] > 1) {
            const buttons = document.getElementsByClassName('au-btn au-btn-icon au-btn--blue');
            for (const button of buttons) {
                button.style.display = 'none';
            }
        }

        // Obtém os dados das cargas através de uma chamada AJAX
        const response = await this.injectMysql.ajaxCall(Config.carga);
        let html = '';

        // Percorre as cargas e cria as linhas da tabela com as informações
        for (let i = 0; i < response.length; i++) {
            const { id_carga, descricao } = response[i];

            // Verifica o nível de acesso do usuário para exibir os botões de edição/exclusão
            if (session['id_nivel'] == 1) {
                html += `
                <tr class="tr-shadow">
                    <td>${id_carga}</td>
                    <td class="desc">${descricao}</td>
                    <td>
                        <div class="table-data-feature">
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" onclick="new Carga().editCarga(${id_carga},'${descricao}')">
                                <i class="zmdi zmdi-edit"></i>
                            </button>
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="new Carga().removeCarga(${id_carga})">
                                <i class="zmdi zmdi-delete"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                `;
            } else {
                html += `<tr class="tr-shadow">
                    <td>${id_carga}</td>
                    <td class="desc">${descricao}</td>
                    <td>
                        <div class="table-data-feature"></div>
                        </div>
                    </td>
                </tr>
                `;
            }
        }

        // Insere as linhas da tabela no corpo da tabela
        tableBody.innerHTML = html;
    }

    async removeCarga(id_carga) {
        // Realiza a remoção da carga através de uma chamada AJAX
        const response = await this.injectMysql.ajaxPOST(Config.removeCarga, [id_carga]);

        // Exibe uma mensagem de sucesso ou erro
        if (response === 0) {
            await new InjectMysql().successCallback('Erro', 'Existe algum erro!', 'sucess');
        } else {
            await new InjectMysql().successCallback('Removido', 'Removido com successo!', 'success');
            window.location.reload();
            // Executar outras ações de sucesso, se necessário
        }
    }
    async searchCarga() {
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('#table-body tr');
        
        // Obtém o valor de pesquisa do campo de entrada
        const searchTerm = searchInput.value.toLowerCase().trim();
    
        // Remove as marcações de destaque dos resultados anteriores
        tableRows.forEach(row => {
            row.classList.remove('highlight');
        });
    
        // Verifica se o campo de pesquisa está vazio
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
  

    async editCarga(id_carga, descricao) {
        // Exibe um formulário de edição com o campo preenchido
        Swal.fire({
            title: 'Editar informação',
            html:
                `<input id="descricao" class="swal2-input" placeholder="Descrição" value='${descricao}'>`,
            showCancelButton: true,
            confirmButtonText: 'Enviar', // Change the text of the confirm button
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const input1Value = document.getElementById('descricao').value;

                // Validação do campo de entrada
                if (!validator.isLength(input1Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('A carga deve ter entre 1 e 255 caracteres.');
                    return false;
                }
                
                return [input1Value];
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                const [input1Value] = result.value;
                // Faça algo com os valores de entrada

                // Realiza a edição da carga através de uma chamada AJAX
                const response = await new InjectMysql().ajaxPOST(Config.editCarga, [id_carga, input1Value]);

                // Exibe uma mensagem de sucesso ou erro
                if (response === 0) {
                    await new InjectMysql().successCallback('Erro', 'Existe algum erro!', 'error');
                } else {
                    await new InjectMysql().successCallback('Editado', 'Editado com success!', 'success');
                    window.location.reload();
                    // Executar outras ações de sucesso, se necessário
                }
            }
        });
    }

    async addCarga() {
        // Exibe um formulário de adição de carga
        Swal.fire({
            title: 'Adicionar informação',
            html:
                `<input id="descricao" class="swal2-input" placeholder="Descrição">`,
            showCancelButton: true,
            confirmButtonText: 'Enviar', // Change the text of the confirm button
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const input1Value = document.getElementById('descricao').value;

                // Validação do campo de entrada
                if (!validator.isLength(input1Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('A carga deve ter entre 1 e 255 caracteres.');
                    return false;
                }
                
                return [input1Value];
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                const [input1Value] = result.value;
                // Faça algo com os valores de entrada

                // Realiza a adição da carga através de uma chamada AJAX
                const response = await new InjectMysql().ajaxPOST(Config.addCarga, [input1Value]);

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
        const carga = new Carga();
        await carga.carga();
    } catch (error) {
        console.error(error);
    }
});
