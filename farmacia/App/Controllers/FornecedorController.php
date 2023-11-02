<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\FornecedorDAO;
use App\Models\Entidades\Fornecedor;
use App\Models\Validacao\FornecedorValidador;

class FornecedorController extends Controller
{
    public function index()
    {
        if (!$this->auth()) $this->redirect('/login/index');

        $fornecedorDAO = new FornecedorDAO();

        self::setViewParam('listaFornecedores', $fornecedorDAO->listar());

        $this->render('/fornecedor/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {
        $this->render('/fornecedor/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $fornecedor = new Fornecedor();
        $fornecedor->setNome($_POST['nome']);

        Sessao::gravaFormulario($_POST);

        $fornecedorValidador = new FornecedorValidador();
        $resultadoValidacao = $fornecedorValidador->validar($fornecedor);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/fornecedor/cadastro');
        }

        try { 

            $fornecedorDAO = new FornecedorDAO();
            $fornecedorDAO->salvar($fornecedor);

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/fornecedor');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Fornecedor adicionado com sucesso!");

        $this->redirect('/fornecedor');
    }

    public function edicao($params)
    {
        $id = $params[0];

        $fornecedorDAO = new FornecedorDAO();

        $fornecedor = $fornecedorDAO->getById($id);

        if(!$fornecedor){
            Sessao::gravaErro("Fornecedor (id:{$id}) inexistente.");
            $this->redirect('/fornecedor');
        }

        self::setViewParam('fornecedor',$fornecedor);

        $this->render('/fornecedor/editar');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function atualizar()
    {
        $fornecedor = new Fornecedor();
        $fornecedor->setId($_POST['id']);
        $fornecedor->setNome($_POST['nome']);

        Sessao::gravaFormulario($_POST);

        $fornecedorValidador = new FornecedorValidador();
        $resultadoValidacao = $fornecedorValidador->validar($fornecedor);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/fornecedor/edicao/'.$_POST['id']);
        }

        try {

            $fornecedorDAO = new FornecedorDAO();
            $fornecedorDAO->atualizar($fornecedor);

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/fornecedor');            
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Fornecedor atualizado com sucesso!");

        $this->redirect('/fornecedor');
    }

    public function exclusao($params)
    {
        $id = $params[0];

        $fornecedorDAO = new FornecedorDAO();

        $fornecedor = $fornecedorDAO->getById($id);

        if(!$fornecedor){
            Sessao::gravaMensagem("Fornecedor (id:{$id}) inexistente.");
            $this->redirect('/fornecedor');
        }

        self::setViewParam('fornecedor',$fornecedor);

        $this->render('/fornecedor/exclusao');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function excluir()
    {
        $fornecedor = new Fornecedor();
        $fornecedor->setId($_POST['id']);
        $fornecedor->setNome($_POST['nome']);

        $fornecedorDAO = new FornecedorDAO();

        if ($totalProdutos = $fornecedorDAO->getQuantidadeProdutos($_POST['id'])){
            if ($totalProdutos == 1) {
                Sessao::gravaMensagem("O fornecedor '{$fornecedor->getNome()}' não pode ser excluído pois existe 1 produto vinculado a ele.");
            }else{
                Sessao::gravaMensagem("O fornecedor '{$fornecedor->getNome()}' não pode ser excluído pois existem {$totalProdutos} produtos vinculados a ele.");
            }
            $this->redirect('/fornecedor');
        }

        try {

            if (!$fornecedorDAO->excluir($fornecedor->getId())){
                Sessao::gravaMensagem("Fornecedor (id:{$fornecedor->getId()}) inexistente.");
                $this->redirect('/fornecedor');
            }

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/fornecedor');            
        }        

        Sessao::gravaMensagem("Fornecedor '{$fornecedor->getNome()}' excluido com sucesso!");

        $this->redirect('/fornecedor');
    }
}