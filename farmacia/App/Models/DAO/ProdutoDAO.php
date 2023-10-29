<?php

namespace App\Models\DAO;

use App\Models\Entidades\Produto; 

class ProdutoDAO extends BaseDAO
{
    public function getById($id)
    {
        $resultado = $this->select(
            "SELECT id, nome, marca, conteudo, valor, linkImagem FROM produtos WHERE idProduto = $id"
        );

        $dataSetProduto = $resultado->fetch();

        if ($dataSetProduto) {
            $produto = new Produto();
            $produto->setId($dataSetProduto['idProduto']);
            $produto->setNome($dataSetProduto['nome']);
            $produto->setMarca($dataSetProduto['marca']);
            $produto->setConteudo($dataSetProduto['conteudo']);
            $produto->setPreco($dataSetProduto['valor']);
            $produto->setImagem($dataSetProduto['linkImagem']);

            return $produto;
        }

        return false;
    }

    public function listar()
    {
        $resultado = $this->select("SELECT * FROM produto");

        return $resultado->fetchAll(\PDO::FETCH_CLASS, Produto::class);
    }


    public function salvar(Produto $produto)
    {
        try {
            $nome = $produto->getNome();
            $marca = $produto->getMarca();
            $conteudo = $produto->getConteudo();
            $preco = $produto->getPreco();
            $imagem = $produto->getImagem();

            return $this->insert(
                'produtos',
                "nome, marca, conteudo, valor, linkImagem",
                [
                    ':nome' => $nome,
                    ':marca' => $marca,
                    ':conteudo' => $conteudo,
                    ':valor' => $preco,
                    ':linkImagem' => $imagem,
                ]
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
        }
    }

    public  function atualizar(Produto $produto)
    {
        try {
            $id = $produto->getId();
            $nome = $produto->getNome();
            $marca = $produto->getMarca();
            $conteudo = $produto->getConteudo();
            $preco = $produto->getPreco();
            $imagem = $produto->getImagem();

            return $this->update(
                'produtos',
                "nome = :nome, marca = :marca, conteudo = :conteudo, valor = :valor, linkImagem = :linkImagem",
                [
                    ':idProduto' => $id,
                    ':nome' => $nome,
                    ':marca' => $marca,
                    ':conteudo' => $conteudo,
                    ':valor' => $preco,
                    ':linkImagem' => $imagem,
                ],
                "idProduto = :idProduto"
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na atualização dos dados." . $e->getMessage(), 500);
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
            throw new \Exception("Erro na atualização dos dados." . $e->getMessage(), 500);
        }
    }

    public function excluir(int $id)
    {
        try {
            return $this->delete('produtos', "idProduto = $id");
        } catch (\Exception $e) {
            throw new \Exception("Erro ao excluir o produto" . $e->getMessage(), 500);
        }
    }
}