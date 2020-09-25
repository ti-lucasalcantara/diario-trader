$(function(){

    $("#product_quantity").change(function(e){
        let quantity    = parseFloat($("#product_quantity").val());
        let price       = parseFloat($("#product_price").val());

        if(quantity > 0 && price > 0){
            let total = (quantity*price).toFixed(2);
            $("#product_total").val( total.replace('.',',') );
        }
    });
    
    $("#product_price").change(function(e){
        let quantity    = parseFloat($("#product_quantity").val());
        let price       = parseFloat($("#product_price").val());

        if(quantity > 0 && price > 0){
            let total = (quantity*price).toFixed(2);
            $("#product_total").val( total.replace('.',',') );
        }
    });

    $("#add_to_cart").click(function(){
        let product_id  = $("#product_name").val();
        let quantity    = parseFloat($("#product_quantity").val());
        let stock       = parseFloat($("#product_stock").val());
        let price       = $("#product_price").val();

        if(product_id === null){
            swal({
                title: "Selecione o produto",
                text: "Não é possível incluir um produto em branco.",
            });

        }else if(isNaN(quantity) || quantity === null || quantity <= 0){
            swal({
                title: "Informe a quantidade",
                text: "Não é possível incluir com a quantidade igual a zero",
            });

        }else if(quantity > stock){
            swal({
                title: "Atenção",
                text: "A quantidade informada é maior que o estoque disponível",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#2bbf9f",
                confirmButtonText: "Ok. Continuar mesmo assim",
                closeOnConfirm: true
            }, function () {
                addToCart(product_id, quantity, price);
            });
        
        }else{
            addToCart(product_id, quantity, price);
        }


    })

    function addToCart(product_id, quantity, price) {
        if(product_id > 0){
            var base_url = window.origin+'/'+window.location.pathname.split('/')[1]+"/";

            $.ajax({
                type: "GET",
                method: 'GET',
                url: base_url+"product/show/"+product_id,
                dataType: 'JSON',

                beforeSend: function(){
                    $("#add_to_cart").prop('disabled',true).html("<i class='fa fa-spinner fa-spin'></i>")
                },
                success: function(res){

                    let template_item_cart   = $("#template_item_cart");
                    let cart                 = $("#cart");

                    cart.prepend(template_item_cart.html());
                   
                    cart.find('#cart_product_id').attr('id','cart_product_id_'+res.id);
                   
                    cart.find('#cart_product_name')
                        .html(res.product)
                        .attr('id','cart_product_name_'+res.id);
                    
                    cart.find('#cart_product_description')
                        .html('descrição')
                        .attr('id','cart_product_description_'+res.id);
                       
                    console.log('price',price);
                    cart.find('#cart_product_price')
                        .val(String(price).replace('.',','))
                        .attr('id','cart_product_price_'+res.id)
                        .inputmask('currency',{"autoUnmask": true,
                            radixPoint:",",
                            groupSeparator: ".",
                            allowMinus: false,
                            prefix: 'R$ ',            
                            digits: 2,
                            digitsOptional: false,
                            rightAlign: true,
                            unmaskAsNumber: true
                        });
                    
                    cart.find('#cart_product_quantity')
                        .val(quantity)
                        .attr('name','cart_product_quantity_'+res.id)
                        .attr('id','cart_product_quantity_'+res.id)
                        .attr('onchange', 'refreshTotalProduct('+res.id+')' )
                        .TouchSpin({
                            min: 1,
                            max: 999999999,
                            step: 1,
                            decimals: 0,
                            boostat: 5,
                            maxboostedstep: 10,
                            buttondown_class: 'btn btn-white',
                            buttonup_class: 'btn btn-white'
                        });
                    
                    let total = ( parseFloat(quantity) * parseFloat(price) ).toFixed(2);
                    cart.find('#cart_product_total')
                        .val(total.replace('.',','))
                        .attr('id','cart_product_total_'+res.id)
                        .inputmask('currency',{"autoUnmask": true,
                            radixPoint:",",
                            groupSeparator: ".",
                            allowMinus: false,
                            prefix: 'R$ ',            
                            digits: 2,
                            digitsOptional: false,
                            rightAlign: true,
                            unmaskAsNumber: true
                        });
                    
                    cart.find('#cart_trash')
                        .attr('id','cart_trash_'+res.id)
                        .attr('onclick', 'removeToCart('+res.id+')' );

                    let quantity_in_cart = parseInt($("#quantity_in_cart").html()) + 1;
                    $("#quantity_in_cart").html(quantity_in_cart);

                    if( quantity_in_cart == 1 ){
                        $("#label_quantity_in_cart").html("Item");
                    }else if( quantity_in_cart > 1 ){
                        $("#label_quantity_in_cart").html("Itens");
                    }

                    refreshTotalCart();
                    console.log('success', res);
                }

            }).done(function( res ) {
                $("#add_to_cart").prop('disabled',false).html("<i class='fa fa-plus'></i>")

            }).fail(function(res) {
                console.log('fail', res);

            }).always(function( res ) {
                console.log('always', res);
            });

        }
    }
});

function removeToCart(product_id){
    if(product_id > 0){

        swal({
            title: "Confirma Exclusão",
            text: "Confirma a exclusão do produto da lista ?",
            showCancelButton: true,
            confirmButtonColor: "#2bbf9f",
            confirmButtonText: "Remover",
            closeOnConfirm: true
        }, function () {

            $("#cart").find('#cart_product_id_'+product_id).fadeOut("slow").remove();
            let quantity_in_cart = parseInt($("#quantity_in_cart").html());
            $("#quantity_in_cart").html(quantity_in_cart - 1);
            refreshTotalCart();
            
            if( quantity_in_cart == 1 ){
                $("#label_quantity_in_cart").html("Item");
            }else if( quantity_in_cart > 1 ){
                $("#label_quantity_in_cart").html("Itens");
            }

        });
    }
}

function refreshTotalProduct(product_id){
    let quantity    = $("#cart_product_quantity_"+product_id).val();
    let price       = $("#cart_product_price_"+product_id).val();
    let total       = ( parseFloat(quantity) * parseFloat(price) ).toFixed(2);

    $("#cart_product_total_"+product_id).val(total.replace('.',','));
    refreshTotalCart();
}

function refreshTotalCart(){
    let cart_total = 0;
    $("input[id*='cart_product_total_']").each(function(){
        cart_total += $(this).val();
    });
    cart_total = String(cart_total.toFixed(2)).replace('.',',');
    $("#cart_total").val(cart_total);
}