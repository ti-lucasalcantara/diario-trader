var base_url = window.origin+'/'+window.location.pathname.split('/')[1]+"/";

$.ajax({
    url: base_url+"measurements/show/",
    beforeSend: function() {
    },
    success: function( data ) {
        $("#measurements_id").empty().append("<option disabled selected>Selecione</option>");
        $.each(data, function(i, item) {
            $("#measurements_id").append("<option value="+item.id+">"+item.name+" ("+item.short_name+")</option>").trigger("chosen:updated");
        });
    },
})
.done(function( data ) {

})
.fail(function( data ) {

})
.always(function( data ) {

});