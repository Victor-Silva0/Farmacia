<div class="container">
    <h1>Lista de Comentarios</h1>
    <div class="row">
        <br />
            <hr>
           
            <?php if($Sessao::retornaMensagem()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="" class="close link-secondary" data-dismiss="alert" aria-label="close"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg></a>
                    <?= $Sessao::retornaMensagem() ?> 
                    <br>
                </div>
            <?php } ?>            

            <?php if(!count($viewVar['listaComentario'])){ ?>
                <div class="alert alert-info" role="alert">Nenhum comentário encontrado.</div>
            <?php } else { ?>                
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tr class="table-secondary" style="font-weight: bold">
                            <td class="info">Nome</td>
                            <td class="info">Texto</td>
                            <td class="info">Data do comentário</td>
                            <td class="info text-center">Ação</td>
                        </tr>
                        <?php foreach($viewVar['listaComentario'] as $comentario) { ?>
                            <tr class="table-light">
                                <td><?= $comentario->getNome() ?></td>
                                <td><?= $comentario->getTexto() ?></td>
                                <td><?= $comentario->getDataComentario() ?></td>
                                <td style="width:15%">
                                    <a href="http://<?= APP_HOST ?>/comentario/edicao/<?= $comentario->getId() ?>" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar </a>
                                    <a href="http://<?= APP_HOST ?>/comentario/exclusao/<?= $comentario->getId() ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Excluir </a>   
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
