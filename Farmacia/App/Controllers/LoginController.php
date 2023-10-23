<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;
use App\Models\Validacao\UsuarioValidador;

class LoginController extends Controller
{
    public function index()
    {
        $this->render('login/index'); 

        Sessao::limpaMensagem();
    }

    public function autentica() 
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        Sessao::gravaFormulario($_POST);

        if(empty(trim($username)) && empty(trim($password))){
            $erro[] = "Faltou digitar usuário e/ou senha!";
            Sessao::gravaErro($erro);
            $this->redirect('/login');
        }

        $usuarioDAO = new UsuarioDAO();
        $id = $usuarioDAO->autenticar($username, $password);

        if ($id == 0) {
            $erro[] = "Usuário ou senha incorretos. Tente novamente!";
            Sessao::gravaErro($erro);
            $this->redirect('/login');
        }
       
        Sessao::gravaLogin($id, $username);

        Sessao::limpaFormulario();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Usuário logado com sucesso!");

        $this->redirect('/login/dashboard');

        Sessao::limpaMensagem();
    }

    public function register()
    {   
        $this->render('login/register');

        Sessao::limpaErro();
    }

    public function registrar()
    {
        $usuario = new Usuario();
        $usuario->setNome($_POST['nome']);
        $usuario->setEmail($_POST['email']);
        $usuario->setEmail($_POST['username']);
        $usuario->setEmail($_POST['password']);

        Sessao::gravaFormulario($_POST);

        $usuarioValidador = new UsuarioValidador();
        $resultadoValidacao = $usuarioValidador->validar($usuario);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/usuario/cadastro');
        }

        $usuarioDAO = new UsuarioDAO();

        if($usuarioDAO->verificaEmail($usuario->getEmail())) {
            $erro[] = "Email Existente!";
            Sessao::gravaErro($erro);
            $this->redirect('/usuario/cadastro');            
        }

        try {

            $usuarioDAO->salvar($usuario);

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/usuario');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Usuário adicionado com sucesso!");

        $this->redirect('/usuario');
    }

    public function dashboard()
    {
        $this->render('login/dashboard');
    }

    public function reset()
    {
        $id = $_SESSION['iduser'];

        $usuarioDAO = new UsuarioDAO();

        $usuario = $usuarioDAO->getById($id);

        if(!$usuario){
            Sessao::gravaMensagem("Usuário inexistente");
            $this->redirect('/login/dashboard');
        }

        self::setViewParam('usuario', $usuario);

        $this->render('login/reset-password');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function logout() 
    {
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $_SESSION["loggedin"] = false;
        unset($_SESSION['username']);

        $this->redirect('/home');
    }
}