<div class="container">
    <h1>Cadastro de Usuário</h1>
    <div class="col-md-9">     
        <?php if($Sessao::retornaErro()){ ?>
            <div class="alert alert-warning" role="alert">
            <a href="" class="close link-secondary" data-dismiss="alert" aria-label="close"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg></a>
                <?php foreach($Sessao::retornaErro() as $key => $mensagem) { echo $mensagem . "<br />"; } ?> 
            </div>
        <?php } ?>   

        <form action="http://<?php echo APP_HOST; ?>/usuario/salvar" method="post" id="form_cadastro"> 
            <br />
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control"  name="nome" placeholder="Seu nome" value="<?php echo $Sessao::retornaValorFormulario('nome'); ?>" required>
            </div>
            <br />
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" name="email" placeholder="Seu e-mail" value="<?php echo $Sessao::retornaValorFormulario('email'); ?>" required>
            </div>
            <br />
            <div class="form-group">
                <label for="username">Usuário:</label>
                <input type="text" class="form-control" name="username" placeholder="Seu usuário" value="<?php echo $Sessao::retornaValorFormulario('username'); ?>" required>
            </div>
            <br />
            <div class="form-group">
                <label for="username">Tipo de Usuário:</label>
                <select class="form-control" name="tipo" required>
                    <option value="user">Usuário</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>
            <br />    
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" class="form-control" name="password" placeholder="Sua senha" value="<?php echo $Sessao::retornaValorFormulario('password'); ?>" required>
            </div>    
            <br />
            <div class="form-group">
                <label for="password_confirm">Confirmação da Senha:</label>
                <input type="password" class="form-control" name="password_confirm" placeholder="Confirmação da senha" value="<?php echo $Sessao::retornaValorFormulario('password_confirm'); ?>" required>
            </div>    
            <br />
            <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Salvar </button>
            <a href="http://<?php echo APP_HOST; ?>/usuario" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Cancelar </a>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>