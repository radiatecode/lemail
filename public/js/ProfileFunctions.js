function showHide(elm) {
    let change= document.getElementById("change");
    if(elm.checked){
        change.classList.remove('hide');
    } else {
        change.classList.add('hide');
    }
}
function passMatch(form_name) {
    let new_pass= document.getElementById("new_pass").value;
    let confirm_pass= document.getElementById("confirm_pass").value;
    let Change= document.getElementById("change_pass");
    if(Change.checked){
        if (new_pass===""){
            swal('New Password Filed Is Empty!');
            return false;
        }else if (new_pass!==confirm_pass){
            swal('Password Does not match !');
            return false;
        }else{
            $("#"+form_name).submit();
        }
    }else{
        $("#"+form_name).submit();
    }

}