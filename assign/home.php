<!--/**
 * Created by PhpStorm.
 * User: MrShyAm
 * Date: 3/14/2017
 * Time: 1:06 AM
 */-->


<div class="col-md-3"></div>
<div class="col-md-6">
    <div class="modal-content container-fluid">
        <div class="modal-body">
            <div class="row">
                <!--Nav tabs-->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#Login" data-toggle="tab"> Login</a></li>
                    <li><a href="#Registration" data-toggle="tab"> Registration</a></li>
                </ul>
                <!--Tab panes-->
                <div class="tab-content">
                    <div class="tab-pane active" id="Login">
                        <form role="form" method="post" class="form-horizontal"><br>
                            <div class="form-group">
<?php

require 'config.php';
////////  Login validation ///////////
if(isset($_REQUEST['login'])){
    session_start();
    $loginEmail=$_REQUEST['loginEmail'];
    $loginPassword=$_REQUEST['loginPassword'];
    $loginResult=mysqli_query($con,"SELECT * FROM userinfo WHERE email='$loginEmail' AND password='$loginPassword'");
    if(mysqli_num_rows($loginResult)==1){
        if($_REQUEST['remember']){
            setcookie('loginEmail',$loginEmail, time()+60*60*7);
            setcookie('loginPassword',$loginPassword, time()+60*60*7);
        }
            $result=mysqli_fetch_assoc($loginResult);
            $fName=$result['fName'];
            $lName=$result['lName'];
            $mobile=$result['mobile'];
            $address=$result['address'];
            $file_name=$result['file_name'];
            $file_ext=$result['file_ext'];
            $reg_date=$result['reg_date'];
            $upd_date=$result['upd_date'];

        $_SESSION['loginEmail']=$loginEmail;
        $_SESSION['fName']=$fName;
        $_SESSION['lName']=$lName;
        $_SESSION['mobile']=$mobile;
        $_SESSION['address']=$address;
        $_SESSION['file_name']=$file_name;
        $_SESSION['file_ext']=$file_ext;
        $_SESSION['reg_date']=$reg_date;
        $_SESSION['upd_date']=$upd_date;
        header('location:welcome.php');
    }
    else{
        echo"<div class='alert alert-danger' role='alert'>
                <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                <span class='sr-only'>Error:</span>Email or Password is not valid. 
             </div>";
    }
}
///////////////////file///////////////////
if (isset($_FILES['file']['name'])) {
    $file_name = $_FILES['file']['name'];
    $file_type=$_FILES['file']['type'];
    $file_ext=end(explode('/',$file_type));
    ///$file_ext = end(explode('.', $file_name));
    $file_name = strtotime("now");
    $file_tmp_name = $_FILES['file']['tmp_name'];
    $extension = array("jpg","jpeg", "png", "gif", "svg", "bmp",);
    $file_path= $file_name.'.'.$file_ext;
    if (in_array($file_ext, $extension)) {
        move_uploaded_file($file_tmp_name, "img/uploads/".$file_path);
    }
    ///////////////////  Registration ////////////////////
    if(isset($_REQUEST['register'])) {
        session_start();
        $fName = $_REQUEST['fName'];
        $lName = $_REQUEST['lName'];
        $email = $_REQUEST['email'];
        $mobile = $_REQUEST['mobile'];
        $password = $_REQUEST['password'];
        $address = $_REQUEST['address'];
        date_default_timezone_set('Asia/Calcutta');
        $reg_date=date("Y-m-d h:i:sa",strtotime("now"));
        $upd_date=date("Y-m-d h:i:sa",strtotime("now"));
        $d = mysqli_query($con, "SELECT * FROM userinfo where email='$email'");
        $num = mysqli_num_rows($d);
        if ($num > 0) {
            echo "<script>alert('Email already exists choose another email');</script>";
        } else {
            $result = mysqli_query($con, "insert into userinfo (fName,lname,email,mobile,password,address,file_name, file_ext, reg_date, upd_date)
                  values ('$fName','$lName', '$email', '$mobile', '$password', '$address', '$file_name', '$file_ext', '$reg_date','$upd_date')");
            $_SESSION['loginEmail']=$email;
            $_SESSION['fName']=$fName;
            $_SESSION['lName']=$lName;
            $_SESSION['mobile']=$mobile;
            $_SESSION['address']=$address;
            $_SESSION['file_name']=$file_name;
            $_SESSION['file_ext']=$file_ext;
            $_SESSION['reg_date']=$reg_date;
            $_SESSION['upd_date']=$upd_date;
            header('location:welcome.php');
        }
    }
}
include 'header.php';
?>
                                <!-----Remaining Login form --------->
                                <label for="loginEmail" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="loginEmail" name="loginEmail" placeholder="Email"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="loginPassword" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="loginPassword" name="loginPassword" placeholder="Password"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" value="1"> Remember me
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-10">
                                    <input type="submit" id="login" name="login" class="btn btn-primary btn-sm" value="Login">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="Registration">
                        <form role="form" method="post" class="form-horizontal" enctype="multipart/form-data"><br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <label for="file" class="col-sm-10 control-label">
                                            <img src="img/dummy.png" style="border:2px solid darkgray; border-radius:30%; height: 100px; width:100px;"><br>
                                            <label for="file" class="glyphicon glyphicon-edit">Upload pic</label>
                                        </label>
                                        <input type="file" class="form-control" id="file" name="file" style="display: none" value="">
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="fName" name="fName" placeholder="First Name"/>
                                </div><div class="col-sm-6">
                                    <input type="text" class="form-control" id="lName" name="lName" placeholder="Last Name"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email"/>
                                </div>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Mobile"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"/>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                           placeholder="Confirm Password" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="address" name="address" placeholder="Enter your address here..."
                                              rows="3"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="submit" id="register" name="register" class="btn btn-primary btn-sm btn-block" onclick="return check()" value="Register & Continue">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3"></div>

<?php
if(isset($_COOKIE['loginEmail']) and isset($_COOKIE['loginPassword'])){
    $loginEmail=$_COOKIE['loginEmail'];
    $loginPassword=$_COOKIE['loginPassword'];
    echo "<script>
              document.getElementById('loginEmail').value='$loginEmail';
              document.getElementById('loginPassword').value='$loginPassword';
                </script>";
}
?>