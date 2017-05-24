<?php
/**
 * Created by PhpStorm.
 * User: Umut
 * Date: 21.05.2017
 * Time: 15:39
 */
include 'baglan.php';
date_default_timezone_set('Europe/Istanbul');
session_start();
$kullaniciID=@$_SESSION["id"];

if (@$_SESSION["oturum"]==false){
    echo '
        <script>
        window.top.location = "./login.php";
        </script>";';}
if($_POST){
    $adSoyad=$_POST["adSoyad"];
    $telefon=$_POST["telefon"];
    $mail=$_POST["email"];
    $cinsiyet=$_POST["cinsiyet"];
    $yeniSifre=$_POST["yeniSifre"];
    $yeniSifre2=$_POST["yeniSifre2"];

    //Profil fotosu yüklenmediyse
    if($_FILES["resim"]["name"]==''){
        if ($yeniSifre!=$yeniSifre2){
            echo '
        <script>
        alert("Yeni şifreniz diğeriyle eşleşmiyor.");
        </script>";';}
        else if ($yeniSifre==''){
            $sorgu = mysql_query("UPDATE kisi SET AdSoyad='$adSoyad', Cinsiyet='$cinsiyet', Email='$mail', Telefon='$telefon' Where kisi.ID=$kullaniciID");
            echo '
        <script>
        alert("Profiliniz güncellendi..");
        </script>";';
        }
        else{
            $sorgu = mysql_query("UPDATE kisi SET AdSoyad='$adSoyad', Cinsiyet='$cinsiyet', Email='$mail', Telefon='$telefon', Sifre ='$yeniSifre' Where kisi.ID=$kullaniciID");
            echo '
        <script>
        alert("Profiliniz güncellendi..");
        </script>";';
        }
    }
else {
    if ($_FILES["resim"]["size"] < 1024 * 1024) {//Dosya boyutu 1Mb tan az olsun
        if ($_FILES["resim"]["type"] == "image/jpeg") {//dosya tipi jpeg olsun
            $dosya_adi = $_FILES["resim"]["name"];
            //Dosyaya yeni bir isim oluşturuluyor
            $uret = array("as", "rt", "ty", "yu", "fg");
            $uzanti = substr($dosya_adi, -4, 4);
            $sayi_tut = rand(1, 10000);
            $yeni_ad = "images/" . $uret[rand(0, 4)] . $sayi_tut . $uzanti;
            //Dosya yeni adıyla dosyalar klasörüne kaydedilecek

            if (move_uploaded_file($_FILES["resim"]["tmp_name"], $yeni_ad)) {
                //echo 'Dosya başarıyla yüklendi.';
                //Bilgiler veri tabanına kaydedilsin
                {
                    if ($yeniSifre!=$yeniSifre2){
                        echo '
        <script>
        alert("Yeni şifreniz diğeriyle eşleşmiyor.");
        </script>";';}
                    else if ($yeniSifre==''){
                        $sorgu = mysql_query("UPDATE kisi SET Foto='$yeni_ad', AdSoyad='$adSoyad', Cinsiyet='$cinsiyet', Email='$mail', Telefon='$telefon' Where kisi.ID=$kullaniciID");
                    }
                    else{
                        $sorgu = mysql_query("UPDATE kisi SET Foto='$yeni_ad', AdSoyad='$adSoyad', Cinsiyet='$cinsiyet', Email='$mail', Telefon='$telefon', Sifre ='$yeniSifre' Where kisi.ID=$kullaniciID");
                    }
                }
                if ($sorgu) {
                    echo '
        <script>
        alert("Profiliniz güncellendi.");
        </script>";';
                } else {
                    echo '
        <script>
        alert("Kayıt esnasında hata oluştu.");
        </script>";';
                }
            } else {
                echo '
        <script>
        alert("Dosya yüklenemedi");
        </script>";';
            }
        } else {
            echo '
        <script>
        alert("Dosya tipi yalnızca jpeg olmalıdır.");
        </script>";';
        }
    } else {
        echo '
        <script>
        alert("Dosya 1 MBı geçemez.");
        </script>";';
    }
}
}

$kullanici=mysql_query("SELECT AdSoyad,Telefon,Cinsiyet,KullAdi,Email,Foto  FROM kisi WHERE kisi.ID='$kullaniciID'");
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

    <?php include 'header.php' ?>

    <br>
    <div class="main_content">
        <div class="menu">
            <ul>
                <li><a href="index.php">Anasayfa</a></li>
                <li><a href="listelerim.php">Listelerim</a>
                </li>
                <li><a href="mesajlar.php">Mesaj kutusu</a>
                </li>
                <li><a href="favoriler.php">Favori Listelerim</a></li>
            </ul>
        </div>
        <div class="center_content">

            <div class="right_content">
                <?php
                /*Listeleme burada yapılıyor */
                $kullaniciOku = mysql_fetch_array($kullanici)
                ?>

                <div class="form">
                    <?php
                    $sorgu2=mysql_query("select Foto from kisi Where kisi.ID=$kullaniciID");
                    if (mysql_num_rows($sorgu2)){
                        echo '<table>';
                        //Veritabanında resimler listeleniyor.
                        while($kayit=mysql_fetch_array($sorgu2)){
                            echo '<tr>';
                            echo '<td><img src="'.$kayit["Foto"].'" width="120" height="120"/></td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    }
                    ?>

                    <form method="post" action="profil.php" class="niceform" enctype="multipart/form-data">
                        <fieldset>
                            <dl>
                                <dt><label for="yeniSifre">Profil resmini güncelle:</label></dt>
                                <dd><input type="file" name="resim"></dd>
                            </dl>
                            <dl>
                                <dt><label for="Kullanıcı Adı">Kullanıcı Adı:</label></dt>
                                <dd><input type="text" name="kullaniciAdi" id="" size="54" readonly value="<?php echo $kullaniciOku['KullAdi'] ?>" /></dd>
                            </dl>

                            <dl>
                                <dt><label for="Ad Soyad">Ad Soyad:</label></dt>
                                <dd><input type="text" name="adSoyad" id="" size="36" value="<?php echo $kullaniciOku['AdSoyad'] ?>"/></dd>
                            </dl>
                            <dl>
                                <dt><label for="Telefon">Telefon:</label></dt>
                                <dd><input type="text" name="telefon" id="" size="16" value="<?php echo $kullaniciOku['Telefon'] ?>" /></dd>
                            </dl>

                            <dl>
                                <dt><label for="Email">Email:</label></dt>
                                <dd><input type="text" name="email" id="" size="36"  value="<?php echo $kullaniciOku['Email'] ?>" /></dd>
                            </dl>
                            <dl>
                                <dt><label for="Cinsiyet">Cinsiyet:</label></dt>
                                <dd>
                                    <select  name="cinsiyet" id="">
                                        <option <?php if ($kullaniciOku['Cinsiyet']=='1')echo 'selected'?> value="1">Erkek</option>
                                        <option <?php if ($kullaniciOku['Cinsiyet']=='0')echo 'selected'?> value="0">Kadın</option>
                                    </select>
                                </dd>
                            </dl>
                            <dl>
                                <dt><label for="yeniSifre">Yeni şifre:</label></dt>
                                <dd><input type="password" name="yeniSifre" id="" size="36"/></dd>
                            </dl>
                            <dl>
                                <dt><label for="yeniSifre2">Yeni şifreyi doğrula:</label></dt>
                                <dd><input type="password" name="yeniSifre2" id="" size="36"/></dd>
                            </dl>

                            <dl>
                                <input type="submit" name="guncelle" id="submit" value="Güncelle" />
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



