<?php
class Funcionarios extends Conexao
{
    function getFuncionarios()
    {
        $query = "SELECT c.id_credencial,c.nome,c.apelido,c.username,c.password,n.id_nivel,n.nome as nome_nivel from credencial c inner join nivel_acesso n on c.id_nivel=n.id_nivel where c.deleted<>1;";
        $this->ExecuteSQL($query);
        $resultados = $this->ListarTodosDados();
        $this->GetLista();
        return $resultados;
    }
    function removeFuncionarios($id_credencial)
    {
        $query = "UPDATE credencial SET deleted=1 WHERE id_credencial=?;";
        $this->ExecuteSQL($query, array($id_credencial));
    }
    function editFuncionarios($id_credencial, $nome, $apelido, $username, $password, $id_nivel)
    {
        $criptografia = new Criptografia();
        $query = "UPDATE credencial SET nome=?, apelido=?, username=?, `password`=?, id_nivel=? WHERE id_credencial=?;";
        $this->ExecuteSQL($query, array($nome, $apelido, $username, $criptografia->cripto($password), $id_nivel, $id_credencial));
    }
    function addFuncionarios($nome, $apelido, $username, $password, $id_nivel)
    {
        $criptografia = new Criptografia();
        $query = "INSERT INTO credencial(nome, apelido, username, `password`, id_nivel) VALUES (?,?,?,?,?);";
        $this->ExecuteSQL($query, array($nome, $apelido, $username, $criptografia->cripto($password), $id_nivel));
    }
    private function GetLista()
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
                'nome_nivel' => $lista['nome_nivel']
            );
            $i++;
        }
    }
}
