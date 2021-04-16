
$(".touchspin_quantity").TouchSpin({
    min: 0,
    max: 999999999,
    step: 1,
    decimals: 0,
    boostat: 5,
    maxboostedstep: 10,
    buttondown_class: 'btn btn-white',
    buttonup_class: 'btn btn-white'
});

$(".touchspin_percent").TouchSpin({
    min: 0,
    max: 999999999,
    step: 0.01,
    decimals: 2,
    boostat: 5,
    maxboostedstep: 100,
    buttondown_class: 'btn btn-white',
    buttonup_class: 'btn btn-white'
});
