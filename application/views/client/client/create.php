<style>
.link{
    text-decoration:underline;
    color:#069;
}

</style>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Clientes</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?=base_url()?>dashboard"><?=APPLICATION_NAME?></a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?=base_url()?>client">Clientes</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Novo Cliente</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <a href="<?=base_url()?>client" class="btn btn-danger col-md-2"><i class="fa fa-chevron-left"></i> Voltar</a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content">

    <?php
        $attributes = array('class' => 'form-horizontal', 'id' => 'form', 'enctype' => 'multipart/form-data');
        echo form_open('client/save', $attributes);
    ?>
    <div class="row">
        
        <div class="col-md-3">
            <div class="ibox ">
                <div>
                    <div class="ibox-content no-padding border-left-right" style="width: 100%; height: 250px; text-align:center;">
                        <img alt="image" class="img-fluid" id="preview_avatar" src="<?=base_url()?>assets/client/template/img/avatar/default_woman.png" style="height: 250px; overflow: hidden;">
                    </div>
                    <div class="ibox-content profile-content text-center">
                        <div class="user-button text-center">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="file" id="avatar" name="avatar" style="display:none;">
                                    <label class="btn btn-primary btn-sm btn-block" for="avatar">Escolher foto</label>
                                </div>
                            </div>
                            <!--
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="btn btn-danger btn-sm btn-block">Remover foto</label>
                                </div>
                            </div>
                            -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">

            <div class="tabs-container">
                <ul class="nav nav-tabs" role="tablist">
                    <li><a class="nav-link active" data-toggle="tab" href="#tab-feed"> Dados do Cliente</a></li>
                </ul>
                <div class="tab-content">

                    <div role="tabpanel" id="tab-feed" class="tab-pane active">
                        <div class="panel-body py-5">

                            <fieldset>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nome:</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Nome do Cliente" onkeydown="javascript:inputFocus('phone',event)">
                                        <div class="text-right text-danger small" id="error_name"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Telefonte (Whatsapp):</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="phone" name="phone" class="form-control mask_phone" placeholder="Telefone" onkeydown="javascript:inputFocus('document',event)">
                                        <div class="text-right text-danger small" id="error_phone"></div>
                                    </div>
                                    <label class="col-sm-2 col-form-label text-right">CPF:</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="document" name="document" class="form-control mask_cpf" placeholder="CPF" onkeydown="javascript:inputFocus('description',event)">
                                        <div class="text-right text-danger small" id="error_document"></div>
                                    </div>
                                </div>
                                <div class="form-group row"><label class="col-sm-2 col-form-label">Descrição:</label>
                                    <div class="col-sm-10">
                                        <textarea  id="description" name="description" placeholder="Descrição do produto"></textarea>
                                        <div class="text-right text-danger small" id="error_description"></div>
                                    </div>
                                </div>  
                            </fieldset>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <div class="row my-3">
        <div class="col-md-12">
            <div class="text-right">
                <button type="submit" class="btn btn-primary" id="btn_send" style="font-size:16px"> Cadastrar Cliente</button>
            </div>
        </div>
    </div>
    <?php
        echo form_close();
    ?>
</div>    

<!-- inputmask -->
<script src="<?=base_url();?>assets/client/template/js/plugins/inputmask/dist/jquery.inputmask.min.js"></script>

<!-- ckeditor5 -->
<script src="<?=base_url();?>assets/client/template/js/plugins/ckeditor5/ckeditor.js"></script>
<script src="<?=base_url();?>assets/client/template/js/plugins/ckeditor5/translations/pt-br.js"></script>
<script src="<?=base_url();?>assets/client/pages/client/js/ckeditor5.js"></script>

<!-- pages -->
<script src="<?=base_url();?>assets/client/pages/client/js/preview-image.js"></script>
<script src="<?=base_url();?>assets/client/pages/client/js/send-form.js"></script>

<script src="<?=base_url();?>assets/client/pages/util/js/util.js"></script>
<script src="<?=base_url();?>assets/client/pages/util/js/inputmask.js"></script>

