<?php

namespace App\Models\Entidades;

class Comentario
{
    private $id;
    private $nome;
    private $texto;
    private $data_comentario;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getTexto()
    {
        return $this->texto;
    }

    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    public function getDataComentario()
    {
        return $this->data_comentario;
    }

    public function setDataComentario($data_comentario)
    {
        $this->data_comentario = $data_comentario;
    }
}