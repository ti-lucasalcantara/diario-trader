function inputFocus(inputId, e) {
    let key = e.which || e.keyCode;
    if(key == 13 || key == 9){       
        e.preventDefault();
        document.getElementById(inputId).focus();
    }
}