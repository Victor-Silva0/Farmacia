<?php

namespace App\Models\DAO;

use App\Models\Entidades\Produto; 

class ProdutoDAO extends BaseDAO
{
    public  function getById($id)
    {
        $resultado = $this->select(
            "SELECT p.id as idProduto,
                    p.nome as nomeProduto,
                    p.preco,
                    p.quantidade,
                    p.descricao,
                    f.id as idFornecedor,
                    f.nome as nomeFornecedor,
                    p.imagem
                FROM produto as p INNER JOIN fornecedor as f ON p.idfornecedor = f.id
                WHERE p.id = $id
            "
        );

        $dataSetProdutos = $resultado->fetch();

        if($dataSetProdutos) {
            $produto = new Produto();
            $produto->setId($dataSetProdutos['idProduto']);
            $produto->setNome($dataSetProdutos['nomeProduto']);
            $produto->setPreco($dataSetProdutos['preco']);
            $produto->setQuantidade($dataSetProdutos['quantidade']);
            $produto->setDescricao($dataSetProdutos['descricao']);
            $produto->getFornecedor()->setId($dataSetProdutos['idFornecedor']);
            $produto->getFornecedor()->setNome($dataSetProdutos['nomeFornecedor']);
            $produto->setImagem($dataSetProdutos['imagem']);

            return $produto;
        }

        return false;
    }

    public function listar()
    {
        $resultado = $this->select("SELECT * FROM produto");

        return $resultado->fetchAll(\PDO::FETCH_CLASS, Produto::class);
    }

    public function listarPaginacao($busca = null, $totalPorPagina = 6, $paginaSelecionada = 1)
    {
        $inicio     = (($paginaSelecionada - 1) * $totalPorPagina);
        $whereBusca = ($busca) ? "AND (p.nome LIKE '%$busca%' OR p.descricao LIKE '%$busca%')" : '';

        $resultadoTotal = $this->select(
            "SELECT count(*) as total 
                FROM produto as p, fornecedor as f 
                WHERE p.idfornecedor = f.id
                {$whereBusca}"
        );

        $resultado = $this->select(
            "SELECT p.id as idProduto,
                    p.nome as nomeProduto,
                    p.preco,
                    p.quantidade,
                    p.descricao,
                    p.dataCadastro,
                    f.id as idFornecedor,
                    f.nome as nomeFornecedor,
                    p.imagem
                FROM produto as p, fornecedor as f
                WHERE p.idfornecedor = f.id
                {$whereBusca} 
                LIMIT {$inicio}, {$totalPorPagina}"
        );

        $dataSetProdutos    = $resultado->fetchAll();
        $totalLinhas        = $resultadoTotal->fetch()['total'];
        $listaProdutos      = [];

        if($dataSetProdutos) {

            foreach($dataSetProdutos as $dataSetProduto) {
                
                $produto = new Produto();
                $produto->setId($dataSetProduto['idProduto']);
                $produto->setNome($dataSetProduto['nomeProduto']);
                $produto->setPreco($dataSetProduto['preco']);
                $produto->setQuantidade($dataSetProduto['quantidade']);
                $produto->setDescricao($dataSetProduto['descricao']);
                $produto->setDataCadastro($dataSetProduto['dataCadastro']);                        
                $produto->getFornecedor()->setId($dataSetProduto['idFornecedor']);
                $produto->getFornecedor()->setNome($dataSetProduto['nomeFornecedor']);
                $produto->setImagem($dataSetProduto['imagem']);

                $listaProdutos[] = $produto;
            }
            
        }

        return ['paginaSelecionada' => $paginaSelecionada,
                'totalPorPagina'    => $totalPorPagina,
                'totalLinhas'       => $totalLinhas,
                'resultado'         => $listaProdutos];
    }

    public function salvar(Produto $produto)
    {
        try {

            $nome           = $produto->getNome();
            $preco          = $produto->getPreco();
            $quantidade     = $produto->getQuantidade();
            $descricao      = $produto->getDescricao();
            $idfornecedor   = $produto->getFornecedor()->getId();
            $imagem         = $produto->getImagem();

            return $this->insert(
                'produto',
                ":nome,:preco,:quantidade,:descricao,:idfornecedor,:imagem",
                [
                    ':nome'         =>$nome,
                    ':preco'        =>$preco,
                    ':quantidade'   =>$quantidade,
                    ':descricao'    =>$descricao,
                    ':idfornecedor' =>$idfornecedor,
                    ':imagem'       =>$imagem
                ]
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
        }
    }

    public  function atualizar(Produto $produto)
    {
        try {

            $id             = $produto->getId();
            $nome           = $produto->getNome();
            $preco          = $produto->getPreco();
            $quantidade     = $produto->getQuantidade();
            $descricao      = $produto->getDescricao();
            $idfornecedor   = $produto->getFornecedor()->getId();
            $imagem         = $produto->getImagem();

            return $this->update(
                'produto',
                "nome = :nome, preco = :preco, quantidade = :quantidade, descricao = :descricao, idfornecedor= :idfornecedor, imagem= :imagem",
                [
                    ':id'           =>$id,
                    ':nome'         =>$nome,
                    ':preco'        =>$preco,
                    ':quantidade'   =>$quantidade,
                    ':descricao'    =>$descricao,
                    ':idfornecedor' =>$idfornecedor,
                    ':imagem'       =>$imagem
                ],
                "id = :id"
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
        }
    }

    public  function atualizarImagem(Produto $produto)
    {
        try {

            $id             = $produto->getId();
            $imagem         = $produto->getImagem();

            return $this->update(
                'produto',
                "imagem= :imagem",
                [
                    ':id'           =>$id,
                    ':imagem'       =>$imagem
                ],
                "id = :id"
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
        }
    }

    public function excluir(Produto $produto)
    {
        try {

            $id = $produto->getId();
            $file = 'public/images/produtos/'.$produto->getImagem();

            if (file_exists($file)) unlink($file);

            return $this->delete('produto',"id = $id");

        }catch (\Exception $e){
            throw new \Exception("Erro ao deletar" . $e->getMessage(), 500);
        }
    }
}