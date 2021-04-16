$("#sortable").sortable({

    opacity: 0.6
    ,cursor: 'move'
    ,update: function( event, ui ) {
        var order = $("#sortable").sortable("serialize", { key: "img" });
        console.log('update', order);
    }
    /*
        activate: function( event, ui ) {
            console.log('activate');
        }
        ,beforeStop: function( event, ui ) {
            console.log('beforeStop');
        }
        ,change: function( event, ui ) {
            console.log('change');
        }
        ,create: function( event, ui ) {
            console.log('create');
        }
        ,deactivate: function( event, ui ) {
            console.log('deactivate');
        }
        ,out: function( event, ui ) {
            console.log('out');
        }
        ,over: function( event, ui ) {
            console.log('over');
        }
        ,receive: function( event, ui ) {
            console.log('receive');
        }
        ,remove: function( event, ui ) {
            console.log('remove');
        }
        ,sort: function( event, ui ) {
            console.log('sort');
        }
        ,start: function( event, ui ) {
            console.log('start');
        }
        ,stop: function( event, ui ) {
            console.log('stop');
        }
        ,update: function( event, ui ) {
            console.log('update');
        }
        ,update: function( event, ui ) {
            console.log('update');
        }
    */

});



$("#sortable").disableSelection();