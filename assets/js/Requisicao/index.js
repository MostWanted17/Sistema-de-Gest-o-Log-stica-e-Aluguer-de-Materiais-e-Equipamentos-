class InjectMysql {
    async successCallback(title, text, icon) {
        await Swal.fire({
            title: title,
            text: text,
            icon: icon
        });
        // Outras operações assíncronas podem ser realizadas aqui, se necessário
    }

    async errorCallback(error) {
        // Extract the error message from the error object
        const errorMessage = error.responseJSON
            ? error.responseJSON.message
            : error.message || "Unknown error";

        // Display the error message using a modal dialog or an alert
        await Swal.fire({
            title: "Error",
            text: errorMessage,
            icon: "error",
        });

        // Handle the error further, if needed
    }

    async ajaxCall(url) {
        try {
            const response = await $.ajax({
                url,
                type: 'GET',
                dataType: 'JSON'
            });
            return response;
        } catch (error) {
            throw error;
        }
    }

    async ajaxPOST(url, data) {
        try {
            const response = await $.ajax({
                url,
                type: 'POST',
                dataType: 'JSON',
                data: { ...data }
            });
            return response;
        } catch (error) {
            // Em caso de erro, chama a função de callback de erro
            await this.errorCallback(error);
            throw error; // Lança o erro novamente para ser tratado pela função de login
        }
    }
}