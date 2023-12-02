<?php

namespace App\Controllers;

use App\Lib\Paginacao;
use App\Models\DAO\ProdutoDAO;
use App\Models\DAO\ComentarioDAO;

class HomeController extends Controller
{
    public function index()
    {
        $produtoDAO = new ProdutoDAO();
        $comentarioDAO = new ComentarioDAO();

        $busca              = isset($_GET['busca']) ? $_GET['busca'] : null;
        $paginaSelecionada  = isset($_GET['paginaSelecionada']) ? $_GET['paginaSelecionada'] : 1;
        $totalPorPagina     = 6;

        
        $listaProdutos  = $produtoDAO->listarPaginacao($busca, $totalPorPagina, $paginaSelecionada);
        $paginacao      = new Paginacao($listaProdutos);

        $listaComentarios = $comentarioDAO->listar();

        self::setViewParam('busca', $busca);
        self::setViewParam('paginacao', $paginacao->criandoLink($busca, "home"));
        self::setViewParam('queryString', Paginacao::criandoQuerystring($paginaSelecionada, $busca));
        self::setViewParam('listaProdutos'  , $listaProdutos['resultado']);
        self::setViewParam('listaComentarios'  , $listaComentarios);

        $this->render('home/index');
    }
}