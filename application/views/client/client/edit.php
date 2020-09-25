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
                <strong><?=$client->name ?? '-';?></strong>
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
        
    <div class="animated fadeInRight">
    <?php
        $attributes = array('class' => 'form-horizontal', 'id' => 'form', 'enctype' => 'multipart/form-data');
        echo form_open('client/save', $attributes);
    ?>
        <input type="hidden" name="client_id" id="client_id" value="<?=$client->id?>">
        
        <div class="row">
            <div class="col-md-3">
                <div class="ibox ">
                    <div class="ibox-title">
                    <h5 style="font-size:16px;">
                        <input type="text" name="name" class="form-control" value="<?=$client->name ?? '-';?>">
                    </h5>
                    </div>
                    <div>
                        <div class="ibox-content no-padding border-left-right" style="width: 100%; height: 250px; text-align:center;">
                            <img alt="image" class="img-fluid" src="<?=$client->avatar ?? base_url().'assets/client/template/img/avatar/default_woman.png';?>" style="height: 250px; overflow: hidden;">
                        </div>
                        <div class="ibox-content profile-content">
                            

                            <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
                            <h5>Observações:</h5>
                            <p><?=$client->description ?? '-';?></p>
                        
                            <div class="user-button">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary btn-sm btn-block" style="background:#34af23; color:#FFFFFF; border-radius:40px;"><i class="fa fa-whatsapp"></i> Whatsapp</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ibox-footer text-center">
                    <button type="button" id="btn_remove" class="btn btn-danger btn-xs col-md-7 mt-1">Remover</button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-9">
        
                <div class="tabs-container">
                    <ul class="nav nav-tabs" role="tablist">
                        <li><a class="nav-link active" data-toggle="tab" href="#tab-feed"> Feed</a></li>
                        <li><a class="nav-link" data-toggle="tab" href="#tab-purchased"> Produtos Adquiridos</a></li>
                        <li><a class="nav-link" data-toggle="tab" href="#tab-financial-position"> Status Financeiro</a></li>
                    </ul>
                    <div class="tab-content">

                        <div role="tabpanel" id="tab-feed" class="tab-pane active">
                            <div class="panel-body">

                                <strong>Lorem ipsum dolor sit amet, consectetuer adipiscing</strong>

                                <div class="ibox-content inspinia-timeline">
                                    <div>
                                    <?php
                                        for ($i=0; $i < 3 ; $i++) { 
                                    ?>
                                    <div class="timeline-item">
                                        <div class="row">
                                            <div class="col-3 date">
                                                <i class="fa fa-file-text"></i>
                                                7:00 am
                                                <br/>
                                                <small class="text-navy">3 hour ago</small>
                                            </div>
                                            <div class="col-7 content">
                                                <p class="m-b-xs"><strong>Send documents to Mike</strong></p>
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                    </div>

                                   
                                    <div class="timeline-item">
                                        <div class="row">
                                            <div class="col-3 date">
                                                <i class="fa fa-user    "></i>
                                                <?=date('d/m/Y', strtotime($client->created_at));?>
                                                <br>
                                                <?=date('H:i', strtotime($client->created_at));?>h
                                            </div>
                                            <div class="col-7 content">
                                                <p class="m-b-xs"><strong>Cadastro do Cliente</strong></p>
                                                <p>Cadadastro de <b><?=$client->name?></b></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        
                        <div role="tabpanel" id="tab-purchased" class="tab-pane">
                            <div class="panel-body">
                                <strong>Donec quam felis</strong>

                                <div class="ibox">
                                    <div class="ibox-title"><h5>Hover Table</h5></div>
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table shoping-cart-table">
                                                <tbody>
                                                    <tr>
                                                        <td width="90" class="text-center">
                                                            <div class="product-imitation-purchased">
                                                                <img class="product-image-cover-purchased" src="<?=base_url()?>uploads/client/123123/products/1/p1.jpeg" alt="">
                                                            </div>
                                                            20/08/2020
                                                            <br> 
                                                            #217
                                                        </td>
                                                        <td class="desc">
                                                            <h3><a href="#" class="text-navy" id="cart_product_name">asdadsdd</a></h3>
                                                            <p class="small" id="cart_product_description">dadsdsadsadsdsadsadsadsadsadsaddasasd</p>
                                                        </td>
                                                        <td>QTD.: 01 </td>
                                                        <td>R$ 190,90</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div role="tabpanel" id="tab-financial-position" class="tab-pane">
                            <div class="panel-body">
                                <strong>Financerio quam felis</strong>

                                <div class="ibox">
                                    <div class="ibox-title">
                                        <h5>Hover Table  </h5>
                                    </div>
                                    <div class="ibox-content table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Venda</th>
                                                    <th>Parcela</th>
                                                    <th>Valor</th>
                                                    <th>Vencimento</th>
                                                    <th>Pagamento</th>
                                                    <th></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td><a href="#" class="link">#217</a></td>
                                                    <td>1/3</td>
                                                    <td>R$ 199,90</td>
                                                    <td>01/10/2020</td>
                                                    <td> 01/10/2020 - R$ 150,00 <br> 10/10/2020 - R$ 49,90 </td>
                                                    <td><span class="label label-primary">pago</span></td>
                                                </tr>
                                                <tr>
                                                    <td>#217</td>
                                                    <td>2/3</td>
                                                    <td>R$ 199,90</td>
                                                    <td>01/10/2020</td>
                                                    <td> 01/10/2020 - R$ 150,00 </td>
                                                    <td><span class="label label-warning">pago parcial</span></td>
                                                </tr>
                                                <tr>
                                                    <td>#217</td>
                                                    <td>3/3</td>
                                                    <td>R$ 199,90</td>
                                                    <td>01/11/2020</td>
                                                    <td>-</td>
                                                    <td></td>
                                                </tr>
                                                <tr style="background:rgba(217, 83, 79,0.2);">
                                                    <td>#212</td>
                                                    <td>3/3</td>
                                                    <td>R$ 199,90</td>
                                                    <td>01/08/2020</td>
                                                    <td>-</td>
                                                    <td><span class="label label-danger">vencido</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
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
        

</div>    



<script src="<?=base_url();?>assets/client/pages/client/js/remove.js"></script>