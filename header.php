<?php
/**
 * Created by PhpStorm.
 * User: Umut
 * Date: 5.05.2017
 * Time: 16:01
 */
include 'baglan.php';
date_default_timezone_set('Europe/Istanbul');
$rol=$_SESSION["rol"];

?>

<div class="header">
    <div class="logo"><a href="#"><img src="images/logo.png" alt="" title="" border="0" /></a></div>
    <br><br>
    <div class="right_header">Hoşgeldiniz <?php echo $_SESSION["kadi"]?>, <a href="./profil.php">Profil</a> | <a href="./mesajlar.php" class="messages">Mesaj Kutusu</a> | <?php  if ($rol==1)echo '<a href="./admin/">Admin Paneli</a> |'; ?> <a href="logout.php" class="logout">Çıkış</a></div>
</div>
