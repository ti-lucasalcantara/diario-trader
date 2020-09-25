var base_url = window.origin+'/'+window.location.pathname.split('/')[1]+"/";

$.ajax({
    url: base_url+"product-categories/show/",
    beforeSend: function() {
    },
    success: function( data ) {
        $("#categories").empty().append("<option disabled>Selecione</option>");
        $.each(data, function(i, item) {
            $("#categories").append("<option value="+item.id+">"+item.name+"</option>").trigger("chosen:updated");
        });
    },
})
.done(function( data ) {

})
.fail(function( data ) {

})
.always(function( data ) {

});