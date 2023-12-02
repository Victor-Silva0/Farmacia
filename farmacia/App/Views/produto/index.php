<div class="container">
    <h1>Lista de Produtos</h1> 
    <div class="row">
        <br />
        <div class="col-md-9">
            <a href="http://<?php echo APP_HOST; ?>/produto/cadastro" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar</a>
        </div>

        <div class="col-md-3">
            <form action="http://<?php echo APP_HOST; ?>/produto/" method="get" class="form-inline buscaDireita">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon input-sm" id="basic-addon1">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </span>
                        <input type="text" placeholder="Digite..." value="" class="form-control input-sm" name="busca" />

                        <div class="input-group-btn">
                            <button class="btn btn-success btn-sm p-2 ms-2" type="submit">Buscar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-12">
            <hr />

            <?php if(is_null($viewVar['listaProdutos'])) { ?>
                <div class="alert alert-info" role="alert">Nenhum produto encontrado.</div>
            <?php } else { ?>

                <?php if($Sessao::retornaMensagem()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="" class="close link-secondary" data-dismiss="alert" aria-label="close"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg></a>
                    <?= $Sessao::retornaMensagem() ?> 
                    <br>
                </div>
            <?php } ?>              

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tr class="table-secondary" style="font-weight: bold">
                        <td class="info">Nome</td>
                        <td class="info hidden-sm hidden-xs" style="width:10%">Marca</td>
                        <td class="info hidden-sm hidden-xs" style="width:10%">Conteúdo</td>
                        <td class="info hidden-sm hidden-xs" style="width:15%">Valor</td>
                        <td class="info hidden-sm hidden-xs text-center" style="width:10%">Imagem</td>
                        <td class="info text-center" style="width:15%">Ação</td>
                    </tr>
                    <?php foreach($viewVar['listaProdutos'] as $produto) { ?>
                        <tr class="table-light">
                            <td><?= $produto->getNome() ?></td>
                            <td><?= $produto->getMarca() ?></td>
                            <td><?= $produto->getConteudo() ?></td>
                            <td>R$ <?= number_format($produto->getValor(),2,",",".") ?></td>
                            <td class="text-center"><?php if ($produto->getImagem()) { ?>
                            <img src="http://<?php echo APP_HOST; ?>/public/images/<?= $produto->getImagem() ?>" alt="imagem" style="width:60%">
                            <?php } ?></td>
                            <td>
                                <a href="http://<?= APP_HOST ?>/produto/edicao/<?= $produto->getId() ?><?php echo $viewVar['queryString']; ?>" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar </a>
                                <a href="http://<?= APP_HOST ?>/produto/exclusao/<?= $produto->getId() ?><?php echo $viewVar['queryString']; ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Excluir </a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="text-center"><?php echo $viewVar['paginacao']; ?></div>
            <?php } ?>
        </div>
    </div>
</div>