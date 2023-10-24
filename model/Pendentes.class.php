<?php
class Pendentes extends Conexao
{
    function getViagem()
    {
        $query = "SELECT v.id_viagem,c.matricula,m.nome as motorista,ca.descricao as carga, v.origem,v.destino,v.descricao,v.peso_carga,v.valor_carga,v.data_saida,v.previsao_chegada FROM `viagem` v inner join carros c on c.id_carro=v.id_carro inner join cargas ca on ca.id_carga = v.id_carga inner join motorista m on m.id_motorista=v.id_motorista where v.deleted<>1 and v.accepted<>1;";
        $this->ExecuteSQL($query);
        $resultados = $this->ListarTodosDados();
        $this->GetListaViagem();
        return $resultados;
    }
    function getAluguer()
    {
        $query = "SELECT a.id_aluguel,c.nome as cliente,e.nome as equipamento, a.data_inicio,a.data_fim,a.quantidade,a.valor,a.status FROM `aluguel` a inner join cliente c on a.id_cliente=c.id_cliente inner join equipamentos e on a.id_equipamento=e.id_equipamento where a.deleted<>1 and accepted<>1;";
        $this->ExecuteSQL($query);
        $resultados = $this->ListarTodosDados();
        $this->GetListaAluguer();
        return $resultados;
    }
    function removeViagem($id_viagem)
    {
        $query = "UPDATE viagem SET deleted=1 WHERE id_viagem=?;";
        $this->ExecuteSQL($query, array($id_viagem));
    }
    function accepteViagem($id_viagem)
    {
        $query = "UPDATE viagem SET accepted=1 WHERE id_viagem=?;";
        $this->ExecuteSQL($query, array($id_viagem));
    }
    function accepteAluguer($id_aluguer)
    {
        $query = "UPDATE aluguel SET accepted=1 WHERE id_aluguel=?;";
        $this->ExecuteSQL($query, array($id_aluguer));
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
                'previsao_chegada' => $lista['previsao_chegada']
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
                'status' => $lista['status']
            );
            $i++;
        }
    }
}
