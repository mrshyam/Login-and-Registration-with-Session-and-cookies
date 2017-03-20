<!--/**
 * Created by PhpStorm.
 * User: MrShyAm
 * Date: 3/14/2017
 * Time: 4:30 PM
 */-->
<?php
    include 'header.php';
?>
<style>
    .userbox {
        background: #fff none repeat scroll 0 0;
        box-shadow: 0 0 3px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .img{
        height: 100px;
        width: 100px;
    }
</style>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <img src="img/71.jpg" height="300px" width="100%">
        </div>
        <div class="col-sm-1"></div>
    </div>
</div><br>
<div class="container">
    <?php
    session_start();
    if (isset($_SESSION['loginEmail'])) {
    require 'config.php';
    $d = mysqli_query($con, "SELECT * FROM userinfo");
    $num = mysqli_num_rows($d);
    while($num>0) {
        $result = mysqli_fetch_assoc($d);
        $id=$result['id'];
        $fName = $result['fName'];
        $lName = $result['lName'];
        $email=$result['email'];
        $mobile=$result['mobile'];
        $address=$result['address'];
        $file_name=$result['file_name'];
        $file_ext=$result['file_ext'];
        $img=$file_name.'.'.$file_ext;
        echo"<div class='row'>
                <div class='col-sm-2'></div>
                <div class='col-sm-8 userbox'>
                    <div class='col-sm-4'>
                        <div class='row'>
                            <div class='input-group'><span class='glyphicon glyphicon-user'></span>
                                <label>User $id:<b><font color='green'> $fName $lName </font></b></label>
                            </div>
                            <div class='input-group'><span class='glyphicon glyphicon-envelope'></span>
                                <label>Email :<b><font color='green'> $email </font></b></label>
                            </div>
                            <div class='input-group'><span class='glyphicon glyphicon-earphone'></span>
                                <label>Mobile :<b><font color='green'> $mobile </font></b></label>
                            </div>
                        </div>
                    </div>
                    <div class='col-sm-4'>
                        <div class='row'>
                            <div class='input-group'><span class='glyphicon glyphicon-user'></span>
                                <label>Address :<b><font color='green'>$address</font></b></label>
                            </div>
                        </div>
                    </div>
                    <div class='col-sm-2'>
                        <img src='img/uploads/$img' class='img img-circle'>
                    </div>
                </div>
                <div class='col-sm-2'></div>
            </div>";
        $num--;
    }
    } else {
    header('location:error.php');
    }
    ?>
</div>

<?php include 'footer.php'; ?>

