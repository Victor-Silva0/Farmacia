<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Vendas;

class VendaValidador{

    public function validar(Vendas $venda)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($venda->getValor()))
        {
            $resultadoValidacao->addErro('valor',"Valor: Este campo não pode ser vazio");
        }

        return $resultadoValidacao;
    }
}