<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ComentarioDAO;
use App\Models\Entidades\Comentario;

class ComentarioController extends Controller
{
    public function index()
    {
        if (!$this->auth()) $this->redirect('/login/index');

        $comentarioDAO = new ComentarioDAO();

        $resultado = $comentarioDAO->listar();
        self::setViewParam('listaComentario', $resultado);

        $this->render('/comentario/index');

        Sessao::limpaMensagem();
    }

    public function salvar()
    {
        $comentario = new Comentario();
        $comentario->setNome($_POST['nome']);
        $comentario->setTexto($_POST['texto']);

        Sessao::gravaFormulario($_POST);

        try { 

            $comentarioDAO = new ComentarioDAO();
            $comentarioDAO->salvar($comentario);

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());            
            $this->redirect('/home');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Comentario adicionado com sucesso!");
        $this->redirect('/home');       
    }

    public function edicao($params)
    {
        $id = $params[0];

        $comentarioDAO = new ComentarioDAO();

        $comentario = $comentarioDAO->getById($id);

        if(!$comentario){
            Sessao::gravaErro("Comentario (id:{$id}) inexistente.");
            $this->redirect('/comentario');
        }

        self::setViewParam('comentario',$comentario);

        $this->render('/comentario/editar');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function atualizar()
    {
        $comentario = new Comentario();
        $comentario->setId($_POST['id']);
        $comentario->setNome($_POST['nome']);
        $comentario->setTexto($_POST['texto']);

        Sessao::gravaFormulario($_POST);

        try {

            $comentarioDAO = new ComentarioDAO();
            $comentarioDAO->atualizar($comentario);

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/comentario');            
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Comentario atualizado com sucesso!");

        $this->redirect('/comentario');
    }

    public function exclusao($params)
    {
        $id = $params[0];

        $comentarioDAO = new ComentarioDAO();

        $comentario = $comentarioDAO->getById($id);

        if(!$comentario){
            Sessao::gravaMensagem("Comentario (id:{$id}) inexistente.");
            $this->redirect('/comentario');
        }

        self::setViewParam('comentario',$comentario);

        $this->render('/comentario/exclusao');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function excluir()
    {
        $comentario = new Comentario();
        $comentario->setId($_POST['id']);

        $comentarioDAO = new ComentarioDAO();

        try {

            if (!$comentarioDAO->excluir($comentario->getId())){
                Sessao::gravaMensagem("Comentario (id:{$comentario->getId()}) inexistente.");
                $this->redirect('/comentario');
            }

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/comentario');            
        }        

        Sessao::gravaMensagem("Comentario '{$comentario->getId()}' excluido com sucesso!");

        $this->redirect('/comentario');
    }
}
