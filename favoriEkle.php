<?php
/**
 * Created by PhpStorm.
 * User: Umut
 * Date: 18.05.2017
 * Time: 15:19
 */
include 'baglan.php';
date_default_timezone_set('Europe/Istanbul');
ob_start();
$geldigi_sayfa = $_SERVER['HTTP_REFERER'];
session_start();
$kullaniciID=@$_SESSION["id"];
$listeID=$_GET["id"];

if (@$_SESSION["oturum"]==false){
    echo '
        <script>
        window.top.location = "./login.php";
        </script>";';}
if ($_GET){
    $favoriKontrol = mysql_query("SELECT COUNT(id) FROM favori WHERE Kisi_ID='$kullaniciID' && Liste_ID='$listeID'");
    $favoriSifirMi=mysql_fetch_array($favoriKontrol);
    if($favoriSifirMi[0]>0){
        echo '
        <script>
        alert("Bu listeyi daha önce favorilerinize eklediniz.");
        </script>";';
        echo "<script>document.location.href=\"$geldigi_sayfa\"</script>";
    }
    else{
    $favoriEkle = mysql_query("INSERT INTO favori (Kisi_ID, Liste_ID) VALUES ('$kullaniciID', '$listeID');");
    echo '
        <script>
        alert("Liste favorilerinize eklendi.");
        </script>";';
    echo "<script>document.location.href=\"$geldigi_sayfa\"</script>";}
}
ob_end_flush();
?>