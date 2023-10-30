<div class="container">
    <h1>Produtos</h1> 
    <hr />
    <br />
    <div class="row">
        <div class="col-md-9" style="padding-left: 50px;">
            <div class="starter-template">
                <?php foreach($viewVar['listaProdutos'] as $produto) { ?>                    
                    <div class="row featurette">
                        <div class="col-md-7">
                            <h2 class="featurette-heading"><?= $produto->getNome() ?></h2>
                            <h4><?= $produto->getConteudo() ?></h4>
                            <br />
                            <h4>Valor: R$ <?= number_format($produto->getValor(),2,",",".") ?></h4>
                        </div>
                        <div class="col-md-5">
                            <figure class="figure">
                                <img src="http://<?= APP_HOST ?>/public/images/<?= $produto->getImagem() ?>" width="100" class="figure-img img-fluid rounded" alt="Imagem do produto" />
                            </figure>
                        </div>
                    </div>
                    <hr class="featurette-divider">
                <?php } ?>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>