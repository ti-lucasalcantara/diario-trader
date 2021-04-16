$("#form").attr('autocomplete','off');


$("#form").submit(function(e){
    e.preventDefault();

    $("#btn_send").prop('disabled',true).html("<i class='fa fa-spinner fa-spin'></i> Aguarde...");

    var base_url = window.origin+'/'+window.location.pathname.split('/')[1]+"/";

    $.ajax({
        type: 'POST',
        url: base_url+"product/insert",
        data: $(this).serialize(),  
        dataType: "json", 
        beforeSend: function() {
            console.log('beforeSend save');
        },
        success: function( data ) {

            $.each($("input"), function (i, input) {
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
        },
    })
    .done(function( data ) {
        console.log('done');
    })
    .fail(function( data ) {
        toastr.error('error ao tentar enviar dados','Falha ao enviar');
    })
    .always(function( data ) {
        console.log('always');

        toastr.options = {
            closeButton: true,
            progressBar: true,
            preventDuplicates: true,
            timeOut: 2000,
        }
        if(data.response_type){
            toastr[data.response_type](data.response_message,data.response_title);
        }

        $("#btn_send").prop('disabled',false).html("Cadastrar Produto");
    });

}); 