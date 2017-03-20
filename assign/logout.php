<!--/**
 * Created by PhpStorm.
 * User: MrShyAm
 * Date: 3/13/2017
 * Time: 11:46 PM
 */-->
<?php
    session_start();
    session_destroy();
    if(isset($_COOKIE['loginEmail']) and isset($_COOKIE['loginPassword'])){
        $loginEmail=$_COOKIE['loginEmail'];
        $loginPassword=$_COOKIE['loginPassword'];
        setcookie('loginEmail',$loginEmail, time()-1);
        setcookie('loginPassword',$loginPassword, time()-1);
    }
header('location:index.php');
?>