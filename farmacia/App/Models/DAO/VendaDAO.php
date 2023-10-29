<?php

namespace App\Models\DAO;

use App\Models\Entidades\Vendas;

class VendaDAO extends BaseDAO
{
    public function getById($id)
    {
        $resultado = $this->select("SELECT * FROM vendas WHERE id = $id");

        return $resultado->fetchObject(Vendas::class);
    }

    public function listar()
    {
        $resultado = $this->select("SELECT * FROM vendas");

        return $resultado->fetchAll(\PDO::FETCH_CLASS, Vendas::class);
    }

    public function salvar(Vendas $venda)
    {
        try {
            $idCliente = $venda->getClientes()->getId();
            $dhVenda = $venda->getDhVenda()->format('Y-m-d H:i:s');
            $valor = $venda->getValor();

            return $this->insert(
                'vendas',
                'id_cliente, dh_venda, valor',
                [
                    ':id_cliente' => $idCliente,
                    ':dh_venda' => $dhVenda,
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
            $dhVenda = $venda->getDhVenda()->format('Y-m-d H:i:s');
            $valor = $venda->getValor();

            return $this->update(
                'vendas',
                'id_cliente = :id_cliente, dh_venda = :dh_venda, valor = :valor',
                [
                    ':id' => $id,
                    ':id_cliente' => $idCliente,
                    ':dh_venda' => $dhVenda,
                    ':valor' => $valor,
                ],
                'id = :id'
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na atualização dos dados." . $e->getMessage(), 500);
        }
    }

    public function excluir($id)
    {
        try {
            return $this->delete('vendas', "id = $id");
        } catch (\Exception $e) {
            throw new \Exception("Erro ao excluir a venda" . $e->getMessage(), 500);
        }
    }
}
