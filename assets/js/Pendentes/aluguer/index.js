class Aluguer {
    constructor() {
        this.injectMysql = new InjectMysql(); // Instância da classe InjectMysql para realizar chamadas AJAX
    }
    async aluguer() {
        const tableBody = document.getElementById('table-body-aluguer');
        const response = await this.injectMysql.ajaxCall(Config.pendentesAluguer);
        let html = '';
        for (let i = 0; i < response.length; i++) {
            const { id_aluguel, cliente, equipamento, data_inicio, data_fim, quantidade, valor, status } = response[i];
            html += `
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
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" onclick="new Aluguer().accepteAluguer(${id_aluguel});">
                            <i class="fa fa-check"></i>
                        </button>
                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onclick="new Aluguer().removeAluguer(${id_aluguel});">
                            <i class="zmdi zmdi-delete"></i>
                        </button>
                    </div>
                </td>
            </tr>
            `;
        }
        tableBody.innerHTML = html;
    }
    async accepteAluguer(id_aluguer) {
        const response = await this.injectMysql.ajaxPOST(Config.accepteAluguer, [id_aluguer]);
        if (response === 0) {
            await new InjectMysql().successCallback('Error', 'Removed error!', 'sucess');
        } else {
            await new InjectMysql().successCallback('Accepted', 'Accepted with sucess!', 'success');
            window.location.reload();
            // Executar outras ações de sucesso, se necessário
        }
    }
    async removeAluguer(id_aluguer) {
        const response = await this.injectMysql.ajaxPOST(Config.removeAluguer, [id_aluguer]);
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
        const aluguer = new Aluguer();
        await aluguer.aluguer();
    } catch (error) {
        console.error(error);
    }
});