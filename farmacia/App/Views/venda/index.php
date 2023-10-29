<div class="container">
    <h1>Lista de Vendas</h1>
    <div class="row">
        <br />
        <div class="col-md-12">
            <a href="http://<?php echo APP_HOST; ?>/venda/cadastro" class="btn btn-success btn-sm">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar
            </a>
        </div>
        <div class="col-md-12">
            <hr>

            <?php if ($Sessao::retornaMensagem()) { ?>
                <div class="alert alert-warning" role="alert">
                    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?= $Sessao::retornaMensagem() ?>
                    <br>
                </div>
            <?php } ?>

            <?php if (count($viewVar['listaVendas']) === 0) { ?>
                <div class="alert alert-info" role="alert">Nenhuma venda encontrada</div>
            <?php } else { ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tr class="table-success" style="font-weight: bold">
                            <td class="info">ID</td>
                            <td class="info">Cliente</td>
                            <td class="info">Valor</td>
                            <td class="info" style="width: 15%">Ação</td>
                        </tr>
                        <?php foreach ($viewVar['listaVendas'] as $venda) { ?>
                            <tr>
                                <td><?= $venda->getId() ?></td>
                                <td><?= $venda->getClientes()->getNome() ?></td>
                                <td>R$ <?= number_format($venda->getValor(), 2, ',', '.') ?></td>
                                <td>
                                    <a href="http://<?= APP_HOST ?>/venda/edicao/<?= $venda->getId() ?>"
                                        class="btn btn-info btn-sm">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar
                                    </a>
                                    <a href="http://<?= APP_HOST ?>/venda/exclusao/<?= $venda->getId() ?>"
                                        class="btn btn-danger btn-sm">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Excluir
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
