<?php

namespace App\Models\DAO;

use App\Models\Entidades\Comentario;

class ComentarioDAO extends BaseDAO
{
    public function getById ($id)
    {
        $resultado = $this->select("SELECT * FROM comentarios WHERE id = $id");

        $dataSetComentario = $resultado->fetch();

        if($dataSetComentario) {
            $comentario = new Comentario();
            $comentario->setId($dataSetComentario['id']);
            $comentario->setNome($dataSetComentario['nome']);
            $comentario->setTexto($dataSetComentario['texto']);
            $comentario->setDataComentario($dataSetComentario['data_comentario']);

            return $comentario;
        }

        return false;
    }

    public function listar ()
    {
        $resultado = $this->select("SELECT * FROM comentarios");

        $dataSetComentarios = $resultado->fetchAll();

        $listaComentario = [];
        
        if($dataSetComentarios) {

            foreach($dataSetComentarios as $dataSetComentario) {
                
                $comentario = new Comentario();
                $comentario->setId($dataSetComentario['id']);
                $comentario->setNome($dataSetComentario['nome']);
                $comentario->setTexto($dataSetComentario['texto']);
                $comentario->setDataComentario($dataSetComentario['data_comentario']);
                $listaComentario[] = $comentario;
            }
        }

        return $listaComentario;
    }

    public function salvar (Comentario $comentario)
    {
        try {

            $nome = $comentario->getNome();
            $texto = $comentario->getTexto();

            return $this->insert('comentarios', ":nome, :texto", [':nome'=>$nome, ':texto'=>$texto]);
            
        }catch (\Exception $e) {
            throw new \Exception("Erro na gravação dos dados. " . $e->getMessage(), 500);
        }
    }

    public function atualizar (Comentario $comentario)
    {
        try {

            $id = $comentario->getId();
            $nome = $comentario->getNome();
            $texto = $comentario->getTexto();

            return $this->update('comentarios', "nome = :nome, texto = :texto", [':id'=>$id, ':nome'=>$nome, ':texto'=>$texto], "id = :id");
            
        } catch (\Exception $e) {
            throw new \Exception("Erro na atualização dos dados. " . $e->getMessage(), 500);
        }
    }

    public function excluir (int $id)
    {
        try {

            return $this->delete('comentarios', "id = $id");

        }catch (\Exception $e) {
            throw new \Exception("Erro ao excluir o clientes. " . $e->getMessage(), 500);
        }
    }
}
