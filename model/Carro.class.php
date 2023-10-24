<?php
class Carro extends Conexao
{
    function getCarro()
    {
        $query = "SELECT id_carro,matricula,modelo,cor,`status` from carros where deleted<>1;";
        $this->ExecuteSQL($query);
        $resultados = $this->ListarTodosDados();
        $this->GetLista();
        return $resultados;
    }
    function getCarroDisponviel()
    {
        $query = "SELECT id_carro,matricula,modelo,cor,`status` from carros where deleted<>1 and `status`<>'indisponível';";
        $this->ExecuteSQL($query);
        $resultados = $this->ListarTodosDados();
        $this->GetLista();
        return $resultados;
    }
    function removeCarro($id_carro)
    {
        $query = "UPDATE carros SET deleted=1 WHERE id_carro=?;";
        $this->ExecuteSQL($query, array($id_carro));
    }
    function editCarro($id_carro, $matricula,$modelo,$cor,$status)
    {
        $query = "UPDATE `carros` SET `matricula` = ?,`modelo` = ?,`cor` = ?,`status` = ? WHERE `carros`.`id_carro` = ?;";
        $this->ExecuteSQL($query, array($matricula,$modelo,$cor,$status,$id_carro));
    }
    function addCarro($matricula,$modelo,$cor,$status)
    {
        $query = "INSERT INTO carros (matricula,modelo,cor,`status`) VALUES (?,?,?,?);";
        $this->ExecuteSQL($query, array($matricula,$modelo,$cor,$status));
    }
    private function GetLista()
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
            );
            $i++;
        }
    }
}
