<?php
/**
 * Created by PhpStorm.
 * User: Umut
 * Date: 18.05.2017
 * Time: 13:31
 */
include 'baglan.php';
date_default_timezone_set('Europe/Istanbul');
ob_start();
$geldigi_sayfa = $_SERVER['HTTP_REFERER'];
session_start();
$kullaniciGonderenID=@$_SESSION["id"];
if (@$_SESSION["oturum"]==false){
    echo '
        <script>
        window.top.location = "./login.php";
        </script>";';}

if ($_POST){
    $kullaniciAliciID = $_POST["mesajAlici"];
    $konu=$_POST["konu"];
    $mesajIcerik=$_POST["mesajIcerik"];
    $gondermeTarihi=date("Y-m-d", time());
    if ($kullaniciAliciID == "" || $konu == "" || $mesajIcerik == "") {
        echo '
        <script>
        alert("Lütfen boş alan bırakmayınız.");
        </script>";';
        echo "<script>document.location.href=\"$geldigi_sayfa\"</script>";
    }
    else{
        $mesajGonder = mysql_query("INSERT INTO mesaj (GonderenID, AliciID, Mesaj, GondermeTarihi, Konu) VALUES ('$kullaniciGonderenID', '$kullaniciAliciID', '$mesajIcerik', '$gondermeTarihi', '$konu')");
        echo '
        <script>
        alert("Mesaj gönderildi.");
        </script>";';
        echo "<script>document.location.href=\"$geldigi_sayfa\"</script>";
    }
}

ob_end_flush();
?>