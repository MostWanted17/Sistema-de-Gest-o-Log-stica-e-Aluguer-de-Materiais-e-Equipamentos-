<?php
class Clientes extends Conexao
{
    function getClientes()
    {
        $query = "SELECT id_cliente,nome,endereco,contacto,email from cliente where deleted<>1;";
        $this->ExecuteSQL($query);
        $resultados = $this->ListarTodosDados();
        $this->GetLista();
        return $resultados;
    }
    function removeClientes($id_cliente)
    {
        $query = "UPDATE cliente SET deleted=1 WHERE id_cliente=?;";
        $this->ExecuteSQL($query, array($id_cliente));
    }
    function editClientes($id_cliente,$nome,$endereco,$contacto,$email)
    {
        $query = "UPDATE cliente SET nome = ?,endereco = ?,contacto = ?,email = ? WHERE id_cliente = ?;";
        $this->ExecuteSQL($query, array($nome,$endereco,$contacto,$email,$id_cliente));
    }
    function addClientes($nome,$endereco,$contacto,$email)
    {
        $query = "INSERT INTO cliente (nome,endereco,contacto,email) VALUES (?,?,?,?);";
        $this->ExecuteSQL($query, array($nome,$endereco,$contacto,$email));
    }
    private function GetLista()
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
            );
            $i++;
        }
    }
}
