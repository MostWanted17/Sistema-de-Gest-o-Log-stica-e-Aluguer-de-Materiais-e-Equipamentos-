class Motorista {
    constructor() {
        this.injectMysql = new InjectMysql(); // Instância da classe InjectMysql para realizar chamadas AJAX
    }

    async motorista() {
        const tableBody = document.getElementById('table-body');
        const session = await this.injectMysql.ajaxCall(Config.getSession);
        if (session['id_nivel'] > 1) {
            const buttons = document.getElementsByClassName('au-btn au-btn-icon au-btn--blue');
            for (const button of buttons) {
                button.style.display = 'none';
            }
        }
        const response = await this.injectMysql.ajaxCall(Config.motorista);
        let html = '';

        for (let i = 0; i < response.length; i++) {
            const { id_motorista, nome, carta_numero, carta_validade, endereco, telefone, status } = response[i];

            // Verifica se a carta está expirada ou falta 5 dias para expirar
            const currentDate = new Date();
            const expirationDate = new Date(carta_validade);
            const fiveDaysFromNow = new Date();
            fiveDaysFromNow.setDate(fiveDaysFromNow.getDate() + 5);

            let cellColor = '';
            if (expirationDate < currentDate || expirationDate <= fiveDaysFromNow) {
                // Carta expirada ou faltam 5 dias para expirar, cor vermelha
                cellColor = 'red';
            }

            html += `
                <tr class="tr-shadow">
                    <td>${id_motorista}</td>
                    <td>${nome}</td>
                    <td>${carta_numero}</td>
                    <td style="color: ${cellColor}">${carta_validade}</td>
                    <td>${endereco}</td>
                    <td>${telefone}</td>
                    <td>${status}</td>
                    <td>
                        <div class="table-data-feature">
            `;

            if (session['id_nivel'] == 1) {
                html += `
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" onclick="new Motorista().editMotorista(${id_motorista},'${nome}','${carta_numero}','${carta_validade}','${endereco}','${telefone}')">
                                <i class="zmdi zmdi-edit"></i>
                            </button>
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="new Motorista().removeMotorista(${id_motorista})">
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
        tableBody.innerHTML = html;
    }
    async searchMotorista() {
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

    async removeMotorista(id_motorista) {
        const response = await this.injectMysql.ajaxPOST(Config.removeMotorista, [id_motorista]);
        if (response === 0) {
            await new InjectMysql().successCallback('Error', 'Removed error!', 'success');
        } else {
            await new InjectMysql().successCallback('Removed', 'Removed with success!', 'success');
            window.location.reload();
            // Executar outras ações de sucesso, se necessário
        }
    }

    async editMotorista(id_motorista, nome, carta_numero, carta_validade, endereco, telefone) {
        Swal.fire({
            title: 'Editar informação',
            html:
                `<input id="nome" class="swal2-input" placeholder="Nome" value='${nome}'>` +
                `<input id="carta_numero" class="swal2-input" placeholder="Numero daCarta de Condução" value='${carta_numero}'>` +
                `<input id="carta_validade" class="swal2-input" placeholder="Validade da Carta de Condução" type="date" value='${carta_validade}'>` +
                `<input id="endereco" class="swal2-input" placeholder="Endereço" value='${endereco}'>` +
                `<input id="telefone" class="swal2-input" placeholder="Telefone" value='${telefone}'>`,
            showCancelButton: true,
            confirmButtonText: 'Enviar', // Change the text of the confirm button
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const input1Value = document.getElementById('nome').value;
                const input2Value = document.getElementById('carta_numero').value;
                const input3Value = document.getElementById('carta_validade').value;
                const input4Value = document.getElementById('endereco').value;
                const input5Value = document.getElementById('telefone').value;

                // Verifica se a data de validade é maior ou igual à data atual
                const currentDate = new Date();
                const expirationDate = new Date(input3Value);

                if (!validator.isLength(input1Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('O nome deve ter entre 1 e 255 caracteres.');
                    return false;
                }

                if (!validator.isLength(input2Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('A carta de condução deve ter entre 1 e 255 caracteres.');
                    return false;
                }

                if (!validator.isLength(input4Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('O endereço deve ter entre 1 e 255 caracteres.');
                    return false;
                }

                if (!validator.isMobilePhone(input5Value, 'any', { strictMode: false })) {
                    Swal.showValidationMessage('Telefone inválido.');
                    return false;
                }

                if (expirationDate < currentDate) {
                    Swal.showValidationMessage('A data de validade deve ser igual ou superior à data atual.');
                } else {
                    return [input1Value, input2Value, input3Value, input4Value, input5Value];
                }
            },
        }).then(async (result) => {
            if (result.isConfirmed) {
                const [input1Value, input2Value, input3Value, input4Value, input5Value] = result.value;
                // Faça algo com os valores de entrada

                const response = await new InjectMysql().ajaxPOST(Config.editMotorista, [
                    id_motorista,
                    input1Value,
                    input2Value,
                    input3Value,
                    input4Value,
                    input5Value,
                ]);

                if (response === 0) {
                    await new InjectMysql().successCallback('Error', 'Error to edit!', 'success');
                } else {
                    await new InjectMysql().successCallback('Edit', 'Edit with success!', 'success');
                    window.location.reload();
                    // Executar outras ações de sucesso, se necessário
                }
            }
        });
    }

    async addMotorista() {
        Swal.fire({
            title: 'Adicionar informação',
            html:
                `<input id="nome" class="swal2-input" placeholder="Nome">` +
                `<input id="carta_numero" class="swal2-input" placeholder="Número da Carta de Condução">` +
                `<input id="carta_validade" class="swal2-input" placeholder="Validade da Carta de Condução" type="date">` +
                `<input id="endereco" class="swal2-input" placeholder="Endereço">` +
                `<input id="telefone" class="swal2-input" placeholder="Telefone">`,
            showCancelButton: true,
            confirmButtonText: 'Enviar', // Change the text of the confirm button
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const input1Value = document.getElementById('nome').value;
                const input2Value = document.getElementById('carta_numero').value;
                const input3Value = document.getElementById('carta_validade').value;
                const input4Value = document.getElementById('endereco').value;
                const input5Value = document.getElementById('telefone').value;

                if (!validator.isLength(input1Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('O nome deve ter entre 1 e 255 caracteres.');
                    return false;
                }

                if (!validator.isLength(input2Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('A carta de condução deve ter entre 1 e 255 caracteres.');
                    return false;
                }

                if (!validator.isLength(input4Value, { min: 1, max: 255 })) {
                    Swal.showValidationMessage('O endereço deve ter entre 1 e 255 caracteres.');
                    return false;
                }

                if (!validator.isMobilePhone(input5Value, 'any', { strictMode: false })) {
                    Swal.showValidationMessage('Telefone inválido.');
                    return false;
                }

                const currentDate = new Date();
                const expirationDate = new Date(input3Value);

                if (expirationDate < currentDate) {
                    Swal.showValidationMessage('A data de validade deve ser igual ou superior à data atual.');
                } else {
                    return [input1Value, input2Value, input3Value, input4Value, input5Value];
                }
            },
        }).then(async (result) => {
            if (result.isConfirmed) {
                const [input1Value, input2Value, input3Value, input4Value, input5Value] = result.value;
                // Faça algo com os valores de entrada

                const response = await new InjectMysql().ajaxPOST(Config.addMotorista, [
                    input1Value,
                    input2Value,
                    input3Value,
                    input4Value,
                    input5Value,
                ]);

                if (response === 0) {
                    await new InjectMysql().successCallback('Error', 'Error to add!', 'success');
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
        const motorista = new Motorista();
        await motorista.motorista();
    } catch (error) {
        console.error(error);
    }
});