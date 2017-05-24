-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 23 May 2017, 20:14:41
-- Sunucu sürümü: 5.7.11
-- PHP Sürümü: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `dbalisveris`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `favori`
--

CREATE TABLE `favori` (
  `ID` int(11) NOT NULL,
  `Kisi_ID` int(11) NOT NULL,
  `Liste_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `favori`
--

INSERT INTO `favori` (`ID`, `Kisi_ID`, `Liste_ID`) VALUES
(1, 1, 7),
(5, 1, 13),
(6, 1, 5),
(7, 1, 2),
(9, 1, 14),
(10, 1, 15),
(11, 7, 14),
(12, 6, 14);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategori`
--

CREATE TABLE `kategori` (
  `ID` int(11) NOT NULL,
  `KategoriAdi` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kategori`
--

INSERT INTO `kategori` (`ID`, `KategoriAdi`) VALUES
(1, 'Mutfak alışverişi'),
(2, 'Fitness alışverişi'),
(3, 'Dağcılık'),
(4, 'Giyim'),
(5, 'Teknoloji');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kisi`
--

CREATE TABLE `kisi` (
  `ID` int(11) NOT NULL,
  `AdSoyad` varchar(60) DEFAULT NULL,
  `Rol` int(11) DEFAULT NULL,
  `Telefon` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `Foto` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `Cinsiyet` int(11) DEFAULT NULL,
  `KullAdi` varchar(60) CHARACTER SET latin1 DEFAULT NULL,
  `Sifre` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `Email` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kisi`
--

INSERT INTO `kisi` (`ID`, `AdSoyad`, `Rol`, `Telefon`, `Foto`, `Cinsiyet`, `KullAdi`, `Sifre`, `Email`) VALUES
(1, 'Umut Kahraman', 1, '5066132092', 'images/as659.jpg', 1, 'admin', '123', 'admin@alisverislistesi.com'),
(5, 'Alışveriş Delisi', 0, '11111', 'images/as984.jpg', 0, 'alisverisDelisi', '1111', 'alisverisci@hotmail.com'),
(6, 'Ali İlker Özkan', 0, '3322233354', 'images/as7125.jpg', 1, 'ilkerhoca', 'web', 'ilkerozkan@selcuk.edu.tr '),
(7, 'Burak Tezcan', 0, '3332223355', '', 1, 'burakhoca', 'web', 'burak@selcuk.edu.tr'),
(9, 'Deneme', 0, '123123123', '', 0, 'deneme', 'deneme', 'deneme@deneme.com'),
(10, 'Umut', 0, '5066132092', '', 1, 'umut', '123', 'umut@umut.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `liste`
--

CREATE TABLE `liste` (
  `ID` int(11) NOT NULL,
  `KullaID` int(11) DEFAULT NULL,
  `KategoriID` int(11) DEFAULT NULL,
  `Icerik` text,
  `KayitTarihi` date DEFAULT NULL,
  `ListeAdi` varchar(50) DEFAULT NULL,
  `Fiyat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `liste`
--

INSERT INTO `liste` (`ID`, `KullaID`, `KategoriID`, `Icerik`, `KayitTarihi`, `ListeAdi`, `Fiyat`) VALUES
(1, 1, 1, 'Pirinç, yağ, ekmek', '2017-04-26', 'Umutun mutfak listesi', 55),
(2, 2, 2, 'Protein tozu', '2017-04-26', 'Body building', 230),
(3, 1, 5, 'GTX 1080 Ekran kartı', '2017-04-19', 'Ekran kartı', 3200),
(5, 2, 4, 'Pantolon', '2017-04-29', 'Giyim listem', 44),
(9, 1, 3, 'ip, konserve', '2017-04-29', 'Dağ listesi', 60),
(14, 7, 5, 'Yorum ve favori eklenecek', '2017-05-21', 'Web programlama', 50),
(15, 6, 5, 'Final 90 tebrikler', '2017-05-21', 'Web final notu', 90);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesaj`
--

CREATE TABLE `mesaj` (
  `ID` int(11) NOT NULL,
  `GonderenID` int(11) NOT NULL,
  `AliciID` int(11) NOT NULL,
  `Mesaj` text NOT NULL,
  `GondermeTarihi` date NOT NULL,
  `Konu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `mesaj`
--

INSERT INTO `mesaj` (`ID`, `GonderenID`, `AliciID`, `Mesaj`, `GondermeTarihi`, `Konu`) VALUES
(1, 2, 1, 'Merhaba umut', '2017-05-02', 'Alışveriş listesi hakkında'),
(2, 1, 2, 'Test mesajıdır.', '2017-05-18', 'Test'),
(3, 1, 4, 'test mesajı', '2017-05-18', 'Test2'),
(4, 1, 4, 'denemee', '2017-05-20', 'Deneme'),
(6, 1, 7, 'Hocam söylenen özellikleri ekledim.', '2017-05-21', 'Web programlama'),
(8, 1, 6, 'Hocam lütfen 100 puan verin', '2017-05-23', 'Web programlama'),
(9, 1, 1, 'deneme', '2017-05-23', 'Deneme');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorum`
--

CREATE TABLE `yorum` (
  `ID` int(11) NOT NULL,
  `Yorum` varchar(300) DEFAULT NULL,
  `Kisi_ID` int(11) NOT NULL,
  `Liste_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `yorum`
--

INSERT INTO `yorum` (`ID`, `Yorum`, `Kisi_ID`, `Liste_ID`) VALUES
(1, 'Güzel liste tebrikler', 1, 1),
(2, 'Bu listeyi beğendim.', 2, 1),
(3, 'Test yorumu', 2, 5),
(4, 'Php kodu için test', 2, 5),
(5, 'Teşekkürler hocam.', 1, 15),
(6, 'Söylenen özellikler eklendi.', 1, 14);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `favori`
--
ALTER TABLE `favori`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `kisi`
--
ALTER TABLE `kisi`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `liste`
--
ALTER TABLE `liste`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `mesaj`
--
ALTER TABLE `mesaj`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `yorum`
--
ALTER TABLE `yorum`
  ADD PRIMARY KEY (`ID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `favori`
--
ALTER TABLE `favori`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Tablo için AUTO_INCREMENT değeri `kategori`
--
ALTER TABLE `kategori`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Tablo için AUTO_INCREMENT değeri `kisi`
--
ALTER TABLE `kisi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Tablo için AUTO_INCREMENT değeri `liste`
--
ALTER TABLE `liste`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Tablo için AUTO_INCREMENT değeri `mesaj`
--
ALTER TABLE `mesaj`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Tablo için AUTO_INCREMENT değeri `yorum`
--
ALTER TABLE `yorum`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
