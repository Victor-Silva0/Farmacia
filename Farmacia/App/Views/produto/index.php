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
                        <input type="text" placeholder="Buscar conteúdo" value="" class="form-control input-sm" name="busca" />

                        <div class="input-group-btn">
                            <button class="btn btn-success btn-sm" type="submit">Buscar</button>
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
                    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?= $Sessao::retornaMensagem() ?> 
                    <br>
                </div>
            <?php } ?>              

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tr class="table-success" style="font-weight: bold">
                        <td class="info">Nome</td>
                        <td class="info hidden-sm hidden-xs" style="width:10%">Preço</td>
                        <td class="info hidden-sm hidden-xs" style="width:10%">Quantidade</td>
                        <td class="info hidden-sm hidden-xs" style="width:15%">Fornecedor</td>
                        <td class="info hidden-sm hidden-xs text-center" style="width:10%">Imagem</td>
                        <td class="info hidden-sm hidden-xs" style="width:12%">Data Cadastro</td>
                        <td class="info text-center" style="width:15%">Ação</td>
                    </tr>
                    <?php foreach($viewVar['listaProdutos'] as $produto) { ?>
                        <tr>
                            <td><?= $produto->getNome() ?></td>
                            <td>R$ <?= number_format($produto->getPreco(),2,",",".") ?></td>
                            <td><?= $produto->getQuantidade() ?></td>
                            <td><?= $produto->getFornecedor()->getNome() ?></td>
                            <td class="text-center"><?php if ($produto->getImagem()) { ?><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><?php } ?></td>
                            <td><?= $produto->getDataCadastro()->format('d/m/Y H:i') ?></td>
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