<?php
class ConexaoPHP
{
    private $host, $user, $senha, $banco;
    private $obj;
    protected $itens = array();
    private $prefix;

    public function __construct()
    {
        $this->host = 'localhost';
        $this->user = 'root';
        $this->senha = '';
        $this->banco = 'transporte';
        $this->prefix = '';

        $this->estabelecerConexao();
    }

    private function estabelecerConexao()
    {
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
        );
        $link = new PDO(
            "mysql:host={$this->host};dbname={$this->banco}",
            $this->user,
            $this->senha,
            $options
        );
        return $link;
    }

    public function ExecuteSQL($query, array $params = NULL)
    {
        try {
            $this->obj = $this->estabelecerConexao()->prepare($query);
            if ($params !== null) {
                foreach ($params as $key => $value) {
                    $this->obj->bindValue($key + 1, $value);
                }
            }
            return $this->obj->execute();
        } catch (PDOException $e) {
            exit('Erro na consulta: ' . $e->getMessage());
        }
    }

    public function ListarDados()
    {
        return $this->obj->fetch(PDO::FETCH_ASSOC);
    }
    public function ListarTodosDados()
    {
        return $this->obj->fetchAll(PDO::FETCH_ASSOC);
    }
    public function TotalDados()
    {
        return $this->obj->rowCount();
    }

    public function GetItens()
    {
        return $this->itens;
    }
}
