
<style>
.quick-bar{
  bottom: 0;
  left: 100;
  padding: 10px;
  position: fixed;
  right: 0;
  margin: 40px 15px;
}

.input-date{
    background:none;

    text-align:center;
    font-size: 1.3em;
    color: #069;
    border: 1px dotted #858585;
    border-radius: 10px;
    outline: 0; 
}


.input-date:focus{
    box-shadow: 0 0 0 0; 
    outline: 0; 
}

</style>

         
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?=$title_page?></h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#"><?=APPLICATION_NAME?></a>
            </li>
            <li class="breadcrumb-item active">
                <strong><?=$title_page?></strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <a href="<?=base_url()?>trading/create/<?=str_replace('/','-', $selected_date);?>" class="btn btn-success col-md-3"><i class="fa fa-plus"></i> Novo Trading</a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title" style="background:rgba(220,220,220,0.5); margin: 0 !important; padding: 0 !important;">
                        <div class="px-5 py-1" style="display:flex; flex-direction: row; justify-content:space-between; align-items:center; align-content:center;">
                            <div>
                                <a href="<?=base_url()?>trading/date/<?=$previus_date?>"><i class="fa fa-chevron-left" style="font-size:1.5em;"></i></a>
                            </div>     
                            <div>
                                <h1 class="no-margins text-center" style="font-size:2.5em;">
                                    <?=$day_of_week;?>
                                </h1>
                                <div id="date">
                                    <div class="input-group date" style="display:flex; flex-direction: row; justify-content:center; align-items:center; align-content:center;">
                                        <div >
                                            <span class="input-group-addon" style="display:none"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <div>
                                            <input type="text" class="input-date" name="date" value="<?=$selected_date;?>">
                                        </div>
                                    </div>
                                </div>
                            </div>     
                            <div>
                            <a href="<?=base_url()?>trading/date/<?=$next_date?>"><i class="fa fa-chevron-right" style="font-size:1.5em;"></i></a>
                            </div>   

                        </div>  
                    </div>
                    <?php
                    if(sizeof($tradings) > 0){
                    ?>
                    <div class="ibox-content">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 text-right mb-3"><button class="btn btn-default btn-xs" id="toggle_price" value='hide'><i class="fa fa-eye-slash"></i> Ocultar Valores</button></div>
                                <div class="col-md-12" >
                                    <table class="table text-center " >
                                        <thead>
                                            <tr>
                                                <th>Operação</th>
                                                <th>Pontuação</th>
                                                <th>Entrada</th>
                                                <th>Saída</th>
                                                <th>Duração</th>
                                                <th class="result_price">Contratos</th>
                                                <th class="result_price">Valor Bruto</th>
                                                <th class="result_price">Taxas/Corretagem</th>
                                                <th class="result_price">Valor Liquído</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <td colspan='11' class="text-right"><small>Operações: <?=str_pad(sizeof($tradings), 2, '0', STR_PAD_LEFT);?></small></td>
                                            </tr>
                                        </tfoot>
                                    
                                        <tbody>
                                            <?php
                                                $total_points = $total_points_gain = $total_points_loss = 0;
                                                $total_gross_value = $total_gross_value_gain = $total_gross_value_loss = 0;
                                                $total_tax = 0;
                                                $total_net_value = 0;

                                                foreach ($tradings as $trading) {
                                            ?>
                                            <tr>
                                               
                                                <td><?=$trading->command?></td>
                                                <td><label class="badge badge-<?=$trading->points > 0 ? 'primary' : 'danger' ?> py-2 px-4"><?=number_format($trading->points, 2, '.', '.' );?> pts</label></td>
                                                <td><?=number_format($trading->price_in, 2, ',', '.' )?><br><?=$trading->hour_in?></td>
                                                <td><?=number_format($trading->price_out, 2, ',', '.' )?><br><?=$trading->hour_out?></td>
                                                <td><?=$trading->duration?></td>
                                                <td class="result_price"><?=$trading->number_of_papers?></td>
                                                <td class="result_price" style="color:<?=$trading->gross_value > 0 ? 'rgb(40,178,148)' : 'rgb(235,87,104)' ?>">R$ <?=number_format($trading->gross_value, 2, ',', '.' )?></td>
                                                <td class="result_price" style="color:rgb(235,87,104)">R$ -<?=number_format($trading->tax, 2, ',', '.' )?></td>
                                                <td class="result_price" style="color:<?=$trading->net_value > 0 ? 'rgb(40,178,148)' : 'rgb(235,87,104)' ?>">R$ <?=number_format($trading->net_value, 2, ',', '.' )?></td>
                                                <td>
                                                <a href="<?=base_url()?>trading/edit/<?=$trading->id?>" style="cursor:pointer; color:#858585" class="fa fa-search"></a> 
                                                </td>
                                                <td><a style="cursor:pointer; color:#858585"  id="<?=$trading->id?>" selected_date="<?=str_replace('/','-', $selected_date);?>" class="fa fa-trash btn_remove"></a></td>   
                                            </tr>
                                            <?php
                                                    if($trading->points > 0 ){
                                                        $total_points_gain += $trading->points;
                                                    }else{
                                                        $total_points_loss += $trading->points;
                                                    }   

                                                    if($trading->gross_value > 0 ){
                                                        $total_gross_value_gain += $trading->gross_value;
                                                    }else{
                                                        $total_gross_value_loss += $trading->gross_value;
                                                    }  

                                                    $total_points       += $trading->points;
                                                    $total_gross_value  += $trading->gross_value;
                                                    $total_tax          += $trading->tax;
                                                    $total_net_value    += $trading->net_value;
                                                }
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="ibox-footer">
                        <div class="row text-center" style="display:flex; justify-content:center;">
                            <div class="my-3 px-5 text-center">
                                <table class="table table-responsive" style="font-size:14px;">
                                    <tr>
                                        <td>Pontuação GAIN</td>
                                        <td class="text-center" style="color:<?=$total_points_gain >= 0 ? 'rgb(40,178,148)' : 'rgb(85,85,85)' ?>"> <?=number_format($total_points_gain, 2, '.', '.' );?> pts</td>
                                        <td class="text-center result_price" style="color:<?=$total_gross_value_gain >= 0 ? 'rgb(40,178,148)' : 'rgb(85,85,85)' ?>"> R$ <?=number_format($total_gross_value_gain, 2, ',', '.' );?></td>
                                    </tr>
                                    <tr>
                                        <td>Pontuação LOSS</td>
                                        <td class="text-center" style="color:<?=$total_points_loss >= 0 ? 'rgb(85,85,85)' : 'rgb(235,87,104)' ?>"> <?=number_format($total_points_loss, 2, '.', '.' );?> pts</td>
                                        <td class="text-center result_price" style="color:<?=$total_gross_value_loss >= 0 ? 'rgb(85,85,85)' : 'rgb(235,87,104)' ?>"> R$ <?=number_format($total_gross_value_loss, 2, ',', '.' );?></td>
                                    </tr>
                                    <tr style="font-size:18px;">
                                        <td class="text-right">>> Saldo</td>
                                        <td class="text-center" style="color:<?=$total_points > 0 ? 'rgb(40,178,148)' : 'rgb(235,87,104)' ?>"> <?=number_format($total_points, 2, '.', '.' );?> pts</td>
                                        <td class="text-center result_price" style="color:<?=$total_gross_value > 0 ? 'rgb(40,178,148)' : 'rgb(235,87,104)' ?>"> R$ <?=number_format($total_gross_value, 2, ',', '.' );?></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="my-3 px-5 text-center result_price">
                                <table class="table table-responsive" style="font-size:14px;">
                                    <tr>
                                        <td class="text-right">Total Bruto</td>
                                        <td class="text-center" style="color:<?=$total_gross_value > 0 ? 'rgb(40,178,148)' : 'rgb(235,87,104)' ?>"> R$ <?=number_format($total_gross_value, 2, ',', '.' );?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Taxas/Corretagens</td>
                                        <td class="text-center" style="color:<?=$total_tax <= 0 ? 'rgb(85,85,85)' : 'rgb(235,87,104)' ?>"> R$ -<?=number_format($total_tax, 2, ',', '.' );?></td>
                                    </tr>
                                    <tr style="font-size:18px;">
                                        <td class="text-right" style="color:<?=$total_net_value > 0 ? 'rgb(40,178,148)' : 'rgb(235,87,104)' ?>">>> Total Liquído</td>
                                        <td class="text-center" style="color:<?=$total_net_value > 0 ? 'rgb(40,178,148)' : 'rgb(235,87,104)' ?>"> R$ <?=number_format($total_net_value, 2, ',', '.' );?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>


                    </div>  
                    <?php
                    }else{
                    ?>          
                    <div class="ibox-content">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 text-center my-5 py-2">
                                    Nenhuma Operação Cadastrada
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>          

                </div>
            </div>
        </div>

    </div>
</div>


<!-- Data picker -->
<link href="<?=base_url();?>assets/client/template/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<script src="<?=base_url();?>assets/client/template/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<script src="<?=base_url();?>assets/client/pages/trading/js/remove.js"></script>


<script>
    $(function(){
        $('#date .input-group.date').datepicker({
            language: 'pt-BR',
            format: 'dd/mm/yyyy',
            keyboardNavigation: true,
            forceParse: false,
            autoclose: true,
            todayHighlight: true, 
        });       

        $("#toggle_price").click(function(e){
            togglePrice( $("#toggle_price").val() );
        });

        function togglePrice( value ) {
            if(value == 'show'){
                $("#toggle_price").val('hide') ;
                $("#toggle_price").html("<i class='fa fa-eye-slash'></i> Ocultar Valores");
                $(".result_price").show();
            } 
            if(value == 'hide'){
                $("#toggle_price").val('show') ;
                $("#toggle_price").html("<i class='fa fa-eye'></i> Mostrar Valores");
                $(".result_price").hide();
            } 
        }

        $("input[name='date']").change(function(){
            let date = $("input[name='date']").val().replace('/', '-').replace('/', '-' ); 
            var base_url = window.origin+'/'+window.location.pathname.split('/')[1]+"/";
            window.location=base_url+'trading/date/'+date;
        });

    });
</script>