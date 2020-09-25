<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Produtos</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?=base_url()?>dashboard"><?=APPLICATION_NAME?></a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Produtos</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <a href="<?=base_url()?>product" class="btn btn-danger col-md-2"><i class="fa fa-chevron-left"></i> Voltar</a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight ecommerce pb-5">
    <?php
        $attributes = array('class' => 'form-horizontal', 'id' => 'form');
        echo form_open('product/save', $attributes);
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li><a class="nav-link active" data-toggle="tab" href="#tab-1"> Produto</a></li>
                        <li><a class="nav-link " data-toggle="tab" href="#tab-2"> Fotos</a></li>
                        <li><a class="nav-link" data-toggle="tab" href="#tab-3"> Informações</a></li>
                        <li><a class="nav-link" data-toggle="tab" href="#tab-4"> Cupons de Desconto</a></li>
                    </ul>
                    <div class="tab-content">
                        <!-- start tab #1 -->
                        <div id="tab-1" class="tab-pane active" style="z-index: 99!important;" >
                            <div class="panel-body">
                                <fieldset>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Nome:</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Nome do Produto" onkeydown="javascript:inputFocus('barcode',event)">
                                            <div class="text-right text-danger small" id="error_name"></div>
                                        </div>

                                        <label class="col-sm-2 col-form-label text-right">Código de barras:</label>
                                        <div class="col-sm-2">
                                            <input type="text" id="barcode" name="barcode" class="form-control" placeholder="Código do Produto" onkeydown="javascript:inputFocus('purchase_price',event)">
                                            <div class="text-right text-danger small" id="error_barcode"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row"> 
                                        <label class="col-sm-2 col-form-label ">Preço de Compra:</label>
                                        <div class="col-sm-2">
                                            <input type="text" id="purchase_price" name="purchase_price" class="form-control mask_currency" placeholder="R$ 0,00" onkeydown="javascript:inputFocus('profit_margin',event)">
                                            <div class="text-right text-danger small" id="error_purchase_price"></div>
                                        </div>

                                        <label class="col-sm-2 col-form-label text-right">Margem de Lucro %</label>
                                        <div class="col-sm-2">
                                            <input type="text" name="profit_margin" id="profit_margin" placeholder="00" class="form-control touchspin_percent" onkeydown="javascript:inputFocus('price',event)">
                                            <div class="text-right text-danger small" id="error_profit_margin"></div>
                                        </div>

                                        <label class="col-sm-2 col-form-label text-right">Preço de Venda:</label>
                                        <div class="col-sm-2">
                                            <input type="text" id="price" name="price" class="form-control mask_currency" placeholder="R$ 0,00" onkeydown="javascript:inputFocus('quantity',event)">
                                            <div class="text-right text-danger small" id="error_price"></div>
                                        </div>
                                    </div>
                                
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Estoque Atual:</label>
                                        <div class="col-sm-2">
                                            <input type="text" name="quantity" id="quantity" placeholder="00" class="form-control touchspin_quantity" onkeydown="javascript:inputFocus('minimum_quantity',event)">
                                            <div class="text-right text-danger small" id="error_quantity"></div>
                                        </div>

                                        <label class="col-sm-2 col-form-label text-right">Quantidade Miníma:</label>
                                        <div class="col-sm-2">
                                            <input type="text" name="minimum_quantity" id="minimum_quantity" placeholder="00" class="form-control touchspin_quantity" onkeydown="javascript:inputFocus('measurements',event)">
                                            <div class="text-right text-danger small" id="error_minimum_quantity"></div>
                                        </div>
                                        
                                        <label class="col-sm-2 col-form-label text-right">Unidade de Medida:</label>
                                        <div class="col-sm-2">
                                            <select data-placeholder="Selecione" id="measurements_id" name="measurements_id" class="chosen_select"></select>
                                            <div class="text-right text-danger small" id="error_measurements_id"></div>
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
                        <!-- end tab #1 -->

                        <!-- start tab #2 -->
                        <div id="tab-2" class="tab-pane ">
                            <div class="panel-body">    
                                <fieldset>         
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label title="Escolher Imagem" for="inputImage" class="btn btn-info offset-3 col-md-6">
                                                    <input type="file" accept="image/*" name="file" id="inputImage" class="hide" style="display:none;">
                                                    Escolher Imagem
                                                </label>

                                                <div class="image-crop mb-5"><img src="" id="image-cropper"></div>
                                                
                                                <div class="btn-group offset-3 col-md-6" id="cropper-controls" style="margin-top:-10px; display:none;">
                                                    <button class="btn btn-light col-md-3 ml-2" id="zoomIn" type="button"><i class="fa fa-search-plus"></i></button>
                                                    <button class="btn btn-light col-md-3 ml-2" id="zoomOut" type="button"><i class="fa fa-search-minus"></i></button>
                                                    <button class="btn btn-light col-md-3 ml-2" id="rotateLeft" type="button"><i class="fa fa-repeat"></i></button>
                                                    <button class="btn btn-light col-md-3 ml-2" id="rotateRight" type="button"><i class="fa fa-undo"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="margin:0 auto;">
                                                <div class="img-preview" style="height: 350px; width: 420px;"></div>
                                                <br>
                                                <div class="btn btn-success col-md-6 offset-3 mt-2" id="save-image" style="display:none;"> Salvar Imagem</div>
                                            </div>
                                        </div>
                                   
                                        <div class="row mt-5">
                                            <div class="col-md-12">
                                                <ul id="sortable">
                                                    <li id="img_1" class="ui-state-default ">
                                                        <div class="product-imitation-sortable">
                                                            <img class="product-image-cover-sortable" src="<?=base_url()?>uploads/client/123123/products/1/p1.jpeg" alt="">
                                                        </div>
                                                    </li>
                                                    <li id="img_3"  class="ui-state-default">3</li>
                                                    <li id="img_4"  class="ui-state-default">4</li>
                                                    <li id="img_5"  class="ui-state-default">5</li>
                                                    <li id="img_6"  class="ui-state-default">6</li>
                                                    <li id="img_7"  class="ui-state-default">7</li>
                                                    <li id="img_8"  class="ui-state-default">8</li>
                                                    <li id="img_9"  class="ui-state-default">9</li>
                                                    <li id="img_10" class="ui-state-default">10</li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                            </div>
                        </div>
                        <!-- end tab #2 -->

                        <!-- start tab #3 -->
                        <div id="tab-3" class="tab-pane">
                            <div class="panel-body">
                                <fieldset>
                                    <div class="form-group row"><label class="col-sm-2 col-form-label">Categoria(s):</label>
                                        <div class="col-sm-10">
                                        <select data-placeholder="Selecione" id="produtct_categories_id" name="produtct_categories_id" class="chosen_select" multiple >
                                        </select>
                                        <div class="text-right text-danger small" id="error_produtct_categories_id"></div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <!-- end tab #3 -->

                        <!-- start tab #4 -->
                        <div id="tab-4" class="tab-pane">
                            <div class="panel-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-stripped">
                                        <thead>
                                        <tr>
                                            <th>
                                                Image preview
                                            </th>
                                            <th>
                                                Image url
                                            </th>
                                            <th>
                                                Sort order
                                            </th>
                                            <th>
                                                Actions
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <img src="img/gallery/2s.jpg">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled value="http://mydomain.com/images/image1.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="1">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/gallery/1s.jpg">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled value="http://mydomain.com/images/image2.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="2">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/gallery/3s.jpg">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled value="http://mydomain.com/images/image3.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="3">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/gallery/4s.jpg">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled value="http://mydomain.com/images/image4.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="4">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/gallery/5s.jpg">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled value="http://mydomain.com/images/image5.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="5">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/gallery/6s.jpg">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled value="http://mydomain.com/images/image6.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="6">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/gallery/7s.jpg">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled value="http://mydomain.com/images/image7.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="7">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!-- end tab #4-->
                    </div>
            </div>
        </div>
    </div>

    <div class="row my-3">
        <div class="col-md-12">
            <div class="text-right">
                <button type="submit" class="btn btn-primary" id="btn_send" style="font-size:16px"> Cadastrar Produto</button>
            </div>
        </div>
    </div>

    <?php
        echo form_close();
    ?>
