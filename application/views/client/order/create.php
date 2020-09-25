
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Vendas</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?=base_url()?>dashboard"><?=APPLICATION_NAME?></a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Vendas</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <a href="<?=base_url()?>order" class="btn btn-danger col-md-2"><i class="fa fa-chevron-left"></i> Voltar</a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content">
    <?php
        $attributes = array('class' => 'form-horizontal', 'id' => 'form');
        echo form_open('order/save', $attributes);
    ?>
    <!-- dados do cliente -->    
    <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-form-label" for="client_name">Cliente</label>
                    <input type="text" name="client_name" id="client_name" placeholder="Nome do cliente" class="form-control">
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label class="col-form-label" for="client_document">CPF</label>
                    <input type="text" name="client_document" id="client_document" placeholder="CPF" class="form-control mask_cpf">
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <label class="col-form-label" for="client_phone">Contato</label>
                    <input type="text" name="client_phone" id="client_phone" placeholder="(00) 0000-0000" class="form-control mask_phone">
                </div>
            </div>
        </div>
    </div>     
    <!-- dados do cliente -->

    <!-- dados da venda -->    
    <div class="ibox-content m-b-sm border-bottom">
        <div class="row" style="display:flex; align-items: flex-end; ">
            <div class="col-sm-5">
                <div class="form-group">
                    <label class="col-form-label" for="product_name">Produto</label>
                    <select data-placeholder="Escolha o Produto" id="product_name" name="product_name" class="chosen_select">
                        <option disabled selected>Escolha o Produto</option>
                        <option value="1">Produto 1</option>
                        <option value="2">Produto 2</option>
                        <option value="3">Produto 3</option>
                        <option value="4">Produto 4</option>
                        <option value="5">Produto 5</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label class="col-form-label" for="product_price">Preço (Unid.) </label>
                    <input type="text" name="product_price" id="product_price" placeholder="R$ 0,00" class="form-control mask_currency">
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label class="col-form-label" for="product_quantity">QTD</label>
                    <input type="text" name="product_quantity" id="product_quantity" placeholder="Qtd" class="form-control touchspin_quantity">
                    <input type="hidden" id="product_stock">
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label class="col-form-label" for="product_total">Sub Total</label>
                    <input type="text" name="product_total" id="product_total" placeholder="R$ 0,00" class="form-control mask_currency disabled" readonly>
                </div>
            </div>

            <div class="col-sm-1">
                <div class="form-group">
                    <button class="btn btn-primary" id="add_to_cart"> <i class="fa fa-plus"></i> </button>
                </div>
            </div>

        </div>
    </div>
    <!-- dados da venda -->

    <div class="row">

        <div class="offset-md-1 col-md-10">
            <div class="ibox" id="box_cart">  
                <div class="ibox-title">
                    <span class="float-right"><strong id="quantity_in_cart">0</strong> <span id="label_quantity_in_cart">Item</span></span>
                    <h5>Produto(s):</h5>
                </div>

                <div class="ibox-content" id="cart">
                </div>
         
                <div class="ibox-footer">
                    <span class="float-right" style="padding:0% 5%; font-size: 15px">
                        >> Total: <input type="text" placeholder="R$ 0,00" id="cart_total" class="cart_total mask_currency" readonly/></span>
                    </span>
                    <h5>&nbsp;</h5>
                </div>

                <!-- template -->
                <div id="template_item_cart" style="display:none;" >
                    <div class="ibox-content" id="cart_product_id">
                        <div class="table-responsive">
                            <table class="table shoping-cart-table">
                                <tbody>
                                    <tr>
                                        <td width="90"><div class="cart-product-imitation"></div></td>
                                        <td class="desc">
                                            <h3><a href="#" class="text-navy" id="cart_product_name"></a></h3>
                                            <p class="small" id="cart_product_description"></p>
                                            <div class="m-t-sm">
                                                <a id="cart_trash" class="cart_trash"><i class="fa fa-trash"></i> Remover Item</a>
                                            </div>
                                        </td>
                                        <td><input id="cart_product_price" class="cart_product_price" readonly></td>
                                        <td width="180">
                                            <input type="text" name="cart_product_quantity" id="cart_product_quantity" placeholder="Qtd" class="form-control">
                                        </td>
                                        <td>
                                            <h4><input id="cart_product_total" class="cart_product_total" readonly></h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- template -->
            </div>
        </div>
        
        <div class="offset-md-1 col-md-10">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>Frete</h5>
                </div>
                <div class="ibox-content">


                    <div class="row" style="display:flex; align-items: flex-end; ">
                        <div class="col-sm-2">

                            <div class="radio radio-info">
                                <input type="radio" id="inlineRadio1" value="option1" name="radioInline" checked="">
                                <label for="inlineRadio1"> Retirar na loja</label>
                            </div>
                            <div class="radio">
                                <input type="radio" id="inlineRadio2" value="option2" name="radioInline">
                                <label for="inlineRadio2"> Calcular Frete</label>
                            </div>

                        </div>

                    </div>

                    <div class="row" style="display:flex; align-items: flex-end; ">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="col-form-label" for="product_name">CEP</label>
                                <input type="text" name="product_name" value="" placeholder="CEP" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label class="col-form-label" for="product_name">Logradouro</label>
                                <input type="text" name="product_name" value="" placeholder="00" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="col-form-label" for="product_name">Número</label>
                                <input type="text" name="product_name" value="" placeholder="00" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label" for="product_name">Complemento</label>
                                <input type="text" name="product_name" value="" placeholder="Complemento" class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="row" style="display:flex; align-items: flex-end; ">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label class="col-form-label" for="product_name">Bairro</label>
                                <input type="text" name="product_name" value="" placeholder="Bairro" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-5">
                            <div class="form-group">
                                <label class="col-form-label" for="product_name">Cidade</label>
                                <input type="text" name="product_name" value="" placeholder="Cidade" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="col-form-label" for="product_name">UF</label>
                                <input type="text" name="product_name" value="" placeholder="UF" class="form-control">
                            </div>
                        </div>

                    </div>
                    <hr/>
                    <div class="row" style="display:flex; align-items: flex-end; ">
                        <div class="col-md-12">
                            asdadsadsdasdsadasads
                        </div>
                    </div>

                </div>
            </div>

            <div class="ibox">
                <div class="ibox-title">
                    <h5>Desconto</h5>
                </div>
                <div class="ibox-content">
                
                    <div class="row" style="display:flex; align-items:center; ">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label" for="product_name">Desconto:</label>
                                <input class="touchspin2" type="text" value="0" name="demo2">
                            </div>
                        </div>
                    </div>    
                
                </div>
            </div>

            <div class="ibox">
                <div class="ibox-title">
                    <h5>Pagamento</h5>
                </div>
                <div class="ibox-content">
                    
                    <span>
                        Total
                    </span>
                    <h2 class="font-bold">
                        R$ 390,00
                    </h2>

                    <hr/>

                    <div class="row" style="display:flex; align-items:center; ">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label" for="payment">Pagamento:</label>
                                <select data-placeholder="Forma de Pagamento" id="payment" name="payment" class="chosen_select">
                                    <option value="cash">À vista</option>
                                    <option value="financed">Parcelado</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3" id="box_number_of_installment" style="display:none;">
                            <div class="form-group">
                                <label class="col-form-label" for="number_of_installment">Qtd. Parcelas:</label>
                                <input type="text" value="0" name="number_of_installment" id="number_of_installment">
                            </div>
                        </div>

                    </div>

                    <div id="template_box_installment">
                        <div class="row" style="display:flex; align-items:flex-start; border-bottom:1px solid #eeeeee ">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label" for="product_name">Parcela 1</label>
                                    <input type="text" name="product_name" value="R$ 130,00" placeholder="3" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="col-form-label" for="product_name">Vencimento</label>
                                    <input type="text" name="product_name" value="30/08/2020" placeholder="3" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="col-form-label" for="product_name">Recebimento:</label>
                                    <select data-placeholder="Categoria" class="chosen_select" tabindex="4">
                                        <option value="United Kingdom">Cartão de Crédito</option>
                                        <option value="United States">Transferência Bancária</option>
                                        <option value="United States">Carteira</option>
                                        <option value="United States">Boleto Bancário</option>
                                    </select>
                                </div>
                            </div>  
                        </div>

                    </div>

                    <div id="box_show_installment">
                    </div>
                    
                    <div class="m-t-sm mt-5 ">
                        <div class="btn-group col-md-12">
                            <button type="submit" class="btn btn-primary btn-sm col-md-12" id="btn_send"><i class="fa fa-shopping-cart"></i> Finalizar Venda</button>
                        </div>
                    </div>

                    <div class="m-t-sm col-md-12">
                        <div class="btn-group offset-md-2 col-md-8 text-center">
                            <a href="#" class="btn btn-white btn-sm col-md-12"> Cancelar</a>
                        </div>


                    </div>

                </div>
            </div>


        </div>
    </div>

    <?php
        echo form_close();
    ?>
    
