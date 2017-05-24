<?php
include 'baglan.php';
date_default_timezone_set('Europe/Istanbul');
session_start();
//@$_SESSION["id"]
$kullaniciID=@$_SESSION["id"];
if (@$_SESSION["oturum"]==false)
    echo '
        <script>
        window.top.location = "./login.php";
        </script>";';

if ($_GET){
    $listeID=$_GET["id"];
    $listeSil=mysql_query("DELETE FROM liste WHERE liste.ID = '$listeID'");
    echo '
        <script>
        alert("Liste silindi.")
        window.top.location = "./listelerim.php";
        </script>";';
}

$kategoriAdlari=mysql_query("SELECT ID,KategoriAdi FROM kategori");
/*$kategori = mysql_query("SELECT kategori.KategoriAdi FROM liste INNER JOIN kategori ON kategori.ID=liste.KategoriID");*/
//sadece üyenin gönderdiği listeleri yayınla
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
                <li><a class="current" href="listelerim.php">Listelerim</a>
                </li>
                <li><a href="mesajlar.php">Mesaj kutusu</a>
                </li>
                <li><a href="favoriler.php">Favori Listelerim</a></li>
            </ul>
        </div>
        <div class="center_content">



            <div class="left_content">

                <div class="sidebar_search">
                    <form>
                        <input type="text" name="" class="search_input" value="Ara.." onclick="this.value=''" />
                        <input type="image" class="search_submit" src="images/search.png" />
                    </form>
                </div>

                <div class="sidebar_box">
                    <div class="sidebar_box_top"></div>
                    <div class="sidebar_box_content">
                        <h3>Liste paylaşırken</h3>
                        <img src="images/info.png" alt="" title="" class="sidebar_icon_right" />
                        <p>
                            Liste paylaşımında açıklayıcı ve doğru bilgiler veriniz.
                        </p>
                    </div>
                    <div class="sidebar_box_bottom"></div>
                </div>

                <div class="sidebar_box">
                    <div class="sidebar_box_top"></div>
                    <div class="sidebar_box_content">
                        <h3>Dikkat !</h3>
                        <img src="images/photo.png" alt="" title="" class="sidebar_icon_right" />
                        <ul>
                            <li>Liste adını içeriğe uygun yazınız.</li>
                            <li>Kategori ismini liste adınıza uygun seçiniz.</li>
                            <li>Listenizin fiyatını doğru belirleyiniz.</li>
                        </ul>
                    </div>
                    <div class="sidebar_box_bottom"></div>
                </div>

                <div class="sidebar_box">
                    <div class="sidebar_box_top"></div>
                    <div class="sidebar_box_content">
                        <h4>Mesaj kutusu</h4>
                        <img src="images/notice.png" alt="" title="" class="sidebar_icon_right" />
                        <p>
                            Üyeleri rahatsız edenlerin üyelikleri silinecektir.
                        </p>
                    </div>
                    <div class="sidebar_box_bottom"></div>
                </div>
            </div>

            <div class="right_content">

                <h2>Paylaştığım listeler</h2>


                <table id="rounded-corner">
                    <thead>
                    <tr>
                        <th scope="col" class="rounded">Liste adı</th>
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
                            <td><a href="./listele.php?id=<?php echo "$listeOku[ID]" ?>"><?php echo "$listeOku[ListeAdi]"?></a></td>
                            <td><?php echo "$listeOku[KategoriAdi]";?></td>
                            <td><?php echo "$listeOku[Fiyat]";?> TL</td>
                            <td><?php echo "$listeOku[KayitTarihi]";?></td>
                            <td><a href="./listelerim.php?id=<?php echo "$listeOku[ID]" ?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>
                        </tr>
                        <?php
                        /*while ın döngü sonu*/
                    }
                    ?>

                    </tbody>
                </table>

                <!--
                <a href="#" class="bt_green"><span class="bt_green_lft"></span><strong>Yeni ekle</strong><span class="bt_green_r"></span></a>
                <a href="#" class="bt_blue"><span class="bt_blue_lft"></span><strong>Görüntüle</strong><span class="bt_blue_r"></span></a>
                <a href="#" class="bt_red"><span class="bt_red_lft"></span><strong>Sil</strong><span class="bt_red_r"></span></a>
                -->
                <!--
                                <br><br>
                                <div class="pagination">
                                    <span class="disabled"><< prev</span><span class="current">1</span><a href="">2</a><a href="">3</a><a href="">4</a><a href="">5</a>…<a href="">10</a><a href="">11</a><a href="">12</a>...<a href="">100</a><a href="">101</a><a href="">next >></a>
                                </div>-->

                                <br><br><br>
                                <h2>Liste Paylaş</h2>

                                <div class="form">
                                    <form action="listeEkle.php" method="post" class="niceform">

                                        <fieldset>
                                            <dl>
                                                <dt><label for="email">Liste adı:</label></dt>
                                                <dd><input type="text" name="listeAdi" id="" size="54" /></dd>
                                            </dl>
                                            <!-- Kategorileri listelem-->
                            <dl>
                                <dt><label for="Kategori">Kategori seç:</label></dt>
                                <dd>
                                    <select size="1" name="kategoriListeleme" id="">
                                        <?php
                                        /*Listeleme burada yapılıyor */
                                        while($kategoriOku = mysql_fetch_assoc($kategoriAdlari)) { ?>
                                            <option value="<?php echo "$kategoriOku[ID]";?>"><?php echo "$kategoriOku[KategoriAdi]";?></option>
                                            <?php
                                        } //while sonu
                                        ?>
                                    </select>
                                </dd>
                            </dl>

                            <dl>
                                <dt><label for="Liste">Liste içeriği:</label></dt>
                                <dd><textarea name="listeIcerik" id="" rows="5" cols="36"></textarea></dd>
                            </dl>
                            <dl>
                                <dt><label for="Fiyat">Listenin tahmini fiyatı:</label></dt>
                                <dd><input type="text" name="listeFiyat" id="" size="6" /></dd>
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
