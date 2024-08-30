-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 29 May 2024, 08:05:46
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `prison`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `building`
--

CREATE TABLE `building` (
  `idb` int(11) NOT NULL,
  `bina` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `building`
--

INSERT INTO `building` (`idb`, `bina`) VALUES
(1, 'Wards (Men)'),
(2, 'Wards (Women)'),
(3, 'Administrative Rooms'),
(4, 'Guard Rooms'),
(5, 'Infirmaries'),
(6, 'Examination Rooms'),
(7, ' Dietitian Rooms'),
(8, ' Nurse Rooms'),
(9, 'Kitchens (Men)'),
(10, 'Kitchens (Women)'),
(11, 'Dining Halls (Men)'),
(12, 'Dining Halls (Women)'),
(13, 'Prison Yard (Men)'),
(14, 'Prison Yard (Women)'),
(15, 'Vocational Training and Hobby Rooms (Men)'),
(16, 'Vocational Training and Hobby Rooms (Women)'),
(17, 'Guardhouse'),
(19, 'Meeting Room');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `buildingdetail`
--

CREATE TABLE `buildingdetail` (
  `idbt` int(11) NOT NULL,
  `binaid` int(11) NOT NULL,
  `oda` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `buildingdetail`
--

INSERT INTO `buildingdetail` (`idbt`, `binaid`, `oda`) VALUES
(1, 1, 'M1'),
(2, 2, 'W1'),
(3, 1, 'M2'),
(4, 2, 'W2'),
(6, 1, 'M3'),
(9, 3, 'Manager Room'),
(10, 3, 'Assistant Director Room 1'),
(11, 3, 'Assistant Director Room 2'),
(12, 4, 'Chief Guard');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `country` varchar(10) NOT NULL,
  `city` varchar(25) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `cities`
--

INSERT INTO `cities` (`id`, `country`, `city`, `country_id`) VALUES
(1, 'KKTC', 'Gazimağusa', 1),
(2, 'KKTC', 'Girne', 1),
(3, 'KKTC', 'Güzelyurt', 1),
(4, 'KKTC', 'Iskele', 1),
(5, 'KKTC', 'Lefke', 1),
(6, 'KKTC', 'Lefkoşa', 1),
(7, 'TC', 'Adana', 2),
(8, 'TC', 'Adıyaman', 2),
(9, 'TC', 'Afyonkarahisar', 2),
(10, 'TC', 'Ağrı', 2),
(11, 'TC', 'Aksaray', 2),
(12, 'TC', 'Amasya', 2),
(13, 'TC', 'Ankara', 2),
(14, 'TC', 'Antalya', 2),
(15, 'TC', 'Ardahan', 2),
(16, 'TC', 'Artvin', 2),
(17, 'TC', 'Aydın', 2),
(18, 'TC', 'Balıkesir', 2),
(19, 'TC', 'Bartın', 2),
(20, 'TC', 'Batman', 2),
(21, 'TC', 'Bayburt', 2),
(22, 'TC', 'Bilecik', 2),
(23, 'TC', 'Bingöl', 2),
(24, 'TC', 'Bitlis', 2),
(25, 'TC', 'Bolu', 2),
(26, 'TC', 'Burdur', 2),
(27, 'TC', 'Bursa', 2),
(28, 'TC', 'Çanakkale', 2),
(29, 'TC', 'Çankırı', 2),
(30, 'TC', 'Çorum', 2),
(31, 'TC', 'Denizli', 2),
(32, 'TC', 'Diyarbakır', 2),
(33, 'TC', 'Düzce', 2),
(34, 'TC', 'Edirne', 2),
(35, 'TC', 'Elazığ', 2),
(36, 'TC', 'Erzincan', 2),
(37, 'TC', 'Erzurum', 2),
(38, 'TC', 'Eskişehir', 2),
(39, 'TC', 'Gaziantep', 2),
(40, 'TC', 'Giresun', 2),
(41, 'TC', 'Gümüşhane', 2),
(42, 'TC', 'Hakkâri', 2),
(43, 'TC', 'Hatay', 2),
(44, 'TC', 'Iğdır', 2),
(45, 'TC', 'Isparta', 2),
(46, 'TC', 'İstanbul', 2),
(47, 'TC', 'İzmir', 2),
(48, 'TC', 'Kahramanmaraş', 2),
(49, 'TC', 'Karabük', 2),
(50, 'TC', 'Karaman', 2),
(51, 'TC', 'Kars', 2),
(52, 'TC', 'Kastamonu', 2),
(53, 'TC', 'Kayseri', 2),
(54, 'TC', 'Kilis', 2),
(55, 'TC', 'Kırıkkale', 2),
(56, 'TC', 'Kırklareli', 2),
(57, 'TC', 'Kırşehir', 2),
(58, 'TC', 'Kocaeli', 2),
(59, 'TC', 'Konya', 2),
(60, 'TC', 'Kütahya', 2),
(61, 'TC', 'Malatya', 2),
(62, 'TC', 'Manisa', 2),
(63, 'TC', 'Mardin', 2),
(64, 'TC', 'Mersin', 2),
(65, 'TC', 'Muğla', 2),
(66, 'TC', 'Muş', 2),
(67, 'TC', 'Nevşehir', 2),
(68, 'TC', 'Niğde', 2),
(69, 'TC', 'Ordu', 2),
(70, 'TC', 'Osmaniye', 2),
(71, 'TC', 'Rize', 2),
(72, 'TC', 'Sakarya', 2),
(73, 'TC', 'Samsun', 2),
(74, 'TC', 'Şanlıurfa', 2),
(75, 'TC', 'Siirt', 2),
(76, 'TC', 'Sinop', 2),
(77, 'TC', 'Sivas', 2),
(78, 'TC', 'Şırnak', 2),
(79, 'TC', 'Tekirdağ', 2),
(80, 'TC', 'Tokat', 2),
(81, 'TC', 'Trabzon', 2),
(82, 'TC', 'Tunceli', 2),
(83, 'TC', 'Uşak', 2),
(84, 'TC', 'Van', 2),
(85, 'TC', 'Yalova', 2),
(86, 'TC', 'Yozgat', 2),
(87, 'TC', 'Zonguldak', 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `crimes`
--

CREATE TABLE `crimes` (
  `id` int(11) NOT NULL,
  `suctipi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `crimes`
--

INSERT INTO `crimes` (`id`, `suctipi`) VALUES
(1, 'Theft'),
(2, 'Murder'),
(3, 'Fraud'),
(4, 'Extortion');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `nutrition`
--

CREATE TABLE `nutrition` (
  `nutid` int(11) NOT NULL,
  `tarih` date NOT NULL,
  `kahvalti` varchar(400) NOT NULL,
  `oglen` varchar(400) NOT NULL,
  `aksam` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `nutrition`
--

INSERT INTO `nutrition` (`nutid`, `tarih`, `kahvalti`, `oglen`, `aksam`) VALUES
(1, '2024-05-01', 'EGG AND CHIPS\r\nWHITE CHEES\r\nOLIVE', 'ROAST CHICKEN\r\nSALAD\r\nAPPLE', 'TOMATO SOUP\r\nSAUSAGE AND MASH\r\nPUDING'),
(2, '2024-05-02', '  OATMEAL\r\nSLICED ALMONDS\r\nGROUND FLAXSEED', 'SANDWICH\r\nRAW VEGGIES\r\nHUMMUS DIP', 'GRILLED SALMON\r\nBAKED POTATO\r\nSPINAC SALAD'),
(3, '2024-05-03', '  SCRAMBLED EGG\r\nWHEAT ENGLISH MUFFIN', 'BEAN SOUP\r\nGREEN SALAD', 'CHICKEN\r\nVEGETABLES\r\nBROWN RICE'),
(4, '2024-05-04', 'EGG\r\nWHITE CHEES\r\nOLIVE', 'EZOGELIN SOUP\r\nBUTTER RICE\r\nBOWL YOGURT', 'TARHANA SOUP\r\nTAS KEBAB\r\nRICE\r\nBANANA'),
(5, '2024-05-05', 'SAUSAGE\r\nCHEES\r\nOLIVE\r\nLINDEN TEA', 'TARHANA SOUP\r\nKAYSERI MANTI\r\nBAKLAVA', 'BROCCOLI SOUP\r\nFRIED CHICKEN\r\nRICE\r\nSEASONAL SALAD'),
(6, '2024-05-06', 'SAUSAGE\r\nTOMATO\r\nCUCUMBER\r\nWHITE CHEES\r\nTEA', 'CHICKEN MUSHROOM SAUTE\r\nRICE\r\nYOGURT', 'TOMATO SOUP\r\nIZMIR MEATBALLS\r\nYOGURT MANTI\r\nCHOCOLATE PUDDING'),
(7, '2024-05-07', 'SİMİT\r\nKREM PEYNİR\r\nREÇEL\r\nADA ÇAYI', 'TAVUK BAGET\r\nGARNİTÜRLÜ PİLAV\r\nYOĞURT', 'KURU FASÜLYE\r\nPİRİNÇ PİLAVI\r\nTAHİN HELVASI'),
(23, '2024-05-08', 'PATATES KIZARTMASI\r\nBEYAZ PEYNİR\r\nZEYTİN', 'ARPA ŞEHRİYE ÇORBASI\r\nFIRIN TAVUK BUT\r\nMEYANE PİLAVI\r\nKASE AYRAN', 'YAYLA ÇORBASI\r\nETLİ NOHUT\r\nSADE BULGUR PİLAVI\r\nKARIŞIK TURŞU'),
(24, '2024-05-09', 'ÇİKOLATALI EKMEK\r\nSÜT\r\nHAŞLANMIŞ YUMURTA', 'EZOGELİN ÇORBASI\r\nARNAVUT CİĞERİ\r\nMISIRLI PİRİNÇ PİLAVI\r\nKASE AYRAN', 'KREMALI MANTAR ÇORBASI\r\nMACAR GULAŞ\r\nTEL ŞEHRİYELİ PİRİNÇ PİLAVI\r\nELMA'),
(25, '2024-05-10', 'DOMATES\r\nSALATALIK\r\nBEYAZ PEYNİR\r\nIHLAMUR ÇAYI', 'KREMALI MANTAR ÇORBASI\r\nMACAR GULAŞ\r\nTEL ŞEHRİYELİ PİRİNÇ PİLAVI\r\nELMA', 'TARHANA ÇORBASI\r\nHARPUT KÖFTESİ\r\nARPA ŞEHRİYELİ PİRİNÇ PİLAVI\r\nKAZANDİBİ'),
(26, '2024-05-11', 'HAŞLANMIŞ YUMURTA\r\nBEYAZ PEYNİR\r\nZEYTİN\r\nADA ÇAYI', 'KÖYLÜM ÇORBASI\r\nETLİ BEZELYE\r\nSADE MAKARNA\r\nKASE YOĞURT', 'GEMİCİ ÇORBASI\r\nİZMİR KÖFTESİ\r\nTEL ŞEHRİYELİ BULGUR PİLAVI\r\nKEMALPAŞA TATLISI'),
(27, '2024-05-12', 'AÇMA\r\nKREM PEYNİR\r\nREÇEL\r\nIHLAMUR ÇAYI', 'KURU FASULYE\r\nPİRİNÇ PİLAVI\r\nTAHİN HELVASI', 'KIYMALI ISPANAK\r\nSOSLU MAKARNA\r\nYOĞURT'),
(28, '2024-05-13', 'PATATES KIZARTMASI\r\nBEYAZ PEYNİR\r\nDOMATES\r\nSALATALIK', 'ZEYTİNYAĞLI BARBUNYA\r\nERİŞTE PİLAVI\r\nYOĞURT', 'KREMALI TAVUK ÇORBASI\r\nZEYTİNYAĞLI TÜRLÜ\r\nTEREYAĞLI ERİŞTE PİLAVI\r\nKASE YOĞURT'),
(29, '2024-05-14', 'SUCUK\r\nBEYAZ PEYNİR\r\nZEYTİN\r\nÇAY', 'DÜĞÜN ÇORBASI\r\nKÖRİ SOSLU TAVUK SOTE\r\nMEYANE PİLAVI\r\nHAVUÇ SALATASI', 'ALAROMEN ÇORBASI\r\nZEYTİNYAĞLI BARBUNYA\r\nŞEHRİYELİ GÜVEÇ\r\nYENİDÜNYA');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `prisoners`
--

CREATE TABLE `prisoners` (
  `idprs` int(11) NOT NULL,
  `mahsicilno` varchar(15) NOT NULL,
  `ad` varchar(20) NOT NULL,
  `soyad` varchar(30) NOT NULL,
  `cinsiyet` varchar(5) NOT NULL,
  `babaadi` varchar(20) NOT NULL,
  `anneadi` varchar(20) NOT NULL,
  `dogumtarihi` date NOT NULL,
  `uyruk` varchar(10) NOT NULL,
  `dogumyeri` varchar(30) NOT NULL,
  `suctarihi` date NOT NULL,
  `succinsi` varchar(25) NOT NULL,
  `mahtarihi` date NOT NULL,
  `mahkararno` varchar(50) NOT NULL,
  `tahliyetarihi` date NOT NULL,
  `avukat` varchar(30) DEFAULT NULL,
  `avukattlf` varchar(15) DEFAULT NULL,
  `adres` varchar(250) DEFAULT NULL,
  `iletkisi` varchar(60) DEFAULT NULL,
  `ilettlf` varchar(25) DEFAULT NULL,
  `resim` varchar(30) DEFAULT NULL,
  `aktiflik` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `prisoners`
--

INSERT INTO `prisoners` (`idprs`, `mahsicilno`, `ad`, `soyad`, `cinsiyet`, `babaadi`, `anneadi`, `dogumtarihi`, `uyruk`, `dogumyeri`, `suctarihi`, `succinsi`, `mahtarihi`, `mahkararno`, `tahliyetarihi`, `avukat`, `avukattlf`, `adres`, `iletkisi`, `ilettlf`, `resim`, `aktiflik`) VALUES
(1, 'PR2328', 'Naci', 'Gök', 'Man', 'Ozan', 'Pınar', '2001-02-05', 'KKTC', 'Girne', '2015-04-15', 'Extortion', '2018-01-05', 'AK215-4562', '2028-02-05', 'Feridun Karayel', '542 456 1256', 'No Adress', 'Mustafa Gök', '542 632 5489', 'prisonerpic/1.jpg', 'No'),
(5, 'PR2329', 'Hayat', 'Kılıç', 'Woman', 'Mahmut', 'Fatma', '2002-02-01', 'TC', 'Bayburt', '2005-12-05', 'Theft', '2022-05-12', 'KH154-12356', '2032-05-15', 'Feridun Tersağaç', '541 607 1112', 'Akar Mah. Beyaz Sokak No:45 BAYBURT', 'İsmail Sancak', '541 652 3652', 'prisonerpic/5.jpg', 'Yes'),
(6, 'PR2330', 'Elif', 'Bayındır', 'Woman', 'Ali', 'Gülçün', '1997-05-01', 'KKTC', 'Lefke', '2016-01-05', 'Fraud', '2019-06-12', 'ak-5345645', '2029-06-12', 'Mahsun Güven', '543 851 6541', 'Aslanlı Mah. 452. Sok No:12 GİRNE', 'Haluk Birden', '532 652 4521', 'prisonerpic/6.jpg', 'Yes'),
(7, 'PR2331', 'Metin', 'Benlidere', 'Man', 'Ali', 'Pınar', '2001-01-01', 'TC', 'Yalova', '2021-01-01', 'Theft', '2022-01-01', 'SSD2354-3456', '2031-01-01', 'Kasım Benekli', '543 542 9541', 'No Adress', 'Ayşe Benlidere', '544 314 5263', NULL, 'Yes'),
(8, 'PR2332', 'Metin', 'Soner', 'Man', 'Ali', 'Pınar', '2001-01-01', 'TC', 'Tekirdağ', '2021-01-01', 'Theft', '2022-01-01', 'SDR23-5434-56', '2031-01-01', '', '111 111 1111', 'Taşlıdere Mah. Akmazlar Sok. Gül Apt. No 5/12 Tekirdağ', 'Ali Soner', '542 652 3254', NULL, 'Yes'),
(9, 'PR2333', 'Ahmet', 'Kara', 'Man', 'Ozan', 'Ayşe', '2001-01-01', 'KKTC', 'Gazimağusa', '2022-01-01', 'Theft', '2023-01-01', 'ASF456-7986', '2032-01-01', 'Metin Sadecan', '541 245 8596', 'No Adress', 'Hasan Kara', '542 451 5236', NULL, 'Yes');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

CREATE TABLE `settings` (
  `persicilno` int(15) NOT NULL,
  `mahsicilno` int(15) NOT NULL,
  `asis` varchar(3) NOT NULL,
  `asip` varchar(3) NOT NULL,
  `indexkolon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`persicilno`, `mahsicilno`, `asis`, `asip`, `indexkolon`) VALUES
(3569, 2336, 'Yes', 'No', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `staffs`
--

CREATE TABLE `staffs` (
  `id` int(11) NOT NULL,
  `persicilno` varchar(15) NOT NULL,
  `ad` varchar(20) NOT NULL,
  `soyad` varchar(30) NOT NULL,
  `cinsiyet` varchar(5) NOT NULL,
  `babaadi` varchar(20) NOT NULL,
  `anneadi` varchar(20) NOT NULL,
  `dogumtarihi` date NOT NULL,
  `uyruk` varchar(10) NOT NULL,
  `dogumyeri` varchar(30) NOT NULL,
  `gorev` varchar(50) NOT NULL,
  `gorevtanim` varchar(250) DEFAULT NULL,
  `baslamatarih` date DEFAULT NULL,
  `baslamasekil` varchar(10) NOT NULL,
  `transferyeri` varchar(200) DEFAULT NULL,
  `tlf` varchar(15) NOT NULL,
  `adres` varchar(250) NOT NULL,
  `medenidurum` varchar(10) NOT NULL,
  `esadsoyad` varchar(60) DEFAULT NULL,
  `cocuksayi` int(11) NOT NULL,
  `cocukbilgi` varchar(300) DEFAULT NULL,
  `kisibilgi` varchar(300) DEFAULT NULL,
  `ayrilistarih` date DEFAULT NULL,
  `ayrilisneden` varchar(25) DEFAULT NULL,
  `resim` varchar(15) DEFAULT NULL,
  `aktiflik` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `staffs`
--

INSERT INTO `staffs` (`id`, `persicilno`, `ad`, `soyad`, `cinsiyet`, `babaadi`, `anneadi`, `dogumtarihi`, `uyruk`, `dogumyeri`, `gorev`, `gorevtanim`, `baslamatarih`, `baslamasekil`, `transferyeri`, `tlf`, `adres`, `medenidurum`, `esadsoyad`, `cocuksayi`, `cocukbilgi`, `kisibilgi`, `ayrilistarih`, `ayrilisneden`, `resim`, `aktiflik`) VALUES
(35, 'OP3542', 'Ahmet', 'Altaş', 'Man', 'Ali', 'Sabriye', '1971-05-10', 'TC', 'Şanlıurfa', 'Assistant Prison Administ', 'Deputy Director Responsible for Male Wards', '2001-01-01', 'Transport', 'Samsun Kapalı Cezaevi', '544 214 2961', 'Şanlıurfa', 'Married', 'Güler Altaş', 2, 'Hale 1997 doğumlu\r\nMerve 1999 doğumlu\r\n', '', '0000-00-00', '', 'staffpic/35.jpg', 'Yes'),
(36, 'OP3546', 'Mustafa', 'Açıksöz', 'Man', 'Mahmut', 'Naciye', '2001-01-01', 'TC', 'Bingöl', 'Chief Guard', 'Responsible for male prisoners', '2002-01-01', 'New', '', '541 314 2145', 'ratesdrfsdrfgdfhgh', 'Single', '', 0, '', '', '0000-00-00', '', 'staffpic/36.jpg', 'Yes'),
(37, 'OP3549', 'Alişan', 'Kaya', 'Man', 'Mahmut', 'Fatama', '2000-01-01', 'KKTC', 'Gazimağusa', 'Officer', 'Responsible for cleaning the mens wards.', '2018-01-01', 'New', '', '544 314 5648', 'rdyghj', 'Single', '', 0, '', '', '0000-00-00', '', NULL, 'Yes'),
(38, 'OP3550', 'Halil', 'Açıkalın', 'Man', 'Osman', 'Fahte', '1998-12-15', 'TC', 'Aydın', 'Officer', 'astdftgyh ghjjhko', '2015-02-01', 'Transport', 'Sivas Kapalı Cezaevi', '234 454 5632', 'drhfhfhdr zasfgdsfg afrdrgyh', 'Married', 'dsdgdf EDASEFDRF', 2, 'GFGFH SDGFDFG\r\nSFDFG SFSDF', 'XDGFGH   SFSDG', '0000-00-00', '', NULL, 'Yes'),
(39, 'OP3557', 'Ada', 'Akıncı', 'Woman', 'Tarık', 'Meltem', '1978-02-01', 'TC', 'Adıyaman', 'Nurse', 'Responsible for cleaning the womens wards', '2012-05-25', 'New', '', '544 456 4542', '', 'Single', '', 0, '', '', '0000-00-00', '', NULL, 'Yes'),
(40, 'OP3558', 'Hande', 'Mercan', 'Woman', 'Ekrem', 'Sabiha', '1968-11-05', 'KKTC', 'Güzelyurt', 'Prison Administrator', '', '1999-11-03', 'New', '', '532 452 6532', '', 'Single', '', 0, '', '', '0000-00-00', '', 'staffpic/40.jpg', 'Yes'),
(41, 'OP3559', 'Kadir', 'Kaleli', 'Man', 'Nuri', 'Bilge', '1992-05-01', 'KKTC', 'Iskele', 'Doctor', 'doktor', '2019-02-02', 'New', '', '542 254 1245', 'No Adress', 'Single', '', 0, '', '', '0000-00-00', '', NULL, 'Yes'),
(42, 'OP3560', 'Aslı', 'Karahan', 'Man', 'Hatice', 'Şükrü', '2002-01-01', 'KKTC', 'Girne', 'Nutritionist', '', '2024-01-01', 'New', '', '544 444 4444', 'asdfvdfcv', 'Married', 'asdasd', 1, 'asdcfsdf', 'asfdsfcv', '0000-00-00', '', 'staffpic/42.jpg', 'Yes'),
(43, 'OP3561', 'Mustafa', 'Karahan', 'Man', 'Temel', 'Elif', '2001-01-01', 'KKTC', 'Iskele', 'Guard', 'hlşi.', '2015-01-01', 'New', '', '541 215 6325', '1256 Sok. No :21 İSKELE', 'Single', '', 0, '', '', '0000-00-00', '', NULL, 'Yes'),
(44, 'OP3562', 'Suphi', 'Demir', 'Man', 'Halit', 'Mesude', '2001-01-01', 'TC', 'Bitlis', 'Cleaning Staff', '', '2023-01-01', 'New', '', '542 325 6981', 'No Adress', 'Married', 'Mahide Demir', 1, 'Ender Demir 2016 Doğumlu', '', '0000-00-00', '', NULL, 'No'),
(45, 'OP3566', 'Müslüm', 'Akalın', 'Man', 'Aydın', 'Nalan', '1987-11-19', 'TC', 'Bilecik', 'Assistant Prison Administ', 'Deputy Director Responsible for female Wards', '2008-05-12', 'New', '', '542 632 5252', 'No Adress', 'Married', 'Hatice Akalın', 1, 'Ali Akalın 2015 Doğumlu', '', '0000-00-00', '', NULL, 'Yes'),
(46, 'OP3567', 'Meltem', 'Tunçbilek', 'Woman', 'Nurullah', 'Funda', '1995-12-15', 'KKTC', 'Güzelyurt', 'Chief Guard', 'Responsible for female prisoners', '2012-01-01', 'New', '', '542 632 6587', 'Güzelyurt', 'Married', 'Ahmet Tunçbilek', 2, 'Emel Tunçbilek 2014 Doğumlu\r\nKayhan Tunçbilek 2018 Doğumlu', '', NULL, NULL, NULL, 'Yes'),
(47, 'OP3568', 'Merve', 'Kurt', 'Woman', 'Abuzer', 'Gülçin', '1999-06-26', 'TC', 'Şanlıurfa', 'Chef', '', '0000-00-00', 'New', '', '544 514 2998', '', 'Married', 'Mehmet Kurt', 0, '', '', NULL, NULL, NULL, 'Yes');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `gorevadi` varchar(25) NOT NULL,
  `gorevprtno` int(11) NOT NULL,
  `prt` varchar(3) NOT NULL,
  `gprt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tasks`
--

INSERT INTO `tasks` (`id`, `gorevadi`, `gorevprtno`, `prt`, `gprt`) VALUES
(1, 'Prison Administrator', 1, 'Yes', 1),
(2, 'Assistant Prison Administ', 2, 'Yes', 2),
(3, 'Chief Guard', 3, 'Yes', 3),
(4, 'Doctor', 4, 'No', 6),
(5, 'Nutritionist', 5, 'No', 7),
(6, 'Nurse', 6, 'No', 6),
(7, 'Guard', 7, 'No', 5),
(8, 'Chef', 9, 'No', 0),
(9, ' Kitchen Attendant', 10, 'No', 0),
(10, 'Cleaning Staff', 11, 'No', 0),
(11, 'Officer', 8, 'No', 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `persid` int(11) NOT NULL,
  `security` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `persid`, `security`) VALUES
(1, 'bWqItx55r3QyeeXv4Yb9LA==', 'E3VMEEeXOSW5AOS55N2KBw==', 0, 0),
(8, 'Ow82cpkpLCIGbeJgRvgKgQ==', 'JaFlsnMRzV8shyYB0Czbgg==', 40, 1),
(9, 'QPHrKIppKXpFwQzn8e4oFg==', '+5tyfjRpscNiUe62GdktSQ==', 35, 2),
(10, 'f2rAzuoXgKU30eCrmjfQjQ==', '1n0Hjo6tzYaRUUnPWy2Tug==', 45, 2),
(11, 'eP9usA0K7jf+nrWGwKl/Aw==', 'sv6p20+0SEd0PgxEdYGAfQ==', 46, 3),
(12, 'yreocbsruPvxeAHZR5Y7uw==', 'BcUJmYJkUtkOGIhXUr0jkQ==', 36, 3),
(14, 'oC8TYtDGLkQlSIR17PevhA==', 'iwnyQULxHENbd6McD9KaoA==', 41, 6),
(15, 'D4Lmc7/6FpJaeWcTrlluDg==', 'ep94BZXoE8DrnEFJvOFedw==', 42, 7),
(16, 'StCX63y5jS9j/eRLS+nf+A==', 'wP6zg9H+SCo/71DkA3Ys4A==', 39, 6),
(17, 'ZrDwA4VdLNMbc1WM5GnqIw==', 'ep94BZXoE8DrnEFJvOFedw==', 43, 5),
(18, '8+MT+vh0rlIn1Jc1qFgX+g==', 'aFrp+0pCgRrz+OPO/7h4XA==', 37, 4);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`idb`);

--
-- Tablo için indeksler `buildingdetail`
--
ALTER TABLE `buildingdetail`
  ADD PRIMARY KEY (`idbt`);

--
-- Tablo için indeksler `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `crimes`
--
ALTER TABLE `crimes`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `nutrition`
--
ALTER TABLE `nutrition`
  ADD PRIMARY KEY (`nutid`);

--
-- Tablo için indeksler `prisoners`
--
ALTER TABLE `prisoners`
  ADD PRIMARY KEY (`idprs`);

--
-- Tablo için indeksler `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`indexkolon`);

--
-- Tablo için indeksler `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `building`
--
ALTER TABLE `building`
  MODIFY `idb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Tablo için AUTO_INCREMENT değeri `buildingdetail`
--
ALTER TABLE `buildingdetail`
  MODIFY `idbt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- Tablo için AUTO_INCREMENT değeri `crimes`
--
ALTER TABLE `crimes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `nutrition`
--
ALTER TABLE `nutrition`
  MODIFY `nutid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Tablo için AUTO_INCREMENT değeri `prisoners`
--
ALTER TABLE `prisoners`
  MODIFY `idprs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `settings`
--
ALTER TABLE `settings`
  MODIFY `indexkolon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Tablo için AUTO_INCREMENT değeri `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
