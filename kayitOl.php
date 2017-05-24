<?php
include 'baglan.php';
date_default_timezone_set('Europe/Istanbul');
ob_start();
$geldigi_sayfa = $_SERVER['HTTP_REFERER'];
session_start();
if (@$_SESSION["oturum"]==true){

    echo '
        <script>
        window.top.location = "./index.php";
        </script>";';}

if ($_POST){
    $kadi = $_POST["kullaniciAdi"];
    $parola = $_POST["yeniParola"];
    $parola2=$_POST["yeniParola2"];
    $adiSoyadi=$_POST["KullaniciAdiSoyadi"];
    $email=$_POST["Email"];
    $telefon=$_POST["Telefon"];
    $cinsiyet=$_POST["cinsiyet"];

    $kullAdiKontrol=mysql_query("SELECT COUNT(id) FROM kisi WHERE KullAdi='$kadi'");
    $kullAdiSifirMi=mysql_fetch_array($kullAdiKontrol);

    if ($kadi == "" || $parola == "" || $parola2 == "" || $adiSoyadi == "" || $email=="" || $telefon==""|| $cinsiyet=="") {
        echo '
        <script>
        alert("Lütfen boş alan bırakmayınız.");
        </script>";';
        echo "<script>document.location.href=\"$geldigi_sayfa\"</script>";
    } else if($parola!=$parola2){
        echo '
        <script>
        alert("Girdiğiniz parola uyuşmamaktadır.");
        </script>";';
        echo "<script>document.location.href=\"$geldigi_sayfa\"</script>";
    }
    else if($kullAdiSifirMi[0]>0){
        echo '
        <script>
        alert("Bu kullanıcı adı uygun değil.");
        </script>";';
        echo "<script>document.location.href=\"$geldigi_sayfa\"</script>";
    }
    else{
        $kullaniciEkle = mysql_query("INSERT INTO kisi (AdSoyad, Rol, Telefon, Foto, Cinsiyet, KullAdi, Sifre,Email) VALUES ('$adiSoyadi', '0', '$telefon', '', '$cinsiyet', '$kadi','$parola','$email')");
        echo '
        <script>
        alert("Kullanıcı eklendi.");
        </script>";';
        echo '
        <script>
        window.top.location = "./login.php";
        </script>";';
    }
}


ob_end_flush();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>ALIŞVERİŞ LİSTESİ PAYLAŞIMI | UMUT KAHRAMAN</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            $('.ask').jConfirmAction();
        });

    </script>

    <script language="javascript" type="text/javascript" src="niceforms.js"></script>
    <link rel="stylesheet" type="text/css" media="all" href="niceforms-default.css" />

</head>
<body>
<div id="main_container">


    <br>
    <div class="main_content">

        <div class="center_content">

            <div class="right_content">
                <br><br><br><br>
                <h2 style="margin-left: 7px;">Kayıt ol</h2>

                <div class="form">
                    <form action="kayitOl.php" method="post" class="niceform" style="height: 350px;">

                        <fieldset>
                            <dl>
                                <dt><label for="kullaniciAdi">Kullanıcı adı:</label></dt>
                                <dd><input type="text" name="kullaniciAdi" size="34"></dd>
                            </dl>

                            <dl>
                                <dt><label for="Yeni parola">Yeni parola:</label></dt>
                                <dd><input type="password" name="yeniParola" id="" size="34"></dd>
                            </dl>

                            <dl>
                                <dt><label for="Yeni parola tekrarı">Yeni parolayı tekrar:</label></dt>
                                <dd><input type="password" name="yeniParola2" id="" size="34"></dd>
                            </dl>

                            <dl>
                                <dt><label for="KullaniciAdiSoyadi">Adı soyadı:</label></dt>
                                <dd><input type="text" name="KullaniciAdiSoyadi" id="" size="34"></dd>
                            </dl>

                            <dl>
                                <dt><label for="Email">Email:</label></dt>
                                <dd><input type="text" name="Email" id="" size="34"></dd>
                            </dl>
                            <dl>
                                <dt><label for="Telefon">Telefon:</label></dt>
                                <dd><input type="text" name="Telefon" id="" size="34"></dd>
                            </dl>
                            <dl>
                                <dt><label for="Cinsiyet">Cinsiyet:</label></dt>
                                <dd>
                                    <select  name="cinsiyet" id="">
                                            <option value="1">Erkek</option>
                                            <option value="0">Kadın</option>
                                    </select>
                                </dd>
                            </dl>

                            <dl class="submit">
                                <input type="submit" name="gonder" id="submit" value="Gönder" />
                            </dl>

                        </fieldset>
                    </form>
                </div>


            </div> <!-- sağ content sonu-->

        </div>   <!--orta content sonu -->

        <div class="clear"></div>
    </div> <!--ana content sonu-->

    <div class="footer">
        <div class="left_footer">ALIŞVERİS LİSTESİ PAYLAŞIMI | Powered by <a href="http://twitter.com/hopehero3">UMUT KAHRAMAN</a></div>
    </div>
</div>
</body>
</html>