</div>

<!-- popper -->
<script src="<?=base_url();?>assets/client/template/js/popper.min.js"></script>

<!-- ckeditor5 -->
<script src="<?=base_url();?>assets/client/template/js/plugins/ckeditor5/ckeditor.js"></script>
<script src="<?=base_url();?>assets/client/template/js/plugins/ckeditor5/translations/pt-br.js"></script>

<!-- TouchSpin -->
<script src="<?=base_url();?>assets/client/template/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

<!-- Typehead -->
<script src="<?=base_url();?>assets/client/template/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>

<!-- inputmask -->
<script src="<?=base_url();?>assets/client/template/js/plugins/inputmask/dist/jquery.inputmask.min.js"></script>

<!-- Image cropper -->
<link href="<?=base_url();?>assets/client/template/css/plugins/cropper/cropper.min.css" rel="stylesheet">
<script src="<?=base_url();?>assets/client/template/js/plugins/cropper/cropper.min.js"></script>

<!-- sortable -->
<script src="<?=base_url();?>assets/client/template/js/jquery-ui.js"></script>

<!-- pages -->
<script src="<?=base_url();?>assets/client/pages/product/js/ckeditor5.js"></script>

<script src="<?=base_url();?>assets/client/pages/product/js/sortable.js"></script>
<link href="<?=base_url();?>assets/client/pages/product/css/sortable.css" rel="stylesheet">

<script src="<?=base_url();?>assets/client/pages/product/js/cropper.js"></script>
<script src="<?=base_url();?>assets/client/pages/product/js/chosen.js"></script>
<script src="<?=base_url();?>assets/client/pages/product/js/touchspin.js"></script>

<script src="<?=base_url();?>assets/client/pages/product/js/calcprice.js"></script>

<script src="<?=base_url();?>assets/client/pages/product/js/load-data-measurements.js"></script>
<script src="<?=base_url();?>assets/client/pages/product/js/load-data-product-categories.js"></script>


<script src="<?=base_url();?>assets/client/pages/product/js/save-image.js"></script>
<script src="<?=base_url();?>assets/client/pages/product/js/send-form.js"></script>

<script src="<?=base_url();?>assets/client/pages/util/js/util.js"></script>
<script src="<?=base_url();?>assets/client/pages/util/js/inputmask.js"></script>