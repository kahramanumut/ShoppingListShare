<?php
include '../baglan.php';
date_default_timezone_set('Europe/Istanbul');
session_start();
//@$_SESSION["id"]

if (@$_SESSION["oturum"]==false || @$_SESSION["rol"]==0)
    echo '
        <script>
       // alert("Bu alana sadece Admin yetkisine sahip kullanıcılar girebilir.")
        window.top.location = "./login.php";
        </script>";';

if ($_GET){
    $kullaniciID=$_GET["id"];
    $kullaniciSil=mysql_query("DELETE FROM kisi WHERE kisi.ID = '$kullaniciID'");
    echo '
        <script>
        alert("Kullanıcı silindi.")
        window.top.location = "./index.php";
        </script>";';
}
$kullanicilar=mysql_query("SELECT ID,KullAdi,AdSoyad,Rol,Cinsiyet,Email,Telefon FROM kisi");
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
                <li><a class="current" href="index.php">Üye yönetimi</a></li>
                <li><a href="kategoriYonetimi.php">Kategori Yönetimi</a>
                </li>
                <li><a href="listeYonetimi.php">Liste Yönetimi</a>
                </li>
            </ul>
        </div>
        <div class="center_content">
    
    <div class="right_content">            
        
    <h2>Kullanıcılar</h2>
                    
                    
<table id="rounded-corner" style="width: 800px;">
    <thead>
    	<tr>

            <th scope="col" class="rounded">Kullanıcı adı</th>
            <th scope="col" class="rounded">Ad Soyad</th>
            <th scope="col" class="rounded">Rol</th>
            <th scope="col" class="rounded">Cinsiyet</th>
            <th scope="col" class="rounded">Email</th>
            <th scope="col" class="rounded">Telefon</th>
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
while($kullaniciOku = mysql_fetch_assoc($kullanicilar))
{ ?>
    <tr>
        	<!-- <td><input type="checkbox" name="" /></td> -->
            <td><a href="../profilGoruntule.php?id=<?php echo "$kullaniciOku[ID]" ?>" target="_blank"><?php echo "$kullaniciOku[KullAdi]"?></a></td>
            <td><?php echo "$kullaniciOku[AdSoyad]";?></td>
            <td><?php if(@$kullaniciOku[Rol]==1){echo 'Admin';}else{echo 'Kullanıcı';};?></td>
            <td><?php if(@$kullaniciOku[Cinsiyet]==1){echo 'Erkek';}else{echo 'Kadın';};?></td>
            <td><?php echo "$kullaniciOku[Email]";?></td>
            <td><?php echo "$kullaniciOku[Telefon]";?></td>
            <td><a href="./index.php?id=<?php echo "$kullaniciOku[ID]" ?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>
        </tr>
<?php
    /*while ın döngü sonu*/
}
?>
        
    </tbody>
</table>

        <br><br>

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