<!--
/**
 * Created by PhpStorm.
 * User: MrShyAm
 * Date: 3/14/2017
 * Time: 8:20 PM
 */-->

<script>
    function checkUpdate() {
        var newfName=document.getElementById('newfName').value;
        var newlName=document.getElementById('newlName').value;
        var newEmail=document.getElementById('newEmail').value;
        var newMobile=document.getElementById('newMobile').value;
        var newPassword=document.getElementById('newPassword').value;
        var newConfirmPassword=document.getElementById('newConfirmPassword').value;
        var newAddress=document.getElementById('newAddress').value;

        if(newfName=="" || newlName=="" || newEmail=="" || newMobile=="" || newPassword==""  || newConfirmPassword==""  || newAddress==""){
            alert("Fill all field values");
            return false;
        }
        else if(newMobile.length!==10){
            alert("Mobile should be of 10 number");
            return false;
        }
        else if(newPassword.length<4){
            alert("Password must be more than 4 character ");
            return false;
        }
        else if(newPassword!==newConfirmPassword){
            alert("Password does not match");
            return false;
        }
        return true;
    }
</script>
<?php
    include 'header.php';
session_start();
require 'config.php';
if (isset($_SESSION['loginEmail'])) {
///////////////////file///////////////////
if (isset($_FILES['newFile']['name'])) {
    $new_file_name = $_FILES['newFile']['name'];
    $new_file_type = $_FILES['newFile']['type'];
    $new_file_ext = end(explode('/', $new_file_type));
    $new_file_name = strtotime("now");
    $new_file_tmp_name = $_FILES['newFile']['tmp_name'];
    $new_extension = array("jpg", "jpeg", "png", "gif", "svg", "bmp",);
    $file_path = $new_file_name . '.' . $new_file_ext;
    if (in_array($new_file_ext, $new_extension)) {
        move_uploaded_file($new_file_tmp_name, "img/uploads/" . $file_path);
        ///////////

        $data=$_SESSION['file_name'].'.'.$_SESSION['file_ext'];
        $dir = "img/uploads";
        $dirHandle = opendir($dir);
        while ($oldFile = readdir($dirHandle)) {
            if($oldFile==$data) {
                unlink($oldFile);
            }
        }
        closedir($dirHandle);
    }
    //////////////////////update//////////////////////
    if (isset($_REQUEST['saveChange'])) {
        $email = $_SESSION['loginEmail'];
        $newfName = $_REQUEST['newfName'];
        $newlName = $_REQUEST['newlName'];
        $newEmail = $_REQUEST['newEmail'];
        $newMobile = $_REQUEST['newMobile'];
        $newPassword = $_REQUEST['newPassword'];
        $newAddress = $_REQUEST['newAddress'];
        date_default_timezone_set('Asia/Calcutta');
        $new_upd_date = date("Y-m-d h:i:sa", strtotime("now"));
        $d = mysqli_query($con, "SELECT * FROM userinfo where email='$newEmail'");
        $num = mysqli_num_rows($d);
        if ($num > 0) {
            echo "<script>alert('Email already exists choose another email');</script>";
        } else {
            $result = mysqli_query($con, "UPDATE userinfo SET fName='$newfName', lName='$newlName', email='$newEmail', mobile='$newMobile',
            password='$newPassword', address='$newAddress',file_name='$new_file_name', file_ext='$new_file_ext', upd_date='$new_upd_date' WHERE email='$email'");
            $_SESSION['loginEmail'] = $newEmail;
            $_SESSION['fName'] = $newfName;
            $_SESSION['lName'] = $newlName;
            $_SESSION['mobile'] = $newMobile;
            $_SESSION['address'] = $newAddress;
            $_SESSION['file_name'] = $new_file_name;
            $_SESSION['file_ext'] = $new_file_ext;
            $_SESSION['upd_date'] = $new_upd_date;
            header('location:welcome.php');
        }
    }
}
} else {
    header('location:error.php');
}
?>
<div class="container">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="row">
            <div class="text-center"><span class="lead">Edit Your Profile</span> </div>
            <form role="form" method="post" class="form-horizontal" enctype="multipart/form-data"><br>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <label for="newFile" class="col-sm-9 control-label">
                                <img src="img/dummy.png" style="border:2px solid darkgray; border-radius:30%; height: 100px; width:100px;"><br>
                                <label for="newFile" class="glyphicon glyphicon-edit">Change pic</label>
                            </label>
                            <input type="file" class="form-control" id="newFile" name="newFile" style="display: none">
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="newfName" name="newfName" placeholder="First Name"/>
                    </div><div class="col-sm-6">
                        <input type="text" class="form-control" id="newlName" name="newlName" placeholder="Last Name"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="email" class="form-control" id="newEmail" name="newEmail" placeholder="New Email"/>
                    </div>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" id="newMobile" name="newMobile" placeholder="New Mobile"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password"/>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="newConfirmPassword" name="newConfirmPassword" placeholder="Confirm New Password" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <textarea class="form-control" id="newAddress" name="newAddress" placeholder="Enter your new address here..." rows="3"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="submit" id="saveChange" name="saveChange" class="btn btn-primary btn-sm btn-block" onclick="return checkUpdate()" value="Save Changes">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-2"></div>
</div>
<br>
<a href="index.php">Home</a>