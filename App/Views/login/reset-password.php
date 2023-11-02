<div class="container">
    <h1>Resetar senha</h1>
    <p>Por favor, entre com os dados para alterar a sua senha.</p>
    <hr />
    <div class="row">
        <div class="col-md-8" style="padding-left: 40px;">
            <br />
            <?php if($Sessao::retornaMensagem()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="" class="close link-secondary" data-dismiss="alert" aria-label="close"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg></a>
                    <?= $Sessao::retornaMensagem() ?> 
                    <br>
                </div>
            <?php } ?>       
            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="" class="close link-secondary" data-dismiss="alert" aria-label="close"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg></a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem) { echo $mensagem . "<br />"; } ?> 
                </div>
            <?php } ?>  
            <div class="table-responsive col-md-6">
                <form action="http://<?php echo APP_HOST; ?>/usuario/resetPassword" method="post" id="form_cadastro">
                    <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['usuario']->getId(); ?>">
                    <div class="form-group">
                        <label for="username">Usuário:</label>
                        <input type="text" class="form-control" name="username" value="<?php echo $viewVar['usuario']->getUsername(); ?>" readonly>
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="password">Nova Senha:</label>
                        <input type="password" class="form-control" name="password" placeholder="Sua nova senha" value="" required>
                    </div>    
                    <br />
                    <div class="form-group">
                        <label for="password_confirm">Confirmação da Nova Senha:</label>
                        <input type="password" class="form-control" name="password_confirm" placeholder="Confirmação da senha" value="" required>
                    </div>    
                    <br />
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Atualizar </button>          
                        <a href="http://<?php echo APP_HOST; ?>/login/dashboard" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Cancelar </a>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>