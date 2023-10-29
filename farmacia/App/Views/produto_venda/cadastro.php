<div class="container">
    <h1>Cadastro de Produto Venda</h1>
    <div class="col-md-9">
        <?php if ($Sessao::retornaErro()) { ?>
            <div class="alert alert-warning" role="alert">
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php foreach ($Sessao::retornaErro() as $key => $mensagem) {
                    echo $mensagem . "<br />";
                } ?>
            </div>
        <?php } ?>

        <form action="http://<?php echo APP_HOST; ?>/produto_venda/salvar" method="post" id="form_cadastro" enctype="multipart/form-data">
            <br />
            <div class="form-group">
                <label for="idproduto">Produto</label>
                <select class="form-control" name="idproduto" required>
                    <?php foreach ($viewVar['listaProdutos'] as $produto) { ?>
                        <option value="<?= $produto->getId() ?>"><?= $produto->getNome() ?></option>
                    <?php } ?>
                </select>
            </div>
            <br />
            <div class="form-group">
                <label for="idvenda">Venda</label>
                <select class="form-control" name="idvenda" required>
                    <?php foreach ($viewVar['listaVendas'] as $venda) { ?>
                        <option value="<?= $venda->getId() ?>"><?= $venda->getId() ?></option>
                    <?php } ?>
                </select>
            </div>
            <br />
            <div class="form-group">
                <label for="quantidade">Quantidade</label>
                <input type="number" class="form-control" name="quantidade" placeholder="0" value="<?php echo $Sessao::retornaValorFormulario('quantidade'); ?>" required>
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
