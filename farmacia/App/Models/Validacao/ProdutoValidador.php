<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Produto;

class ProdutoValidador{

    public function validar(Produto $produto)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($produto->getNome()))
        {
            $resultadoValidacao->addErro('nome',"Nome: Este campo não pode ser vazio");
        }

        if(empty($produto->getValor()))
        {
            $resultadoValidacao->addErro('valor',"Valor: Este campo não pode ser vazio");
        }

        if(empty($produto->getConteudo()))
        {
            $resultadoValidacao->addErro('conteudo',"Conteudo: Este campo não pode ser vazio");
        }

        if(empty($produto->getMarca()))
        {
            $resultadoValidacao->addErro('marca',"Marca: Este campo não pode ser vazio");
        }

        return $resultadoValidacao;
    }
}