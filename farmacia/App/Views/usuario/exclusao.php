<div class="container">
    <h1>Exclusão de Usuário</h1>
    <div class="col-md-9">
        <?php if($Sessao::retornaErro()){ ?>
            <div class="alert alert-warning" role="alert">
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php foreach($Sessao::retornaErro() as $key => $mensagem) { echo $mensagem . "<br />"; } ?> 
            </div>
        <?php } ?>    

        <form action="http://<?php echo APP_HOST; ?>/usuario/excluir" method="post" id="form_cadastro">
            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['usuario']->getId(); ?>">

            <br />
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text"  class="form-control" name="nome" id="nome" value="<?php echo $viewVar['usuario']->getNome(); ?>" readonly>
            </div>

            <br />
            <div class="form-group">
                <label for="email">E-Mail</label>
                <input type="text"  class="form-control" name="email" id="email" value="<?php echo $viewVar['usuario']->getEmail(); ?>" readonly>
            </div>

            <br />
            <div class="form-group">
                <label for="username">Usuário:</label>
                <input type="text" class="form-control" name="username" id="username" value="<?php echo $viewVar['usuario']->getUsername(); ?>" readonly>
            </div>
            <br />    
            <div class="form-group">
                <label for="tipo">Tipo de Usuário:</label>
                <input type="text" class="form-control" name="tipo" id="tipo" value="<?= ($viewVar['usuario']->getTipo() == 'admin') ? 'Administrador' : 'Usuário' ?>" readonly>
            </div>
            <br />
            <div class="panel panel-danger">
                <div class="panel-body">
                    Deseja realmente excluir o usuário: <b><?= $viewVar['usuario']->getNome() ?></b>?
                </div>
                <br />
                <div class="panel-footer"> 
                    <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Excluir </button>
                    <a href="http://<?php echo APP_HOST; ?>/usuario" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Cancelar </a>
                </div>
            </div>
        </form>
    </div>
    <div class=" col-md-3"></div>
</div>
