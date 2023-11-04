<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\VendaDAO;
use App\Models\Entidades\Vendas;
use App\Models\Validacao\VendaValidador;
use App\Models\DAO\ClienteDAO;
use App\Models\Entidades\Clientes;

class VendaController extends Controller
{
    public function index()
    {
        if (!$this->auth()) $this->redirect('/login/index');

        $vendaDAO = new VendaDAO();

        $listaVendas = $vendaDAO->listar();

        self::setViewParam('listaVendas', $listaVendas);

        $this->render('/venda/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {
        $clienteDAO = new ClienteDAO();

        $clientes = $clienteDAO->listar();
        
        self::setViewParam('listaClientes', $clientes);

        $this->render('/venda/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $venda = new Vendas();
        $venda->getClientes()->setId($_POST['idclientes']);
        $venda->setValor($_POST['valor']);

        Sessao::gravaFormulario($_POST);

        $vendaValidador = new VendaValidador();
        $resultadoValidacao = $vendaValidador->validar($venda);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/venda/cadastro');
        }

        try { 

            $vendaDAO = new VendaDAO();
            $vendaDAO->salvar($venda);

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/venda');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Venda adicionada com sucesso!");

        $this->redirect('/venda');
    }

    public function edicao($params)
    {
        $id = $params[0];

        $vendaDAO = new VendaDAO();
        $clienteDAO = new ClienteDAO();

        $venda = $vendaDAO->getById($id);
        $clientes = $clienteDAO->listar();

        if(!$venda){
            Sessao::gravaErro("Venda (id:{$id}) inexistente.");
            $this->redirect('/venda');
        }

        self::setViewParam('venda',$venda);
        self::setViewParam('listaClientes', $clientes);

        $this->render('/venda/editar');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function atualizar()
    {
        $venda = new Vendas();
        $venda->setId($_POST['id']);
        $venda->getClientes()->setId($_POST['idclientes']);
        $venda->setvalor($_POST['valor']);

        Sessao::gravaFormulario($_POST);

        $vendaValidador = new VendaValidador();
        $resultadoValidacao = $vendaValidador->validar($venda);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/venda/edicao/'.$_POST['id']);
        }

        try {

            $vendaDAO = new VendaDAO();
            $vendaDAO->atualizar($venda);

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/venda');            
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Venda atualizado com sucesso!");

        $this->redirect('/venda');
    }

    public function exclusao($params)
    {
        $id = $params[0];

        $vendaDAO = new VendaDAO();

        $venda = $vendaDAO->getById($id);

        if(!$venda){
            Sessao::gravaMensagem("Venda (id:{$id}) inexistente.");
            $this->redirect('/venda');
        }

        self::setViewParam('venda',$venda);

        $this->render('/venda/exclusao');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function excluir()
    {
        $venda = new Vendas();
        $venda->setId($_POST['id']);
        //$venda->setNome($_POST['nome']);

        $vendaDAO = new VendaDAO();

        if ($totalProdutos = $vendaDAO->getQuantidadeProdutos($_POST['id'])){
            if ($totalProdutos == 1) {
                Sessao::gravaMensagem("A venda nº'{$venda->getId()}' não pode ser excluída pois existe 1 produto vinculado a ela.");
            }else{
                Sessao::gravaMensagem("A venda nº'{$venda->getId()}' não pode ser excluída pois existem {$totalProdutos} produtos vinculados a ela.");
            }
            $this->redirect('/venda');
        }

        try {

            if (!$vendaDAO->excluir($venda->getId())){
                Sessao::gravaMensagem("Venda (id:{$venda->getId()}) inexistente.");
                $this->redirect('/venda');
            }

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/venda');            
        }        

        Sessao::gravaMensagem("Venda '{$venda->getId()}' excluida com sucesso!");

        $this->redirect('/venda');
    }
}