</div>

<!-- TouchSpin -->
<script src="<?=base_url();?>assets/client/template/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

<!-- Typehead -->
<script src="<?=base_url();?>assets/client/template/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>

<!-- inputmask -->
<script src="<?=base_url();?>assets/client/template/js/plugins/inputmask/dist/jquery.inputmask.min.js"></script>

<!-- pages -->
<link href="<?=base_url();?>assets/client/pages/order/css/manager-cart.css" rel="stylesheet">

<script src="<?=base_url();?>assets/client/pages/order/js/client-show-by-params.js"></script>
<script src="<?=base_url();?>assets/client/pages/order/js/get-attr-products.js"></script>
<script src="<?=base_url();?>assets/client/pages/order/js/manager-cart.js"></script>
<script src="<?=base_url();?>assets/client/pages/util/js/inputmask.js"></script>

<script>
     
    
    $(function(){
        
       
        
        $("#form").attr('autocomplete','off');
        
        $("#form").submit(function(e){
            $("#btn_send").prop('disabled',true).html("<i class='fa fa-spinner fa-spin'></i> Aguarde...");
            e.preventDefault();
        });

        $('.chosen_select').chosen({width: "100%"});

        $("#payment").change(function(e){
            if( $(this).val() === "financed"){
                $("#box_number_of_installment").show();
            }else{
                $("#box_number_of_installment").hide();
            }

            e.preventDefault();
        });



        $(".touchspin2").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%',
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });

        $(".touchspin_quantity").TouchSpin({
            min: 1,
            max: 999999999,
            step: 1,
            decimals: 0,
            boostat: 5,
            maxboostedstep: 10,
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });

        $("#number_of_installment").TouchSpin({
            min: 1,
            max: 100,
            step: 1,
            decimals: 0,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '',
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });

        $("#number_of_installment").change(function(){
            let number = $("#number_of_installment").val();
            showInstallment( number )
        });

        function showInstallment( number ) {
            if(number > 0 && number <= 100){
               
                $("#box_show_installment").empty();

                for (let index = 1; index <= number; index++) {
                    $("#box_show_installment").append( $("#template_box_installment").html() );
                    $('.chosen_select').chosen({width: "100%"});

                }

            }
        }

    });
</script>
