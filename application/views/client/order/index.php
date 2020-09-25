<!-- FooTable -->
<link href="<?=base_url();?>assets/client/template/css/plugins/footable/footable.core.css" rel="stylesheet">

<!-- FooTable -->
<script src="<?=base_url();?>assets/client/template/js/plugins/footable/footable.all.min.js"></script>


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>This is main title</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">This is</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Breadcrumb</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            <a href="<?=base_url()?>order/create" class="btn btn-primary col-md-2"><i class="fa fa-plus"></i> Criar Venda</a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content">
    
<div class="ibox-content m-b-sm border-bottom ecommerce">

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label class="col-form-label" for="product_name">Product Name</label>
                <input type="text" id="product_name" name="product_name" value="" placeholder="Product Name" class="form-control">
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label class="col-form-label" for="price">Price</label>
                <input type="text" id="price" name="price" value="" placeholder="Price" class="form-control">
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label class="col-form-label" for="quantity">Quantity</label>
                <input type="text" id="quantity" name="quantity" value="" placeholder="Quantity" class="form-control">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="col-form-label" for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="1" selected>Enabled</option>
                    <option value="0">Disabled</option>
                </select>
            </div>
        </div>
    </div>

    </div>

    <div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">

                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                    <thead>
                    <tr>

                        <th data-toggle="true">Product Name</th>
                        <th data-hide="phone">Model</th>
                        <th data-hide="all">Description</th>
                        <th data-hide="phone">Price</th>
                        <th data-hide="phone,tablet" >Quantity</th>
                        <th data-hide="phone">Status</th>
                        <th class="text-right" data-sort-ignore="true">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    for ($i=0; $i < 150; $i++) { 
                    ?>
                    <tr>
                        <td>
                            Example product <?=$i?>
                        </td>
                        <td>
                            Model 1
                        </td>
                        <td>
                            It is a long established fact that a reader will be distracted by the readable
                            content of a page when looking at its layout. The point of using Lorem Ipsum is
                            that it has a more-or-less normal distribution of letters, as opposed to using
                            'Content here, content here', making it look like readable English.
                        </td>
                        <td>
                            $50.00
                        </td>
                        <td>
                            1000
                        </td>
                        <td>
                            <span class="label label-primary">Enable</span>
                        </td>
                        <td class="text-right">
                            <div class="btn-group">
                                <button class="btn-white btn btn-xs">View</button>
                                <button class="btn-white btn btn-xs">Edit</button>
                            </div>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>

                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="6">
                            <ul class="pagination float-right"></ul>
                        </td>
                    </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
    </div>


</div>


<script>
    $(document).ready(function() {

        $('.footable').footable();

    });

</script>