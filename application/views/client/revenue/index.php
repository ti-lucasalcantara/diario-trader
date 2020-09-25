
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Receitas</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?=base_url()?>dashboard"><?=APPLICATION_NAME?></a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Receitas</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action"></div>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row">


        <div class="col-lg-3">
            <div class="widget ">
                <div class="row">
                    <div class="form-group" id="data_5">
                        <label class="font-bold">Período:</label>
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="form-control-sm form-control" name="start" placeholder="dd/mm/aaaa" value="01/<?=date('m/Y')?>"/>
                            <span class="my-2 px-2 font-bold">até</span>
                            <input type="text" class="form-control-sm form-control" name="end" placeholder="dd/mm/aaaa" value="<?=date('d/m/Y')?>" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="widget lazur-bg">
                <div class="row">
                    <div class="col-4">
                        <i class="fa fa-usd fa-4x mt-1"></i>
                    </div>
                    <div class="col-8 text-right">
                        <div class="my-1" style="font-size:18px">Previsto</div>
                        <h3 class="font-bold"  style="font-size:19px">R$ 81.428,48</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="widget widget-filter navy-bg">
                <div class="row">
                    <div class="col-4">
                        <i class="fa fa-usd fa-4x mt-1"></i>
                    </div>
                    <div class="col-8 text-right">
                        <div class="my-1" style="font-size:18px">Recebido</div>
                        <h3 class="font-bold"  style="font-size:19px">R$ 1.428,48</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="widget widget-filter yellow-bg">
                <div class="row">
                    <div class="col-4">
                        <i class="fa fa-usd fa-4x mt-1"></i>
                    </div>
                    <div class="col-8 text-right">
                        <div class="my-1" style="font-size:18px">A Receber</div>
                        <h3 class="font-bold"  style="font-size:19px">R$ 80.428,48</h3>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>


<style>
.filter-disabled{
    opacity: 0.4;
}
.widget-filter{
    cursor:pointer;
}
</style>

<!-- Data picker -->
<link href="<?=base_url();?>assets/client/template/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<script src="<?=base_url();?>assets/client/template/js/plugins/datapicker/bootstrap-datepicker.js"></script>


<script>

    $(function(){


        $(".widget-filter").click(function(e){
            e.preventDefault();
            $(this).toggleClass('filter-disabled');
        })


        $('#data_5 .input-daterange').datepicker({
            language: 'pt-BR',
            format: 'dd/mm/yyyy',
            keyboardNavigation: true,
            forceParse: false,
            autoclose: true,
        });
        
    });
</script>