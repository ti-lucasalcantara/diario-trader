
$(function(){

   $("#client_name").keyup(function(e){
    let value = $(this).val();
    showByParams('name', value, "#client_name")
   });

   function showByParams(rule, value, input) {
        var base_url = window.origin+'/'+window.location.pathname.split('/')[1]+"/";

        $.ajax({
            url: base_url+"client/show-params/",
            data: rule+'='+value,
            type: 'POST',
            beforeSend: function() {

            },
            success: function( data ) {
                $(".list_clients").empty();
                $.each(data, function(i, item) {

                    if ( item.avatar === null){
                        item.avatar = base_url+'assets/client/template/img/avatar/default_man.png';
                    }

                    let add =   '<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">'+
                                '    <div class="contact-box center-version">'+
                                '        <a href="'+base_url+'client/edit/'+item.id+'">'+
                                '            <img alt="avatar" class="rounded-circle" src="'+item.avatar+'" style="box-shadow: 3px 3px 10px 1px rgba(0, 0, 0, 0.2);">'+
                                '            <h3 class="m-b-xs"><strong>'+item.name+'</strong></h3>'+
                                '            <address class="m-t-md">'+
                                '                San Francisco, CA 94107<br>'+
                                '            '+item.phone+
                                '            </address>'+
                                '        </a>'+
                                '        <div class="contact-box-footer">'+
                                '            <div class="m-t-xs btn-group">'+
                                '                <a href="#"  class="btn btn-xs btn-white mr-2 py-2" style="background:#34af23; color:#FFFFFF; border-radius:40px; width:120px;"><i class="fa fa-whatsapp"></i> Whatsapp</a>'+
                                '            </div>'+
                                '        </div>'+
                                '    </div>'+
                                '</div>';
                                
                    $(".list_clients").append(add);
                });
            },
        })
        .done(function( data ) {
        
        })
        .fail(function( data ) {
        
        })
        .always(function( data ) {
            if ( data.length === 0){
                $(".list_clients").empty();
                let add =   '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">'+
                            '    <div class="text-center center-version mt-3 mb-5">'+
                            '       Nenhum resultado encontrado.<br>'+
                            '    </div>'+
                            '</div>';
                $(".list_clients").append(add);

            }
        });

   }




});