<?php
/**
 * Created by PhpStorm.
 * User: Umut
 * Date: 18.05.2017
 * Time: 13:19
 */
include 'baglan.php';
date_default_timezone_set('Europe/Istanbul');
//@$_SESSION["id"]
session_start();
$mesajID=$_GET['id'];
if (@$_SESSION["oturum"]==false)
    echo '
        <script>
        window.top.location = "./login.php";
        </script>";';


$mesaj=mysql_query("SELECT kisi.KullAdi, Mesaj, Konu,GondermeTarihi FROM mesaj INNER JOIN kisi ON kisi.ID=mesaj.GonderenID WHERE mesaj.ID=$mesajID");
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
                <?php
                /*Listeleme burada yapılıyor */
                $mesajOku = mysql_fetch_array($mesaj)
                ?>

                <div class="form">
                    <form class="niceform">

                        <fieldset>
                            <dl>
                                <dt><label for="Gönderen kullanıcı adı">Gönderen:</label></dt>
                                <dd><input type="text" name="gonderenAdi" id="" size="10" readonly value="<?php echo $mesajOku['KullAdi'] ?>" /></dd>
                            </dl>

                            <dl>
                                <dt><label for="Konu">Konu:</label></dt>
                                <dd><input type="text" name="Konu" id="" size="40" readonly value="<?php echo $mesajOku['Konu'] ?>" /></dd>
                            </dl>

                            <dl>
                                <dt><label for="Mesaj Icerik">Mesaj:</label></dt>
                                <dd><textarea name="MesajIcerik" id="" rows="5" cols="46" readonly><?php echo $mesajOku['Mesaj'] ?></textarea></dd>
                            </dl>

                            <dl>
                                <dt><label for="Mesaj tarihi">Tarih:</label></dt>
                                <dd><input type="text" name="MesajTarih" id="" size="16" readonly value="<?php echo $mesajOku['GondermeTarihi'] ?>" /></dd>
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
