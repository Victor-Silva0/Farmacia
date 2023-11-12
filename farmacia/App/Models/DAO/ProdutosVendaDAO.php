<?php

namespace App\Models\DAO;

use App\Models\Entidades\ProdutosVenda;


class ProdutosVendaDAO extends BaseDAO
{
    public function getByVendaId($vendaId)
    {
        $sql = "SELECT * FROM produtos_da_venda WHERE idVenda = $vendaId";
        $resultado = $this->select($sql);
        return $resultado->fetchAll(\PDO::FETCH_CLASS, ProdutosVenda::class);
    }

    public function listar ()
    {
        $resultado = $this->select("SELECT * FROM produtos_da_venda WHERE idVenda = 3"); //aqui eu forcei o ID para testar

        return $resultado->fetchAll(\PDO::FETCH_CLASS, ProdutosVenda::class);
    }

    public function salvar(ProdutosVenda $produtosVenda)
    {
        try {
            $idVenda = $produtosVenda->getVendas()->getId();
            $idProduto = $produtosVenda->getProduto()->getId();

            return $this->insert(
                'produtos_da_venda',
                'idVenda, idProduto, quantidade',
                [':idVenda' => $idVenda, ':idProduto' => $idProduto]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
        }
    }

    public function excluir($vendaId, $produtoId)
    {
        $sql = "DELETE FROM produtos_da_venda WHERE idVenda = $vendaId AND idProduto = $produtoId";
        return $this->delete('produtos_da_venda', "idVenda = $vendaId AND idProduto = $produtoId");
    }
}
