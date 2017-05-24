<?php
/**
 * Created by PhpStorm.
 * User: Umut
 * Date: 18.05.2017
 * Time: 15:37
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
if ($_GET){
    $favoriListeID=$_GET["id"];
    $favoriSil=mysql_query("DELETE FROM favori WHERE favori.Liste_ID = '$favoriListeID'");
    echo '
        <script>
        alert("Favori listenizden çıkarıldı.")
        window.top.location = "./favoriler.php";
        </script>";';
}



$listeler=mysql_query("SELECT kisi.KullAdi,liste.ID, liste.KayitTarihi, liste.Fiyat, kategori.KategoriAdi, liste.ListeAdi, kisi.ID as kisiID FROM favori INNER JOIN liste ON favori.Liste_ID=liste.ID INNER JOIN kategori ON kategori.ID=liste.KategoriID INNER JOIN kisi ON kisi.ID=liste.KullaID WHERE favori.Kisi_ID='$kullaniciID'");
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
                <li><a class="current" href="favoriler.php">Favori Listelerim</a></li>
            </ul>
        </div>
        <div class="center_content">

            <div class="right_content">

                <h2>Favori Listelerim</h2>


                <table id="rounded-corner">
                    <thead>
                    <tr>

                        <th scope="col" class="rounded">Liste adı</th>
                        <th scope="col" class="rounded">Kullanıcı Adı</th>
                        <th scope="col" class="rounded">Kategori</th>
                        <th scope="col" class="rounded">Fiyat</th>
                        <th scope="col" class="rounded">Tarih</th>
                        <th scope="col" class="rounded">Favoriden çıkar</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    /*Listeleme burada yapılıyor */
                    while($listeOku = mysql_fetch_assoc($listeler))
                    { ?>
                        <tr>
                            <!-- <td><input type="checkbox" name="" /></td> -->
                            <td><a href="./listele.php?id=<?php echo "$listeOku[ID]" ?>"><?php echo "$listeOku[ListeAdi]"?></a></td>
                            <td><a href="./profilGoruntule.php?id=<?php echo "$listeOku[kisiID]"?>"><?php echo "$listeOku[KullAdi]";?></a></td>
                            <td><?php echo "$listeOku[KategoriAdi]";?></td>
                            <td><?php echo "$listeOku[Fiyat]";?> TL</td>
                            <td><?php echo "$listeOku[KayitTarihi]";?></td>
                            <td><a href="./favoriler.php?id=<?php echo "$listeOku[ID]" ?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>

                        </tr>
                        <?php
                        /*while ın döngü sonu*/
                    }
                    ?>

                    </tbody>
                </table>

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
