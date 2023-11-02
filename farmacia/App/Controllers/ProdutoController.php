<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Lib\Upload;
use App\Lib\Paginacao;
use App\Models\DAO\ProdutoDAO;
use App\Models\Entidades\Produto;
use App\Models\Validacao\ProdutoValidador;
use App\Models\Entidades\Fornecedor;
use App\Models\DAO\FornecedorDAO;

class ProdutoController extends Controller
{
    public function index()
    {
        if (!$this->auth()) $this->redirect('/login');
        
        $produtoDAO = new ProdutoDAO();

        $busca              = isset($_GET['busca']) ? $_GET['busca'] : null;
        $paginaSelecionada  = isset($_GET['paginaSelecionada']) ? $_GET['paginaSelecionada'] : 1;
        $totalPorPagina     = 3;

        
        $listaProdutos  = $produtoDAO->listarPaginacao($busca, $totalPorPagina, $paginaSelecionada);
        $paginacao      = new Paginacao($listaProdutos); 

        self::setViewParam('busca', $busca);
        self::setViewParam('paginacao', $paginacao->criandoLink($busca, "produto"));
        self::setViewParam('queryString', Paginacao::criandoQuerystring($paginaSelecionada, $busca));
        self::setViewParam('listaProdutos'  , $listaProdutos['resultado']);

        $this->render('/produto/index');

        Sessao::limpaErro();
        Sessao::limpaMensagem();
    }

    public function produtos()
    {
        $produtoDAO = new ProdutoDAO();
        
        self::setViewParam('listaProdutos', $produtoDAO->listar());

        $this->render('/produto/produtos');
    }

    public function cadastro()
    {
        $fornecedorDAO = new FornecedorDAO();

        self::setViewParam('listaFornecedores', $fornecedorDAO->listar());

        $this->render('/produto/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $fornecedor = new Fornecedor();
        $fornecedor->setId($_POST['idfornecedor']);
        
        $produto = new Produto();
        $produto->setNome($_POST['nome']);
        $produto->setPreco($_POST['preco']);
        $produto->setQuantidade($_POST['quantidade']);
        $produto->setDescricao($_POST['descricao']);
        $produto->setFornecedor($fornecedor);
        $produto->setImagem("");

        Sessao::gravaFormulario($_POST);
        
        $produtoValidador = new ProdutoValidador();
        $resultadoValidacao = $produtoValidador->validar($produto);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/produto/cadastro');
        }

        try { 

            $produtoDAO = new ProdutoDAO(); 
            $lastId = $produtoDAO->salvar($produto);
            $produto->setId($lastId);

            if (!empty($_FILES['imagem']['name'])) {      

                $objUpload = new Upload($_FILES['imagem']);
                $objUpload->setName('img-id'.$lastId);
                $produto->setImagem($objUpload->getBasename());
                $dir = 'public/images/produtos';
                
                $sucesso = $objUpload->upload($dir); 
    
                if (!$sucesso) {
                    $resultadoValidacao->addErro('imagem',"Imagem: Problemas ao enviar a imagem do produto. Código de erro: ".$objUpload->getError());
                    Sessao::gravaErro($resultadoValidacao->getErros());
                    $this->redirect('/produto/cadastro');
                }
                
                $produtoDAO->atualizarImagem($produto);
            }  

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/produto');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Produto adicionado com sucesso!");
        
        $this->redirect('/produto');
    }

    public function edicao($params)
    {
        $id = $params[0];

        $produtoDAO = new ProdutoDAO();

        $produto = $produtoDAO->getById($id);

        if(!$produto){
            Sessao::gravaMensagem("Produto (id:{$id}) inexistente.");
            $this->redirect('/produto');
        }

        $fornecedorDAO = new FornecedorDAO();

        self::setViewParam('listaFornecedores', $fornecedorDAO->listar());
        self::setViewParam('produto',$produto);
        self::setViewParam('queryString', Paginacao::criandoQuerystring($_GET['paginaSelecionada'], $_GET['busca']));

        $this->render('/produto/editar');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function atualizar()
    {
        $produto = new Produto();

        $produto->setId($_POST['id']);
        $produto->setNome($_POST['nome']);
        $produto->setPreco($_POST['preco']);
        $produto->setQuantidade($_POST['quantidade']);
        $produto->setDescricao($_POST['descricao']);
        $produto->getFornecedor()->setId($_POST['idfornecedor']);
        $produto->setImagem($_POST['imagem1']);

        Sessao::gravaFormulario($_POST);

        $produtoValidador = new ProdutoValidador();
        $resultadoValidacao = $produtoValidador->validar($produto);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/produto/edicao/'.$_POST['id']);
        }

        try {

            $dir = 'public/images/produtos';
            $file = $dir .'/'.$_POST['imagem0'];

            if (empty($_POST['imagem1'])) {
                if (file_exists($file)) unlink($file);
            }

            if (!empty($_FILES['imagem']['name'])) {      
                $objUpload = new Upload($_FILES['imagem']);
                $objUpload->setName('img-id'.$produto->getId());
                $produto->setImagem($objUpload->getBasename());

                if (file_exists($file)) unlink($file);
                
                $sucesso = $objUpload->upload($dir); 
    
                if (!$sucesso) {
                    $resultadoValidacao->addErro('imagem',"Imagem: Problemas ao enviar a imagem do produto. Código de erro: ".$objUpload->getError());
                    Sessao::gravaErro($resultadoValidacao->getErros());
                    $this->redirect('/produto'.$_POST['id'].'?busca='.$_GET['busca'].'&paginaSelecionada='.$_GET['paginaSelecionada']);
                }               
            }

            $produtoDAO = new ProdutoDAO();
            $produtoDAO->atualizar($produto);

        } catch (\Exception $e) {
            Sessao::gravaMensagem($e->getMessage());
            $this->redirect('/produto');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Produto atualizado com sucesso!");

        $this->redirect('/produto');
    }

    public function exclusao($params)
    {
        $id = $params[0];

        $produtoDAO = new ProdutoDAO();

        $produto = $produtoDAO->getById($id);

        if(!$produto){
            Sessao::gravaMensagem("Produto (id:{$id}) inexistente.");
            $this->redirect('/produto');
        }

        self::setViewParam('produto',$produto);
        self::setViewParam('queryString', Paginacao::criandoQuerystring($_GET['paginaSelecionada'], $_GET['busca']));

        $this->render('/produto/exclusao');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function excluir()
    {
        $produto = new Produto();
        $produto->setId($_POST['id']);
        $produto->setNome($_POST['nome']);
        $produto->setImagem($_POST['imagem']);

        $produtoDAO = new ProdutoDAO();

        if(!$produtoDAO->excluir($produto)){
            Sessao::gravaMensagem("Produto (id:{$produto->getId()}) inexistente.");
            $this->redirect('/produto');
        }

        Sessao::gravaMensagem("Produto '{$produto->getNome()}' excluido com sucesso!");

        $this->redirect('/produto');
    }
}
