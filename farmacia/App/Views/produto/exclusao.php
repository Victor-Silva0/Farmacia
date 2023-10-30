<div class="container">
    <h1>Exclusão de Produto</h1>
    <div class="col-md-9">
        <?php if($Sessao::retornaErro()){ ?>
            <div class="alert alert-warning" role="alert">
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php foreach($Sessao::retornaErro() as $key => $mensagem) { echo $mensagem . "<br />"; } ?> 
            </div>
        <?php } ?>   

        <form action="http://<?php echo APP_HOST; ?>/produto/excluir" method="post" id="form_cadastro">
            <input type="hidden" class="form-control" name="idProduto" id="idProduto" value="<?= $viewVar['produto']->getId() ?>">
            <br />

            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text"  class="form-control" name="nome" id="nome" value="<?= $viewVar['produto']->getNome() ?>" readonly>
            </div>
            <br />
            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text"  class="form-control" name="marca" id="marca" placeholder="" value="<?php echo $viewVar['produto']->getMarca(); ?>" readonly>
            </div>
            <br />
            <div class="form-group">
                <label for="conteudo">Conteúdo</label>
                <input type="text"  class="form-control" name="conteudo" id="conteudo" placeholder="" value="<?php echo $viewVar['produto']->getConteudo(); ?>" readonly>
            </div>
            <br />
            <div class="form-group">
                <label for="valor">Valor</label>
                <input type="text"  class="form-control"  name="valor" id="valor" placeholder="" value="<?php echo $viewVar['produto']->getValor(); ?>" readonly>
            </div>
            <br />
            <div class="form-group">
                <label for="imagem">Imagem</label>
                <?php if ($viewVar['produto']->getImagem()) { ?>
                    <p><img src="http://<?= APP_HOST ?>/public/images/<?= $viewVar['produto']->getImagem() ?>" width="200" class="img-fluid" alt="Imagem do produto" /></p>
                <?php } ?>
                <input type="text"  class="form-control" name="imagem" id="imagem" value="<?= $viewVar['produto']->getImagem() ?>" readonly>
            </div>

            <br />
            <div class="panel panel-danger">
                <div class="panel-body">
                    Deseja realmente excluir o produto: <b><?= $viewVar['produto']->getNome() ?></b>?
                </div>
                <br />
                <div class="panel-footer"> 
                    <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Excluir </button>
                    <a href="http://<?php echo APP_HOST; ?>/produto<?php echo $viewVar['queryString']; ?>" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Cancelar </a>

                </div>
            </div>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>
