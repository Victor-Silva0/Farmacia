<div class="container">
    <h1>Edição de Produto Venda</h1>
    <div class="col-md-9">
        <?php if ($Sessao::retornaErro()) { ?>
            <div class="alert alert-warning" role="alert">
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php foreach ($Sessao::retornaErro() as $key => $mensagem) {
                    echo $mensagem . "<br />";
                } ?>
            </div>
        <?php } ?>

        <form action="http://<?php echo APP_HOST; ?>/produto_venda/atualizar" method="post" id="form_cadastro" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="id" value="<?php echo $viewVar['produtoVenda']->getId(); ?>">
            <br />
            <div class="form-group">
                <label for="idproduto">Produto</label>
                <select class="form-control" name="idproduto" required>
                    <?php foreach ($viewVar['listaProdutos'] as $produto) { ?>
                        <option value="<?= $produto->getId() ?>" <?= ($produto->getId() == $viewVar['produtoVenda']->getProduto()->getId()) ? 'selected' : '' ?>>
                            <?= $produto->getNome() ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <br />
            <div class="form-group">
                <label for="idvenda">Venda</label>
                <select class="form-control" name="idvenda" required>
                    <?php foreach ($viewVar['listaVendas'] as $venda) { ?>
                        <option value="<?= $venda->getId() ?>" <?= ($venda->getId() == $viewVar['produtoVenda']->getVendas()->getId()) ? 'selected' : '' ?>>
                            <?= $venda->getId() ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <br />
            <div class="form-group">
                <label for="quantidade">Quantidade</label>
                <input type="number" class="form-control" name="quantidade" placeholder="0"
                    value="<?php echo $viewVar['produtoVenda']->getQuantidade(); ?>" required>
            </div>
            <br />

            <button type="submit" class="btn btn-success btn-sm">
                <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Salvar
            </button>
            <a href="http://<?php echo APP_HOST; ?>/produto_venda" class="btn btn-info btn-sm">
                <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Cancelar
            </a>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>
