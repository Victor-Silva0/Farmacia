<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ProdutosVendaDAO;


class ProdutoVendaController extends Controller
{
    public function index()
    {
        if (!$this->auth()) $this->redirect('/login');

        $produtosVendaDAO = new ProdutosVendaDAO();



        $this->render('/produto_venda/index');

        Sessao::limpaErro();
        Sessao::limpaMensagem();

    }

    public function cadastro()
    {

    }

    public function salvar()
    {

    }

    public function edicao($params)
    {

    }

    public function atualizar()
    {

    }

    public function exclusao($params)
    {

    }

    public function excluir()
    {

    }
}

