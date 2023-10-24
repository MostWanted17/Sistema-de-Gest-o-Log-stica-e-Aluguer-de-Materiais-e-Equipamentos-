class Viagem {
    constructor() {
        this.injectMysql = new InjectMysql(); // Instância da classe InjectMysql para realizar chamadas AJAX
        this.startMarker = null; // Marcador de partida
        this.endMarker = null; // Marcador de chegada
        this.routePolyline = null; // Polilinha da rota
        this.routingControl = null; // Controle de roteamento
        this.numClicks = 0;
    }

    async viagem() {
        const tableBody = document.getElementById('table-body');
        const response = await this.injectMysql.ajaxCall(Config.pendentesViagem);
        let html = '';
        for (let i = 0; i < response.length; i++) {
            const { id_viagem, matricula, motorista, carga, origem, destino, descricao, peso_carga, valor_carga,data_saida, previsao_chegada } = response[i];
            html += `
            <tr class="tr-shadow">
                <td>${id_viagem}</td>
                <td>${matricula}</td>
                <td>${motorista}</td>
                <td>${carga}</td>
                <td>
                    <span class="block-email">${origem}</span>
                </td>
                <td>
                    <span class="block-email">${destino}</span>
                </td>
                <td class="desc">${descricao}</td>
                <td>${peso_carga}</td>
                <td>${valor_carga}</td>
                <td>${data_saida}</td>
                <td>${previsao_chegada}</td>
                <td>
                    <div class="table-data-feature">
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" onclick="new Viagem().accepteViagem(${id_viagem})">
                            <i class="fa fa-check"></i>
                        </button>
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="new Viagem().removeViagem(${id_viagem})">
                            <i class="zmdi zmdi-delete"></i>
                        </button>
                    </div>
                </td>
            </tr>
            `;
        }
        tableBody.innerHTML = html;
    }
    async accepteViagem(id_viagem) {
        const response = await this.injectMysql.ajaxPOST(Config.accepteViagem, [id_viagem]);
        if (response === 0) {
            await new InjectMysql().successCallback('Error', 'Removed error!', 'sucess');
        } else {
            await new InjectMysql().successCallback('Accepted', 'Accepted with sucess!', 'success');
            window.location.reload();
            // Executar outras ações de sucesso, se necessário
        }
    }
    async removeViagem(id_viagem) {
        const response = await this.injectMysql.ajaxPOST(Config.removeViagem, [id_viagem]);
        if (response === 0) {
            await new InjectMysql().successCallback('Error', 'Removed error!', 'sucess');
        } else {
            await new InjectMysql().successCallback('Removed', 'Removed with sucess!', 'success');
            window.location.reload();
            // Executar outras ações de sucesso, se necessário
        }
    }
}

document.addEventListener('DOMContentLoaded', async () => {
    try {
        const viagem = new Viagem();
        await viagem.viagem();
    } catch (error) {
        console.error(error);
    }
});