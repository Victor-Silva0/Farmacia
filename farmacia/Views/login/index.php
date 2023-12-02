<link href="http://<?php echo APP_HOST; ?>/public/css/style_login.css" rel="stylesheet">
<style>
    .all {
    background-image: url("http://<?php echo APP_HOST; ?>/public/images/img.jpg");
}
</style>
    <div class="all">
        <div class="container-sm">
            <h1>Login</h1>
            <p>Por favor, entre com os seus dados de login.</p>
            <hr />

            <?php if ($Sessao::retornaMensagem()) { ?>
                <div class="alert alert-warning" role="alert">
                <a href="" class="close link-secondary" data-dismiss="alert" aria-label="close"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg></a>
                    <?= $Sessao::retornaMensagem() ?>
                    <br>
                </div>
            <?php } ?>

            <?php if ($Sessao::retornaErro()) { ?>
                <div class="alert alert-warning" role="alert">
                <a href="" class="close link-secondary" data-dismiss="alert" aria-label="close"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg></a>
                    <?php foreach ($Sessao::retornaErro() as $key => $mensagem) {
                        echo $mensagem . "<br />";
                    } ?>
                </div>
            <?php } ?>

            <div class="table-responsive">
                <form action="http://<?php echo APP_HOST; ?>/login/autentica" method="post" id="form_cadastro">
                    <div class="form-group">
                        <label for="username">Usuário:</label>
                        <input type="text" class="form-control" name="username" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Senha:</label>
                        <input type="password" class="form-control" name="password" value="" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>&nbsp;&nbsp;Login
                        </button>
                        <br><br>
                        <p>Não possui uma conta? <a href="http://<?php echo APP_HOST; ?>/login/register">Registre-se agora</a>.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
