<div class="container">
    <h1>Cadastro de Produto</h1>
    <div class="col-md-9">      
        <?php if($Sessao::retornaErro()){ ?>
            <div class="alert alert-warning" role="alert">
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php foreach($Sessao::retornaErro() as $key => $mensagem) { echo $mensagem . "<br />"; } ?> 
            </div>
        <?php } ?>   

        <form action="http://<?php echo APP_HOST; ?>/produto/salvar" method="post" id="form_cadastro" enctype="multipart/form-data">
            <br />
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" placeholder="Nome do Produto" value="<?php echo $Sessao::retornaValorFormulario('nome'); ?>" required>
            </div>
            <br />
            <div class="form-group">
                <label for="nome">Marca</label>
                <input type="text" class="form-control" name="marca" placeholder="Marca do Produto" value="<?php echo $Sessao::retornaValorFormulario('marca'); ?>" required>
            </div>
            <br />
            <div class="form-group">
                <label for="nome">Conteúdo</label>
                <input type="text" class="form-control" name="conteudo" placeholder="Conteúdo do Produto" value="<?php echo $Sessao::retornaValorFormulario('conteudo'); ?>" required>
            </div>
            <br />
            <div class="form-group">
                <label for="preco">Valor</label>
                R$ <input type="text" class="form-control" name="valor" placeholder="0" value="<?php echo $Sessao::retornaValorFormulario('valor'); ?>" required>
            </div>
            <br />
            <div class="form-group">
                <label for="imagem">Imagem</label>
                <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*">
                <p class="help-block">JPG, PNG ou GIF.</p>
                <p><img id="foto" data-src="holder.js/180x180" src="" width="180" class="img-fluid" alt="Imagem Produto"></p>
            </div>
            <br />
            <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Salvar </button>
            <a href="http://<?php echo APP_HOST; ?>/produto" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Cancelar </a>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>