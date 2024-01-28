<?php
require_once("config.php");

if (($_SESSION['Key'] != "AdminKey")) {

    header("location:logout.php");
    exit();
}
