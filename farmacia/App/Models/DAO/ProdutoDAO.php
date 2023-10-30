<?php

namespace App\Models\DAO;

use App\Models\Entidades\Produto;


class ProdutoDAO extends BaseDAO 
{
    public function getById ($id)
    {
        $resultado = $this->select("SELECT * FROM produtos WHERE idProduto = $id
        "
    );

    $dataSetProdutos = $resultado->fetch();

        if($dataSetProdutos) {
            $produto = new Produto();
                $produto->setId($dataSetProdutos['idProduto']);
                $produto->setNome($dataSetProdutos['nome']);
                $produto->setMarca($dataSetProdutos['marca']);
                $produto->setConteudo($dataSetProdutos['conteudo']);
                $produto->setValor($dataSetProdutos['valor']);                        
                $produto->setImagem($dataSetProdutos['imagem']);

            return $produto;
        }

        return false;
    }

    public function listar ()
    {
        $resultado = $this->select("SELECT * FROM produtos");

        return $resultado->fetchAll(\PDO::FETCH_CLASS, Produto::class);
    }

    public function listarPaginacao($busca = null, $totalPorPagina = 6, $paginaSelecionada = 1)
    {
        $inicio = (($paginaSelecionada - 1) * $totalPorPagina);
        $busca = trim($busca);
        $whereBusca = ''; 
    
        if (!empty($busca)) {
            $whereBusca = "WHERE nome LIKE '%$busca%' OR marca LIKE '%$busca%'";
        }

        $resultadoTotal = $this->select(
            "SELECT count(*) as total 
                FROM produtos
                {$whereBusca}"
        );

        $resultado = $this->select(
            "SELECT *
                FROM produtos
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
                $produto->setNome($dataSetProduto['nome']);
                $produto->setMarca($dataSetProduto['marca']);
                $produto->setConteudo($dataSetProduto['conteudo']);
                $produto->setValor($dataSetProduto['valor']);                        
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

            $nome = $produto->getNome();
            $marca = $produto->getMarca();
            $conteudo = $produto->getConteudo();
            $valor = $produto->getValor();
            $imagem = $produto->getImagem();

            return $this->insert('produtos',
            ":nome,:marca,:conteudo,:valor,:imagem",
            [
                ':nome'         =>$nome,
                ':marca'        =>$marca,
                ':conteudo'   =>$conteudo,
                ':valor'    =>$valor,
                ':imagem' =>$imagem
            ]
        );
            
        }catch (\Exception $e) {
            throw new \Exception("Erro na gravação dos dados. " . $e->getMessage(), 500);
        }
    }

    public function atualizar(Produto $produto)
    {
        try {

            $id = $produto->getId();
            $nome = $produto->getNome();
            $marca = $produto->getMarca();
            $conteudo = $produto->getConteudo();
            $valor = $produto->getValor();
            $imagem = $produto->getImagem();

            return $this->update(
            'produtos',
            "nome = :nome, marca = :marca, conteudo = :conteudo, valor = :valor, imagem = :imagem",
            [
                ':idProduto'     =>$id,
                ':nome'         =>$nome,
                ':marca'        =>$marca,
                ':conteudo'   =>$conteudo,
                ':valor'    =>$valor,
                ':imagem' =>$imagem
            ],
            "idProduto = :idProduto"
        );
            
        } catch (\Exception $e) {
            throw new \Exception("Erro na atualização dos dados. " . $e->getMessage(), 500);
        }
    }

    public  function atualizarImagem(Produto $produto)
    {
        try {

            $id             = $produto->getId();
            $imagem         = $produto->getImagem();

            return $this->update(
                'produtos',
                "imagem= :imagem",
                [
                    ':idProduto'           =>$id,
                    ':imagem'       =>$imagem
                ],
                "idProduto = :idProduto"
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
        }
    }

    public function excluir(Produto $produto)
    {
        try {

            $id = $produto->getId();
            $file = 'public/images/'.$produto->getImagem();

            if (file_exists($file)) unlink($file);

            return $this->delete('produtos',"idProduto = $id");

        }catch (\Exception $e){
            throw new \Exception("Erro ao deletar" . $e->getMessage(), 500);
        }
    }

}