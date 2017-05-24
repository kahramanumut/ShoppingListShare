<?php
/**
 * Created by PhpStorm.
 * User: Umut
 * Date: 28.04.2017
 * Time: 02:08
 */

//Kullanıcın listeyi eklediğinde nerden geldiyse oraya gitmesi için
ob_start();
$geldigi_sayfa = $_SERVER['HTTP_REFERER'];

include 'baglan.php';
date_default_timezone_set('Europe/Istanbul');
session_start();
//@$_SESSION["id"]
        if ($_POST) {
            $postListeAdi = $_POST["listeAdi"];
            $postKategori = $_POST["kategoriListeleme"];
            $postListeIcerik = $_POST["listeIcerik"];
            $postListeFiyat = $_POST["listeFiyat"];
            $kullaniciID = @$_SESSION["id"];
            $kayitTarihi = date("Y-m-d", time());
            $kategoriID = $_POST["kategoriListeleme"];
            if ($postListeAdi == "" || $postKategori == "" || $postListeIcerik == "" || $postListeFiyat == "") {
                echo '
        <script>
        alert("Lütfen boş alan bırakmayınız.");
        </script>";';
                echo "<script>document.location.href=\"$geldigi_sayfa\"</script>";
            }
            else{
                $listeEkle = mysql_query("INSERT INTO liste (KullaID, KategoriID, Icerik, KayitTarihi, ListeAdi, Fiyat) VALUES ('$kullaniciID', '$kategoriID', '$postListeIcerik', '$kayitTarihi', '$postListeAdi', '$postListeFiyat')");
            echo '
        <script>
        alert("Listeniz eklendi.");
        </script>";';
                echo "<script>document.location.href=\"$geldigi_sayfa\"</script>";
            }
        }
ob_end_flush();
        ?>
