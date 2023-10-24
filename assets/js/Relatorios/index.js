class Relatorios {
    constructor() {
        this.injectMysql = new InjectMysql(); // Instância da classe InjectMysql para realizar chamadas AJAX
    }
    async relatorio() {
        console.log("ola");
        const response = await this.injectMysql.ajaxPOST(Config.relatorios);
        console.log(response);
    }
}