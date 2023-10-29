<div class="container">
    <h1>Lista de Produtos Vendidos</h1>
    <div class="row">
        <br />
        <div class="col-md-12">
            <a href="http://<?php echo APP_HOST; ?>/produto_venda/cadastro" class="btn btn-success btn-sm">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Produto à Venda
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

            <?php if (!count($viewVar['listaProdutoVenda'])) { ?>
                <div class="alert alert-info" role="alert">Nenhum produto vendido encontrado</div>
            <?php } else { ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tr class="table-success" style="font-weight: bold">
                            <td class="info">Produto</td>
                            <td class="info">Venda</td>
                            <td class="info">Quantidade</td>
                            <td class="info text-center" style="width:15%">Ação</td>
                        </tr>
                        <?php foreach ($viewVar['listaProdutoVenda'] as $produtoVenda) { ?>
                            <tr>
                                <td><?= $produtoVenda->getProduto()->getNome() ?></td>
                                <td><?= $produtoVenda->getVendas()->getId() ?></td>
                                <td><?= $produtoVenda->getQuantidade() ?></td>
                                <td>
                                    <a href="http://<?= APP_HOST ?>/produto_venda/edicao/<?= $produtoVenda->getId() ?>"
                                        class="btn btn-info btn-sm">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar
                                    </a>
                                    <a href="http://<?= APP_HOST ?>/produto_venda/exclusao/<?= $produtoVenda->getId() ?>"
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
