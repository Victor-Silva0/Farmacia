<?php

namespace App\Models\Entidades;

use DateTime;
use App\Models\Entidades\Clientes;

class Vendas
{
    private int $id;
    private  Clientes $clientes;
    private string $dhVenda;
    private float $valor;

    public function __construct()
    {
        $this->clientes = new Clientes();        
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getClientes()
    {
        return $this->clientes;
    }

    public function setClientes(Clientes $clientes)
    {
        $this->clientes = $clientes;
    }

    public function getDhVenda()
    {
        return $this->dhVenda;
    }

    public function setDhVenda($dhVenda)
    {
        $this->dhVenda = $dhVenda;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }
}