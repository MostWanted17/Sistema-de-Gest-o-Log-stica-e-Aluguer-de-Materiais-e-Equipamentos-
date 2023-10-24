<?php
class Equipamentos extends Conexao
{
    function getEquipamentos()
    {
        $query = "SELECT id_equipamento,nome,descricao,quantidade_estoque,valor from equipamentos where deleted<>1;";
        $this->ExecuteSQL($query);
        $resultados = $this->ListarTodosDados();
        $this->GetLista();
        return $resultados;
    }
    function getEquipamentosDisponivel()
    {
        $query = "SELECT id_equipamento,nome,descricao,quantidade_estoque,valor from equipamentos where deleted<>1 and quantidade_estoque>0;";
        $this->ExecuteSQL($query);
        $resultados = $this->ListarTodosDados();
        $this->GetLista();
        return $resultados;
    }
    function removeEquipamentos($id_equipamento)
    {
        $query = "UPDATE equipamentos SET deleted=1 WHERE id_equipamento=?;";
        $this->ExecuteSQL($query, array($id_equipamento));
    }
    function editEquipamentos($id_equipamento, $nome, $descricao, $quantidade, $valor)
    {
        $query = "UPDATE equipamentos SET nome=?, descricao=?, quantidade_estoque=?, valor=? WHERE id_equipamento=?;";
        $this->ExecuteSQL($query, array($nome, $descricao, $quantidade, $valor, $id_equipamento));
    }
    function addEquipamentos($nome, $descricao, $quantidade, $valor)
    {
        $query = "INSERT INTO equipamentos (nome, descricao, quantidade_estoque, valor) VALUES (?,?,?,?);";
        $this->ExecuteSQL($query, array($nome, $descricao, $quantidade, $valor));
    }
    private function GetLista()
    {
        $this->itens = array();
        $i = 1;
        while ($lista = $this->ListarDados()) {
            $this->itens[$i] = array(
                'id_equipamento' => $lista['id_equipamento'],
                'nome' => $lista['nome'],
                'descricao' => $lista['descricao'],
                'quantidade_estoque' => $lista['quantidade_estoque'],
                'valor' => $lista['valor']
            );
            $i++;
        }
    }
}
