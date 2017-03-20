<!--/**
 * Created by PhpStorm.
 * User: MrShyAm
 * Date: 3/9/2017
 * Time: 11:34 PM
 */
-->

<?php
session_start();
    if(isset($_SESSION['loginEmail'])){
        header('location:welcome.php');
    }
    else{
        header('location:home.php');
    }
?>