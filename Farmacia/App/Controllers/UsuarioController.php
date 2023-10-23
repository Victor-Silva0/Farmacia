<?php 

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;
use App\Models\Validacao\UsuarioValidador;

class UsuarioController extends Controller
{
    public function index()
    {
        // Verifica se está logado.
        if (!$this->auth()) $this->redirect('/login/index');

        $usuarioDAO = new UsuarioDAO();

        self::setViewParam('listaUsuarios', $usuarioDAO->listar());

        $this->render('/usuario/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {
        $this->render('/usuario/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $usuario = new Usuario();

        $usuario->setNome($_POST['nome']);
        $usuario->setEmail($_POST['email']);
        $usuario->setUsername($_POST['username']);
        $usuario->setPassword($_POST['password']);
        $usuario->setTipo($_POST['tipo']);
        $password_confirm = $_POST['password_confirm'];

        Sessao::gravaFormulario($_POST);

        $usuarioValidador = new UsuarioValidador();
        $resultadoValidacao = $usuarioValidador->validar($usuario);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/usuario/cadastro');
        }

        $erros = [];
        $usuarioDAO = new UsuarioDAO();

        if($usuarioDAO->verificaEmail($usuario->getEmail())) {
            $erros[] = "Email existente!";
        }

        if($usuarioDAO->verificaUsuario($usuario->getUsername())) {
            $erros[] = "Nome de usuário já cadastrado!";
        }

        if(empty($usuario->getPassword()) || empty($password_confirm)) {
            $erros[] = "Senha ou confirmação de senha não digitada!";
        }

        if(trim($usuario->getPassword()) != trim($password_confirm)) {
            $erros[] = "As senhas digitadas não coincidem!";
        }

        if ($erros) {
            Sessao::gravaErro($erros);
            $this->redirect('/usuario/cadastro');
        }

        $usuario->setPassword(password_hash($usuario->getPassword(), PASSWORD_DEFAULT));

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
    
    public function edicao($params)
    {
        $id = $params[0];

        $usuarioDAO = new UsuarioDAO();

        $usuario = $usuarioDAO->getById($id);

        if(!$usuario){
            Sessao::gravaMensagem("Usuário inexistente");
            $this->redirect('/usuario');
        }

        self::setViewParam('usuario', $usuario);

        $this->render('/usuario/editar');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function atualizar()
    {
        $usuario = new Usuario();

        $usuario->setId($_POST['id']);
        $usuario->setNome($_POST['nome']);
        $usuario->setEmail($_POST['email']);
        $usuario->setUsername($_POST['username']);
        $usuario->setTipo($_POST['tipo']);
        $usuario->setPassword($_POST['password']);

        Sessao::gravaFormulario($_POST);

        $usuarioValidador = new UsuarioValidador();
        $resultadoValidacao = $usuarioValidador->validar($usuario);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/usuario/edicao/' . $usuario->getId());
        }

        $erros = [];
        $usuarioDAO = new UsuarioDAO();

        $resultado  = $usuarioDAO->verificaEmail($usuario->getEmail());

        if($resultado && $resultado['id'] != $usuario->getId()) {
            $erros[] = "O email '{$usuario->getEmail()}' já está sendo utilizado!";
        }

        $resultado  = $usuarioDAO->verificaUsuario($usuario->getUsername());

        if($resultado && $resultado['id'] != $usuario->getId()) {
            $erros[] = "O nome de usuário '{$usuario->getUsername()}' já esta sendo utilizado!";
        }

        if ($erros) {
            Sessao::gravaErro($erros);
            $this->redirect('/usuario/edicao/' . $usuario->getId());
        }

        try{
            
            $usuarioDAO->atualizar($usuario);

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/usuario');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Usuário atualizado com sucesso!");

        $this->redirect('/usuario');
    }

    public function exclusao($params)
    {
        $id = $params[0];

        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->getById($id);

        if(!$usuario){
            Sessao::gravaMensagem("Usuario (id:{$id}) inexistente.");
            $this->redirect('/usuario');
        }

        self::setViewParam('usuario',$usuario);

        $this->render('/usuario/exclusao');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function excluir()
    {
        $usuario = new Usuario();
        $usuario->setId($_POST['id']);
        $usuario->setNome($_POST['nome']);

        $usuarioDAO = new UsuarioDAO();

        try {

            if(!$usuarioDAO->excluir($usuario->getId())){
                Sessao::gravaMensagem("Usuario (id:{$usuario->getId()}) inexistente.");
                $this->redirect('/usuario');
            }

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/usuario');
        }        

        Sessao::gravaMensagem("Usuário '{$usuario->getNome()}' excluido com sucesso!");

        $this->redirect('/usuario');
    }

    public function registrar()
    {
        $usuario = new Usuario();

        $usuario->setNome($_POST['nome']);
        $usuario->setEmail($_POST['email']);
        $usuario->setUsername($_POST['username']);
        $usuario->setPassword($_POST['password']);
        $usuario->setTipo($_POST['tipo']);
        $password_confirm = $_POST['password_confirm'];

        Sessao::gravaFormulario($_POST);

        $usuarioValidador = new UsuarioValidador();
        $resultadoValidacao = $usuarioValidador->validar($usuario);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/login/register'); 
        }

        $erros = [];
        $usuarioDAO = new UsuarioDAO();

        if($usuarioDAO->verificaEmail($usuario->getEmail())) {
            $erros[] = "Email existente!";
        }

        if($usuarioDAO->verificaUsuario($usuario->getUsername())) {
            $erros[] = "Nome de usuário já cadastrado!";
        }

        if(empty($usuario->getPassword()) || empty($password_confirm)) {
            $erros[] = "Senha ou confirmação de senha não digitada!";
        }

        if(strcmp(trim($usuario->getPassword()), trim($password_confirm)) != 0) {
            $erros[] = "As senhas digitadas não coincidem!";
        }

        if ($erros) {
            Sessao::gravaErro($erros);
            $this->redirect('/login/register');
        }

        $usuario->setPassword(password_hash($usuario->getPassword(), PASSWORD_DEFAULT));

        try {

            $usuarioDAO->salvar($usuario);

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/login');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Usuário registrado com sucesso!");

        $this->redirect('/login');
    }

    public function resetPassword()
    {
        $usuario = new Usuario();

        $usuario->setId($_POST['id']);
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];

        Sessao::gravaFormulario($_POST);

        $erros = [];
        $usuarioDAO = new UsuarioDAO();

        if ($password !== $password_confirm) {
            $erros[] = "As senhas digitadas não coincidem!";
        }

        if ($erros) {
            Sessao::gravaErro($erros);
            $this->redirect('/login/reset' . $usuario->getId());
        }

        try{

            $usuario->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $usuarioDAO->atualizarPassword($usuario);

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/login/dashboard');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Usuário atualizado com sucesso!");

        $this->redirect('/login/dashboard');
    }
}