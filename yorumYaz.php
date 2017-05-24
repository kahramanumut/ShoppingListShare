<?php
/**
 * Created by PhpStorm.
 * User: Umut
 * Date: 18.05.2017
 * Time: 13:51
 */
include 'baglan.php';
date_default_timezone_set('Europe/Istanbul');
ob_start();
$geldigi_sayfa = $_SERVER['HTTP_REFERER'];
session_start();
$kullaniciGonderenID=@$_SESSION["id"];
$listeID=$_POST["listeID"];

if (@$_SESSION["oturum"]==false){
    echo '
        <script>
        window.top.location = "./login.php";
        </script>";';}
if ($_POST){
    $yorumIcerik = $_POST["yorumYazisi"];
    if ($yorumIcerik == "") {
        echo '
        <script>
        alert("Boş yorum yazılamaz.");
        </script>";';
        echo "<script>document.location.href=\"$geldigi_sayfa\"</script>";
    }
    else{
        $yorumGonder = mysql_query("INSERT INTO yorum (Yorum, Kisi_ID, Liste_ID) VALUES ('$yorumIcerik', '$kullaniciGonderenID', '$listeID');");
        echo '
        <script>
        alert("Yorum gönderildi.");
        </script>";';
        echo "<script>document.location.href=\"$geldigi_sayfa\"</script>";
    }
}
ob_end_flush();
?>
