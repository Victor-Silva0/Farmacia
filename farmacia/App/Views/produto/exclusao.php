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
            <input type="hidden" class="form-control" name="id" id="id" value="<?= $viewVar['produto']->getId() ?>">
            <br />

            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text"  class="form-control" name="nome" id="nome" value="<?= $viewVar['produto']->getNome() ?>" readonly>
            </div>

            <br />
            <div class="form-group">
                <label for="preco">Preço</label>
                <input type="text"  class="form-control"  name="preco" id="preco" value="<?= $viewVar['produto']->getPreco() ?>" readonly>
            </div>

            <br />
            <div class="form-group">
                <label for="quantidade">Quantidade</label>
                <input type="number"  class="form-control"  name="quantidade" id="quantidade" value="<?= $viewVar['produto']->getQuantidade() ?>" readonly>
            </div>

            <br />
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea class="form-control" name="descricao" placeholder="Descrição do produto" readonly><?= $viewVar['produto']->getDescricao() ?></textarea>
            </div>

            <br />
            <div class="form-group">
                <label for="imagem">Imagem</label>
                <?php if ($viewVar['produto']->getImagem()) { ?>
                    <p><img src="http://<?= APP_HOST ?>/public/images/produtos/<?= $viewVar['produto']->getImagem() ?>" width="200" class="img-fluid" alt="Imagem do produto" /></p>
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
