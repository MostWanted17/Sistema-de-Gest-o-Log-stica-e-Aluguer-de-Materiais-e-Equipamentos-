<?php
class Viagem extends Conexao
{
    function getViagem()
    {
        $query = "SELECT v.id_viagem,c.matricula,m.nome as motorista,ca.descricao as carga, v.origem,v.destino,v.descricao,v.peso_carga,v.valor_carga,v.data_saida,v.previsao_chegada,v.status FROM `viagem` v inner join carros c on c.id_carro=v.id_carro inner join cargas ca on ca.id_carga = v.id_carga inner join motorista m on m.id_motorista=v.id_motorista where v.deleted<>1 and v.accepted<>0;";
        $this->ExecuteSQL($query);
        $resultados = $this->ListarTodosDados();
        $this->GetLista();
        return $resultados;
    }
    function removeViagem($id_viagem)
    {
        $query = "UPDATE viagem SET deleted=1 WHERE id_viagem=?;
        Update carros set `status`='disponível' where id_carro=(SELECT id_carro FROM viagem WHERE id_viagem=?);
        Update motorista set `status`='disponível' where id_motorista=(SELECT id_motorista FROM viagem WHERE id_viagem=?)";
        $this->ExecuteSQL($query, array($id_viagem,$id_viagem,$id_viagem));
    }
    function accepteViagem($id_viagem)
    {
        $query = "UPDATE viagem SET `status`=`a caminho` WHERE id_viagem=?;";
        $this->ExecuteSQL($query, array($id_viagem));
    }
    function editViagem($id_viagem, $descricao)
    {
        $query = "UPDATE `viagem` SET `descricao` = ? WHERE `id_viagem` = ?;";
        $this->ExecuteSQL($query, array($descricao,$id_viagem));
    }
    function finishedViagem($id_viagem)
    {
        $query = "UPDATE viagem SET `status`='concluido' WHERE id_viagem=?;
        Update carros set `status`='disponível' where id_carro=(SELECT id_carro FROM viagem WHERE id_viagem=?);
        Update motorista set `status`='disponível' where id_motorista=(SELECT id_motorista FROM viagem WHERE id_viagem=?)";
        $this->ExecuteSQL($query, array($id_viagem,$id_viagem,$id_viagem));
    }
    function addViagem($id_carro,$id_motorista,$id_carga,$descricao,$peso_carga,$valor_carga,$data_saida,$previsao_chegada,$origem,$destino)
    {
        $query = "INSERT INTO viagem (id_carro,id_carga,id_motorista,origem,destino,descricao,peso_carga,valor_carga,data_saida,previsao_chegada) VALUES (?,?,?,?,?,?,?,?,?,?);
        Update carros set `status`='indisponível' where id_carro=?;
        Update motorista set `status`='indisponível' where id_motorista=?";
        $this->ExecuteSQL($query, array($id_carro,$id_carga,$id_motorista,$origem,$destino,$descricao,$peso_carga,$valor_carga,$data_saida,$previsao_chegada,$id_carro,$id_motorista));
    }
    private function GetLista()
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
                'previsao_chegada' => $lista['previsao_chegada'],
                'status' => $lista['status']
            );
            $i++;
        }
    }
}
