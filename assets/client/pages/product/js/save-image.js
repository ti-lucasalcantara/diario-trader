
$("#save-image").click(function(e){
    e.preventDefault();

    // https://developer.mozilla.org/en-US/docs/Web/API/HTMLCanvasElement/toBlob
    // https://developer.mozilla.org/en-US/docs/Web/API/FormData
        
    //var image = $("#image-cropper");
    //let a = image.cropper("getCroppedCanvas");
    //console.log( a );
    
    // Upload cropped image to server if the browser supports `HTMLCanvasElement.toBlob`
    /*
    $().cropper('getCroppedCanvas').toBlob(function (blob) {
        var formData = new FormData();
    
        formData.append('croppedImage', blob);
    
        var base_url = window.origin+'/'+window.location.pathname.split('/')[1]+"/";

        $.ajax({
            type: 'POST',
            url: base_url+"product/save-image",
            data: formData,  
            dataType: "json",
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            beforeSend: function() {
                console.log('beforeSend save image');
            },
            success: function( data ) {
                console.log('success', data);
            },
        })
        .done(function( data ) {
            console.log('done');
        })
        .fail(function( data ) {
            console.log('fail');
        })
        .always(function( data ) {
            console.log('always');
        });
    });
    */

    
    /*
    var promise = createFile( $("#image-cropper").attr('src') );

    promise.then(function (value) {

        let files = value;
        let fd = new FormData();
        fd.append('files', files);

        var base_url = window.origin+'/'+window.location.pathname.split('/')[1]+"/";

        $.ajax({
            type: 'POST',
            url: base_url+"product/save-image",
            data: fd,  
            dataType: "json",
            enctype: "multipart/form-data",
            beforeSend: function() {
                console.log('beforeSend save image');
            },
            success: function( data ) {
                console.log('success', data);
            },
        })
        .done(function( data ) {
            console.log('done');
        })
        .fail(function( data ) {
            console.log('fail');
        })
        .always(function( data ) {
            console.log('always');
        });

    });
    */

});


async function createFile( path_file ){
    let response = await fetch(path_file);
    let data     = await response.blob;
    let metadata = {type: 'image/jpeg'};
    let file     = new File([data], 'filename.jpeg', metadata);
    return file;
}


