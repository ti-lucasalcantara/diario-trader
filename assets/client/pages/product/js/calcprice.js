
$("#purchase_price").on("change keyup", function(){
    calcPrice();
});

$("#profit_margin").on("change keyup", function(){
    calcPrice();
});

$("#price").on("change keyup", function(){
    calcPercent();
});

function calcPrice() {

    let purchase_price  = parseFloat($("#purchase_price").val());
    let profit_margin   = parseFloat($("#profit_margin").val());
    let price           = String( purchase_price.toFixed(2) ).replace('.',',');

    if ( !(isNaN(purchase_price)) && !(isNaN(profit_margin)) ) {
        price  =  String( ( ( (purchase_price * profit_margin) / 100 ) + purchase_price ).toFixed(2)).replace('.',',');
    }

    $("#price").val(price);
}

function calcPercent() {

    let purchase_price  = parseFloat($("#purchase_price").val());
    let price           = parseFloat($("#price").val());
    let profit_margin   = ( ( ( (price / purchase_price) - 1 ) * 100 ).toFixed(2) );
    
    if( parseFloat(profit_margin) < 0 ){
        $("#profit_margin").addClass('is-invalid');
    }else{
        $("#profit_margin").removeClass('is-invalid');
    }

    if ( ! isNaN(profit_margin) ){
        $("#profit_margin").val(profit_margin); 
    }

}