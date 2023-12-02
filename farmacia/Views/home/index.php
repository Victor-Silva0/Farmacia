<link rel="stylesheet" href="css/style.css">
<style>
  body {background-color: #d8f2f3; font-family: 'Lato', sans-serif;}
  .container {margin-top: 30px; margin-bottom: 20px; color: #133a3a;}
  .container > a{border: 10px solid #133a3a; border-radius: 15px;}
  .container1 {color: white; margin-top: 30px; padding: 50px; padding-bottom: 0px; background-color: #133a3a;}
</style>

<div class="container">
  <div id="farmaciaCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active text-center" style="transition: transform 1s ease, opacity .1s ease-out">
        <h1>Medicamentos</h1>
        <a href="#" style="border: 10px solid #133a3a; border-radius: 15px; display: inline-block;">
        <img src="http://<?= APP_HOST ?>/public/images/1.jpg" width="400" height="200">
        </a>
      </div>
      <div class="carousel-item text-center" style="transition: transform 1s ease, opacity .1s ease-out">
        <h1>Suplementos e Vitaminas</h1>
        <a href="#" style="border: 10px solid #133a3a; border-radius: 15px; display: inline-block;">
        <img src="http://<?= APP_HOST ?>/public/images/2.jpg" width="400" height="200">
        </a>
      </div>
      <div class="carousel-item text-center" style="transition: transform 1s ease, opacity .1s ease-out">
        <h1>Beleza</h1>
        <a href="#" style="border: 10px solid #133a3a; border-radius: 15px; display: inline-block;">
        <img src="http://<?= APP_HOST ?>/public/images/3.jpg" width="400" height="200">
        </a>
      </div>
      <div class="carousel-item text-center" style="transition: transform 1s ease, opacity .1s ease-out">
        <h1>Higiene</h1>
        <a href="# style="border: 10px solid #133a3a; border-radius: 15px; display: inline-block;">
        <img src="http://<?= APP_HOST ?>/public/images/4.jpg" width="400" height="200">
        </a>
      </div>
    </div>
    <a class="carousel-control-prev" href="#farmaciaCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" style="background-color: #133a3a; border-radius: 10px; padding: 25px;" aria-hidden="true"></span>
      <span class="sr-only"></span>
    </a>
    <a class="carousel-control-next"  href="#farmaciaCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" style="background-color: #133a3a; border-radius: 10px; padding: 25px;" aria-hidden="true"></span>
      <span class="sr-only"></span>
    </a>
  </div>
</div>

<div class="container1">
  <h1 class="text-white text-center">Nossos Produtos</h1>
  <br />

  <div class="col-md-3 mx-auto">
    <form action="http://<?php echo APP_HOST; ?>" method="get">
      <div class="form-group">
        <label for="busca" class="sr-only">Digite o Produto ou Marca:</label>
        <input type="text" placeholder="Digite..." value="" class="form-control input-sm" name="busca" />
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col">
            <label for="minPrice" class="sr-only">Preço Mínimo</label>
            <input type="number" placeholder="Preço Mínimo" class="form-control input-sm" name="minPrice" id="minPrice" value="" />
          </div>

          <div class="col">
            <label for="maxPrice" class="sr-only">Preço Máximo</label>
            <input type="number" placeholder="Preço Máximo" class="form-control input-sm" name="maxPrice" id="maxPrice" value="" />
          </div>
        </div>
      </div>
      <br>
      <div class="form-group text-center">
        <button class="btn btn-success btn-sm" type="submit">Buscar</button>
      </div>
    </form>
  </div>

  <div class="align-items-center text-center" style="min-height: 100vh;">
    <div class="row g-5 py-5 pb-2">

      <?php if(is_null($viewVar['listaProdutos'])) { ?>
                  <div class="alert alert-info" role="alert">Nenhum produto encontrado.</div>
      <?php } else { ?>

      <?php foreach($viewVar['listaProdutos'] as $produto) { ?>
        
        <div class="col-md-4">
          <div class="context-box bg-dark">
            <h4 class="text-white p-3"><?= $produto->getNome() ?></h4>
            <img src="http://<?= APP_HOST ?>/public/images/<?= $produto->getImagem() ?>" class="d-block mx-auto img-fluid border border-warning rounded" alt="imagem" style="width:200px; height: 200px">
            <br />
            <p class="lead"><?= $produto->getMarca() ?></p>
            <p class="lead"><?= $produto->getConteudo() ?></p>
            <hr />
            <p class="lead pb-3">R$ <?= $produto->getvalor() ?></p>
          </div>
        </div>

      <?php } ?>

      
      <?php } ?>
      
    </div>
  </div>
</div>

<div style="margin: 12px" class="text-center mt-3 ms-3"><?php echo $viewVar['paginacao']; ?></div>
