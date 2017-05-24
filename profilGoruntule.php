<?php
/**
 * Created by PhpStorm.
 * User: Umut
 * Date: 23.05.2017
 * Time: 15:36
 */
include 'baglan.php';
//@$_SESSION["id"]
session_start();
$kullaniciID=$_GET['id'];
if (@$_SESSION["oturum"]==false)
    echo '
        <script>
        window.top.location = "./login.php";
        </script>";';

$kullanici=mysql_query("SELECT AdSoyad,Telefon,Cinsiyet,KullAdi,Email,Foto  FROM kisi WHERE kisi.ID='$kullaniciID'");
$listeler=mysql_query("SELECT liste.ID,KayitTarihi,Fiyat,kategori.KategoriAdi,ListeAdi FROM liste INNER JOIN kategori ON kategori.ID=liste.KategoriID WHERE KullaID='$kullaniciID'");
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

                    <form class="niceform">
                        <fieldset>
                            <dl>
                                <dt><label for="Kullanıcı Adı">Kullanıcı Adı:</label></dt>
                                <dd><input type="text" name="kullaniciAdi" id="" size="54" readonly value="<?php echo $kullaniciOku['KullAdi'] ?>" /></dd>
                            </dl>

                            <dl>
                                <dt><label for="Ad Soyad">Ad Soyad:</label></dt>
                                <dd><input type="text" name="adSoyad" id="" size="36" readonly value="<?php echo $kullaniciOku['AdSoyad'] ?>"/></dd>
                            </dl>
                            <dl>
                                <dt><label for="Telefon">Telefon:</label></dt>
                                <dd><input type="text" name="telefon" id="" size="16" readonly value="<?php echo $kullaniciOku['Telefon'] ?>" /></dd>
                            </dl>

                            <dl>
                                <dt><label for="Email">Email:</label></dt>
                                <dd><input type="text" name="email" id="" size="36" readonly  value="<?php echo $kullaniciOku['Email'] ?>" /></dd>
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

                        </fieldset>
                    </form>
                </div>

                <h2>Kullanıcın Paylaştığı Listeler</h2>


                <table id="rounded-corner">
                    <thead>
                    <tr>
                        <th scope="col" class="rounded">Liste adı</th>
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
                            <td><a href="./listele.php?id=<?php echo "$listeOku[ID]" ?>"><?php echo "$listeOku[ListeAdi]"?></a></td>
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

