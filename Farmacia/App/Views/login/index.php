<div class="container">
    <h1>Login</h1>
    <p>Por favor, entre com os seus dados de login.</p>
    <hr />
    <div class="row">
        <div class="col-md-9" style="padding-left: 40px;">
            <br />
            <?php if($Sessao::retornaMensagem()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?= $Sessao::retornaMensagem() ?> 
                    <br>
                </div>
            <?php } ?>       
            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem) { echo $mensagem . "<br />"; } ?> 
                </div>
            <?php } ?>  
            <div class="table-responsive col-md-6">
                <form action="http://<?php echo APP_HOST; ?>/login/autentica" method="post" id="form_cadastro">
                    <div class="form-group">
                        <label for="username">Usuário:</label>
                        <input type="text" class="form-control" name="username" value="" required>
                    </div>
                    <br />    
                    <div class="form-group">
                        <label for="password">Senha:</label>
                        <input type="password" class="form-control" name="password" value="" required>
                    </div>    
                    <br />
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>&nbsp;&nbsp;Login </button>
                        <br /><br />
                        <p>Não possui uma conta? <a href="http://<?php echo APP_HOST; ?>/login/register">Registre-se agora</a>.</p>
                    </div>
                </form>
            </div>
            <div class="table-responsive col-md-6"></div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>