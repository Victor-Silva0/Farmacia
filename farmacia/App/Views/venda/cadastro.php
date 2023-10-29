<div class="container">
    <h1>Cadastro de Venda</h1>
    <div class="col-md-9">
        <?php if ($Sessao::retornaErro()) { ?>
            <div class="alert alert-warning" role="alert">
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { echo $mensagem . "<br />"; } ?>
            </div>
        <?php } ?>

        <form action="http://<?php echo APP_HOST; ?>/venda/salvar" method="post" id="form_cadastro" enctype="multipart/form-data">
            <br />
            <div class="form-group">
                <label for="idclientes">Cliente</label>
                <select class="form-control" name="idclientes" required>
                    <?php foreach($viewVar['listaClientes'] as $clientes) { ?>
                    <option value="<?= $clientes->getId() ?>"><?=$clientes->getNome() ?></option>
                <?php } ?>
                </select>
            </div>
            <br />
            <div class="form-group">
                <label for="valor">Valor</label>
                 R$ <input type="text" class="form-control" name="valor" placeholder="0" value="<?php echo$Sessao::retornaValorFormulario('valor'); ?>" required>
            </div>
            <br />

            <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Salvar</button>
            <a href="http://<?php echo APP_HOST; ?>/venda" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Cancelar</a>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>
