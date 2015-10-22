<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8">
    <title><?= $titulo ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="" name="description">
    <meta content="" name="author">
    <?= $this->load->view('inc/header') ?>
</head>
<style>
    .image-preview-input {
        position: relative;
        overflow: hidden;
        margin: 0px;
        color: #333;
        background-color: #fff;
        border-color: #ccc;
    }
    .image-preview-input input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
    .image-preview-input-title {
        margin-left:2px;
    }
</style>
<body>
<!-- BEGIN HEADER -->
<div class="page-header">
    <!-- BEGIN HEADER TOP -->
    <div class="page-header-top">
        <div class="container">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="index.html"><img src="../../assets/admin/layout3/img/logo-default.png" alt="logo"
                                          class="logo-default"></a>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <?= $this->load->view('inc/menuatividades'); ?>
        </div>
    </div>
    <!-- END HEADER TOP -->
    <!-- BEGIN HEADER MENU -->
    <?= $this->load->view('inc/menu') ?>
    <!-- END HEADER MENU -->
</div>
<!-- END HEADER -->
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
    <!-- BEGIN PAGE HEAD -->
    <!-- END PAGE HEAD -->
    <!-- BEGIN PAGE CONTENT -->
    <div class="page-content">
        <div class="container">
            <!-- BEGIN PAGE BREADCRUMB -->
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="<?= base_url() ?>">Home</a><i class="fa fa-circle"></i>
                </li>
                <li class="active">
                    Cadastro
                </li>
            </ul>
            <!-- END PAGE BREADCRUMB -->
            <? $this->load->view('inc/avisos') ?>
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-folder-open fa-3x font-red-sunglo"></i>
                        <span class="caption-subject font-red-sunglo  bold uppercase">Formulário de cadastro</span>
                        <span class="caption-helper"></span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="<?= base_url() ?>cadastro/novo" class="form-horizontal" id="form-cadastro"
                          method="post" enctype="multipart/form-data">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Nome</label>
                                <div class="col-md-4">
                                    <input type="text" name="fullname" value="<?=set_value('fullname')?>" class="form-control" placeholder="Nome completo">
														<span class="help-block">Coloque seu nome completo.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">login</label>
                                <div class="col-md-4">
                                    <input type="text" name="username" value="<?=set_value('username')?>" class="form-control" placeholder="Login">
                                    <span class="help-block">Login de acesso ao sistema.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Telefone</label>
                                <div class="col-md-4">
                                    <input type="text" id="telefone" value="<?=set_value('telefone')?>" name="telefone" class="form-control" >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">CPF</label>
                                <div class="col-md-4">
                                    <input type="text" id="cpf" name="cpf" value="<?=set_value('cpf')?>" class="form-control" >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">RG</label>
                                <div class="col-md-4">
                                    <input type="text" name="rg" id="number" value="<?=set_value('rg')?>" class="form-control" >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Email</label>
                                <div class="col-md-4">
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="email" value="<?=set_value('email')?>" name="email" class="form-control" placeholder="endereço de Email">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Sexo</label>
                                <div class="col-md-4">
                                    <div class="col-md-4">
                                        <select  name="sexo" class="form-control">
                                            <option value="">Selecione</option>
                                            <option value="">Masculino</option>
                                            <option value="">Feminino</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Data de inicio</label>
                                <div class="col-md-4">
                                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                                    <input type="text" class="form-control" readonly=""><span class="input-group-btn"><button class="btn default" type="button"><i class="fa fa-calendar"></i></button></span>
                                </div>
                                    <span class="help-block">Selecione a data de cadastro </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Registro</label>
                                <div class="col-md-4">
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                        <input type="text" value="<?=set_value('registro')?>" name="registro" class="form-control" placeholder="Registro interno">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Endereço</label>
                                <div class="col-md-4">
                                    <input type="text" name="endereco" value="<?=set_value('endereco')?>" class="form-control" placeholder="Rua, Av. Traveça" >
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Número</label>
                                <div class="col-md-4">
                                    <input type="text" name="numero" value="<?=set_value('numero')?>" class="form-control" placeholder="45" >
                                    <span class="help-block">Somente números</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Complemto</label>
                                <div class="col-md-4">
                                    <input type="text" name="complemento" value="<?=set_value('complemento')?>" class="form-control" placeholder="Bloco C" >
                                    <span class="help-block">Até 90 caractéres</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Grupo</label>
                                <div class="col-md-4">
                                    <select class="form-control" data-selectsplitter-firstselect-selector="" size="5">
                                     <?php foreach($grupos as $row){ ?>
                                        <option value="<?=$row['value']?>"><?=$row['descricao']?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="help-block">Grupo em que se encontra o cadastro</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Image</label>
                                <div class="col-md-9">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="input-group input-large">
                                            <div class="form-control uneditable-input span3" data-trigger="fileinput">
                                                <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename"></span>
                                            </div>
													<span class="input-group-addon btn default btn-file">
													<span class="fileinput-new">
													Select file </span>
													<span class="fileinput-exists">
													Change </span>
													<input type="hidden" value="" name="..."><input type="file" name="">
													</span>
                                            <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">
                                                Remove </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Estado</label>
                                <div class="col-md-4">
                                    <select id="uf" name="estado" class="form-control" onChange="get_cidades_from_estado_empresa(this.value,'cidade')">
                                        <option value="">Selecione</option>
                                        <?php
                                        foreach($estados as $row){
                                            echo '<option '.set_select('estado',$row->id_estado).' value="'.$row->id_estado.'">'.$row->nome.'</option>';
                                        }
                                        ?>
                                    </select>
                                    <span class="help-inline"></span>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label">Cidade</label>
                                <div class="col-md-4">
                                    <select id="cidade" name="cidade" class="form-control">
                                        <option value="">Selecione um estado primeiro</option>
                                        <?php
                                        if(isset ($opt_cidades))
                                            echo @$opt_cidades;
                                        ?>
                                    </select>
                                    <span class="help-inline"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Senha</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="password" class="form-control" placeholder="Senha"
                                            ><span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Confirme a senha</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="password_conf" class="form-control" placeholder="Confirmação de senha"
                                            ><span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green" form="form-cadastro">Cadastrar</button>
                                <button type="reset" class="btn default">Cancelar</button>
                            </div>
                        </div>
                    </div>
                    <!-- END FORM-->
                </div>
            </div>

            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
    <!-- END PAGE CONTENT -->
</div>
<div class="page-footer">
    <div class="container">
        <?=date("Y")?> &copy; Merchan Master All Rights Reserved.
    </div>
</div>
<div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
</div>
<?= $this->load->view('inc/footer') ?>

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
