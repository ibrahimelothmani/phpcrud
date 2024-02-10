function verify() {
    nom = document.getElementById('form2Example1').value;
    pass = document.getElementById('form2Example2').value;

    if(nom==""){
        alert("Please put your name");
        return false;
        
    }  else if (isNaN(nom)){
        alert("Incorrect username");
        return false;
    }

    if(pass==""){
        alert("Please Put your password");
        return false;
    }else if (!isNaN(pass)){
        alert("Password Incorrect");
        return false;
    }

    return true;
}

verify();