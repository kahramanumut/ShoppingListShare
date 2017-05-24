
<?php
include 'baglan.php';
date_default_timezone_set('Europe/Istanbul');
//@$_SESSION["id"]
session_start();
$listeID=$_GET['id'];
if (@$_SESSION["oturum"]==false)
    echo '
        <script>
        window.top.location = "./login.php";
        </script>";';

//$kategoriAdlari=mysql_query("SELECT ID,KategoriAdi FROM kategori");
/*$kategori = mysql_query("SELECT kategori.KategoriAdi FROM liste INNER JOIN kategori ON kategori.ID=liste.KategoriID");*/
$yorum=mysql_query("SELECT kisi.KullAdi, Yorum FROM yorum INNER JOIN kisi ON kisi.ID=yorum.Kisi_ID WHERE yorum.Liste_ID=$listeID");
$listeler=mysql_query("SELECT KayitTarihi,Fiyat,kategori.KategoriAdi,ListeAdi,Icerik,kisi.KullAdi,kisi.AdSoyad,liste.ID FROM liste INNER JOIN kategori ON kategori.ID=liste.KategoriID INNER JOIN kisi ON liste.KullaID=kisi.ID WHERE liste.ID='$listeID'");
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
                $listeOku = mysql_fetch_array($listeler)
                 ?>

                <div class="form">
                    <form class="niceform">

                        <fieldset>
                            <dl>
                                <dt><label for="Liste Adı">Liste adı:</label></dt>
                                <dd><input type="text" name="listeAdi" id="" size="54" readonly value="<?php echo $listeOku['ListeAdi'] ?>" /></dd>
                            </dl>

                            <dl>
                                <dt><label for="Liste">Liste içeriği:</label></dt>
                                <dd><textarea name="listeIcerik" id="" rows="5" cols="46" readonly><?php echo $listeOku['Icerik'] ?></textarea></dd>
                            </dl>
                            <dl>
                                <dt><label for="Fiyat">Listenin tahmini fiyatı:</label></dt>
                                <dd><input type="text" name="listeFiyat" id="" size="6" readonly value="<?php echo $listeOku['Fiyat'] ?>" /></dd>
                            </dl>

                            <dl>
                                <dt><label for="KullaniciAdi">Kullanıcı adı:</label></dt>
                                <dd><input type="text" name="KullaniciAdi" id="" size="6" readonly value="<?php echo $listeOku['KullAdi'] ?>" /></dd>
                            </dl>

                            <dl>
                                <dt><label for="KullaniciAdiSoyadi">Adı soyadı:</label></dt>
                                <dd><input type="text" name="KullaniciAdiSoyadi" id="" size="16" readonly value="<?php echo $listeOku['AdSoyad'] ?>" /></dd>
                            </dl>

                            <dl>
                                <dt><label for="Paylasma tarihi">Tarih:</label></dt>
                                <dd><input type="text" name="Tarih" id="" size="16" readonly value="<?php echo $listeOku['KayitTarihi'] ?>" /></dd>
                            </dl>
                            <td><a href="./favoriEkle.php?id=<?php echo "$listeOku[ID]"?>"><img src="images/like32x32.png" alt="" title="" border="0" /></a></td>
                        </fieldset>
                    </form>
                </div>

                <div class="form" for="Yorumları okuma">

                    <form class="niceform">
                        <fieldset>
                            <h2>Yorumlar</h2>
                            <?php
                            /*Yorum listeleme */
                            while($yorumOku = mysql_fetch_assoc($yorum))
                            { ?>
                            <dl>
                                <dd><font style="font-size: medium;"><B><?php echo $yorumOku['KullAdi'] ?></B> <?php echo " : ".$yorumOku['Yorum'] ?></font></dd>
                            </dl>
                                <?php
                                /*while ın döngü sonu*/
                            }
                            ?>
                        </fieldset>
                    </form>
                </div>

                <div class="form" for="Yorumları yazma">
                    <h2>Yorum yaz</h2>
                    <form action="yorumYaz.php" method="post" class="niceform">
                        <fieldset>
                            <dl>
                                <dd><textarea name="yorumYazisi" id="" rows="5" cols="36"></textarea></dd>
                            </dl>
                            <dl class="submit">
                                <input type="submit" name="gonder"  value="Gönder" />
                            </dl>
                            <input type="hidden" name="listeID" value="<?php echo $listeID;?>" />
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
