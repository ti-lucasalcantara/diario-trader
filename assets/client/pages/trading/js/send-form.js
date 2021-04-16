$("#form").attr('autocomplete','off');

$("#form").submit(function(){
    $("#btn_send").prop('disabled',true).html("<i class='fa fa-spinner fa-spin'></i> Aguarde...");
});  


/* 
$("#form").submit(function(e){
    e.preventDefault();

    $("#btn_send").prop('disabled',true).html("<i class='fa fa-spinner fa-spin'></i> Aguarde...");

    var base_url    = window.origin+'/'+window.location.pathname.split('/')[1]+"/";
    var form_data   = new FormData( document.getElementById('form') );

    $.ajax({
        type: 'POST',
        url: base_url+"trading/insert/",
        data: form_data,  
        enctype: 'multipart/form-data',
        dataType: "json", 
        processData: false,
        contentType: false,
        beforeSend: function() {
           // console.log('beforeSend save');
        },
        success: function( data ) {
            // console.log(data);
            $.each($("input, textarea, select"), function (i, input) {
                let input_name = input.getAttribute('name');
                if(input_name != null){
                    $("input[name='"+input_name+"']").removeClass('is-invalid');
                    $("#error_"+input_name).html('');
                }
            });

            if(data.response_type == 'error'){
                $.each(data, function (input_name, message_error ){
                    $("input[name='"+input_name+"']").addClass('is-invalid');
                    $("#error_"+input_name).html(message_error);
                });
            }
            else if(data.response_type == 'warning'){
             
            }
            else if(data.response_type == 'success'){ 

                swal({
                    title: data.response_title,
                    text: data.response_message,
                    type: "success"
                }, function(){
                    window.location.href = data.response_redirect;
                });

            }

        },
    })
    .done(function( data ) {
        // console.log('done');
    })
    .fail(function( data ) {
        toastr.warning('Error ao tentar enviar dados','Falha ao comunicar com o servidor');
    })
    .always(function( data ) {
        console.log('always', data);

        toastr.options = {
            closeButton: true,
            progressBar: true,
            preventDuplicates: true,
            timeOut: 2000,
        }
        if(data.response_type){
            toastr[data.response_type](data.response_message,data.response_title);
        }
        
        $("#btn_send").prop('disabled',false).html("<i class='fa fa-check'></i> Salvar Trading");
    });

});  
*/