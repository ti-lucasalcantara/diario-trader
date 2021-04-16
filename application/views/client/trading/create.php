<style>
.link{
    text-decoration:underline;
    color:#069;
}

.label-error{
    color:#bb2124 !important;
    margin: 1% 0 !important;
    display:flex;
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
        echo form_open('trading/insert', $attributes);
    ?>
    
        <div class="ibox">
            <div class="ibox-title"></div>
           
            <div class="ibox-content">
                
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Informe o Ativo</label>
                        <input type="text" name="ticker" id="ticker" placeholder="Informe o Ativo" class="form-control <?=(form_error('ticker')) ? 'is-invalid' : ''; ?>" value="<?=set_value('ticker')?>">
                        <?=form_error('ticker','<small class="form-text text-muted label-error">', '</small>'); ?>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Valor por pontos</label>
                        <input type="text" inputmode="numeric" name="price_of_point" id="price_of_point" placeholder="R$ 0,00" class="form-control mask_currency <?=(form_error('price_of_point')) ? 'is-invalid' : ''; ?>" value="<?=set_value('price_of_point')?>">
                        <?=form_error('price_of_point','<small class="form-text text-muted label-error">', '</small>'); ?>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Operação</label>
                        <div class="radio radio-success">
                            <input type="radio" id="Compra" inputmode="numeric" value="buy" name="command" class="<?=(form_error('command')) ? 'is-invalid' : ''; ?>" checked="">
                            <label for="Compra"> Compra</label>
                        </div>
                        <div class="radio radio-danger">
                            <input type="radio" id="Venda" inputmode="numeric" value="sell" name="command" class="<?=(form_error('command')) ? 'is-invalid' : ''; ?>">
                            <label for="Venda"> Venda</label>
                        </div>
                        <?=form_error('command','<small class="form-text text-muted label-error">', '</small>'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Estratégia Usada</label>
                        <input type="text" name="setup" id="setup" placeholder="Qual foi a estratégia/setup para entrar na operação?" class="form-control <?=(form_error('setup')) ? 'is-invalid' : ''; ?>" value="<?=set_value('setup');?>">
                        <?=form_error('setup','<small class="form-text text-muted label-error">', '</small>'); ?>
                    </div>
                </div>

                <div class="row mt-4"><div class="col-md-12"><h3>Dados da Entrada da Operação:</h3></div></div>

                <div class="row">
                    <div class="form-group col-md-2">
                        <label>Contratos/Papeis <small>(entrada)</small></label>
                        <input type="text" placeholder="00" value="01" name="number_of_papers" class="form-control touchspin <?=(form_error('number_of_papers')) ? 'is-invalid' : ''; ?>" value="<?=set_value('number_of_papers');?>">
                        <?=form_error('number_of_papers','<small class="form-text text-muted label-error">', '</small>'); ?>
                    </div>
                    <div class="form-group col-md-2" id="date">
                        <label class="font-normal">Data da Entrada</label>
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="form-control <?=(form_error('date_in')) ? 'is-invalid' : ''; ?>" inputmode="date" name="date_in" value="<?=set_value('date_in',$date_in);?>">
                        </div>
                        <?=form_error('date_in','<small class="form-text text-muted label-error">', '</small>'); ?>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Hora Entrada</label>
                        <input type="text" inputmode="numeric" name="hour_in" placeholder="hh:mm:ss" class="form-control mask_hour <?=(form_error('hour_in')) ? 'is-invalid' : ''; ?>" value="<?=set_value('hour_in');?>">
                        <?=form_error('hour_in','<small class="form-text text-muted label-error">', '</small>'); ?>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Preço Entrada</label>
                        <input type="text" inputmode="numeric" name="price_in" placeholder="R$ 0,00" class="form-control mask_currency <?=(form_error('price_in')) ? 'is-invalid' : ''; ?>" value="<?=set_value('price_in');?>">
                        <?=form_error('price_in','<small class="form-text text-muted label-error">', '</small>'); ?>
                    </div>
                </div>
                    
                <div class="row"><div class="col-md-12"><hr></div></div>
                <div class="row">
                    <div class="col-md-8"><h3>Dados da Saída da Operação:</h3></div>
                    <div class="form-group col-md-4 text-right">
                        <button type="button" id="addLineOut" class="btn btn-info"><i class="fa fa-plus"></i> criar parcial</button>
                    </div>
                </div>

                <div id="line_out"></div>
               
                <div class="row"><div class="col-md-12"><hr></div></div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Observações da Operação</label>
                        <textarea  id="description" name="description" placeholder="Observações da Operação"></textarea>
                    </div>
                </div>

                <div class="row my-5">
                    <div class="form-group col-md-2">
                        <label for="file" class="btn btn-success col-md-12">Enviar Foto</label>
                        <input type="file" id="file" name="image" accept="image/*" inputmode="camera" style="display:none;">
                    </div>
                    <div class="col-md-10 text-center" id="preview"></div>
                </div>
            </div>

            <div class="ibox-footer">
                <div class="row px-5 py-2">
                    <div class="offset-md-9 col-md-3 ">
                        <input type="hidden" name="quantity_line_out" value="<?=set_value('quantity_line_out', 1)?>">
                        <button type="submit" id="btn_send" class="btn btn-primary col-md-12" style="font-size:1.3em;"> <i class="fa fa-check"></i> Salvar Trading</button>
                    </div>
                </div>
            </div>
        </div>

    <?php
        echo form_close();
    ?>
</div>




<script>
    $(function(){
        showLineOut();

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

        $(document).on('click', '.removeLineOut', function(e){
            e.preventDefault();
            $(this).prop('disabled',true);

            var id = $(this).attr('lineOut');
            $("#line_out_"+id).remove();
            var quantity_line_out = parseInt($("input[name='quantity_line_out']").val());
            $("input[name='quantity_line_out']").val(quantity_line_out-1);
        });

        $(document).on('click', '#addLineOut', function(e){
            e.preventDefault();

            var quantity_line_out = parseInt($("input[name='quantity_line_out']").val());
            $("input[name='quantity_line_out']").val(quantity_line_out+1);

            showLineOut();

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

            $(".mask_currency").inputmask('currency',{"autoUnmask": true,
                radixPoint:",",
                groupSeparator: ".",
                allowMinus: false,
                prefix: 'R$ ',            
                digits: 2,
                digitsOptional: false,
                rightAlign: true,
                unmaskAsNumber: true
            });
            
            $(".mask_hour").inputmask({ alias: "datetime", inputFormat: "HH:MM:ss", placeholder: 'hh:mm:ss'});

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

    function showLineOut(){
        var id = $("input[name='quantity_line_out']").val();
        var removeLineOut = "";
            removeLineOut = `<div class="form-group col-md-2" style="margin-top: 28px"><button lineOut='${id}' class='btn btn-danger removeLineOut'><i class='fa fa-remove'></i></button></div>`;

        $("#line_out").append(`<div class="row" id="line_out_${id}">
                <div class="form-group col-md-2">
                    <label>Contratos/Papeis <small>(saída)</small></label>
                    <input type="text" placeholder="0" value="01" name="number_of_papers_out[]" class="form-control touchspin">
                </div>
                <div class="form-group col-md-2" id="date">
                    <label class="font-normal">Data da Saída Operação</label>
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control" inputmode="date" name="date_out[]" value="<?=$date_in;?>">
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label>Hora Saída</label>
                    <input type="text" inputmode="numeric" name="hour_out[]" placeholder="hh:mm:ss" class="form-control mask_hour">
                </div>
                <div class="form-group col-md-2">
                    <label>Preço Saída</label>
                    <input type="text" inputmode="numeric" name="price_out[]" placeholder="R$ 0,00" class="form-control mask_currency">
                </div>
                ${removeLineOut}
            </div>`);

        return true;
    }

</script>


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
<script src="<?=base_url();?>assets/client/pages/trading/js/send-form.js"></script>

<script src="<?=base_url();?>assets/client/pages/util/js/util.js"></script>
<script src="<?=base_url();?>assets/client/pages/util/js/inputmask.js"></script>
