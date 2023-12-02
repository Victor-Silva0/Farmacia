<div class="container">
  <h1>Dashboard</h1>
  <h4>Olá <b><?= $_SESSION['username'] ?></b>! Bem-vindo ao sistema '<?= TITLE ?>'.</h4>
  <hr />
  <div class="row">
    <div class="col-md-9">
      <?php if($Sessao::retornaMensagem()){ ?>
        <div class="alert alert-warning" role="alert">
          <?= $Sessao::retornaMensagem() ?> 
        </div>
      <?php } ?>
      <a href="http://<?= APP_HOST.'/login/reset' ?>" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Resete a sua senha </a>
      <a href="http://<?= APP_HOST.'/login/logout' ?>" class="btn btn-danger btn-lg ms-3"><span class="glyphicon glyphicon-log-out"></span> Faça logout em sua conta </a>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-sm-3 py-2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Usuários</h5>
          <img src="http://<?php echo APP_HOST; ?>/public/images/user.png" class="card-img-top" alt="usuarios">
          <p class="card-text">Gerenciamento dos usuários administradores do sistema, somente é possivel consultar os usuários já cadastrados, incluir um novo usuário ou excluir
          algum usuário que não poderá mais acessar o sistema.</p>
          <a href="http://<?= APP_HOST ?>/usuario" class="btn btn-primary">Gerenciar Usuários</a>
        </div>
      </div>
    </div>
    <div class="col-sm-3 py-2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Produtos</h5>
          <img src="http://<?php echo APP_HOST; ?>/public/images/product.png" class="card-img-top" alt="produtos">
          <p class="card-text">Gerenciamento dos produtos, incluindo novos opções, consultando as já cadastradas, alterando alguma informação ou até mesmo excluindo alguma opção.</p>
          <a href="http://<?php echo APP_HOST; ?>/produto" class="btn btn-primary">Gerenciar Produtos</a>
        </div>
      </div>
    </div>
    <div class="col-sm-3 py-2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Clientes</h5>
          <img src="http://<?php echo APP_HOST; ?>/public/images/clients.png" class="card-img-top" alt="clientes">
          <p class="card-text">Gerenciamento dos clientes, somente é possivel consultar os clientes já cadastrados, incluir um novo cliente ou excluir
    algum cliente que não poderá mais acessar o sistema.</p>
          <a href="http://<?= APP_HOST ?>/cliente" class="btn btn-primary">Gerenciar Clientes</a>
        </div>
      </div>
    </div>
    <div class="col-sm-3 py-2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Vendas</h5>
          <img src="http://<?php echo APP_HOST; ?>/public/images/sales.jpg" class="card-img-top" alt="vendas">
          <p class="card-text">Gerenciamento das vendas, incluindo novas vendas, consultando as já cadastradas, alterando algum item cadastrado ou também excluindo algum item cadastrado por engano.</p>
          <a href="http://<?= APP_HOST ?>/venda" class="btn btn-primary">Gerenciar Vendas</a>
        </div>
      </div>
    </div>
    <div class="col-sm-3 py-2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Comentários</h5>
              <img src="http://<?php echo APP_HOST; ?>/public/images/foto_comentarios.jpg" class="card-img-top" alt="...">
              <p class="card-text">Aqui você gerencia os comentários dos clientes, somente é possivel consultar os 
                comentários já cadastrados, editar ou excluir algum que não seja adequado.</p>
              <a href="http://<?= APP_HOST; ?>/comentario" class="btn btn-primary">Gerenciar comentários</a>
        </div>
      </div>
    </div>
  </div>
</div>
