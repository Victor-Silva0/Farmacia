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

        $quantidadePagina   = ceil( $this->totalLinhas / $this->totalPorPagina );
        $queryString        = (isset($busca)) ? "&busca=$busca" : "";
        $primeiraPagina     = 1;


        $html          = '<div class="row">';
        $html         .= '<div class="col-md-12 cenralizado">';
        $html         .= '<ul class="pagination pagination-sm">';
        $desabilita    = ( $this->paginaSelecionada == $primeiraPagina ) ? "disabled" : "";
        $html         .= "<li class='page-item $desabilita '>";
        $html         .= ( $this->paginaSelecionada == $primeiraPagina ) ?
                           '<a href="#">&laquo; Anterior </a>' :
                           '<a href="http://'. APP_HOST . '/' . $controller . '/?paginaSelecionada=' .
                           ( $this->paginaSelecionada - 1 ) . $queryString . '">&laquo; Anterior </a>';
        $html         .= '</li>';

        $html         .= "<li class='page-item active'><a>ㅤㅤ".$this->paginaSelecionada." de ".$quantidadePagina."ㅤㅤ</a></li>";

        $desabilita    = ( $this->paginaSelecionada == $quantidadePagina ) ? "disabled" : "";
        $html         .= "<li class='page-item  $desabilita  '>";
        $html         .= ( $this->paginaSelecionada == $quantidadePagina ) ? '<a href="#">Próxima &raquo;</a>' :
                         '<a href="http://'. APP_HOST . '/' . $controller . '/?paginaSelecionada=' .
                          ( $this->paginaSelecionada + 1 ) . $queryString . '">Próxima &raquo;</a>';
        $html         .= '</li>';
        $html         .= '</ul>';
        $html         .= '</div>';
        $html         .= '</div>';

        return $html;
    }

    public static function criandoQuerystring($paginaSelecionada = "", $busca = "")
    {
        $queryString  = (!empty($paginaSelecionada)) ? '?paginaSelecionada=' . $paginaSelecionada : '';
        $queryString .= (!empty($busca)) ? '&busca=' . $busca : '';

        return $queryString;
    }
}