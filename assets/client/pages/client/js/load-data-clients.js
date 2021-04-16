var base_url = window.origin+'/'+window.location.pathname.split('/')[1]+"/";

$.ajax({
    url: base_url+"client/show/",
    beforeSend: function() {
       let add =    '<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">'+
                    '    <div class="contact-box center-version">'+
                    '        <a href="#">'+
                    '            <img alt="image" class="rounded-circle" src="'+base_url+'assets/client/template/img/avatar/default_man.png">'+
                    '            <h3 class="m-b-xs"><strong></strong></h3>'+
                    '            <div class="font-bold"></div>'+
                    '            <address class="m-t-md"></address>'+
                    '        </a>'+
                    '        <div class="contact-box-footer">'+
                    '            <div class="m-t-xs btn-group"></div>'+
                    '        </div>'+
                    '    </div>'+
                    '</div>';

        for (let index = 0; index < 4; index++) {
            $(".list_clients").append(add);            
        }
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

});