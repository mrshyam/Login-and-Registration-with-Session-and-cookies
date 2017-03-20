/**
 * Created by MrShyAm on 3/15/2017.
 */

/******************  Registration check *******************/
function check() {
    var fName=document.getElementById('fName').value;
    var lName=document.getElementById('lName').value;
    var email=document.getElementById('email').value;
    var mobile=document.getElementById('mobile').value;
    var password=document.getElementById('password').value;
    var confirmPassword=document.getElementById('confirmPassword').value;
    var address=document.getElementById('address').value;

    if(fName=="" || lName=="" || email=="" || mobile=="" || password==""  || confirmPassword==""  || address==""){
        alert("Fill all field values");
        return false;
    }
    else if(mobile.length!==10){
        alert("Mobile should be of 10 number");
        return false;
    }
    else if(password.length<4){
        alert("Password must be more than 4 character ");
        return false;
    }
    else if(password!=confirmPassword){
        alert("Password does not match");
        return false;
    }
    return true;
}

/******************** Update check *******************************/
