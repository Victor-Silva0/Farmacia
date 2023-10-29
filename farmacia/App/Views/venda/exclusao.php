<div class="container">
    <h1>Exclusão de Venda</h1>
    <div class="col-md-9">
        <?php if ($Sessao::retornaErro()) { ?>
            <div class="alert alert-warning" role="alert">
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php foreach ($Sessao::retornaErro() as $key => $mensagem) {
                    echo $mensagem . "<br />";
                } ?>
            </div>
        <?php } ?>

        <form action="http://<?php echo APP_HOST; ?>/venda/excluir" method="post" id="form_exclusao">
            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['venda']->getId(); ?>">
            <br />
            <div class="form-group">
                <label for="idclientes">Cliente</label>
                <input type="text" class="form-control" name="cliente" value="<?php echo $viewVar['venda']->getClientes()->getNome(); ?>" readonly>
            </div>
            <br />
            <div class="form-group">
                <label for="valor">Valor</label>
                R$ <input type="text" class="form-control" name="valor" value="<?php echo $viewVar['venda']->getValor(); ?>" readonly>
            </div>
            <br />

            <div class="panel panel-danger">
                <div class="panel-body">
                    Deseja realmente excluir esta venda?
                </div>
                <br />
                <div class="panel-footer">
                    <button type="submit" class="btn btn-danger btn-sm">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Excluir
                    </button>
                    <a href="http://<?php echo APP_HOST; ?>/venda" class="btn btn-info btn-sm">
                        <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>
