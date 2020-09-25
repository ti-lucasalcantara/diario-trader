var base_url = window.origin+'/'+window.location.pathname.split('/')[1]+"/";

$.ajax({
    url: base_url+"product/show/",
    beforeSend: function() {
       let add =  '<div class="col-md-3">'+
                        '    <div class="ibox">'+
                        '        <div class="ibox-content product-box">'+
                        '            <div class="product-imitation">'+
                        '                <img class="product-image-cover" src="#" alt="">'+
                        '            </div>'+
                        '            <div class="product-desc" style="background:rgba(220,220,220,0.5);">'+
                        '                <small class="text-muted"><br></small>'+
                        '                <a href="#" class="product-name text-center"><i class="fa fa-spinner fa-spin"></i></a>'+
                        '                <div class="small m-t-xs"><br></div>'+
                        '            </div>'+
                        '        </div>'+
                        '    </div>'+
                        '</div>';
        $(".list_products").append(add);
    },
    success: function( data ) {
        $(".list_products").empty();
        $.each(data, function(i, item) {

            let add =  '<div class="col-md-3">'+
                        '    <div class="ibox">'+
                        '        <a href="'+base_url+'product/edit/'+item.id+'">'+
                        '           <div class="ibox-content product-box">'+
                        '            <div class="product-imitation">'+
                        '                <img class="product-image-cover" src="#" alt="">'+
                        '            </div>'+
                        '            <div class="product-desc">'+
                        '                <span class="product-star-offer">'+
                        '                    <i class="fa fa-star"></i>'+
                        '                </span>'+
                        '                <span class="product-price-purchase" style="top:-112px">'+
                        '                    3'+
                        '                </span>'+
                        '                <span class="product-price-offer" style="top:-72px">'+
                        '                    <s>4</s>'+
                        '                </span>'+
                        '                <span class="product-price">'+
                        '                    5'+
                        '                </span>'+
                        '                <small class="text-muted">'+item.product_categories_name+'</small>'+
                        '                <a href="#" class="product-name">'+item.name+'</a>'+
                        '                <div class="small m-t-xs">'+item.description+'</div>'+
                        '            </div>'+
                        '        </div>'+
                        '       </a>'+
                        '    </div>'+
                        '</div>';
                        
            $(".list_products").append(add);
        });
    },
})
.done(function( data ) {

})
.fail(function( data ) {

})
.always(function( data ) {

});