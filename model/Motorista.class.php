<?php
class Motorista extends Conexao
{
    function getMotorista()
    {
        $query = "SELECT id_motorista,nome,carta_numero,carta_validade,endereco,telefone,`status` FROM `motorista` where deleted<>1;";
        $this->ExecuteSQL($query);
        $resultados = $this->ListarTodosDados();
        $this->GetLista();
        return $resultados;
    }
    function getMotoristaDisponivel()
    {
        $query = "SELECT id_motorista,nome,carta_numero,carta_validade,endereco,telefone,`status` FROM `motorista` where deleted<>1 and `status`<>'indisponível';";
        $this->ExecuteSQL($query);
        $resultados = $this->ListarTodosDados();
        $this->GetLista();
        return $resultados;
    }
    function removeMotorista($id_motorista)
    {
        $query = "UPDATE `motorista` SET deleted=1 WHERE id_motorista=?;";
        $this->ExecuteSQL($query, array($id_motorista));
    }
    function editMotorista($id_motorista, $nome, $carta_numero, $carta_validade, $endereco, $telefone)
    {
        $query = "UPDATE `motorista` SET `nome` = ?, `carta_numero` = ?, `carta_validade` = ?, `endereco` = ?, `telefone` = ? WHERE `id_motorista` = ?;";
        $this->ExecuteSQL($query, array($nome,$carta_numero,$carta_validade,$endereco,$telefone,$id_motorista));
    }
    function addMotorista( $nome, $carta_numero, $carta_validade, $endereco, $telefone)
    {
        $query = "INSERT INTO motorista (nome,carta_numero,carta_validade,endereco,telefone,`status`) VALUES (?,?,?,?,?,'disponível');";
        $this->ExecuteSQL($query, array($nome,$carta_numero,$carta_validade,$endereco,$telefone));
    }
    private function GetLista()
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
                'status' => $lista['status']
            );
            $i++;
        }
    }
}
