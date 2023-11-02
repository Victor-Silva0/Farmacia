<div class="container">
    <h1>Cadastro de Fornecedor</h1>       
    <div class="col-md-9">
        <?php if($Sessao::retornaErro()){ ?>
            <div class="alert alert-warning" role="alert">
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php foreach($Sessao::retornaErro() as $key => $mensagem) { echo $mensagem . "<br />"; } ?> 
            </div>
        <?php } ?>     

        <form action="http://<?php echo APP_HOST; ?>/fornecedor/salvar" method="post" id="form_cadastro">
            <br />
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control"  name="nome" placeholder="Nome do Fornecedor" value="<?php echo $Sessao::retornaValorFormulario('nome'); ?>" required>
            </div>
            <br />
            <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Salvar </button>
            <a href="http://<?php echo APP_HOST; ?>/fornecedor" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Cancelar </a>
        </form>
    </div>
    <div class=" col-md-3"></div>
</div>