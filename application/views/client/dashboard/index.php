
<style>
.quick-bar{
  bottom: 0;
  left: 100;
  padding: 10px;
  position: fixed;
  right: 0;
  margin: 40px 15px;
}

.calendar{
    background:rgba(220,220,220,0.5);
    width:70%;
}

.day{
    background:rgba(220,220,220,0.7);
    padding: 5%;
}
.today{
    background:rgba(0, 110, 255,0.5);
    color:#FFF;

}

.heading_row_start{
    background:rgba(0, 110, 255,0.5);
}



</style>

   
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Dashboard</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?=base_url()?>dashboard"><?=APPLICATION_NAME?></a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Dashboard</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <!-- 
                <a href="<?=base_url()?>client" class="btn btn-danger col-md-2"><i class="fa fa-chevron-left"></i> Voltar</a>
            -->
        </div>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row text-center">
        <div class="col-md-6 text-center">
        <?=$calendar?>
        </div>
        <div class="col-md-6"> 
           
            <div class="text-center" style="font-size:1.5em">
                <?=$month_name?>/<?=$year?>
                <br>
                <small>14 Operações</small>
            </div>
        
            <div class="mt-4">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>GAIN</td>
                            <td>10 Operações</td>
                            <td>+ 27pts</td>
                            <td>R$ 1.293,98</td>
                        </tr>
                        <tr>
                            <td>LOSS</td>
                            <td>2 Operações</td>
                            <td>- 7pts</td>
                            <td>R$ -293,98</td>
                        </tr>
                        <tr>
                            <td>DRAW</td>
                            <td>1 Operação</td>
                            <td>0 pts</td>
                            <td>R$ -2,66</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
