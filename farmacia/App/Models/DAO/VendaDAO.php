<?php

namespace App\Models\DAO;

use App\Models\Entidades\Vendas;

class VendaDAO extends BaseDAO
{
    public function getById($id)
    {
        $resultado = $this->select("SELECT * FROM vendas WHERE idVenda = $id");

        $dataSetVenda = $resultado->fetch();

        if($dataSetVenda) {
            $venda = new Vendas();
            $venda->setId($dataSetVenda['idVenda']);
            $venda->getClientes()->setId($dataSetVenda['idCliente']);
            $venda->setDhVenda($dataSetVenda['dhVenda']);
            $venda->setValor($dataSetVenda['valor']);

            return $venda;
        }

        return false;
    }

    public function listar()
    {
        $resultado = $this->select("SELECT * FROM vendas");

        $dataSetVendas = $resultado->fetchAll();

        $listaVendas = [];
        
        if($dataSetVendas) {

            foreach($dataSetVendas as $dataSetVenda) :

                $idCliente = $dataSetVenda['idCliente'];
                $resultado_cliente = $this->select("SELECT * FROM clientes WHERE idCliente  = $idCliente");
                $dataSetCliente = $resultado_cliente->fetch();

                if ($dataSetCliente) {

                    
                    $venda = new Vendas();
                    $venda->setId($dataSetVenda['idVenda']);
                    $venda->setDhVenda($dataSetVenda['dhVenda']);
                    $venda->setValor($dataSetVenda['valor']);
                    $venda->getClientes()->setNome($dataSetCliente['nome']);
                    $listaVendas[] = $venda;
                }
            endforeach;
        }

        return $listaVendas;
    }

    public function salvar(Vendas $venda)
    {
        try {
            $idCliente = $venda->getClientes()->getId();
            $valor = $venda->getValor();

            return $this->insert(
                'vendas',
                ':idCliente, :valor',
                [
                    ':idCliente' => $idCliente,
                    ':valor' => $valor,
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
        }
    }

    public function atualizar(Vendas $venda)
    {
        try {
            $id = $venda->getId();
            $idCliente = $venda->getClientes()->getId();
            $valor = $venda->getValor();

            return $this->update(
                'vendas',
                'idCliente = :idCliente, valor = :valor',
                [
                    ':idVenda' => $id,
                    ':idCliente' => $idCliente,
                    ':valor' => $valor,
                ],
                'idVenda = :idVenda'
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na atualização dos dados." . $e->getMessage(), 500);
        }
    }

    public function excluir($id)
    {
        try {
            return $this->delete('vendas', "idVenda = $id");
        } catch (\Exception $e) {
            throw new \Exception("Erro ao excluir a venda" . $e->getMessage(), 500);
        }
    }

    public function getQuantidadeProdutos($id)
    {
        if ($id) {
            $resultado = $this->select("SELECT count(*) as total FROM produtos_da_venda WHERE idVenda = $id");

            return $resultado->fetch()['total'];
        }

        return false;
    }

}
