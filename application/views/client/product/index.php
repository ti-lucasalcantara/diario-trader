
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
            <a href="<?=base_url()?>product/create" class="btn btn-primary col-md-2"><i class="fa fa-plus"></i> ADD Produto</a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content">

    <div class="ibox-content m-b-sm border-bottom">
        <div class="row" style="display:flex; align-items: center; ">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-form-label" for="product_name">Produto</label>
                    <input type="text" id="product_name" name="product_name" value="" placeholder="Nome do produto" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-form-label" for="product_name">Categoria</label>
                    <select data-placeholder="Categoria" class="chosen-select" multiple tabindex="4">
                        <option value="United States">United States</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="Afghanistan">Afghanistan</option>
                        <option value="Aland Islands">Aland Islands</option>
                        <option value="Albania">Albania</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">        
            <div class="offset-md-10 col-sm-2 text-right">
                <button class="btn btn-success right-sidebar-toggle"><i class="fa fa-filter"></i> Filtros</button>
            </div>
        </div>

    </div>

    <div class="row list_products">
    </div><!-- row -->
    
</div>


<?php
    $this->load->view('client/product/sidebar_filter');
?>

<script src="<?=base_url();?>assets/client/pages/product/js/load-data-products.js"></script>

<script>
    $(function(){
        $('.chosen-select').chosen({width: "100%"});

    });
</script>
