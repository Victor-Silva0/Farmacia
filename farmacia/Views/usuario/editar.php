<div class="container">
    <h1>Edição de Usuário</h1>
    <div class="col-md-9">
        <?php if($Sessao::retornaErro()){ ?>
            <div class="alert alert-warning" role="alert">
            <a href="" class="close link-secondary" data-dismiss="alert" aria-label="close"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg></a>
                <?php foreach($Sessao::retornaErro() as $key => $mensagem) { echo $mensagem . "<br />"; } ?> 
            </div>
        <?php } ?>     

        <form action="http://<?php echo APP_HOST; ?>/usuario/atualizar" method="post" id="form_cadastro">
            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['usuario']->getId(); ?>">
            <input type="hidden" class="form-control" name="password" value="<?php echo $viewVar['usuario']->getPassword();; ?>">
            <br />
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text"  class="form-control" name="nome" id="nome" placeholder="" value="<?php echo $viewVar['usuario']->getNome(); ?>" required>
            </div>
            <br />
            <div class="form-group">
                <label for="email">E-Mail</label>
                <input type="text"  class="form-control" name="email" id="email" placeholder="" value="<?php echo $viewVar['usuario']->getEmail(); ?>" required>
            </div>
            <br />
            <div class="form-group">
                <label for="username">Usuário:</label>
                <input type="text" class="form-control" name="username" placeholder="" value="<?php echo $viewVar['usuario']->getUsername(); ?>" required>
            </div>
            <br />
            <div class="form-group">
                <label for="tipo">Tipo de Usuário:</label>
                <select class="form-control" name="tipo" required>
                    <option value="user" <?= ($viewVar['usuario']->getTipo() == 'user') ? 'selected' : '' ?>>Usuário</option>
                    <option value="admin" <?= ($viewVar['usuario']->getTipo() == 'admin') ? 'selected' : '' ?>>Administrador</option>
                </select>
            </div>
            <br />
            <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Salvar </button>          
            <a href="http://<?php echo APP_HOST; ?>/usuario" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Cancelar </a>
        </form>
    </div>
    <div class=" col-md-3"></div>
</div>
