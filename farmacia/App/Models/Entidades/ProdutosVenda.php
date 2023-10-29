<?php

namespace App\Models\Entidades;

use App\Models\Entidades\Vendas;
use App\Models\Entidades\Produto;

Class ProdutosVenda
{
    private Vendas $vendas;
    private Produto $produto;

    public function __construct()
    {
        $this->vendas = new Vendas();
        $this->produto = new Produto();        
    }

    public function getVendas()
    {
        return $this->vendas;
    }

    public function setVendas(Vendas $vendas)
    {
        $this->vendas = $vendas;
    }

    public function getProduto()
    {
        return $this->produto;
    }

    public function setProduto(Produto $produto)
    {
        $this->produto = $produto;
    }
}