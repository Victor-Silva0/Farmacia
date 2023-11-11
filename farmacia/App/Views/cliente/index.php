<div class="container">
    <h1>Lista de Clientes</h1>
    <div class="row">
        <br />
        <div class="col-md-12">
            <a href="http://<?php echo APP_HOST; ?>/cliente/cadastro" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar</a>
        </div>
        <div class="col-md-12">
            <hr>
           
            <?php if($Sessao::retornaMensagem()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?= $Sessao::retornaMensagem() ?> 
                    <br>
                </div>
            <?php } ?>            

            <?php if(!count($viewVar['listaClientes'])){ ?>
                <div class="alert alert-info" role="alert">Nenhum cliente encontrado</div>
            <?php } else { ?>                
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tr class="table-secondary" style="font-weight: bold">
                            <td class="info">Nome</td>
                            <td class="info">Celular</td>
                            <td class="info">E-mail</td>
                            <td class="info text-center">Ação</td>
                        </tr>
                        <?php foreach($viewVar['listaClientes'] as $cliente) { ?>
                            <tr class="table-light">
                                <td><?= $cliente->getNome() ?></td>
                                <td><?= $cliente->getCelular() ?></td>
                                <td><?= $cliente->getEmail() ?></td>
                                <td style="width:15%">
                                    <a href="http://<?= APP_HOST ?>/cliente/edicao/<?= $cliente->getId() ?>" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar </a>
                                    <a href="http://<?= APP_HOST ?>/cliente/exclusao/<?= $cliente->getId() ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Excluir </a>   
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>
</div>