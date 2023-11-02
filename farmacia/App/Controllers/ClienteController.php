<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ClienteDAO;
use App\Models\Entidades\Clientes;
use App\Models\Validacao\ClienteValidador;

class ClienteController extends Controller
{
    public function index()
    {
        if (!$this->auth()) $this->redirect('/login/index');

        $clienteDAO = new ClienteDAO();

        self::setViewParam('listaClientes', $clienteDAO->listar());

        $this->render('/cliente/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {
        $this->render('/cliente/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $cliente = new Clientes();
        $cliente->setNome($_POST['nome']);
        $cliente->setCelular($_POST['celular']);
        $cliente->setEmail($_POST['email']);

        Sessao::gravaFormulario($_POST);

        $clienteValidador = new ClienteValidador();
        $resultadoValidacao = $clienteValidador->validar($cliente);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/cliente/cadastro');
        }

        try { 

            $clienteDAO = new ClienteDAO();
            $clienteDAO->salvar($cliente);

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/cliente');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Cliente adicionado com sucesso!");

        $this->redirect('/cliente');
    }

    public function edicao($params)
    {
        $id = $params[0];

        $clienteDAO = new ClienteDAO();

        $cliente = $clienteDAO->getById($id);

        if(!$cliente){
            Sessao::gravaErro("Cliente (id:{$id}) inexistente.");
            $this->redirect('/cliente');
        }

        self::setViewParam('cliente',$cliente);

        $this->render('/cliente/editar');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function atualizar()
    {
        $cliente = new Clientes();
        $cliente->setId($_POST['id']);
        $cliente->setNome($_POST['nome']);
        $cliente->setCelular($_POST['celular']);
        $cliente->setEmail($_POST['email']);

        Sessao::gravaFormulario($_POST);

        $clienteValidador = new ClienteValidador();
        $resultadoValidacao = $clienteValidador->validar($cliente);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/cliente/edicao/'.$_POST['id']);
        }

        try {

            $clienteDAO = new ClienteDAO();
            $clienteDAO->atualizar($cliente);

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/cliente');            
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Cliente atualizado com sucesso!");

        $this->redirect('/cliente');
    }

    public function exclusao($params)
    {
        $id = $params[0];

        $clienteDAO = new ClienteDAO();

        $cliente = $clienteDAO->getById($id);

        if(!$cliente){
            Sessao::gravaMensagem("Cliente (id:{$id}) inexistente.");
            $this->redirect('/cliente');
        }

        self::setViewParam('cliente',$cliente);

        $this->render('/cliente/exclusao');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function excluir()
    {
        $cliente = new Clientes();
        $cliente->setId($_POST['id']);
        $cliente->setNome($_POST['nome']);

        $clienteDAO = new ClienteDAO();

        if ($totalProdutos = $clienteDAO->getQuantidadeVendas($_POST['id'])){
            if ($totalProdutos == 1) {
                Sessao::gravaMensagem("O Cliente '{$cliente->getNome()}' não pode ser excluído pois existe 1 produto vinculado a ele.");
            }else{
                Sessao::gravaMensagem("O Cliente '{$cliente->getNome()}' não pode ser excluído pois existem {$totalProdutos} produtos vinculados a ele.");
            }
            $this->redirect('/cliente');
        }

        try {

            if (!$clienteDAO->excluir($cliente->getId())){
                Sessao::gravaMensagem("Cliente (id:{$cliente->getId()}) inexistente.");
                $this->redirect('/cliente');
            }

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/cliente');            
        }        

        Sessao::gravaMensagem("Cliente '{$cliente->getNome()}' excluido com sucesso!");

        $this->redirect('/cliente');
    }
}