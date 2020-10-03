<style>
.link{
    text-decoration:underline;
    color:#069;
}

</style>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?=$title_page?></h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?=base_url()?>dashboard"><?=APPLICATION_NAME?></a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?=base_url()?>trading">Operações</a>
            </li>
            <li class="breadcrumb-item active">
                <strong><?=$title_page?></strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <a href="<?=base_url()?>trading/date/<?=$selected_date;?>" class="btn btn-danger col-md-3"><i class="fa fa-chevron-left"></i> Voltar</a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content">

    <?php
        $attributes = array('class' => 'form-horizontal', 'id' => 'form', 'enctype' => 'multipart/form-data');
        echo form_open('client/save', $attributes);
    ?>
    
        <div class="ibox">
            <div class="ibox-title"></div>
            <div class="ibox-content">
                <div class="row">
                    <div class="form-group col-md-2">
                        <label>Ativo</label>
                        <select data-placeholder="Ativo" id="ticker" name="ticker" class="chosen_select">
                            <option disabled selected>Selecione o Ativo</option>
                            <?php
                             foreach ($tickers as $ticker) {
                            ?>
                                <option value="<?=$ticker?>"  <?=$trading->ticker == $ticker ?  'selected' : '' ?>  ><?=$ticker?></option>
                            <?php
                             }
                            ?>
                        </select>
                        <div class="text-right text-danger small" id="error_ticker"></div>
                    </div>
                    
                    <div class="form-group col-md-2" id="date">
                        <label class="font-normal">Data da Operação</label>
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="form-control" inputmode="date" name="date_in" value="<?=date('d/m/Y',strtotime($trading->date_in));?>">
                            
                        </div>
                        <div class="text-right text-danger small" id="error_date_in"></div>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Hora Entrada</label>
                        <input type="text" placeholder="" inputmode="numeric" name="hour_in" class="form-control mask_hour" value="<?=$trading->hour_in?>">
                        <div class="text-right text-danger small" id="error_hour_in"></div>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Hora Saída</label>
                        <input type="text" placeholder="" inputmode="numeric" name="hour_out" class="form-control mask_hour" value="<?=$trading->hour_out?>">
                        <div class="text-right text-danger small" id="error_hour_out"></div>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Preço Entrada</label>
                        <input type="text" placeholder="" inputmode="numeric" name="price_in" class="form-control mask_currency_without_prefix" value="<?=str_replace('.',',',$trading->price_in);?>">
                        <div class="text-right text-danger small" id="error_price_in"></div>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Preço Saída</label>
                        <input type="text" placeholder="" inputmode="numeric" name="price_out" class="form-control mask_currency_without_prefix" value="<?=str_replace('.',',',$trading->price_out);?>">
                        <div class="text-right text-danger small" id="error_price_out"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-8">
                        <label>Estratégia Usada</label>
                        <input type="text" name="setup" id="setup" placeholder="Estratégia" class="form-control" value="<?=$trading->setup;?>">
                        <div class="text-right text-danger small" id="error_setup"></div>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Operação</label>
                        <div class="radio radio-success">
                            <input type="radio" id="Compra" inputmode="numeric" value="Compra" name="command" <?=$trading->command == "Compra" ? "checked" : "";?>>
                            <label for="Compra"> Compra</label>
                        </div>
                        <div class="radio radio-danger">
                            <input type="radio" id="Venda" inputmode="numeric" value="Venda" name="command"   <?=$trading->command == "Venda" ? "checked" : "";?>>
                            <label for="Venda"> Venda</label>
                        </div>
                        <div class="text-right text-danger small" id="error_command"></div>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Contratos</label>
                        <input type="text" placeholder="0" value="01" name="number_of_papers" class="form-control touchspin" value="<?=$trading->number_of_papers;?>">
                        <div class="text-right text-danger small" id="error_number_of_papers"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Observações da Operação</label>
                        <textarea  id="description" name="description" placeholder="Observações da Operação"><?=$trading->description;?></textarea>
                        <div class="text-right text-danger small" id="error_description"></div>
                    </div>
                </div>

                <div class="row my-5">
                    <div class="form-group col-md-2">
                        <label for="file" class="btn btn-success col-md-12">Enviar Foto</label>
                        <input type="file" id="file" name="image" accept="image/*" inputmode="camera" style="display:none;">
                    </div>
                    <div class="col-md-10 text-center" id="preview">
                        <?php
                            if(!empty($trading->image)){
                        ?>
                            <img src="<?=$trading->image?>" width="100%" heigt="100%">
                            <div class="col-md-12"></div>
                            <button type='button' class='btn btn-danger mt-3' onclick='removeImage()'><i class='fa fa-remove'></i> Remover Foto</button>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="ibox-footer">
                <div class="row px-5 py-2">
                    <div class="offset-md-9 col-md-3 ">
                        <input type="hidden" name="id" value="<?=$trading->id?>">
                        <button type="submit" id="btn_send" class="btn btn-primary col-md-12" style="font-size:1.3em;"> <i class="fa fa-refresh"></i> Editar Trading</button>
                    </div>
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
<script src="<?=base_url();?>assets/client/pages/trading/js/ckeditor5.js"></script>

<!-- Data picker -->
<link href="<?=base_url();?>assets/client/template/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<script src="<?=base_url();?>assets/client/template/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- TouchSpin -->
<script src="<?=base_url();?>assets/client/template/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

<!-- Typehead -->
<script src="<?=base_url();?>assets/client/template/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>

<!-- pages -->
<script src="<?=base_url();?>assets/client/pages/trading/js/strategy-show-by-params.js"></script>
<script src="<?=base_url();?>assets/client/pages/trading/js/update-form.js"></script>

<script src="<?=base_url();?>assets/client/pages/util/js/util.js"></script>
<script src="<?=base_url();?>assets/client/pages/util/js/inputmask.js"></script>



<script>
    $(function(){
        $('.chosen_select').chosen({width: "100%"});

        $('#date .input-group.date').datepicker({
            language: 'pt-BR',
            format: 'dd/mm/yyyy',
            keyboardNavigation: true,
            forceParse: false,
            autoclose: true,
        });

        $(".touchspin").TouchSpin({
            min: 1,
            max: 999,
            step: 1,
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });

        $("#file").change(function(){
            if( typeof(FileReader) != 'undefined' ){
                let preview = $("#preview");
                preview.empty();

                let reader = new FileReader();

                reader.onload = function(e){
                    $("<img />", {
                        "src": e.target.result,
                        "width": '100%',
                        "heigth": '100%'
                    }).appendTo(preview);

                    $("<div />", {
                        "class": "col-md-12",
                    }).appendTo(preview);

                    $("<button />", {
                        "type": "button",
                        "id": "remove_image",
                        "onclick": 'removeImage()',
                        "class": "btn btn-danger mt-3",
                        "html": "<i class='fa fa-remove'></i> Remover Foto",
                    }).appendTo(preview);
                }

                preview.show();
                reader.readAsDataURL($(this)[0].files[0]);

            }
        });

    });

    function removeImage() {
        let preview = $("#preview");
            preview.empty();
        $("#file").empty();
    }
</script>