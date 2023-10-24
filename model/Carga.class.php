<?php
class Carga extends Conexao
{
    function getCarga()
    {
        $query = "SELECT id_carga,descricao from cargas where deleted<>1;";
        $this->ExecuteSQL($query);
        $resultados = $this->ListarTodosDados();
        $this->GetLista();
        return $resultados;
    }
    function removeCarga($id_carga)
    {
        $query = "UPDATE cargas SET deleted=1 WHERE id_carga=?;";
        $this->ExecuteSQL($query, array($id_carga));
    }
    function editCarga($id_carga, $descricao)
    {
        $query = "UPDATE `cargas` SET `descricao` = ? WHERE `cargas`.`id_carga` = ?;";
        $this->ExecuteSQL($query, array($descricao,$id_carga));
    }
    function addCarga($descricao)
    {
        $query = "INSERT INTO cargas (descricao) VALUES (?);";
        $this->ExecuteSQL($query, array($descricao));
    }
    private function GetLista()
    {
        $this->itens = array();
        $i = 1;
        while ($lista = $this->ListarDados()) {
            $this->itens[$i] = array(
                'id_carga' => $lista['id_carga'],
                'descricao' => $lista['descricao']
            );
            $i++;
        }
    }
}
