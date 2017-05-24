<?php
/**
 * Created by PhpStorm.
 * User: Umut
 * Date: 23.05.2017
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
if ($_POST){
    $listeAdi=$_POST["ara"];
}



$listeler=mysql_query("Select liste.ID,Fiyat,Icerik,KayitTarihi,ListeAdi,kategori.KategoriAdi,kisi.AdSoyad,kisi.KullAdi,kisi.ID as kisiID From liste INNER JOIN kisi ON liste.KullaID=kisi.ID INNER JOIN kategori ON liste.KategoriID=kategori.ID Where liste.ListeAdi LIKE '%$listeAdi%'");
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


                <table id="rounded-corner">
                    <thead>
                    <tr>

                        <th scope="col" class="rounded">Liste adı</th>
                        <th scope="col" class="rounded">Kullanıcı Adı</th>
                        <th scope="col" class="rounded">Kategori</th>
                        <th scope="col" class="rounded">Fiyat</th>
                        <th scope="col" class="rounded">Tarih</th>
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
