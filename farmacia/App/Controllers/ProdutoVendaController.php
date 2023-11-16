<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ProdutoDAO;
use App\Models\DAO\ProdutosVendaDAO;
use App\Models\Entidades\ProdutosVenda;

class ProdutoVendaController extends Controller
{
    public function index($params)
    {
        $id = $params[0];

        if (!$this->auth()) $this->redirect('/login/index');

        $produtosVendaDAO = new ProdutosVendaDAO();

        $listaprodutosVenda = $produtosVendaDAO->listar($id);
        
        self::setViewParam('listaProdutoVenda', $listaprodutosVenda);
        self::setViewParam('idvenda', $id);

        $this->render('/produto_venda/index');


        Sessao::limpaErro();
        Sessao::limpaMensagem();
    }

    public function cadastro($params)
    {
        $produtoDAO = new ProdutoDAO();

        $listaProdutos = $produtoDAO->listar();
        
        self::setViewParam('listaProdutos', $listaProdutos);

        self::setViewParam('idvenda', $params[0]);
        
        $this->render('/produto_venda/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $produto = new ProdutosVenda();
        $produto->getProduto()->setId($_POST['idproduto']);
        $produto->getVendas()->setId($_POST['idvenda']);
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

        Sessao::gravaMensagem("Produto adicionado à venda com sucesso!");
        
        $this->redirect('/produto_venda/index/' . $produto->getVendas()->getId());
    }

    public function edicao($params)
    {
        $id = $params[0];

        $ProdutosVendaDAO = new ProdutosVendaDAO();
        $produtoDAO = new ProdutoDAO();

        $ProdutosVendaDAO = $ProdutosVendaDAO->getById($id);
        $produtos = $produtoDAO->listar();

        if(!$ProdutosVendaDAO){
            Sessao::gravaErro("Venda (id:{$id}) inexistente.");
            $this->redirect('/produto_venda');
        }

        self::setViewParam('listaProdutos', $produtos);
        self::setViewParam('produtoVenda', $ProdutosVendaDAO);

        $this->render('/produto_venda/editar');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function atualizar()
    {
        $ProdutosVenda = new ProdutosVenda();
        $ProdutosVenda->setId($_POST['id']);
        $ProdutosVenda->getProduto()->setId($_POST['idproduto']);
        $ProdutosVenda->setQuantidade($_POST['quantidade']);
        $ProdutosVenda->getVendas()->setId($_POST['idvenda']);


        Sessao::gravaFormulario($_POST);

       /* $ProdutosVendaDAOValidador = new VendaValidador();
        $resultadoValidacao = $ProdutosVendaDAOValidador->validar($ProdutosVendaDAO);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/venda/edicao/'.$_POST['id']);
        } */

        
        try {

            $ProdutosVendaDAO = new ProdutosVendaDAO();
            $ProdutosVendaDAO->atualizar($ProdutosVenda);

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/produto_venda/index/' . $ProdutosVenda->getVendas()->getId());            
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Produto da venda atualizado com sucesso!");

        $this->redirect('/produto_venda/index/' . $ProdutosVenda->getVendas()->getId());
    }

    public function exclusao($params)
    {
        $id = $params[0];

        $ProdutosVendaDAO = new ProdutosVendaDAO();

        $ProdutosVendaDAO = $ProdutosVendaDAO->getById($id);

        if(!$ProdutosVendaDAO){
            Sessao::gravaMensagem("Produto da Venda (id:{$id}) inexistente.");
            $this->redirect('/produto_venda');
        }

        self::setViewParam('produtoVenda',$ProdutosVendaDAO);

        $this->render('/produto_venda/exclusao');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function excluir()
    {
        $ProdutosVenda = new ProdutosVenda();
        $ProdutosVenda->setId($_POST['id']);
        $ProdutosVenda->getVendas()->setId($_POST['idvenda']);
        //$ProdutosVendaDAO->setNome($_POST['nome']);

        $ProdutosVendaDAO = new ProdutosVendaDAO();

        try {

            if (!$ProdutosVendaDAO->excluir($ProdutosVenda->getId())){
                Sessao::gravaMensagem("Produto da venda (id:{$ProdutosVenda->getId()}) inexistente.");
            }

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/produto_venda/index/' . $ProdutosVenda->getVendas()->getId());            
        }        

        Sessao::gravaMensagem("Produto da venda '{$ProdutosVenda->getId()}' excluído com sucesso!");

        $this->redirect('/produto_venda/index/' . $ProdutosVenda->getVendas()->getId());
    }
}
