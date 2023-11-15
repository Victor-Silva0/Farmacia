<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ProdutosVendaDAO;
use App\Models\Entidades\ProdutosVenda;

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

    public function cadastro()
    {
        $this->render('/produto_venda/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $produto = new ProdutosVenda();
        $produto->setProduto($_POST['idproduto']);
        $produto->setVendas($_POST['idvenda']);
        $produto->setQuantidade($_POST['quantidade']);


        Sessao::gravaFormulario($_POST);

        //$produtoValidador = new ProdutoValidador();
        //$resultadoValidacao = $produtoValidador->validar($produto);

        //if ($resultadoValidacao->getErros()) {
        //    Sessao::gravaErro($resultadoValidacao->getErros());
        //    $this->redirect('/produto/cadastro');
        //}

        try {

            $produtosVendaDAO = new ProdutosVendaDAO(); 
            $lastId = $produtosVendaDAO->salvar($produto);
            $produto->setId($lastId);

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/produto_venda');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Produto adicionado com sucesso!");
        
        $this->redirect('/produto');
    }

}
