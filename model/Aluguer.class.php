<?php
class Aluguer extends Conexao
{
    function getAluguer()
    {
        $query = "SELECT a.id_aluguel,c.nome as cliente,e.nome as equipamento, a.data_inicio,a.data_fim,a.quantidade,a.valor,a.status FROM `aluguel` a inner join cliente c on a.id_cliente=c.id_cliente inner join equipamentos e on a.id_equipamento=e.id_equipamento where a.deleted<>1 and accepted<>0;";
        $this->ExecuteSQL($query);
        $resultados = $this->ListarTodosDados();
        $this->GetLista();
        return $resultados;
    }
    function removeAluguer($id_aluguer)
    {
        $query = "UPDATE `equipamentos`
        SET quantidade_estoque = (quantidade_estoque + (
            SELECT quantidade
            FROM `aluguel`
            WHERE id_aluguel = ?
        ))
        WHERE id_equipamento = (
            SELECT id_equipamento
            FROM `aluguel`
            WHERE id_aluguel = ?
        );
        UPDATE aluguel SET deleted=1 WHERE id_aluguel=?;";
        $this->ExecuteSQL($query, array($id_aluguer,$id_aluguer,$id_aluguer));
    }
    function addAluguer($id_cliente,$id_equipamento,$data_inicio,$data_fim,$quantidade,$valor)
    {
        $query = "INSERT INTO aluguel (id_cliente,id_equipamento,data_inicio,data_fim,quantidade,valor) VALUES (?,?,?,?,?,?);
        Update equipamentos set quantidade_estoque = quantidade_estoque - ? where id_equipamento=?;";
        $this->ExecuteSQL($query, array($id_cliente,$id_equipamento,$data_inicio,$data_fim,$quantidade,$valor,$quantidade,$id_equipamento));
    }
    function editAluguer($id_aluguer,$data_inicio,$data_fim,$quantidade,$valor)
    {
        $query = "Update equipamentos set quantidade_estoque = quantidade_estoque + (Select quantidade from aluguel where id_aluguel=?) where id_equipamento = (Select id_equipamento from aluguel where id_aluguel=?);
            Update aluguel set data_inicio = ? , data_fim = ? , quantidade = ? , valor = ? where id_aluguel = ?;
            Update equipamentos set quantidade_estoque = quantidade_estoque - ? where id_equipamento = (Select id_equipamento from aluguel where id_aluguel=?)
            ";
        $this->ExecuteSQL($query, array($id_aluguer,$id_aluguer,$data_inicio,$data_fim,$quantidade,$valor,$id_aluguer,$quantidade,$id_aluguer));
    }
    function finishedAluguer($id_aluguer){
        $query = "Update aluguel set status = 'devolvido' where id_aluguel = ?;
        Update equipamentos set quantidade_estoque = quantidade_estoque + (Select quantidade from aluguel where id_aluguel=?) where id_equipamento = (Select id_equipamento from aluguel where id_aluguel=?);";
        $this->ExecuteSQL($query, array($id_aluguer,$id_aluguer,$id_aluguer));
    }
    private function GetLista()
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
                'status' => $lista['status']
            );
            $i++;
        }
    }
}
