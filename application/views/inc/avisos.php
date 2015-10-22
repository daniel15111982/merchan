<?php $sucesso = $this->session->flashdata('sucesso'); ?>
<?php $erro = $this->session->flashdata('erro'); ?>
<?php $aviso = $this->session->flashdata('aviso');?>
<?php $info = $this->session->flashdata('info'); ?>

<?php if ($sucesso || $erro || $aviso || $info){ ?>
    <?php if ($sucesso){ ?>
        <div class="alert alert-success"><i class="icon-exclamation-sign"></i> <?php echo $sucesso; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php } ?>
    <?php if ($aviso){ ?>
        <div class="alert alert-info"><i class="icon-exclamation-sign"></i> <?php echo $aviso; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php } ?>
    <?php if ($erro){ ?>
        <div class="alert alert-danger"><i class="icon-exclamation-sign"></i> <?php echo $erro; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php } ?>
<?php }
//Validação menssagens
if(function_exists('validation_errors') && validation_errors() != '')
{
    $error = validation_errors('<div class="alert alert-danger"><i class="icon-exclamation-sign"></i>','<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
}

if (!empty($error)){
    echo $error;
}

?>
<?php if (isset($erro_imagem)){ ?>
    <div class="alert alert-danger"><i class="icon-exclamation-sign"></i> <?php echo $erro_imagem; ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php } ?>