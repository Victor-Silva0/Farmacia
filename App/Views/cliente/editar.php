<div class="container">
    <h1>Edição de Cliente</h1>
    <div class="col-md-9">
        <?php if($Sessao::retornaErro()){ ?>
            <div class="alert alert-warning" role="alert">
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php foreach($Sessao::retornaErro() as $key => $mensagem) { echo $mensagem . "<br />"; } ?> 
            </div>
        <?php } ?>   

        <form action="http://<?php echo APP_HOST; ?>/cliente/atualizar" method="post" id="form_cadastro">
            <br />
            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['cliente']->getId(); ?>">

            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text"  class="form-control" name="nome" id="nome" value="<?php echo $viewVar['cliente']->getNome(); ?>" required>
            </div>
            <br />
            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="text"  class="form-control" name="celular" id="celular" value="<?php echo $viewVar['cliente']->getCelular(); ?>" required>
            </div>
            <br />
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text"  class="form-control" name="email" id="email" value="<?php echo $viewVar['cliente']->getEmail(); ?>" required>
            </div>
            <br />
            <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Salvar </button>
            <a href="http://<?php echo APP_HOST; ?>/cliente" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Cancelar </a>
        </form>
    </div>
    <div class=" col-md-3"></div>
</div>
