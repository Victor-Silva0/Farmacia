<?php

namespace App\Models\Entidades;

use App\Models\Entidades\Vendas;
use App\Models\Entidades\Produto;

Class ProdutosVenda
{
    private int $id;
    private Vendas $vendas;
    private Produto $produto;
    private int $quantidade;

    public function __construct()
    {
        $this->vendas = new Vendas();
        $this->produto = new Produto();        
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
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

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade(int $quantidade)
    {
        $this->quantidade = $quantidade;
    }


}
