<?php

namespace App\Models\DAO;

use App\Models\Entidades\Clientes;

class ClienteDAO extends BaseDAO
{
    public function getById ($id)
    {
        $resultado = $this->select("SELECT * FROM clientes WHERE id = $id");

        $dataSetCliente = $resultado->fetch();

        if($dataSetCliente) {
            $cliente = new Clientes();
            $cliente->setId($dataSetCliente['idCliente']);
            $cliente->setNome($dataSetCliente['nome']);
            $cliente->setCelular($dataSetCliente['celular']);
            $cliente->setEmail($dataSetCliente['email']);

            return $cliente;
        }

        return false;
    }

    public function listar ()
    {
        $resultado = $this->select("SELECT * FROM clientes");

        $dataSetClientes = $resultado->fetchAll();

        $listaClientes = [];
        
        if($dataSetClientes) {

            foreach($dataSetClientes as $dataSetCliente) {
                
                $cliente = new Clientes();
                $cliente->setId($dataSetCliente['idCliente']);
                $cliente->setNome($dataSetCliente['nome']);
                $cliente->setCelular($dataSetCliente['celular']);
                $cliente->setEmail($dataSetCliente['email']);
                $listaClientes[] = $cliente;
            }
        }

        return $listaClientes;
    }

    public function getQuantidadeVendas($id)
    {
        if ($id) {
            $resultado = $this->select("SELECT count(*) as total FROM vendas WHERE idCliente = $id");

            return $resultado->fetch()['total'];
        }

        return false;
    }

    public function salvar (Clientes $cliente)
    {
        try {

            $nome = $cliente->getNome();
            $celular = $cliente->getNome();
            $email = $cliente->getEmail();

            return $this->insert('clientes', ":nome, :celular, :email", [':nome'=>$nome, ':celular'=>$celular, ':email'=>$email]);
            
        }catch (\Exception $e) {
            throw new \Exception("Erro na gravação dos dados. " . $e->getMessage(), 500);
        }
    }

    public function atualizar (Clientes $cliente)
    {
        try {

            $id = $cliente->getId();
            $nome = $cliente->getNome();
            $celular = $cliente->getCelular();
            $email = $cliente->getEmail();

            return $this->update('clientes', "nome = :nome, celular = :celular, email = :email", [':id'=>$id, ':nome'=>$nome, ':celular'=>$celular, ':email'=>$email], "id = :id");
            
        } catch (\Exception $e) {
            throw new \Exception("Erro na atualização dos dados. " . $e->getMessage(), 500);
        }
    }

    public function excluir (int $id)
    {
        try {

            return $this->delete('clientes', "id = $id");

        }catch (\Exception $e) {
            throw new \Exception("Erro ao excluir o clientes. " . $e->getMessage(), 500);
        }
    }
}
