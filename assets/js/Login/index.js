// Classe para lidar com o login
class Login {
    constructor() {
        // Obtém o campo de entrada de email e senha
        this.usernameInput = document.querySelector('input[name="username"]');
        this.passwordInput = document.querySelector('input[name="password"]');

        // Instância da classe InjectMysql para realizar chamadas AJAX
        this.injectMysql = new InjectMysql();

        // Instância da classe Config para acessar as URLs dos controladores
        this.config = new Config(); 
    }

    async login(element) {
        // Obtém os valores do campo de email e senha
        let username = this.usernameInput.value.trim();
        let password = this.passwordInput.value;

        // Validação dos campos de username e password
        if (!username || !password) {
            $('#error-message').text('Username and password are required.'); // Exibe mensagem de erro
            return;
        }

        // Sanitização dos campos de username e password (removendo possíveis scripts maliciosos)
        username = this.sanitizeInput(username);
        password = this.sanitizeInput(password);
       
        const originalText = $(element).text();

        // Configura a exibição do estado de carregamento
        $(element).text('Loading...');

        if ($(element).is('button')) {
            $(element).prop('disabled', true); // Desativa o botão
        } else if ($(element).is('a')) {
            $(element).css('pointer-events', 'none'); // Impede eventos de clique na tag <a>
            $(element).addClass('disabled'); // Adiciona a classe 'disabled' para desativar o estilo de link
        }

        // Faz a chamada AJAX para o login
        const response = await this.injectMysql.ajaxPOST(Config.login, [ username, password ]);

        if (response === 0) {
            // Exibe mensagem de erro caso o login falhe
            await this.injectMysql.errorCallback('Login Error', 'Please check your username or password!', 'error');

            $(element).text(originalText);

            if ($(element).is('button')) {
                $(element).prop('disabled', false); // Ativa o botão novamente
            } else if ($(element).is('a')) {
                $(element).css('pointer-events', 'auto'); // Permite eventos de clique na tag <a> novamente
                $(element).removeClass('disabled'); // Remove a classe 'disabled' para reativar o estilo de link
            }
        } else {
            window.location.reload(); // Faz o reload da página em caso de login bem-sucedido
            // Outras ações de sucesso podem ser executadas aqui, se necessário
        }

        $('#error-message').text(''); // Limpa a mensagem de erro
    }

    // Função para sanitizar o input removendo possíveis tags HTML
    sanitizeInput(input) {
        return input.replace(/<[^>]+>/g, '');
    }
}