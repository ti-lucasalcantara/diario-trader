$(function(){
    
    $(".mask_phone").inputmask({"mask": "(99) 9999[9]-9999"});
    
    $(".mask_phone").change(function(){
        let phone = $(this).val().replace(/([^\d])+/gim, '');
        if(phone.length == 10){
            $(this).val( "("+phone.substr(0, 2)+") "+phone.substr(2, 4)+"-"+phone.substr(6, 4) );
        }
    });

    $(".mask_currency").inputmask('currency',{"autoUnmask": true,
        radixPoint:",",
        groupSeparator: ".",
        allowMinus: false,
        prefix: 'R$ ',            
        digits: 2,
        digitsOptional: false,
        rightAlign: true,
        unmaskAsNumber: true
    });

    $(".mask_currency_without_prefix").inputmask('currency',{"autoUnmask": true,
        radixPoint:",",
        groupSeparator: ".",
        allowMinus: false,        
        digits: 2,
        digitsOptional: false,
        rightAlign: true,
        unmaskAsNumber: true
    });

    $(".mask_cpf").inputmask({"mask": "999.999.999-99"});

    $(".mask_hour").inputmask({ alias: "datetime", inputFormat: "HH:MM:ss", placeholder: 'hh:mm:ss'});

});