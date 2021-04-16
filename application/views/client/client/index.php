
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Clientes</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?=base_url()?>dashboard"><?=APPLICATION_NAME?></a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Clientes</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <a href="<?=base_url()?>client/create" class="btn btn-primary col-md-2"><i class="fa fa-plus"></i> Novo Cliente</a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content">
    
    <div class="ibox-content m-b-sm border-bottom">
        <!-- filter -->
        <div class="row" style="display:flex; align-items: center; ">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="col-form-label" for="client_name">Cliente</label>
                    <input type="text" name="client_name" id="client_name" placeholder="Digite o nome do cliente" class="form-control" >
                </div>
            </div>
        </div>
        <!-- filter -->
    </div>

    <div class="row list_clients"></div>
</div>    


<!-- Typehead -->
<script src="<?=base_url();?>assets/client/template/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>

<!-- pages -->
<script src="<?=base_url();?>assets/client/pages/client/js/load-data-clients.js"></script>
<script src="<?=base_url();?>assets/client/pages/client/js/load-data-clients-by-params.js"></script>
