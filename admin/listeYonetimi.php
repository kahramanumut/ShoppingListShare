<?php
/**
 * Created by PhpStorm.
 * User: Umut
 * Date: 21.05.2017
 * Time: 03:01
 */


include '../baglan.php';
date_default_timezone_set('Europe/Istanbul');
session_start();
ob_start();

if (@$_SESSION["oturum"]==false || @$_SESSION["rol"]==0) {
    echo '
        <script>
        alert("Bu alana sadece Admin yetkisine sahip kullanıcılar girebilir.")
        window.top.location = "./login.php";
        </script>";';
}

$kategoriAdlari=mysql_query("SELECT ID,KategoriAdi FROM kategori");
$listeler=mysql_query("SELECT liste.ID,KayitTarihi,Fiyat,kategori.KategoriAdi,ListeAdi,kisi.KullAdi FROM liste INNER JOIN kategori ON kategori.ID=liste.KategoriID INNER JOIN kisi ON liste.KullaID=kisi.ID");

if ($_GET){
    $listeID=$_GET["id"];
    $listeSil=mysql_query("DELETE FROM liste WHERE liste.ID = '$listeID'");
    echo '
        <script>
        alert("Liste silindi.")
        window.top.location = "./listeYonetimi.php";
        </script>";';
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

    <?php include './header.php' ?>

    <br>
    <div class="main_content">
        <div class="menu">
            <ul>
                <li><a href="index.php">Üye yönetimi</a></li>
                <li><a href="kategoriYonetimi.php">Kategori Yönetimi</a>
                </li>
                <li><a class="current" href="listeYonetimi.php">Liste Yönetimi</a>
                </li>
            </ul>
        </div>
        <div class="center_content">

            <div class="right_content">

                <h2>Liste Yönetimi</h2>


                <table id="rounded-corner">
                    <thead>
                    <tr>
                        <th scope="col" class="rounded">Liste adı</th>
                        <th scope="col" class="rounded">Kullanıcı</th>
                        <th scope="col" class="rounded">Kategori</th>
                        <th scope="col" class="rounded">Fiyat</th>
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
                    while($listeOku = mysql_fetch_assoc($listeler))
                    { ?>
                        <tr>
                            <td><a href="../listele.php?id=<?php echo "$listeOku[ID]" ?>"><?php echo "$listeOku[ListeAdi]"?></a></td>
                            <td><?php echo "$listeOku[KullAdi]";?></td>
                            <td><?php echo "$listeOku[KategoriAdi]";?></td>
                            <td><?php echo "$listeOku[Fiyat]";?> TL</td>
                            <td><?php echo "$listeOku[KayitTarihi]";?></td>
                            <td><a href="./listeYonetimi.php?id=<?php echo "$listeOku[ID]"?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>
                        </tr>
                        <?php
                        /*while ın döngü sonu*/
                    }
                    ?>

                    </tbody>
                </table>

                <br>


                <br>
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



