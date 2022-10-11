function passwd(){
    if(document.getElementById("password").type==="password"){
        document.getElementById("password").type="text";
    }
    else if(document.getElementById("password").type==="text"){
        document.getElementById("password").type="password";
    }
}