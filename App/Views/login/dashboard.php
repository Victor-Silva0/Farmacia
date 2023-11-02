<div class="container">
    <h1>Dashboard</h1>
    <h4>Olá <b><?= $_SESSION['username'] ?></b>! Bem-vindo ao sistema '<?= TITLE ?>'.</h4>
    <hr />
    <div class="row">
        <div class="col-md-9" style="padding-left: 40px;">
            <?php if($Sessao::retornaMensagem()){ ?>
                <div class="alert alert-warning" role="alert">
                    <?= $Sessao::retornaMensagem() ?> 
                </div>
            <?php } ?>
            <br />
            <br />
            <br />
            <a href="http://<?= APP_HOST.'/login/reset' ?>" class="btn btn-warning"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Resete a sua senha </a>
            <a href="http://<?= APP_HOST.'/login/logout' ?>" class="btn btn-danger ml-3"><span class="glyphicon glyphicon-log-out"></span> Faça logout em sua conta </a>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>