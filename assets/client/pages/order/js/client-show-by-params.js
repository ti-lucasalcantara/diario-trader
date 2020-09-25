
$(function(){

   $("#client_name").keyup(function(e){
    let value = $(this).val();
    showByParams('name', value, "#client_name")
   });

   function showByParams(rule, value, input) {
    if(value.length > 0){

        var base_url = window.origin+'/'+window.location.pathname.split('/')[1]+"/";

        var fd = new FormData();
        fd.append(rule, value);

        $.ajax({
            type: "POST",
            method: 'POST',
            url: base_url+"client/show-params",
            data: fd,
            dataType: 'JSON',
            enctype:"multipart/form-data",
            contentType: false,
            processData: false,
            
            beforeSend: function(){
                console.log('beforeSend');
            },
            success: function(res){
                console.log('success', res);
            }

        }).done(function( res ) {
            console.log('done',res);

        }).fail(function(res) {
            console.log('fail', res);

        }).always(function( res ) {

            $(input).typeahead({
                source: res,
                afterSelect: function(selected){
                    $('#client_name').hide().fadeIn('fast').val(selected.name);
                    $('#client_document').hide().fadeIn('fast').val(selected.document);

                    let phone = selected.phone.replace(/([^\d])+/gim, '');
                    if(phone.length == 10){
                        $('#client_phone').hide().fadeIn('fast').val( "("+phone.substr(0, 2)+") "+phone.substr(2, 4)+"-"+phone.substr(6, 4) );
                    }else{
                        $('#client_phone').hide().fadeIn('fast').val(selected.phone);
                    }
                    nextFocus();
                }
            }); 

            console.log('always', res);
        });


    }

   }

   function nextFocus() {
        if( $('#client_name').val() == '' ){
            $('#client_name').focus();

        }else if( $('#client_document').val() == '' ){
            $('#client_document').focus();

        }else if( $('#client_phone').val() == '' ){
            $('#client_phone').focus();

        }else{
            $('#product_name').focus();
        }
   }



});