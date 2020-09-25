$(function(){

   $("#product_name").change(function(e){
    let value = $(this).val();
    getAttr(value);
   });

   function getAttr(product_id) {
    if(product_id > 0){

        var base_url = window.origin+'/'+window.location.pathname.split('/')[1]+"/";

        $.ajax({
            type: "GET",
            method: 'GET',
            url: base_url+"product/show/"+product_id,
            dataType: 'JSON',

            beforeSend: function(){
                console.log('beforeSend');
            },
            success: function(res){
                console.log('success', res);
                $("#product_price").val( res.price.replace('.',',') );
                $("#product_stock").val(res.stock);
                $("#product_quantity").val('');
                $("#product_total").val('');
                $('#product_quantity').focus();
            }

        }).done(function( res ) {
            console.log('done',res);

        }).fail(function(res) {
            $("#product_price").val('');
            $("#product_stock").val('');
            $("#product_quantity").val('');
            $("#product_total").val('');
            console.log('fail', res);

        }).always(function( res ) {
            console.log('always', res);
        });


    }

   }


});