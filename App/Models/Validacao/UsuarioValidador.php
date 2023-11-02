<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Usuario;

class UsuarioValidador{

    public function validar(Usuario $usuario)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($usuario->getNome()))
        {
            $resultadoValidacao->addErro('nome',"Nome: Este campo não pode ser vazio.");
        }

        if(empty($usuario->getEmail()))
        {
            $resultadoValidacao->addErro('email',"E-Mail: Este campo não pode ser vazio.");
        }

        if(empty($usuario->getUsername()))
        {
            $resultadoValidacao->addErro('username',"Usuário: Este campo não pode ser vazio");
        }

        if(empty($usuario->getPassword()))
        {
            $resultadoValidacao->addErro('password',"Senha: Este campo não pode ser vazio");
        }

        return $resultadoValidacao;
    }
}