<?php
/**
 * Created by PhpStorm.
 * User: Umut
 * Date: 20.05.2017
 * Time: 16:31
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

if ($_POST){
    $geldigi_sayfa = $_SERVER['HTTP_REFERER'];
    $kategoriAdi = $_POST["kategoriAdi"];
    if ($kategoriAdi == "") {
        echo '
        <script>
        alert("Lütfen kategori adı giriniz.");
        </script>";';
        echo "<script>document.location.href=\"$geldigi_sayfa\"</script>";}
    else{
        $kategoriEkle = mysql_query("INSERT INTO kategori (KategoriAdi) VALUES ('$kategoriAdi')");
        echo '
        <script>
        alert("Kategori eklendi.");
        </script>";';
        echo "<script>document.location.href=\"$geldigi_sayfa\"</script>";
    }
}

if ($_GET){
    $kategoriID=$_GET["id"];
    $kategoriSil=mysql_query("DELETE FROM kategori WHERE kategori.ID = '$kategoriID'");
    echo '
        <script>
        alert("Kategori silindi.")
        window.top.location = "./kategoriYonetimi.php";
        </script>";';
}

$kategoriler=mysql_query("SELECT ID,KategoriAdi FROM kategori");
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
                <li><a class="current" href="kategoriYonetimi.php">Kategori Yönetimi</a>
                </li>
                <li><a href="listeYonetimi.php">Liste Yönetimi</a>
                </li>
            </ul>
        </div>
        <div class="center_content">

            <div class="right_content">

                <h2>Kategoriler</h2>


                <table id="rounded-corner" style="width: 300px;">
                    <thead>
                    <tr>
                        <th scope="col" class="rounded">Kategori Adı</th>
                        <th scope="col" class="rounded">Liste Sayısı</th>
                        <th scope="col" class="rounded">Sil</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    /*Listeleme burada yapılıyor */
                    while($kategoriOku = mysql_fetch_assoc($kategoriler))
                    { ?>
                       <tr>
                            <td><?php echo "$kategoriOku[KategoriAdi]";?></td>
                            <?php $listeSayisi=mysql_query("SELECT COUNT(kategori.ID) FROM liste INNER JOIN kategori ON liste.KategoriID=kategori.ID WHERE kategori.KategoriAdi='$kategoriOku[KategoriAdi]'");
                            $listeSayisiKontrol=mysql_fetch_array($listeSayisi);
                            ?>
                            <td  align="center"><?php echo $listeSayisiKontrol[0];?></td>
                            <td><a href="./kategoriYonetimi.php?id=<?php echo "$kategoriOku[ID]"?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>
                        </tr>
                        <?php
                        /*while ın döngü sonu*/
                    }
                    ?>

                    </tbody>
                </table>

                <br><br>

                <h2>Yeni kategori ekle</h2>

                <div class="form">
                    <form action="kategoriYonetimi.php" method="post" class="niceform">

                        <fieldset>
                            <dl>
                                <dt><label for="kategoriAdi">Kategori adı:</label></dt>
                                <dd><input type="text" name="kategoriAdi" size="34"></dd>
                            </dl>

                            <dl class="submit">
                                <input type="submit" name="gonder" id="submit" value="Gönder" />
                            </dl>

                        </fieldset>
                    </form>
                </div>


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
