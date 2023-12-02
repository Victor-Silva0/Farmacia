<div class="container">
    <h1>Edição de Produto</h1>
    <div class="col-md-9">       
        <?php if($Sessao::retornaErro()){ ?>
            <div class="alert alert-warning" role="alert">
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php foreach($Sessao::retornaErro() as $key => $mensagem) { echo $mensagem . "<br />"; } ?> 
            </div>
        <?php } ?>    

        <form action="http://<?php echo APP_HOST; ?>/produto/atualizar" method="post" id="form_cadastro" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="idProduto" id="idProduto" value="<?php echo $viewVar['produto']->getId(); ?>">
            <br />
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text"  class="form-control" name="nome" id="nome" placeholder="" value="<?php echo $viewVar['produto']->getNome(); ?>" required>
            </div>
            <br />
            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text"  class="form-control" name="marca" id="marca" placeholder="" value="<?php echo $viewVar['produto']->getMarca(); ?>" required>
            </div>
            <br />
            <div class="form-group">
                <label for="conteudo">Conteúdo</label>
                <input type="text"  class="form-control" name="conteudo" id="conteudo" placeholder="" value="<?php echo $viewVar['produto']->getConteudo(); ?>" required>
            </div>
            <br />
            <div class="form-group">
                <label for="text">Valor</label>
                <input type="number"  class="form-control"  name="valor" id="valor" placeholder="" value="<?php echo $viewVar['produto']->getValor(); ?>" required>
            </div>
            <br />
            <div class="form-group">
                <input type="hidden" name="imagem0" id="imagem0" value="<?php echo $viewVar['produto']->getImagem(); ?>">
                <input type="hidden" name="imagem1" id="imagem1" value="<?php echo $viewVar['produto']->getImagem(); ?>">
                <label for="imagem">Imagem</label>
                <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*">
                <p class="help-block">JPG, PNG ou GIF.</p>
                <?php if ($viewVar['produto']->getImagem()) { ?>
                    <p><img id="foto" data-src="holder.js/180x180" src="http://<?= APP_HOST ?>/public/images/<?= $viewVar['produto']->getImagem() ?>" width="180" class="img-fluid" alt="Imagem do produto" /></p>
                    <p><button type="button" style="padding: 5px 5px;" onclick="excluirImagem()"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </button>&nbsp;<?php echo $viewVar['produto']->getImagem(); ?></p>
                <?php } else { ?>
                    <p><img id="foto" data-src="holder.js/180x180" src="" width="180" class="img-fluid" alt="Imagem do produto" /></p>
                <?php } ?>               
            </div>
            <br />
            <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Salvar </button>
            <a href="http://<?php echo APP_HOST; ?>/produto<?php echo $viewVar['queryString']; ?>" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Cancelar </a>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>
<script>
function excluirImagem() 
{
    document.getElementById('imagem1').value='';
    document.getElementById('foto').setAttribute('src', 'http://<?= APP_HOST ?>/public/images/img-noimage.jpg');
}
</script>