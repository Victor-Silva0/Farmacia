<div class="container">
    <h1>Exclusão de Produto Venda</h1>
    <div class="col-md-9">
        <?php if ($Sessao::retornaErro()) { ?>
            <div class="alert alert-warning" role="alert">
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php foreach ($Sessao::retornaErro() as $key => $mensagem) {
                    echo $mensagem . "<br />";
                } ?>
            </div>
        <?php } ?>

        <form action="http://<?php echo APP_HOST; ?>/produto_venda/excluir" method="post" id="form_cadastro">
            <input type="hidden" class="form-control" name="id" value="<?php echo $viewVar['produtoVenda']->getId(); ?>">
            <br />
            <div class="form-group">
                <label for="idproduto">Produto</label>
                <input type="text" class="form-control" name="produto" value="<?php echo $viewVar['produtoVenda']->getProduto()->getNome(); ?>" readonly>
            </div>
            <br />
            <div class="form-group">
                <label for="idvenda">Venda</label>
                <input type="text" class="form-control" name="venda" value="<?php echo $viewVar['produtoVenda']->getVendas()->getId(); ?>" readonly>
            </div>
            <br />
            <div class="form-group">
                <label for="quantidade">Quantidade</label>
                <input type="text" class="form-control" name="quantidade" value="<?php echo $viewVar['produtoVenda']->getQuantidade(); ?>" readonly>
            </div>
            <br />
            <div class="panel panel-danger">
                <div class="panel-body">
                    Deseja realmente excluir a venda do produto:
                    <b><?= $viewVar['produtoVenda']->getProduto()->getNome() ?></b>
                    na venda número: <b><?= $viewVar['produtoVenda']->getVendas()->getId() ?></b>?
                </div>
                <br />
                <div class="panel-footer">
                    <button type="submit" class="btn btn-danger btn-sm">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Excluir
                    </button>
                    <a href="http://<?php echo APP_HOST; ?>/produto_venda" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>
