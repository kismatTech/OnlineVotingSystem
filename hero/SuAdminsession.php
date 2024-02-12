<?php
// Initialize the session
// Check if the user is logged in, if not then redirect him to login page
require_once("../admin/inc/config.php");
require("../admin/inc/function.php");
if (($_SESSION['Key'] != "SuAdminKey")) {

    header("location:../logout.php");
    exit();
}
$logname = htmlspecialchars($_SESSION["username"]);
