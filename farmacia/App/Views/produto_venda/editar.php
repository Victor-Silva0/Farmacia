<div class="container">
    <h1>Edição de Produto Venda</h1>
    <div class="col-md-9">
        <?php if ($Sessao::retornaErro()) { ?>
            <div class="alert alert-warning" role="alert">
            <a href="" class="close link-secondary" data-dismiss="alert" aria-label="close"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg></a>
                <?php foreach ($Sessao::retornaErro() as $key => $mensagem) {
                    echo $mensagem . "<br />";
                } ?>
            </div>
        <?php } ?>

        <form action="http://<?php echo APP_HOST; ?>/produto_venda/atualizar" method="post" id="form_cadastro" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="id" value="<?php echo $viewVar['produtoVenda']->getId(); ?>">
            <input type="hidden" class="form-control" name="idvenda" value="<?php echo $viewVar['produtoVenda']->getVendas()->getId(); ?>">
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
                <label for="quantidade">Quantidade</label>
                <input type="number" class="form-control" name="quantidade" placeholder="0"
                    value="<?php echo $viewVar['produtoVenda']->getQuantidade(); ?>" required>
            </div>
            <br />

            <button type="submit" class="btn btn-success btn-sm">
                <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Salvar
            </button>
            <a href="http://<?php echo APP_HOST; ?>/produto_venda/index/<?= $viewVar['produtoVenda']->getVendas()->getId() ?>" class="btn btn-info btn-sm">
                <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Cancelar
            </a>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>
