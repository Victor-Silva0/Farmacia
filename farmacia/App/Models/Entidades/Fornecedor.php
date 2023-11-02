<?php

namespace App\Models\Entidades;

use DateTime;

class Fornecedor 
{
    private int $id;
    private string $nome;
    private string $dataCadastro;

    public function getId () : int {
        return $this->id;
    }

    public function setId (int $id) {
        $this->id = $id;
    }

    public function getNome() : string {
        return $this->nome;
    }

    public function setNome(string $nome) {
        $this->nome = $nome;
    }

    public function getDataCadastro() : DateTime {
        return new DateTime($this->dataCadastro);
    }

    public function setDataCadastro(string $dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;
    }
}