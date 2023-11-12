<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ProdutosVendaDAO;
use App\Models\Entidades\Vendas;


class ProdutoVendaController extends Controller
{
    public function index()
    {
        if (!$this->auth()) $this->redirect('/login/index');

        $produtosVendaDAO = new ProdutosVendaDAO();

        $listaprodutosVenda = $produtosVendaDAO->listar();
        
        self::setViewParam('listaProdutoVenda', $listaprodutosVenda);

        $this->render('/produto_venda/index');


        Sessao::limpaErro();
        Sessao::limpaMensagem();
    }

}
