<?php

namespace App\Models\DAO;

use App\Models\Entidades\Fornecedor;
use Exception;

class FornecedorDAO extends BaseDAO 
{
    public function getById ($id)
    {
        $resultado = $this->select("SELECT * FROM fornecedor WHERE id = $id");

        return $resultado->fetchObject(Fornecedor::class);
    }

    public function listar ()
    {
        $resultado = $this->select("SELECT * FROM fornecedor");

        return $resultado->fetchAll(\PDO::FETCH_CLASS, Fornecedor::class);
    }

    public function getQuantidadeProdutos($id)
    {
        if ($id) {
            $resultado = $this->select("SELECT count(*) as total FROM produto WHERE idfornecedor = $id");

            return $resultado->fetch()['total'];
        }

        return false;
    }

    public function salvar (Fornecedor $fornecedor)
    {
        try {

            $nome = $fornecedor->getNome();

            return $this->insert('fornecedor', ":nome", [':nome'=>$nome]);
            
        }catch (\Exception $e) {
            throw new \Exception("Erro na gravação dos dados. " . $e->getMessage(), 500);
        }
    }

    public function atualizar (Fornecedor $fornecedor)
    {
        try {

            $id = $fornecedor->getId();
            $nome = $fornecedor->getNome();

            return $this->update('fornecedor', "nome = :nome", [':id'=>$id, ':nome'=>$nome], "id = :id");
            
        } catch (\Exception $e) {
            throw new \Exception("Erro na atualização dos dados. " . $e->getMessage(), 500);
        }
    }

    public function excluir (int $id)
    {
        try {

            return $this->delete('fornecedor', "id = $id");

        }catch (\Exception $e) {
            throw new \Exception("Erro ao excluir o fornecedor. " . $e->getMessage(), 500);
        }
    }
}