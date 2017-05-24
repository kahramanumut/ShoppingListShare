<?php
/**
 * Created by PhpStorm.
 * User: Umut
 * Date: 24.04.2017
 * Time: 02:16
 */
session_start();
session_destroy();
header("location: login.php");
?>