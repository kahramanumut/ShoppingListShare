<?php
include  'baglan.php';
session_start();
// giris.php sayfası
# mysql baglantisi, sesion_start yapilmis varsayiyoruz
# bilgiler

if(@$_SESSION["oturum"]==true){
    echo '
        <script>
        window.top.location = "./index.php";
        </script>";';
}

if($_POST){
    $kadi = $_POST["KullAdi"];
    $parola = $_POST["Sifre"];
    $bul = mysql_query("SELECT * FROM kisi WHERE KullAdi = '$kadi' && Sifre = '$parola'");
    $say = mysql_fetch_array($bul);
    if($say > 0 ){
        $_SESSION["oturum"] = true;
        $_SESSION["kadi"] = $kadi;
        $_SESSION["parola"] = $parola;
        @$_SESSION["id"]=$say[ID];
        @$_SESSION["rol"]=$say[Rol];
        echo '
        <script>
       /* alert("Başarıyla giriş yaptınız! Şimdi anasayfaya yönlendiriliyorsunuz.");*/
        window.top.location = "./";
        </script>";';
    }else{
        echo '
        <script>
        alert("Kullanıcı adı veya parola yanlış.");
        window.top.location = "./login.php";
        </script>;';
    }
}
else{
    echo '';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ALIŞVERİŞ LİSTESİ PAYLAŞIMI | UMUT KAHRAMAN</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="ddaccordion.js"></script>
    <script type="text/javascript">
        ddaccordion.init({
            headerclass: "submenuheader", //Shared CSS class name of headers group
            contentclass: "submenu", //Shared CSS class name of contents group
            revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
            mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
            collapseprev: true, //Collapse previous content (so only one open at any time)? true/false
            defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
            onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
            animatedefault: false, //Should contents open by default be animated into view?
            persiststate: true, //persist state of opened contents within browser session?
            toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
            togglehtml: ["suffix", "<img src='images/plus.gif' class='statusicon' />", "<img src='images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
            animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
            oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
                //do nothing
            },
            onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
                //do nothing
            }
        })
    </script>

    <script type="text/javascript" src="jconfirmaction.jquery.js"></script>
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

    <div class="header_login">

        <div style="margin-top: 250px"></div>

    </div>


    <div class="login_form">

        <h3>Kullanıcı Girişi</h3>


        <form action="login.php" method="post" class="niceform">

            <fieldset>
                <dl>
                    <dt style="text-align:right;"><label for="email">Kullanıcı Adı:</label></dt>
                    <dd><input type="text" name="KullAdi" id="" size="54" /></dd>
                </dl>
                <dl>
                    <dt style="text-align:right;"><label for="password">Parola:</label></dt>
                    <dd><input type="password" name="Sifre" id="" size="54" /></dd>
                </dl>


                <dl class="submit">
                    <input type="submit" name="gonder" id="submit" value="Giriş" />
                    <a href="./kayitOl.php" class="kayitOl">Kayıt ol</a>
                </dl>



            </fieldset>

        </form>
    </div>

    <div class="footer_login">

        <div class="left_footer_login">ALIŞVERİS LİSTESİ PAYLAŞIMI | Powered by <a href="http://twitter.com/hopehero3">UMUT KAHRAMAN</a></div>

    </div>

</div>
</body>
</html>