<?php
class Login extends Conexao
{
    function __construct()
    {
        parent::__construct();
    }
    function getLogin($username, $password)
    {
        $criptografia = new Criptografia();
        $query = "SELECT c.id_credencial,c.nome,c.apelido,c.username,c.password,n.id_nivel,n.nome as nome_nivel from credencial c inner join nivel_acesso n on c.id_nivel=n.id_nivel where c.username=? and c.password=? and c.deleted<>1;";
        try {
            $this->ExecuteSQL($query, array($username, $criptografia->cripto($password)));
            $this->GetLista();
            if ($this->TotalDados() == 1) {
                session_start();
                $_SESSION['auth_session'] = $this->itens[1];
                $this->setHistory($this->itens[1]['id_credencial']);
                return 1;
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            exit('Erro na consulta: ' . $e->getMessage());
        }
    }
    function setHistory($id_credential){
        $query = "Insert into history_login (id_credencial) values (?);";
        $this->ExecuteSQL($query, array($id_credential));
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
