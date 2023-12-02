<div class="container">
    <h1>Exclusão de Cliente</h1>
    <div class="col-md-9">
        <?php if($Sessao::retornaErro()){ ?>
            <div class="alert alert-warning" role="alert">
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php foreach($Sessao::retornaErro() as $key => $mensagem) { echo $mensagem . "<br />"; } ?> 
            </div>
        <?php } ?>    

        <form action="http://<?php echo APP_HOST; ?>/cliente/excluir" method="post" id="form_cadastro">
            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['cliente']->getId(); ?>">
            <br />

            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text"  class="form-control" name="nome" id="nome" value="<?php echo $viewVar['cliente']->getNome(); ?>" readonly>
            </div>

            <br />

            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="text"  class="form-control" name="celular" id="celular" value="<?php echo $viewVar['cliente']->getCelular(); ?>" readonly>
            </div>

            <br />

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text"  class="form-control" name="email" id="email" value="<?php echo $viewVar['cliente']->getEmail(); ?>" readonly>
            </div>

            <br />
            <div class="panel panel-danger">
                <div class="panel-body">
                    Deseja realmente excluir o cliente: <b><?= $viewVar['cliente']->getNome() ?></b>?
                </div>
                <br />
                <div class="panel-footer"> 
                    <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Excluir </button>
                    <a href="http://<?php echo APP_HOST; ?>/cliente" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Cancelar </a>
                </div>
            </div>
        </form>
    </div>
    <div class=" col-md-3"></div>
</div>