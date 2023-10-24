<?php

class Relatorios extends ConexaoPHP
{

    function getAluguer($data_inicio, $data_fim)
    {
        $query = "SELECT a.id_aluguel, c.nome as cliente, e.nome as equipamento, a.data_inicio, a.data_fim, a.quantidade, a.valor, a.status, a.accepted, a.deleted FROM `aluguel` a INNER JOIN cliente c ON a.id_cliente = c.id_cliente INNER JOIN equipamentos e ON a.id_equipamento = e.id_equipamento WHERE a.data_inicio >= ? AND a.data_inicio <= ?;";
        $this->ExecuteSQL($query, array($data_inicio, $data_fim));
        $resultados = $this->ListarTodosDados();
        $this->GetListaAluguer();

        // Criar um novo objeto MPDF
        $mpdf = new \Mpdf\Mpdf();

        // Definir o conteúdo do relatório
        $html = '<style>
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .header h1 {
            margin-bottom: 0;
        }

        .header h6 {
            margin: 0;
            padding: 0;
        }
        .header img {
            max-height: 50px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 5px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table td.deleted {
            background-color: #ffe6e6;
        }

        .totals {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .totals strong {
            display: inline-block;
            width: 200px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>';

        $html .= '<div class="header">
    <img src="assets/images/icon/logo.png" alt="Logo da Empresa" width="200px">
    <h1>Relatório de Aluguer</h1>
    <h6>(' . $data_inicio . ' até ' . $data_fim . ')</h6>
</div>';

        // Calcular totais
        $totalElementos = count($resultados);
        $totalValor = 0;
        $totalAtivos = 0;
        $totalDevolvidos = 0;
        $totaisDeletados = 0;
        $totaisPendentes = 0;
        foreach ($resultados as $resultado) {
            $totalValor += $resultado['valor'];
            if ($resultado['status'] == 'em processo' && $resultado['deleted'] != 1 && $resultado['accepted'] !=0) {
                $totalAtivos++;
            }
            if ($resultado['status'] == 'devolvido') {
                $totalDevolvidos++;
            }
            if ($resultado['deleted'] == 1) {
                $totaisDeletados++;
            }
            if ($resultado['accepted'] == 0) {
                $totaisPendentes++;
            }
        }

        // Adicionar totais no relatório
        $html .= '<div class="totals">';
        $html .= '<strong>Total de Equipamentos Alugados:</strong> ' . $totalElementos . '<br>';
        $html .= '<strong>Total de Valor:</strong> ' . $totalValor . '<br>';
        $html .= '<strong>Total de Aluguer Ativos:</strong> ' . $totalAtivos . '<br>';
        $html .= '<strong>Total de Equipamentos Devolvidos:</strong> ' . $totalDevolvidos . '<br>';
        $html .= '<strong>Total de Aluguer Deletados:</strong> ' . $totaisDeletados . '<br>';
        $html .= '<strong>Total de Aluguer Pendentes:</strong> ' . $totaisPendentes . '<br>';
        // Adicione outras informações pertinentes aqui
        $html .= '</div>';

        // Adicionar os dados do relatório
        $html .= '<table class="table">';
        $html .= '<tr>';
        $html .= '<th>ID Aluguel</th>';
        $html .= '<th>Cliente</th>';
        $html .= '<th>Equipamento</th>';
        $html .= '<th>Data Início</th>';
        $html .= '<th>Data Fim</th>';
        $html .= '<th>Quantidade</th>';
        $html .= '<th>Valor</th>';
        $html .= '<th>Status</th>';
        $html .= '<th>Accepted</th>';
        $html .= '<th>Deleted</th>';
        $html .= '</tr>';

        foreach ($resultados as $resultado) {
            $html .= '<tr>';
            $html .= '<td>' . $resultado['id_aluguel'] . '</td>';
            $html .= '<td>' . $resultado['cliente'] . '</td>';
            $html .= '<td>' . $resultado['equipamento'] . '</td>';
            $html .= '<td>' . $resultado['data_inicio'] . '</td>';
            $html .= '<td>' . $resultado['data_fim'] . '</td>';
            $html .= '<td>' . $resultado['quantidade'] . '</td>';
            $html .= '<td>' . $resultado['valor'] . '</td>';
            $html .= '<td>' . $resultado['status'] . '</td>';
            if (strval($resultado['accepted']) == '1') {
                $html .= '<td>Aceite</td>';
            } else {
                $html .= '<td>Pendente</td>';
            }
            if (strval($resultado['deleted']) == '1') {
                $html .= '<td>Deletado</td>';
            } else {
                $html .= '<td>Ativo</td>';
            }
            $html .= '</tr>';
        }

        $html .= '</table>';

        $html .= '<div class="footer">
        Relatório gerado em ' . date('Y-m-d H:i:s') . ' por ' . $_SESSION['auth_session']['nome'] . ' ' . $_SESSION['auth_session']['apelido'] . '
    </div>';

        // Definir o conteúdo HTML no MPDF
        $mpdf->WriteHTML($html);

        // Gerar o PDF e abrir em uma nova aba do navegador
        $mpdf->Output('Relatorio de Aluguer (' . $data_inicio . ' ate ' . $data_fim . ').pdf', 'I');
    }

    function getViagem($data_inicio, $data_fim)
    {
        $query = "SELECT v.id_viagem, c.matricula, m.nome as motorista, ca.descricao as carga, v.origem, v.destino, v.descricao, v.peso_carga, v.valor_carga, v.data_saida, v.previsao_chegada, v.status, v.accepted, v.deleted FROM `viagem` v INNER JOIN carros c ON c.id_carro = v.id_carro INNER JOIN cargas ca ON ca.id_carga = v.id_carga INNER JOIN motorista m ON m.id_motorista = v.id_motorista WHERE v.data_saida >= ? AND v.data_saida <= ?;";
        $this->ExecuteSQL($query, array($data_inicio, $data_fim));
        $resultados = $this->ListarTodosDados();
        $this->GetListaViagem();

        // Criar um novo objeto MPDF
        $mpdf = new \Mpdf\Mpdf();

        // Definir o conteúdo do relatório
        $html = '<style>
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .header h1 {
            margin-bottom: 0;
        }

        .header h6 {
            margin: 0;
            padding: 0;
        }
        .header img {
            max-height: 50px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 5px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table td.deleted {
            background-color: #ffe6e6;
        }

        .totals {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .totals strong {
            display: inline-block;
            width: 200px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>';

    $html .= '<div class="header">
    <img src="assets/images/icon/logo.png" alt="Logo da Empresa" width="200px">
    <h1>Relatório de Viagem</h1>
    <h6>(' . $data_inicio . ' até ' . $data_fim . ')</h6>
</div>';

        // Adicionar os dados do relatório
        $html .= '<table class="table">';
        $html .= '<tr>';
        $html .= '<th>ID Viagem</th>';
        $html .= '<th>Matrícula</th>';
        $html .= '<th>Motorista</th>';
        $html .= '<th>Carga</th>';
        $html .= '<th>Origem</th>';
        $html .= '<th>Destino</th>';
        $html .= '<th>Descrição</th>';
        $html .= '<th>Peso da Carga</th>';
        $html .= '<th>Valor da Carga</th>';
        $html .= '<th>Data de Saída</th>';
        $html .= '<th>Previsão de Chegada</th>';
        $html .= '<th>Status</th>';
        $html .= '<th>Accepted</th>';
        $html .= '<th>Deleted</th>';
        $html .= '</tr>';

        foreach ($resultados as $resultado) {
            $html .= '<tr>';
            $html .= '<td>' . $resultado['id_viagem'] . '</td>';
            $html .= '<td>' . $resultado['matricula'] . '</td>';
            $html .= '<td>' . $resultado['motorista'] . '</td>';
            $html .= '<td>' . $resultado['carga'] . '</td>';
            $html .= '<td>' . $resultado['origem'] . '</td>';
            $html .= '<td>' . $resultado['destino'] . '</td>';
            $html .= '<td>' . $resultado['descricao'] . '</td>';
            $html .= '<td>' . $resultado['peso_carga'] . '</td>';
            $html .= '<td>' . $resultado['valor_carga'] . '</td>';
            $html .= '<td>' . $resultado['data_saida'] . '</td>';
            $html .= '<td>' . $resultado['previsao_chegada'] . '</td>';
            $html .= '<td>' . $resultado['status'] . '</td>';
            if (strval($resultado['accepted']) == '1') {
                $html .= '<td>Aceite</td>';
            } else {
                $html .= '<td>Pendente</td>';
            }
            if (strval($resultado['deleted']) == '1') {
                $html .= '<td>Deletado</td>';
            } else {
                $html .= '<td>Ativo</td>';
            }
            $html .= '</tr>';
        }

        $html .= '</table>';
        $html .= '<div class="footer">
        Relatório gerado em ' . date('Y-m-d H:i:s') . ' por ' . $_SESSION['auth_session']['nome'] . ' ' . $_SESSION['auth_session']['apelido'] . '
    </div>';

        // Definir o conteúdo HTML no MPDF
        $mpdf->WriteHTML($html);

        // Gerar o PDF e abrir em uma nova aba do navegador
        $mpdf->Output('Relatorio de Viagem (' . $data_inicio . ' ate ' . $data_fim . ').pdf', 'I');
    }
    function getCarga()
    {
        $query = "SELECT id_carga,descricao,deleted from cargas;";
        $this->ExecuteSQL($query);
        $resultados = $this->ListarTodosDados();
        $this->GetListaCarga();
        // Criar um novo objeto MPDF
        $mpdf = new \Mpdf\Mpdf();

        // Definir o conteúdo do relatório
        $html = '<style>
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .header img {
            max-height: 50px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 5px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table td.deleted {
            background-color: #ffe6e6;
        }

        .totals {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .totals strong {
            display: inline-block;
            width: 200px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>';

        $html .= '<div class="header">
        <img src="assets/images/icon/logo.png" alt="Logo da Empresa" width="200px">

    <h1>Relatório de Carga</h1>
</div>';

        // Adicionar os dados do relatório
        $html .= '<table class="table">';
        $html .= '<tr>';
        $html .= '<th>ID Carga</th>';
        $html .= '<th>Descricao</th>';
        $html .= '<th>Deleted</th>';
        $html .= '</tr>';

        foreach ($resultados as $resultado) {
            $html .= '<tr>';
            $html .= '<td>' . $resultado['id_carga'] . '</td>';
            $html .= '<td>' . $resultado['descricao'] . '</td>';
            if (strval($resultado['deleted']) == '1') {
                $html .= '<td>Deletado</td>';
            } else {
                $html .= '<td>Ativo</td>';
            }
            $html .= '</tr>';
        }

        $html .= '</table>';
        $html .= '<div class="footer">
        Relatório gerado em ' . date('Y-m-d H:i:s') . ' por ' . $_SESSION['auth_session']['nome'] . ' ' . $_SESSION['auth_session']['apelido'] . '
    </div>';

        // Definir o conteúdo HTML no MPDF
        $mpdf->WriteHTML($html);

        // Gerar o PDF e abrir em uma nova aba do navegador
        $mpdf->Output('Relatorio de Carga.pdf', 'I');
    }
    function getCarro()
    {
        $query = "SELECT id_carro,matricula,modelo,cor,`status`,deleted from carros;";
        $this->ExecuteSQL($query);
        $resultados = $this->ListarTodosDados();
        $this->GetListaCarro();

        // Criar um novo objeto MPDF
        $mpdf = new \Mpdf\Mpdf();

        // Definir o conteúdo do relatório
        $html = '<style>
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .header img {
            max-height: 50px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 5px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table td.deleted {
            background-color: #ffe6e6;
        }

        .totals {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .totals strong {
            display: inline-block;
            width: 200px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>';

        $html .= '<div class="header">
        <img src="assets/images/icon/logo.png" alt="Logo da Empresa" width="200px">

    <h1>Relatório de Carros</h1>
</div>';

        // Adicionar os dados do relatório
        $html .= '<table class="table">';
        $html .= '<tr>';
        $html .= '<th>ID Carro</th>';
        $html .= '<th>Matricula</th>';
        $html .= '<th>Modelo</th>';
        $html .= '<th>Cor</th>';
        $html .= '<th>Status</th>';
        $html .= '<th>Deleted</th>';
        $html .= '</tr>';

        foreach ($resultados as $resultado) {
            $html .= '<tr>';
            $html .= '<td>' . $resultado['id_carro'] . '</td>';
            $html .= '<td>' . $resultado['matricula'] . '</td>';
            $html .= '<td>' . $resultado['modelo'] . '</td>';
            $html .= '<td>' . $resultado['cor'] . '</td>';
            $html .= '<td>' . $resultado['status'] . '</td>';
            if (strval($resultado['deleted']) == '1') {
                $html .= '<td>Deletado</td>';
            } else {
                $html .= '<td>Ativo</td>';
            }
            $html .= '</tr>';
        }

        $html .= '</table>';

        // Definir o conteúdo HTML no MPDF
        $mpdf->WriteHTML($html);

        // Gerar o PDF e abrir em uma nova aba do navegador
        $mpdf->Output('Relatorio de Carros.pdf', 'I');
    }
    function getMotorista()
    {
        $query = "SELECT id_motorista,nome,carta_numero,carta_validade,endereco,telefone,`status`,deleted FROM `motorista`;";
        $this->ExecuteSQL($query);
        $resultados = $this->ListarTodosDados();
        $this->GetListaMotorista();


        // Criar um novo objeto MPDF
        $mpdf = new \Mpdf\Mpdf();

        // Definir o conteúdo do relatório
        $html = '<style>
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .header img {
            max-height: 50px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 5px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table td.deleted {
            background-color: #ffe6e6;
        }

        .totals {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .totals strong {
            display: inline-block;
            width: 200px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>';

        $html .= '<div class="header">
        <img src="assets/images/icon/logo.png" alt="Logo da Empresa" width="200px">

    <h1>Relatório de Motoristas</h1>
</div>';

        // Adicionar os dados do relatório
        $html .= '<table class="table">';
        $html .= '<tr>';
        $html .= '<th>ID Motorista</th>';
        $html .= '<th>Nome</th>';
        $html .= '<th>Carta Numero</th>';
        $html .= '<th>Carta Validade</th>';
        $html .= '<th>Endereco</th>';
        $html .= '<th>Telefone</th>';
        $html .= '<th>Status</th>';
        $html .= '<th>Deleted</th>';
        $html .= '</tr>';

        foreach ($resultados as $resultado) {
            $html .= '<tr>';
            $html .= '<td>' . $resultado['id_motorista'] . '</td>';
            $html .= '<td>' . $resultado['nome'] . '</td>';
            $html .= '<td>' . $resultado['carta_numero'] . '</td>';
            $html .= '<td>' . $resultado['carta_validade'] . '</td>';
            $html .= '<td>' . $resultado['endereco'] . '</td>';
            $html .= '<td>' . $resultado['telefone'] . '</td>';
            $html .= '<td>' . $resultado['status'] . '</td>';
            if (strval($resultado['deleted']) == '1') {
                $html .= '<td>Deletado</td>';
            } else {
                $html .= '<td>Ativo</td>';
            }
            $html .= '</tr>';
        }

        $html .= '</table>';
        $html .= '<div class="footer">
        Relatório gerado em ' . date('Y-m-d H:i:s') . ' por ' . $_SESSION['auth_session']['nome'] . ' ' . $_SESSION['auth_session']['apelido'] . '
    </div>';

        // Definir o conteúdo HTML no MPDF
        $mpdf->WriteHTML($html);

        // Gerar o PDF e abrir em uma nova aba do navegador
        $mpdf->Output('Relatorio de Motoristas.pdf', 'I');
    }
    function getEquipamentos()
    {
        $query = "SELECT id_equipamento,nome,descricao,quantidade_estoque,deleted from equipamentos;";
        $this->ExecuteSQL($query);
        $resultados = $this->ListarTodosDados();
        $this->GetListaEquipamentos();

        // Criar um novo objeto MPDF
        $mpdf = new \Mpdf\Mpdf();

        // Definir o conteúdo do relatório
        $html = '<style>
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .header img {
            max-height: 50px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 5px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table td.deleted {
            background-color: #ffe6e6;
        }

        .totals {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .totals strong {
            display: inline-block;
            width: 200px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>';

        $html .= '<div class="header">
        <img src="assets/images/icon/logo.png" alt="Logo da Empresa" width="200px">

    <h1>Relatório de Equipamentos</h1>
</div>';

        // Adicionar os dados do relatório
        $html .= '<table class="table">';
        $html .= '<tr>';
        $html .= '<th>ID Equipamento</th>';
        $html .= '<th>Nome</th>';
        $html .= '<th>Descricao</th>';
        $html .= '<th>Quantidade</th>';
        $html .= '<th>Deleted</th>';
        $html .= '</tr>';

        foreach ($resultados as $resultado) {
            $html .= '<tr>';
            $html .= '<td>' . $resultado['id_equipamento'] . '</td>';
            $html .= '<td>' . $resultado['nome'] . '</td>';
            $html .= '<td>' . $resultado['descricao'] . '</td>';
            $html .= '<td>' . $resultado['quantidade_estoque'] . '</td>';
            if (strval($resultado['deleted']) == '1') {
                $html .= '<td>Deletado</td>';
            } else {
                $html .= '<td>Ativo</td>';
            }
            $html .= '</tr>';
        }

        $html .= '</table>';

        // Definir o conteúdo HTML no MPDF
        $mpdf->WriteHTML($html);

        // Gerar o PDF e abrir em uma nova aba do navegador
        $mpdf->Output('Relatorio de Equipamentos.pdf', 'I');
    }
    function getFuncionarios()
    {
        $query = "SELECT c.id_credencial,c.nome,c.apelido,c.username,c.password,n.id_nivel,n.nome as nome_nivel,deleted from credencial c inner join nivel_acesso n on c.id_nivel=n.id_nivel;";
        $this->ExecuteSQL($query);
        $resultados = $this->ListarTodosDados();
        $this->GetListaFuncionarios();

        // Criar um novo objeto MPDF
        $mpdf = new \Mpdf\Mpdf();

        // Definir o conteúdo do relatório
        $html = '<style>
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .header img {
            max-height: 50px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 5px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table td.deleted {
            background-color: #ffe6e6;
        }

        .totals {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .totals strong {
            display: inline-block;
            width: 200px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>';

        $html .= '<div class="header">
        <img src="assets/images/icon/logo.png" alt="Logo da Empresa" width="200px">

    <h1>Relatório de Funcionarios</h1>
</div>';

        // Adicionar os dados do relatório
        $html .= '<table class="table">';
        $html .= '<tr>';
        $html .= '<th>ID Funcionario</th>';
        $html .= '<th>Nome</th>';
        $html .= '<th>Apelido</th>';
        $html .= '<th>Username</th>';
        $html .= '<th>Nivel de Acesso</th>';
        $html .= '<th>Deleted</th>';
        $html .= '</tr>';

        foreach ($resultados as $resultado) {
            $html .= '<tr>';
            $html .= '<td>' . $resultado['id_credencial'] . '</td>';
            $html .= '<td>' . $resultado['nome'] . '</td>';
            $html .= '<td>' . $resultado['apelido'] . '</td>';
            $html .= '<td>' . $resultado['username'] . '</td>';
            $html .= '<td>' . $resultado['nome_nivel'] . '</td>';
            if (strval($resultado['deleted']) == '1') {
                $html .= '<td>Deletado</td>';
            } else {
                $html .= '<td>Ativo</td>';
            }
            $html .= '</tr>';
        }

        $html .= '</table>';
        $html .= '<div class="footer">
        Relatório gerado em ' . date('Y-m-d H:i:s') . ' por ' . $_SESSION['auth_session']['nome'] . ' ' . $_SESSION['auth_session']['apelido'] . '
    </div>';

        // Definir o conteúdo HTML no MPDF
        $mpdf->WriteHTML($html);

        // Gerar o PDF e abrir em uma nova aba do navegador
        $mpdf->Output('Relatorio de Funcionarios.pdf', 'I');
    }
    function getClientes()
    {
        $query = "SELECT id_cliente,nome,endereco,contacto,email,deleted from cliente;";
        $this->ExecuteSQL($query);
        $resultados = $this->ListarTodosDados();
        $this->GetListaClientes();

        // Criar um novo objeto MPDF
        $mpdf = new \Mpdf\Mpdf();

        // Definir o conteúdo do relatório
        $html = '<style>
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .header img {
            max-height: 50px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 5px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table td.deleted {
            background-color: #ffe6e6;
        }

        .totals {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .totals strong {
            display: inline-block;
            width: 200px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>';

        $html .= '<div class="header">
        <img src="assets/images/icon/logo.png" alt="Logo da Empresa" width="200px">

    <h1>Relatório de Clientes</h1>
</div>';

        // Adicionar os dados do relatório
        $html .= '<table class="table">';
        $html .= '<tr>';
        $html .= '<th>ID Cliente</th>';
        $html .= '<th>Nome</th>';
        $html .= '<th>Endereço</th>';
        $html .= '<th>Contacto</th>';
        $html .= '<th>Email</th>';
        $html .= '<th>Status</th>';
        $html .= '</tr>';

        foreach ($resultados as $resultado) {
            $html .= '<tr>';
            $html .= '<td>' . $resultado['id_cliente'] . '</td>';
            $html .= '<td>' . $resultado['nome'] . '</td>';
            $html .= '<td>' . $resultado['endereco'] . '</td>';
            $html .= '<td>' . $resultado['contacto'] . '</td>';
            $html .= '<td>' . $resultado['email'] . '</td>';
            $html .= '<td>' . ($resultado['deleted'] ? 'Deletado' : 'Ativo') . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';
        $html .= '<div class="footer">
        Relatório gerado em ' . date('Y-m-d H:i:s') . ' por ' . $_SESSION['auth_session']['nome'] . ' ' . $_SESSION['auth_session']['apelido'] . '
    </div>';

        // Definir o conteúdo HTML no MPDF
        $mpdf->WriteHTML($html);

        // Gerar o PDF e abrir em uma nova aba do navegador
        $mpdf->Output('Relatorio de Clientes.pdf', 'I');
    }
    function getPorFuncionario($id_credencial)
    {
        $query = "SELECT h.id_history,h.id_credencial,h.acessed_at,c.nome,c.apelido FROM `history_login` h inner join `credencial` c on h.id_credencial=c.id_credencial where c.id_credencial=?;";
        $this->ExecuteSQL($query, array($id_credencial));
        $resultados = $this->ListarTodosDados();
        $this->GetListaPorFuncionarios();

        // Criar um novo objeto MPDF
        $mpdf = new \Mpdf\Mpdf();

        // Definir o conteúdo do relatório
        $html = '<style>
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .header img {
            max-height: 50px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 5px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table td.deleted {
            background-color: #ffe6e6;
        }

        .totals {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .totals strong {
            display: inline-block;
            width: 200px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>';

        $html .= '<div class="header">
        <img src="assets/images/icon/logo.png" alt="Logo da Empresa" width="200px">

    <h1>Relatório por Funcionario</h1>
</div>';

        // Adicionar os dados do relatório
        $html .= '<table class="table">';
        $html .= '<tr>';
        $html .= '<th>ID History</th>';
        $html .= '<th>ID Credencial</th>';
        $html .= '<th>Acessed At</th>';
        $html .= '<th>Nome</th>';
        $html .= '<th>Apelido</th>';
        $html .= '</tr>';

        foreach ($resultados as $resultado) {
            $html .= '<tr>';
            $html .= '<td>' . $resultado['id_history'] . '</td>';
            $html .= '<td>' . $resultado['id_credencial'] . '</td>';
            $html .= '<td>' . $resultado['acessed_at'] . '</td>';
            $html .= '<td>' . $resultado['nome'] . '</td>';
            $html .= '<td>' . $resultado['apelido'] . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';
        $html .= '<div class="footer">
        Relatório gerado em ' . date('Y-m-d H:i:s') . ' por ' . $_SESSION['auth_session']['nome'] . ' ' . $_SESSION['auth_session']['apelido'] . '
    </div>';

        // Definir o conteúdo HTML no MPDF
        $mpdf->WriteHTML($html);

        // Gerar o PDF e abrir em uma nova aba do navegador
        $mpdf->Output('Relatorio do Historico do Funcionario.pdf', 'I');
    }
    private function GetListaPorFuncionarios()
    {
        $this->itens = array();
        $i = 1;
        while ($lista = $this->ListarDados()) {
            $this->itens[$i] = array(
                'id_history' => $lista['id_history'],
                'id_Credencial' => $lista['id_credencial'],
                'acessed_at' => $lista['acessed_at'],
                'nome' => $lista['nome'],
                'apelido' => $lista['apelido']
            );
            $i++;
        }
    }
    private function GetListaClientes()
    {
        $this->itens = array();
        $i = 1;
        while ($lista = $this->ListarDados()) {
            $this->itens[$i] = array(
                'id_cliente' => $lista['id_cliente'],
                'nome' => $lista['nome'],
                'endereco' => $lista['endereco'],
                'contacto' => $lista['contacto'],
                'email' => $lista['email'],
                'deleted' => $lista['deleted']
            );
            $i++;
        }
    }
    private function GetListaFuncionarios()
    {
        $this->itens = array();
        $i = 1;
        while ($lista = $this->ListarDados()) {
            $this->itens[$i] = array(
                'id_credencial' => $lista['id_credencial'],
                'nome' => $lista['nome'],
                'apelido' => $lista['apelido'],
                'username' => $lista['username'],
                'password' => $lista['password'],
                'id_nivel' => $lista['id_nivel'],
                'nome_nivel' => $lista['nome_nivel'],
                'deleted' => $lista['deleted']
            );
            $i++;
        }
    }
    private function GetListaEquipamentos()
    {
        $this->itens = array();
        $i = 1;
        while ($lista = $this->ListarDados()) {
            $this->itens[$i] = array(
                'id_equipamento' => $lista['id_equipamento'],
                'nome' => $lista['nome'],
                'descricao' => $lista['descricao'],
                'quantidade_estoque' => $lista['quantidade_estoque'],
                'deleted' => $lista['deleted']
            );
            $i++;
        }
    }
    private function GetListaMotorista()
    {
        $this->itens = array();
        $i = 1;
        while ($lista = $this->ListarDados()) {
            $this->itens[$i] = array(
                'id_motorista' => $lista['id_motorista'],
                'nome' => $lista['nome'],
                'carta_numero' => $lista['carta_numero'],
                'carta_validade' => $lista['carta_validade'],
                'endereco' => $lista['endereco'],
                'telefone' => $lista['telefone'],
                'status' => $lista['status'],
                'deleted' => $lista['deleted']
            );
            $i++;
        }
    }
    private function GetListaCarro()
    {
        $this->itens = array();
        $i = 1;
        while ($lista = $this->ListarDados()) {
            $this->itens[$i] = array(
                'id_carro' => $lista['id_carro'],
                'matricula' => $lista['matricula'],
                'modelo' => $lista['modelo'],
                'cor' => $lista['cor'],
                'status' => $lista['status'],
                'deleted' => $lista['deleted']
            );
            $i++;
        }
    }

    private function GetListaAluguer()
    {
        $this->itens = array();
        $i = 1;
        while ($lista = $this->ListarDados()) {
            $this->itens[$i] = array(
                'id_aluguel' => $lista['id_aluguel'],
                'cliente' => $lista['cliente'],
                'equipamento' => $lista['equipamento'],
                'data_inicio' => $lista['data_inicio'],
                'data_fim' => $lista['data_fim'],
                'quantidade' => $lista['quantidade'],
                'valor' => $lista['valor'],
                'status' => $lista['status'],
                'accepted' => $lista['accepted'],
                'deleted' => $lista['deleted']
            );
            $i++;
        }
    }
    private function GetListaViagem()
    {
        $this->itens = array();
        $i = 1;
        while ($lista = $this->ListarDados()) {
            $this->itens[$i] = array(
                'id_viagem' => $lista['id_viagem'],
                'matricula' => $lista['matricula'],
                'motorista' => $lista['motorista'],
                'carga' => $lista['carga'],
                'origem' => $lista['origem'],
                'destino' => $lista['destino'],
                'descricao' => $lista['descricao'],
                'peso_carga' => $lista['peso_carga'],
                'valor_carga' => $lista['valor_carga'],
                'data_saida' => $lista['data_saida'],
                'previsao_chegada' => $lista['previsao_chegada'],
                'status' => $lista['status'],
                'accepted' => $lista['accepted'],
                'deleted' => $lista['deleted']
            );
            $i++;
        }
    }
    private function GetListaCarga()
    {
        $this->itens = array();
        $i = 1;
        while ($lista = $this->ListarDados()) {
            $this->itens[$i] = array(
                'id_carga' => $lista['id_carga'],
                'descricao' => $lista['descricao'],
                'deleted' => $lista['deleted']
            );
            $i++;
        }
    }
}
