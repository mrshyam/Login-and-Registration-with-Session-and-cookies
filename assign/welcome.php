<!--
/**
 * Created by PhpStorm.
 * User: MrShyAm
 * Date: 3/13/2017
 * Time: 12:04 PM
 */-->
<?php
session_start();
require 'config.php';
if (isset($_SESSION['loginEmail'])) {
    $alt = $_SESSION['file_name'].'.'.$_SESSION['file_ext'];
} else {
    header('location:error.php');
}
include 'header.php';
?><br>
    <!-- Slider -->
<div class="container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <img src="img/71.jpg" height="300px" width="100%">
            </div>
            <div class="col-sm-1"></div>
        </div>
    </div>
</div><br>
        <!-- My Account -->
<div class="container">
    <div class="container-fluid">
        <div class="row">
            <form method="post">
                <div class="col-sm-3">
                    <div class="input-group">
                        <span class="glyphicon glyphicon-user"></span>
                        <label>My Account </label>
                    </div>
                    <hr size="80%" noshade>
                    <div class="form-inline form-group input-group ">
                        <input type="search" class="form-control" name="searchText" placeholder="Search user by Email">
                        <div class="input-group-addon">
                            <button type="submit" name="searchUser" style="background-color:transparent; border: transparent" class="glyphicon glyphicon-search"></button>
                        </div>
                    </div>
                    <hr size="80%">
                    <div class="input-group">
                        <span class="glyphicon glyphicon-edit"></span>
                        <label><a href="update.php">Edit Profile</a> </label>
                    </div>
                    <hr size="80%">
                    <div class="input-group">
                        <span class="glyphicon glyphicon-eye-open"></span>
                        <label><a href="viewuser.php">View all users</a> </label>
                    </div>
                    <hr size="80%">
                    <div class="input-group">
                        <span class="glyphicon glyphicon-log-out"></span>
                        <label><a href="logout.php">Logout</a> </label>
                    </div>
                    <hr size="80%">
                    <div class="input-group">
                        <span class="glyphicon glyphicon-trash"></span>
                        <label><a href="delete.php">Deactivate Account</a> </label>
                    </div>
                    <hr size="80%">
                </div>
                    <!-- Profile pic -->
                <div class="col-sm-5">
                    <div class="col-sm-12 img-circle">
                        <img src="img/uploads/<?php echo $alt ?>" class="img-circle" height="250px" width="100%"
                             alt="Profile pic">
                    </div>
                </div>
                    <!----- Info ---->
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="glyphicon glyphicon-user"></span>
                        <label><?php echo "Hello: <b><font color='green'>" . $_SESSION['fName'] . " " . $_SESSION['lName'] . "</font> </b>" ?></label>
                    </div>
                    <hr size="80%" noshade>
                    <div class="input-group">
                        <span class="glyphicon glyphicon-envelope"></span>
                        <label><?php echo "Email: <b><font color='green'>" . $_SESSION['loginEmail'] . "</font></b>" ?></label>
                    </div>
                    <hr size="80%">
                    <div class="input-group">
                        <span class="glyphicon glyphicon-earphone"></span>
                        <label><?php echo "Mobile: <b><font color='green'>" . $_SESSION['mobile'] . "</font></b>" ?></label>
                    </div>
                    <hr size="80%">
                    <div class="input-group">
                        <span class="glyphicon glyphicon-home"></span>
                        <label><?php echo "Address: <b><font color='green'>" . $_SESSION['address'] . "</font></b>" ?></label>
                    </div>
                    <hr size="80%">
                    <div class="input-group">
                        <span class="glyphicon glyphicon-calendar"></span>
                        <label><?php echo "Reg. Date: <b><font color='green'>" . $_SESSION['reg_date'] . "</font></b>" ?></label>
                    </div>
                    <hr size="80%">
                    <div class="input-group">
                        <span class="glyphicon glyphicon-time"></span>
                        <label><?php echo "Last update: <b><font color='green'>" . $_SESSION['upd_date'] . "</font></b>" ?></label>
                    </div>
                    <hr size="80%">
                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'search.php'; ?>
