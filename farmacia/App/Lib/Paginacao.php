<?php

namespace App\Lib;

class Paginacao
{
    private $totalPorPagina;
    private $totalLinhas;
    private $paginaSelecionada; 

    public function __construct($resultado)
    {
        $this->totalLinhas          = $resultado['totalLinhas'];
        $this->totalPorPagina       = $resultado['totalPorPagina'];
        $this->paginaSelecionada    = $resultado['paginaSelecionada'];
    }

    public function criandoLink($busca = "", $controller)
{
    $quantidadePagina = ceil($this->totalLinhas / $this->totalPorPagina);
    $queryString = (isset($busca)) ? "&busca=$busca" : "";
    $primeiraPagina = 1;

    $html = '<div>';
    $html .= '<div class="col-md-12 cenralizado">';
    $html .= '<ul class="pagination pagination-sm">';
    
    $desabilita = ($this->paginaSelecionada == $primeiraPagina) ? "disabled" : "";
    $html .= "<li class='page-item $desabilita'>";
    
    $html .= ($this->paginaSelecionada == $primeiraPagina) ?
        '<a class="pagination-link disabled link-dark link-opacity-50-hover link-underline-opacity-0" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
      </svg>ㅤAnterior</a>' :
        '<a class="pagination-link disabled link-dark link-opacity-50-hover link-underline-opacity-0 " href="http://' . APP_HOST . '/' . $controller . '/?paginaSelecionada=' .
        ($this->paginaSelecionada - 1) . $queryString . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/></svg>ㅤAnterior</a>';

    $html .= '</li>';
    
    $html .= "<li class='page-item active'><a>ㅤㅤㅤ" . $this->paginaSelecionada . " de " . $quantidadePagina . "ㅤㅤㅤ</a></li>";
    
    $desabilita = ($this->paginaSelecionada == $quantidadePagina) ? "disabled" : "";
    $html .= "<li class='page-item $desabilita'>";
    
    $html .= ($this->paginaSelecionada == $quantidadePagina) ? '<a class="pagination-link disabled link-dark link-opacity-50-hover link-underline-opacity-0" href="#">Próximaㅤ<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
    <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
  </svg></a>' :
        '<a class="pagination-link disabled link-dark link-opacity-50-hover link-underline-opacity-0 " href="http://' . APP_HOST . '/' . $controller . '/?paginaSelecionada=' .
        ($this->paginaSelecionada + 1) . $queryString . '">Próximaㅤ<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
        <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/></a>';
    
    $html .= '</li>';
    $html .= '</ul>';
    $html .= '</div>';
    $html .= '</div>';
    
    return $html;
}


    public static function criandoQuerystring($paginaSelecionada = "", $busca = "")
    {
        $queryString  = (!empty($paginaSelecionada)) ? '?paginaSelecionada=' . $paginaSelecionada : '';
        $queryString .= (!empty($busca)) ? '&busca=' . $busca : '';

        return $queryString;
    }
}
