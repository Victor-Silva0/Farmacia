<div class="container">
    <h1>Exclusão de Produto</h1>
    <div class="col-md-9">
        <?php if($Sessao::retornaErro()){ ?>
            <div class="alert alert-warning" role="alert">
            <a href="" class="close link-secondary" data-dismiss="alert" aria-label="close"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg></a>
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
