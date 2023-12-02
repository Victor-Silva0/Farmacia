<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Clientes;

class ClienteValidador{

    public function validar(Clientes $cliente)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($cliente->getNome()))
        {
            $resultadoValidacao->addErro('nome',"Nome: Este campo não pode ser vazio");
        }

        return $resultadoValidacao;
    }
}