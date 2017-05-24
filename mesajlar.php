<?php
/**
 * Created by PhpStorm.
 * User: Umut
 * Date: 6.05.2017
 * Time: 00:30
 */



include 'baglan.php';
date_default_timezone_set('Europe/Istanbul');
session_start();
if (@$_SESSION["oturum"]==false)
    echo '
        <script>
        window.top.location = "./login.php";
        </script>";';
$girisYapan=@$_SESSION["id"];
if ($_GET){
    $mesajID=$_GET["id"];
    $mesajSil=mysql_query("DELETE FROM mesaj WHERE mesaj.ID = '$mesajID'");
    echo '
        <script>
        alert("Mesaj silindi.")
        window.top.location = "./mesajlar.php";
        </script>";';
}
$kullaniciAdlari=mysql_query("SELECT KullAdi,ID FROM kisi");
$mesajlar=mysql_query("SELECT mesaj.ID,kisi.KullAdi,mesaj.Mesaj,mesaj.GondermeTarihi,mesaj.Konu,kisi.ID as kisiID FROM kisi INNER JOIN mesaj ON kisi.ID=mesaj.GonderenID WHERE mesaj.AliciID='$girisYapan'")
//$mesajlar=mysql_query("SELECT KayitTarihi,Fiyat,kategori.KategoriAdi,ListeAdi,Icerik,kisi.KullAdi,kisi.AdSoyad FROM liste INNER JOIN kategori ON kategori.ID=liste.KategoriID INNER JOIN kisi ON liste.KullaID=kisi.ID WHERE liste.ID='$listeID'");
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
                <li><a class="current"  href="mesajlar.php">Mesaj kutusu</a>
                </li>
                <li><a href="favoriler.php">Favori Listelerim</a></li>
            </ul>
        </div>
        <div class="center_content">

            <div class="right_content">

                <h2>Gelen kutusu</h2>
                <table id="rounded-corner">
                    <thead>
                    <tr>
                        <th scope="col" class="rounded">Gönderen</th>
                        <th scope="col" class="rounded">Konu</th>
                        <th scope="col" class="rounded">Tarih</th>
                        <th scope="col" class="rounded-q4">Sil</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>

                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    /*Listeleme burada yapılıyor */
                    while($mesajOku = mysql_fetch_assoc($mesajlar))
                    { ?>
                        <tr>
                            <!-- <td><input type="checkbox" name="" /></td> -->
                            <td><a href="./profilGoruntule.php?id=<?php echo "$mesajOku[kisiID]"?>"><?php echo "$mesajOku[KullAdi]"?></a></td>
                            <td><a href="./mesajGoruntule.php?id=<?php echo "$mesajOku[ID]" ?>"><?php echo "$mesajOku[Konu]";?></a></td>
                            <td><?php echo "$mesajOku[GondermeTarihi]";?></td>
                            <td><a href="./mesajlar.php?id=<?php echo "$mesajOku[ID]"?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>
                        </tr>
                        <?php
                        /*while ın döngü sonu*/
                    }
                    ?>

                    </tbody>
                </table>


                <br><br><br>
                <h2>Mesaj gönder</h2>

                <div class="form">
                    <form action="mesajGonder.php" method="post" class="niceform">

                        <fieldset>
                            <dl>
                                <dt><label>Konu:</label></dt>
                                <dd><input type="text" name="konu" id="" size="54" /></dd>
                            </dl>
                            <!-- Mesaj gönderme-->
                            <dl>
                                <dt><label>Alıcı seç:</label></dt>
                                <dd>
                                    <select size="1" name="mesajAlici" id="">
                                        <?php
                                        /*Kullanıcı listeleme burada yapılıyor */
                                        while($kullaniciOku = mysql_fetch_assoc($kullaniciAdlari)) { ?>
                                            <option value="<?php echo "$kullaniciOku[ID]";?>"><?php echo "$kullaniciOku[KullAdi]";?></option>
                                            <?php
                                        } //while sonu
                                        ?>
                                    </select>
                                </dd>
                            </dl>

                            <dl>
                                <dt><label>Mesaj:</label></dt>
                                <dd><textarea name="mesajIcerik" id="" rows="5" cols="36"></textarea></dd>
                            </dl>

                            <dl class="submit">
                                <input type="submit" name="gonder"  value="Gönder" />
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