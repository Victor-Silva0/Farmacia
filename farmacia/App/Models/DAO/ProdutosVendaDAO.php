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


    public function listar($id)
    {
        $resultado = $this->select("SELECT 
          pv.*
        , p.nome as nomeProd
        , p.idProduto as idProd
        , p.valor as valorProd
        FROM produtos_da_venda pv, produtos p WHERE pv.idProduto = p.idProduto AND idVenda = $id");

        $dataSetVendas = $resultado->fetchAll();

        $listapVendas = [];
        
        if($dataSetVendas) {

            foreach($dataSetVendas as $dataSetVenda) :
                
                $pvenda = new ProdutosVenda();
                $pvenda->setId($dataSetVenda['id']);
                $pvenda->getProduto()->setId($dataSetVenda['idProd']);
                $pvenda->getProduto()->setNome($dataSetVenda['nomeProd']);
                $pvenda->getProduto()->setValor($dataSetVenda['valorProd']);
                $pvenda->setQuantidade($dataSetVenda['quantidade']);
                $listapVendas[] = $pvenda;
                
            endforeach;
        }

        return $listapVendas;
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
