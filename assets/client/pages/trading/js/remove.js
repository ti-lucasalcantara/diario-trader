

$(".btn_remove").click(function(e){
    e.preventDefault();
    
    let id              = $(this).attr('id');
    let selected_date   = $(this).attr('selected_date');

    swal({
        title: "Confirma a operação?",
        text: "Essa operação não poderá ser revertida. Confirma a exclusão? ",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Excluir",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }, function () {
        if( isNaN(id) ){
            swal("Error!", "Houve um error ao executar a operação. Tente novamente.", "error");
        }else{
            remove(id, selected_date);
        }
    });

}); 


function remove(id, redirect) {

    //$("#btn_remove").prop('disabled',true).html("<i class='fa fa-spinner fa-spin'></i> Aguarde...");

    var base_url    = window.origin+'/'+window.location.pathname.split('/')[1]+"/";
    var form_data   = 'id='+id;

    $.ajax({
        type: 'POST',
        url: base_url+"trading/delete",
        data: form_data,  
        dataType: "json", 
        beforeSend: function() {
           // console.log('beforeSend delete a', base_url);
        },
        success: function( data ) {
            // console.log(data);
            swal({
                title: data.response_title,
                text: data.response_message,
                type: data.response_type,
            }, function(){
                window.location.href = base_url+"trading/date/"+redirect;
            });
        },
    })
    .done(function( data ) {
        // console.log('done');
    })
    .fail(function( data ) {
        toastr.warning('Error ao tentar enviar dados','Falha ao comunicar com o servidor');
    })
    .always(function( data ) {
        /*
        toastr.options = {
            closeButton: true,
            progressBar: true,
            preventDuplicates: true,
            timeOut: 2000,
        }
        if(data.response_type){
            toastr[data.response_type](data.response_message,data.response_title);
        }
        */
    });
}