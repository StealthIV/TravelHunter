<?php
session_start();
if (!isset($_SESSION["UserName"])) {
  header("location: index.php");
  exit();
}

require_once '../connect/dbcon.php';

$UserName = $_SESSION["UserName"];

try {
  $pdoQuery = "SELECT * FROM user WHERE UserName = :UserName";
  $pdoResult = $pdoConnect->prepare($pdoQuery);
  $pdoResult->execute(['UserName' => $UserName]);
  $user = $pdoResult->fetch();
  $profile_image = $user['image']; // Assuming this is the URL to the profile image
  $full_name = $user['FullName'];
} catch (PDOException $error) {
  echo $error->getMessage() . '';
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Explore Now!!</title>
  <!-- CSS -->
  <link rel="stylesheet" href="../style/home.css" />
  <link rel="stylesheet" href="../style/chatbot.css" />
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

  <?php require_once 'nav.php' ?>

  <section class="overlay"></section>

  <Section class="main">
    <div class="container">

     

      <h1 data-lang-en="Top Tourist Destinations" data-lang-es="Principales Destinos Turísticos"
        data-lang-fr="Meilleures Destinations Touristiques" data-lang-de="Top-Touristenziele"
        data-lang-zh="顶级旅游目的地 (Dǐngjí Lǚyóu Mùdìdì)" data-lang-jp="トップ観光地 (Toppu Kankōchi)ター"
        data-lang-ru="Топ Туристических Направлений" data-lang-it="Principali Destinazioni Turistiche"
        data-lang-pt="Principais Destinos Turísticos" data-lang-ar="أفضل الوجهات السياحية ">Top Tourist Destinations
      </h1>
      <p class="pl" data-lang-en="Discover the Paradise: Explore the Philippines with us!!"
        data-lang-es="Descubre el Paraíso: ¡Explora Filipinas con nosotros!"
        data-lang-fr="Découvrez le Paradis : Explorez les Philippines avec nous !!"
        data-lang-de="Entdecken Sie das Paradies: Erkunden Sie die Philippinen mit uns !!"
        data-lang-zh="发现天堂：与我们一起探索菲律宾！！" data-lang-jp="パラダイスを発見：私たちとフィリピンを探検しよう！！"
        data-lang-ru="Откройте для себя рай: исследуйте Филиппины с нами !!"
        data-lang-it="Scopri il Paradiso: Esplora le Filippine con noi !!"
        data-lang-pt="Descubra o Paraíso: Explore as Filipinas conosco !!"
        data-lang-ar="اكتشف الجنة: استكشف الفلبين معنا !!">
        Discover the Paradise: Explore the Philippines with us!!
      </p>


      <main>

        <div id="carousel" class="carousel">

          <div id='item_1' class="hideLeft">
            <a class="top" href="boracay.php"><img src="../img/5_20241024_104832_0004.png"></a>

          </div>

          <div id='item_2' class="prevLeftSecond">
            <a class="top" href="boracay.php"> <img src="../img/4_20241024_104832_0003.png"></a>

          </div>

          <div id='item_3' class="prev">
            <a class="top" href="boracay.php"> <img src="../img/3_20241024_104832_0002.png"></a>

          </div>

          <div id='item_4' class="selected">
            <a class="top" href="boracay.php"> <img src="../img/5_20241024_104832_0004.png"></a>

          </div>

          <div id='item_5' class="next">
            <a class="top" href="boracay.php"> <img src="../img/2_20241024_104832_0001.png"></a>

          </div>

          <div id='item_6' class="nextRightSecond">
            <a class="top" href="boracay.html"> <img src="../img/1_20241024_104831_0000.png"></a>

          </div>

          <div id='item_7' class="hideRight">
            <a class="top" href="boracay.html"> <img src="../places/palawan/Travel Hunter - 2.png"></a>

          </div>

          <div id='item_8' class="hideRight">
            <a class="top" href="boracay.html"> <img src="../places/palawan/Travel Hunter - 3.png"></a>

          </div>

        </div>

        <div class="buttons">
          <button class="button-82-pushable" role="button" id="prev"><span class="button-82-shadow"></span><span
              class="button-82-edge"></span><span
              class="button-82-front text"><span>&#139;</span></span></span></button>


          <button class="button-82-pushable" role="button" id="next"><span class="button-82-shadow"></span><span
              class="button-82-edge"></span><span class="button-82-front text"><span>&#155;</span></span></button>
        </div>

      </main>
  </section>


  <button class="init" id="init"><i class="bx bx-support icon"></i></button>

  <div id="test" style="position: fixed;top: 4rem;right: 8rem;display: none;margin-top:50px">
    <div class="child" id="chatbot">
      <div class="header9">
        <div class="h-child">
          <img src="../img/1.jpg" alt="avatar" id="avatar">
          <div>
            <span class="name" style=" font-size: 20px;">Chat Support</span>
            <br>
            <span style="color:lawngreen">online</span>
          </div>
        </div>
        <div class="sis">
          <button class="refBtn"><i class="fa fa-refresh" onclick="initChat()"></i></button>
        </div>
      </div>

      <div id="chat-box">

      </div>
      <div class="footer">
        <span> @TravelHunter</span>
      </div>
    </div>
  </div>
  </div>

  <section class="package">
    <main>
      <header>
        <h1 data-lang-en="Top Tourist Destination in Pampanga" data-lang-es="Principal Destino Turístico en Pampanga"
          data-lang-fr="Meilleure Destination Touristique à Pampanga" data-lang-de="Top-Touristenziel in Pampanga"
          data-lang-zh="邦板牙的顶级旅游目的地" data-lang-jp="パンパンガのトップ観光地 "
          data-lang-ru="Топ Туристическое Направление в Пампанге"
          data-lang-it="Principale Destinazione Turistica a Pampanga"
          data-lang-pt="Principal Destino Turístico em Pampanga" data-lang-ar="أفضل وجهة سياحية في بامبانجا"> <i
            class="bx bx-map icon" style=" color: #32b4ff;"></i><span></span>Top Tourist Destination in Pampanga</h1>
        <br>

        <p>
          <span class="span1">&#139;</span>
          <span class="span1">&#155;</span>

        </p>
      </header>
      <p class="p2">Discover the Paradise: Explore the Philippines with us!!</p>
      <section class="section6">
        <div class="product">
          <picture>
            <img src="../places/pampanga/Travel Hunter - 9.png" alt="Summer Place(Palakol)" class="clickable-image">
          </picture>
          <div class="detail">
            <p>

              <b data-lang-en="Summer Place(Palakol)" data-lang-es="Lugar de Verano (Palakol)"
                data-lang-fr="Endroit Estival (Palakol)" data-lang-de="Sommerort (Palakol)" data-lang-zh="夏日之地 "
                data-lang-jp="夏の場所" data-lang-ru="Летнее Место (Палакол)" data-lang-it="Luogo Estivo (Palakol)"
                data-lang-pt="Lugar de Verão (Palakol)" data-lang-ar="مكان الصيف "><i
                  class="bx bx-water icon"></i>Summer Place(Palakol) </b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small data-lang-en="San Jose Floridablanca, Pampanga" data-lang-es="Lugar de Verano (Palakol)"
                data-lang-fr="Endroit Estival (Palakol)" data-lang-de="Sommerort (Palakol)" data-lang-zh="圣何塞佛罗里达布兰卡 "
                data-lang-jp="サン・ホセ・フロリダブランカ、パンパンガ " data-lang-ru="Сан-Хосе Флоридабланка, Пампанга"
                data-lang-it="Luogo Estivo (Palakol)" data-lang-pt="Lugar de Verão (Palakol)"
                data-lang-ar="سان خوسيه فلوريدابلانكا، بامبانج">San Jose Floridablanca, Pampanga</small>
            </p>
          </div>

        </div>
        <div class="product">
          <picture>
            <img src="../places/pampanga/nabuclod.jpg" class="clickable-image">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Nabuclod Mountain View" data-lang-es="Vista de la Montaña Nabuclod"
                data-lang-fr="Vue sur la Montagne Nabuclod" data-lang-de="Nabuclod-Bergblick" data-lang-zh="那布克洛德山景  "
                data-lang-jp=" ナブクロッドの山の眺め " data-lang-ru="Вид на Гору Набуклод"
                data-lang-it="Vista sulla Montagna Nabuclod" data-lang-pt="Vista da Montanha Nabuclod"
                data-lang-ar="إطلالة جبل نابوكلود "><i class="bx bx-chevrons-up icon"></i>Nabuclod Mountain View</b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small data-lang-en="Nabuclod, Floridablanca, Pampanga" data-lang-es="Nabuclod, Floridablanca, Pampanga"
                data-lang-fr="Nabuclod, Floridablanca, Pampanga" data-lang-de="Nabuclod, Floridablanca, Pampanga"
                data-lang-zh=" 那布克洛德  " data-lang-jp=" ナブクロッド、フロリダブランカ、パンパンガ 眺め " data-lang-ru="Набуклод, Флоридабланка"
                data-lang-it="Nabuclod, Floridablanca, Pampanga" data-lang-pt="Nabuclod, Floridablanca, Pampanga"
                data-lang-ar="نابوكلود، فلوريدابلانكا، بامبانجا">Nabuclod, Floridablanca, Pampanga</small>
            </p>
          </div>
          <div class="button7">


          </div>
        </div>


        <div class="product">
          <picture>
            <img src="../places/Pampanga/tungab1.jpg" class="clickable-image">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Tungab Lagoon" data-lang-es="Laguna Tungab" data-lang-fr="Lagon Tungab"
                data-lang-de="Tungab-Lagune" data-lang-zh=" 通加布泻湖 " data-lang-jp=" トゥンガブ潟湖  "
                data-lang-ru="Лагуна Тунгаб" data-lang-it="Laguna di Tungab" data-lang-pt="Lagoa Tungab"
                data-lang-ar="بحيرة تونجاب"> <i class="bx bx-water icon"></i>Tungab Lagoon</b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small data-lang-en="Nabuclod, Floridablanca, Pampanga" data-lang-es="Nabuclod, Floridablanca, Pampanga"
                data-lang-fr="Nabuclod, Floridablanca, Pampanga" data-lang-de="Nabuclod, Floridablanca, Pampanga"
                data-lang-zh=" 那布克洛德  " data-lang-jp=" ナブクロッド、フロリダブランカ、パンパンガ 眺め " data-lang-ru="Набуклод, Флоридабланка"
                data-lang-it="Nabuclod, Floridablanca, Pampanga" data-lang-pt="Nabuclod, Floridablanca, Pampanga"
                data-lang-ar="نابوكلود، فلوريدابلانكا، بامبانجا">Nabuclod, Floridablanca, Pampanga</small>
            </p>

          </div>
          <div class="button7">


          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/Pampanga/sumuclab.jpg" class="clickable-image">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Sumuclab Lagoon" data-lang-es="Laguna Sumuclab" data-lang-fr="Lagon Sumuclab"
                data-lang-de="Sumuclab-Lagune" data-lang-zh=" 通加布泻湖 " data-lang-jp=" トゥンガブ潟湖  "
                data-lang-ru="Лагуна Тунгаб" data-lang-it="Laguna di Sumuclab" data-lang-pt="Lagoa Sumuclab"
                data-lang-ar="بحيرة تونجاب"><i class="bx bx-water icon"></i>Sumuclab Lagoon</b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small data-lang-en="Nabuclod, Floridablanca, Pampanga" data-lang-es="Nabuclod, Floridablanca, Pampanga"
                data-lang-fr="Nabuclod, Floridablanca, Pampanga" data-lang-de="Nabuclod, Floridablanca, Pampanga"
                data-lang-zh=" 那布克洛德  " data-lang-jp=" ナブクロッド、フロリダブランカ、パンパンガ 眺め " data-lang-ru="Набуклод, Флоридабланка"
                data-lang-it="Nabuclod, Floridablanca, Pampanga" data-lang-pt="Nabuclod, Floridablanca, Pampanga"
                data-lang-ar="نابوكلود، فلوريدابلانكا، بامبانجا">Nabuclod, Floridablanca, Pampanga</small>
            </p>

          </div>
          <div class="button7">


          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/Pampanga/puning1.jpg" class="clickable-image">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Puning Hot Spring" data-lang-es="Aguas Termales de Puning"
                data-lang-fr="Source Thermale de Puning" data-lang-de="Puning-Heißquelle" data-lang-zh=" 埔宁温泉 "
                data-lang-jp=" プニング温泉  " data-lang-ru="Горячий Источник Пуньин "
                data-lang-it="Sorgente Termale di Puning" data-lang-pt="Fonte Termal de Puning"
                data-lang-ar=" الينابيع الساخنة في بونينغ "><i class="bx bx-water icon"></i>Puning Hot Spring</b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small data-lang-en="Sapang Bato, Angeles City,Pampanga"
                data-lang-es="Sapang Bato, Ciudad de Angeles, Pampanga"
                data-lang-fr="Sapang Bato, Ville d'Angeles, Pampanga "
                data-lang-de="Sapang Bato, Angeles Stadt, Pampanga" data-lang-zh=" 萨庞巴托，安赫莱斯市，邦板牙  "
                data-lang-jp=" サパンバト、アンヘレス市、パンパンガ  " data-lang-ru="Сапанг Батo, Город Анджелес, Пампанга"
                data-lang-it=" Sapang Bato, Città di Angeles, Pampanga"
                data-lang-pt="Sapang Bato, Cidade de Angeles, Pampanga"
                data-lang-ar=" سابانغ باتو، مدينة أنجيليس، بامبانجا ">Sapang Bato, Angeles City,Pampanga</small>
            </p>

          </div>
          <div class="button7">

          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/Pampanga/mtp.jpg" class="clickable-image">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Mount Pinatubo" data-lang-es="Monte Pinatubo" data-lang-fr="Mont Pinatubo"
                data-lang-de=" Berg Pinatubo" data-lang-zh=" 皮纳图博山 " data-lang-jp=" ピナトゥボ山  "
                data-lang-ru="Гора Пинатубо " data-lang-it="Monte Pinatubo" data-lang-pt="Monte Pinatubo"
                data-lang-ar="جبل بيناتوبو "><i class="bx bx-chevrons-up icon"></i>Mount Pinatubo</b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small data-lang-en="Station 3, Front Beach Malay" data-lang-es="Estación 3, Playa Frontal Malay"
                data-lang-fr="Station 3, Plage Frontale Malay" data-lang-de="Station 3, Frontstrand Malay"
                data-lang-zh="马来正滩 3 号站" data-lang-jp=" ステーション3、フロントビーチ・マレイ  " data-lang-ru="Станция 3, Пляж Малай "
                data-lang-it="Stazione 3, Spiaggia Frontale Malay" data-lang-pt="Estação 3, Praia Frontal Malay"
                data-lang-ar="المحطة 3، شاطئ الواجهة مالاي">Station 3, Front Beach Malay</small>
            </p>

          </div>
          <div class="button7">


          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/Pampanga/miyamit.jpg" class="clickable-image">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Miyamit Falls" data-lang-es="Cataratas Miyamit" data-lang-fr="Chutes Miyamit"
                data-lang-de=" Miyamit Wasserfälle" data-lang-zh=" 米亚米特瀑布 " data-lang-jp=" ミヤミットの滝  "
                data-lang-ru="Водопады Миямит" data-lang-it="Cascate Miyamit" data-lang-pt="Cachoeiras Miyamit"
                data-lang-ar="شلالات مياميت"><i class="bx bx-water icon"></i>Miyamit Falls</b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small data-lang-en="Baranggay Sapang Uwak, Porac,Pampanga"
                data-lang-es="Baranggay Sapang Uwak, Porac,Pampanga"
                data-lang-fr="Baranggay Sapang Uwak, Porac,Pampanga"
                data-lang-de="Baranggay Sapang Uwak, Porac,Pampanga" data-lang-zh="  沙邦乌瓦克村，波拉克，邦板牙省  "
                data-lang-jp=" バランガイ・サパン・ウワク、ポラック、パンパンガ  " data-lang-ru="Барангаи Сапанг Увак, Порак, Пампанга"
                data-lang-it="Barangay Sapang Uwak, Porac, Pampanga"
                data-lang-pt="Barangay Sapang Uwak, Porac, Pampanga"
                data-lang-ar="بارانغاي سابانغ أوواك، بوراك، بامبانغا">Baranggay Sapang Uwak, Porac,Pampanga</small>
            </p>

          </div>
          <div class="button7">

          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/Pampanga/mt arayat.jpg" class="clickable-image">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Mount Arayat National Park" data-lang-es="Parque Nacional del Monte Arayat"
                data-lang-fr="Parc National du Mont Arayat" data-lang-de=" Nationalpark Mount Arayat"
                data-lang-zh="阿拉亚山国家公园 " data-lang-jp=" アラヤット山国立公園  " data-lang-ru="Национальный парк Маунт Араят"
                data-lang-it="Parco Nazionale del Monte Arayat" data-lang-pt="Parque Nacional do Monte Arayat"
                data-lang-ar="منتزه جبل أرايات الوطني"><i class="bx bx-chevrons-up icon"></i>Mount Arayat National
                Park</b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small data-lang-en="Arayat, Pampanga" data-lang-es="Arayat, Pampanga" data-lang-fr="Arayat, Pampanga"
                data-lang-de="Arayat, Pampanga" data-lang-zh="阿拉亚特，邦板牙省" data-lang-jp=" アラヤット、パンパンガ   "
                data-lang-ru="Араят, Пампанга" data-lang-it="Arayat, Pampanga" data-lang-pt="Arayat, Pampanga"
                data-lang-ar="أرايات، بامبانغا "> Arayat, Pampanga</small>
            </p>

          </div>

        </div>
        <div class="product">
          <picture>
            <img src="../places/Pampanga/ilog kamalig.jpg" class="clickable-image">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Ilog Kamalig" data-lang-es="río granero" data-lang-fr="rivière grange"
                data-lang-de=" Fluss Scheune" data-lang-zh=" 河谷仓  " data-lang-jp="  川倉庫  " data-lang-ru="река амбар"
                data-lang-it="fiume granaio" data-lang-pt="rio celeiro" data-lang-ar="نهر المخزن "><i
                  class="bx bx-water icon"></i>Ilog Kamalig </b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small data-lang-en="Pio, Porac, Pampanga" data-lang-es=" Pio, Porac, Provincia de Pampanga"
                data-lang-fr="Pio, Porac, Province de Pampanga" data-lang-de=" Pio, Porac, Provinz Pampanga"
                data-lang-zh="皮奥，波拉克，邦板牙省 " data-lang-jp="  ピオ、ポラック、パンパンガ州  "
                data-lang-ru="Пио, Порак, провинция Пампанга" data-lang-it="Pio, Porac, Provincia di Pampanga"
                data-lang-pt="Pio, Porac, Província de Pampanga" data-lang-ar="بيو، بوراك، مقاطعة بامبانجا">Pio, Porac,
                Pampanga</small>
            </p>

          </div>

        </div>
        <div class="product">
          <picture>
            <img src="../places/Pampanga/ana an.jpg">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Ana an Falls " data-lang-es="Ana an Cascadas" data-lang-fr="Ana an Chutes"
                data-lang-de=" Ana an Wasserfälle" data-lang-zh=" 阿娜安瀑布  " data-lang-jp="  アナ アン 滝"
                data-lang-ru="Ана ан Водопады " data-lang-it="Ana an Cascate" data-lang-pt="Ana an Cachoeiras"
                data-lang-ar="آنا آن شلالات "><i class="bx bx-water icon"></i>Ana an Falls </b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small data-lang-en="Inararo,Porac, Pampanga " data-lang-es=" Inararo, Porac, Provincia de Pampanga"
                data-lang-fr="Inararo, Porac, Province de Pampanga" data-lang-de="  Inararo, Porac, Provinz Pampanga"
                data-lang-zh="  伊纳拉罗，波拉克，邦板牙省  " data-lang-jp="  イナラロ、ポラック、パンパンガ州"
                data-lang-ru=" Индараро, Порак, провинция Пампанга" data-lang-it="Inararo, Porac, Provincia di Pampanga"
                data-lang-pt=" Inararo, Porac, Província de Pampanga" data-lang-ar="آنا آن شلالات ">Inararo,Porac,
                Pampanga</small>
            </p>

          </div>

        </div>
        <div class="product">
          <picture>
            <img src="../places/Pampanga/dara.jpg">
          </picture>
          <div class="detail">
            <p>
              <b><i class="bx bx-water icon"></i>Dara Water Falls </b><br>
              <i class="bx bx-map icon" style="color: red;"></i>
              <small> Jalung, Porac, Pampanga</small>
            </p>

          </div>

        </div>
        <div class="product">
          <picture>
            <img src="../places/Pampanga/Bigfalls.jpg">
          </picture>
          <div class="detail">
            <p>
              <b><i class="bx bx-water icon"></i>Big Falls</b><br>
              <i class="bx bx-map icon" style="color: red;"></i>
              <small>Pidpid, Porac, Pampanga</small>
            </p>

          </div>

        </div>
      </section>
    </main>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        // Language Switcher Function
        function switchLanguage(lang) {
          document.querySelectorAll(`[data-lang-${lang}]`).forEach(element => {
            element.textContent = element.getAttribute(`data-lang-${lang}`);
          });
        }

        // Initialize Language Selection Event Listeners
        function setupLanguageSwitcher() {
          document.querySelectorAll('.language-option').forEach(button => {
            button.addEventListener('click', function () {
              const selectedLang = this.getAttribute('data-lang');
              switchLanguage(selectedLang);
            });
          });
        }

        // Modal Popup Functionality for Images
        function enableImageModal(imageSelector) {
          const modal = document.createElement('div');
          modal.classList.add('modal');
          modal.innerHTML = `
      <div class="modal-content">
        <span class="close-button">&times;</span>
        <img class="modal-image" src="" alt="Enlarged Image">
      </div>
    `;
          document.body.appendChild(modal);

          const modalImage = modal.querySelector('.modal-image');
          const closeButton = modal.querySelector('.close-button');

          document.querySelectorAll(imageSelector).forEach(image => {
            image.addEventListener('click', function () {
              modalImage.src = this.src;
              modal.style.display = 'block';
            });
          });

          closeButton.addEventListener('click', function () {
            modal.style.display = 'none';
          });

          window.addEventListener('click', function (event) {
            if (event.target === modal) {
              modal.style.display = 'none';
            }
          });
        }

        // Initialize Features
        setupLanguageSwitcher();
        enableImageModal('.clickable-image');
      });

    </script>

    <main>

      <header>
        <h1 data-lang-en="Top Tourist Destination in Boracay" data-lang-es="Principal Destino Turístico en Boracay"
          data-lang-fr="Meilleure Destination Touristique à Boracay" data-lang-de="Top-Touristenziel in Boracay"
          data-lang-zh="邦板牙的顶级旅游目的地" data-lang-jp="パンパンガのトップ観光地 "
          data-lang-ru="Топ Туристическое Направление в Пампанге"
          data-lang-it="Principale Destinazione Turistica a Boracay"
          data-lang-pt="Principal Destino Turístico em Boracay" data-lang-ar="أفضل وجهة سياحية في بامبانجا"> <i
            class="bx bx-map icon" style="color: red;"></i>Top Tourist Destination in Boracay</h1>
        <p>
          <span class="span2">&#139;</span>
          <span class="span2">&#155;</span>

        </p>
      </header>
      <p class="p2">Discover the Paradise: Explore the Philippines with us!!</p>
      <section class="section6">
        <div class="product">
          <picture>
            <img src="../places/boracay/white1.jpg">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="White Beach" data-lang-es="Playa Blanca" data-lang-fr="Plage Blanche"
                data-lang-de="Weißer Strand" data-lang-zh="白沙滩" data-lang-jp="ホワイトビーチ" data-lang-ru="Белый Пляж"
                data-lang-it="Spiaggia Bianca" data-lang-pt="Praia Branca" data-lang-ar="شاطئ أبيض"><i
                  class="bx bx-water icon"></i>
                White Beach
              </b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small data-lang-en="White Beach Station 1, Boracay Island, Malay, Philippines"
                data-lang-es="Estación 1 de Playa Blanca, Isla Boracay, Malay, Filipinas"
                data-lang-fr="Station 1 de la Plage Blanche, Île de Boracay, Malay, Philippines"
                data-lang-de="Weißer Strand Station 1, Boracay-Insel, Malay, Philippinen" data-lang-zh="白沙滩站1，菲律宾马来博拉凯岛"
                data-lang-jp="ホワイトビーチステーション1、ボラカイ島、マレーシア、フィリピン"
                data-lang-ru="Станция 1 Белого Пляжа, Остров Борокай, Малай, Филиппины"
                data-lang-it="Stazione 1 della Spiaggia Bianca, Isola di Boracay, Malay, Filippine"
                data-lang-pt="Estação 1 da Praia Branca, Ilha de Boracay, Malay, Filipinas"
                data-lang-ar="محطة 1 لشاطئ أبيض، جزيرة بوراكاي، مالاي، الفلبين">
                White Beach Station 1, Boracay Island, Malay, Philippines
              </small>
            </p>
          </div>

        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Puka Shell Beach.jpg">
          </picture>
          <div class="detail">
            <p>
              <b><i class="bx bx-water icon"></i>Puka Shell Beach</b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small> Malay, Aklan</small>
            </p>

          </div>

        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Puka Shell Beach.jpg">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Puka Shell Beach" data-lang-es="Playa de Conchas Puka"
                data-lang-fr="Plage de Coquilles Puka" data-lang-de="Puka-Muschel-Strand" data-lang-zh="普卡贝壳沙滩"
                data-lang-jp="プカシェルビーチ" data-lang-ru="Пляж Пука" data-lang-it="Spiaggia Puka"
                data-lang-pt="Praia de Conchas Puka" data-lang-ar="شاطئ بوكه"><i class="bx bx-water icon"></i>
                Puka Shell Beach
              </b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small data-lang-en="Malay, Aklan" data-lang-es="Malay, Aklan" data-lang-fr="Malay, Aklan"
                data-lang-de="Malay, Aklan" data-lang-zh="马来，阿克兰" data-lang-jp="マレー、アklan" data-lang-ru="Малай, Аклан"
                data-lang-it="Malay, Aklan" data-lang-pt="Malay, Aklan" data-lang-ar="مالاي، أكلان">
                Malay, Aklan
              </small>
            </p>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/ariel1.jpg">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Ariel's Point" data-lang-es="Punto de Ariel" data-lang-fr="Point d'Ariel"
                data-lang-de="Ariels Punkt" data-lang-zh="阿里尔角" data-lang-jp="アリエルズポイント" data-lang-ru="Точка Ариэль"
                data-lang-it="Punto di Ariel" data-lang-pt="Ponto de Ariel" data-lang-ar="نقطة أرييل"><i
                  class="bx bx-water icon"></i>
                Ariel's Point
              </b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small data-lang-en="Batason, Buruanga, Malay, Aklan Province"
                data-lang-es="Batason, Buruanga, Malay, Provincia de Aklan"
                data-lang-fr="Batason, Buruanga, Malay, Province d'Aklan"
                data-lang-de="Batason, Buruanga, Malay, Provinz Aklan" data-lang-zh="巴塔松，布鲁安加，阿克兰省，马来"
                data-lang-jp="バタソン、ブルアンダ、マレー、アクラン州" data-lang-ru="Батасон, Буруанга, Малай, Провинция Аклан"
                data-lang-it="Batason, Buruanga, Malay, Provincia di Aklan"
                data-lang-pt="Batason, Buruanga, Malay, Província de Aklan"
                data-lang-ar="باتاسون، بوروانغا، مالاي، محافظة أكلان">
                Batason, Buruanga, Malay, Aklan Province
              </small>
            </p>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/din.jpg">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Diniwid Beach" data-lang-es="Playa Diniwid" data-lang-fr="Plage de Diniwid"
                data-lang-de="Diniwid Strand" data-lang-zh="迪尼维德沙滩" data-lang-jp="ディニウィッドビーチ"
                data-lang-ru="Пляж Динивид" data-lang-it="Spiaggia di Diniwid" data-lang-pt="Praia Diniwid"
                data-lang-ar="شاطئ دينيود"><i class="bx bx-water icon"></i>
                Diniwid Beach
              </b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small data-lang-en="Malay, Aklan." data-lang-es="Malay, Aklan." data-lang-fr="Malay, Aklan."
                data-lang-de="Malay, Aklan." data-lang-zh="马来，阿克兰。" data-lang-jp="マレー、アklan。"
                data-lang-ru="Малай, Аклан." data-lang-it="Malay, Aklan." data-lang-pt="Malay, Aklan."
                data-lang-ar="مالاي، أكلان.">
                Malay, Aklan.
              </small>
            </p>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/will.jpg">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Willy's Rock" data-lang-es="Roca de Willy" data-lang-fr="Rocher de Willy"
                data-lang-de="Willys Felsen" data-lang-zh="威利岩" data-lang-jp="ウィリーの岩" data-lang-ru="Скала Уилли"
                data-lang-it="Roccia di Willy" data-lang-pt="Pedra do Willy" data-lang-ar="صخرة ويلي"><i
                  class="bx bx-water icon"></i>
                Willy's Rock
              </b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small data-lang-en="XW99+7FW, Malay, Aklan" data-lang-es="XW99+7FW, Malay, Aklan"
                data-lang-fr="XW99+7FW, Malay, Aklan" data-lang-de="XW99+7FW, Malay, Aklan"
                data-lang-zh="XW99+7FW，马来，阿克兰" data-lang-jp="XW99+7FW、マレー、アklan" data-lang-ru="XW99+7FW, Малай, Аклан"
                data-lang-it="XW99+7FW, Malay, Aklan" data-lang-pt="XW99+7FW, Malay, Aklan"
                data-lang-ar="XW99+7FW، مالاي، أكلان">
                XW99+7FW, Malay, Aklan
              </small>
            </p>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/Iligiligan-beach.jpg">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Ilig Iligan Beach" data-lang-es="Playa Ilig Iligan" data-lang-fr="Plage Ilig Iligan"
                data-lang-de="Ilig Iligan Strand" data-lang-zh="伊利格伊利根沙滩" data-lang-jp="イリグイリガンビーチ"
                data-lang-ru="Пляж Илиг Илигн" data-lang-it="Spiaggia di Ilig Iligan" data-lang-pt="Praia Ilig Iligan"
                data-lang-ar="شاطئ إيلغ إيلغن"><i class="bx bx-water icon"></i>
                Ilig Iligan Beach
              </b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small data-lang-en="Malay, Aklan" data-lang-es="Malay, Aklan" data-lang-fr="Malay, Aklan"
                data-lang-de="Malay, Aklan" data-lang-zh="马来，阿克兰" data-lang-jp="マレー、アklan" data-lang-ru="Малай, Аклан"
                data-lang-it="Malay, Aklan" data-lang-pt="Malay, Aklan" data-lang-ar="مالاي، أكلان">
                Malay, Aklan
              </small>
            </p>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/mount-luho.jpg">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Mount Luho" data-lang-es="Monte Luho" data-lang-fr="Mont Luho" data-lang-de="Berg Luho"
                data-lang-zh="卢霍山" data-lang-jp="マウントルホ" data-lang-ru="Гора Лухо" data-lang-it="Monte Luho"
                data-lang-pt="Monte Luho" data-lang-ar="جبل لوه"><i class="bx bx-water icon"></i>
                Mount Luho
              </b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small data-lang-en="Malay, Aklan" data-lang-es="Malay, Aklan" data-lang-fr="Malay, Aklan"
                data-lang-de="Malay, Aklan" data-lang-zh="马来，阿克兰" data-lang-jp="マレー、アklan" data-lang-ru="Малай, Аклан"
                data-lang-it="Malay, Aklan" data-lang-pt="Malay, Aklan" data-lang-ar="مالاي، أكلان">
                Malay, Aklan
              </small>
            </p>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/bulabog.jpg">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Bulabog Beach" data-lang-es="Playa Bulabog" data-lang-fr="Plage de Bulabog"
                data-lang-de="Bulabog Strand" data-lang-zh="布拉博沙滩" data-lang-jp="ブラバグビーチ" data-lang-ru="Пляж Булобог"
                data-lang-it="Spiaggia di Bulabog" data-lang-pt="Praia de Bulabog" data-lang-ar="شاطئ بولابوغ"><i
                  class="bx bx-water icon"></i>
                Bulabog Beach
              </b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small data-lang-en="Malay, Aklan" data-lang-es="Malay, Aklan" data-lang-fr="Malay, Aklan"
                data-lang-de="Malay, Aklan" data-lang-zh="马来，阿克兰" data-lang-jp="マレー、アklan" data-lang-ru="Малай, Аклан"
                data-lang-it="Malay, Aklan" data-lang-pt="Malay, Aklan" data-lang-ar="مالاي، أكلان">
                Malay, Aklan
              </small>
            </p>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/crystal.jpg">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Crystal Cove Island" data-lang-es="Isla Crystal Cove" data-lang-fr="Île Crystal Cove"
                data-lang-de="Crystal Cove Insel" data-lang-zh="水晶湾岛" data-lang-jp="クリスタルコーブアイランド"
                data-lang-ru="Остров Кристал Ков" data-lang-it="Isola Crystal Cove" data-lang-pt="Ilha Crystal Cove"
                data-lang-ar="جزيرة كريستال كوف"><i class="bx bx-water icon"></i>
                Crystal Cove Island
              </b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small data-lang-en="Tabon Point, Malay, Aklan" data-lang-es="Punta Tabon, Malay, Aklan"
                data-lang-fr="Point Tabon, Malay, Aklan" data-lang-de="Tabon Point, Malay, Aklan"
                data-lang-zh="塔博点，马来，阿克兰" data-lang-jp="タボンポイント、マレー、アklan" data-lang-ru="Точка Табон, Малай, Аклан"
                data-lang-it="Punto Tabon, Malay, Aklan" data-lang-pt="Ponto Tabon, Malay, Aklan"
                data-lang-ar="نقطة تابون، مالاي، أكلان">
                Tabon Point, Malay, Aklan
              </small>
            </p>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/crocodile.jpg">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Crocodile Island" data-lang-es="Isla Cocodrilo" data-lang-fr="Île Crocodile"
                data-lang-de="Krokodilinsel" data-lang-zh="鳄鱼岛" data-lang-jp="クロコダイルアイランド"
                data-lang-ru="Остров Крокодил" data-lang-it="Isola Crocodile" data-lang-pt="Ilha Crocodile"
                data-lang-ar="جزيرة تمساح"><i class="bx bx-water icon"></i>
                Crocodile Island
              </b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small data-lang-en="Malay, Aklan" data-lang-es="Malay, Aklan" data-lang-fr="Malay, Aklan"
                data-lang-de="Malay, Aklan" data-lang-zh="马来，阿克兰" data-lang-jp="マレー、アklan" data-lang-ru="Малай, Аклан"
                data-lang-it="Malay, Aklan" data-lang-pt="Malay, Aklan" data-lang-ar="مالاي، أكلان">
                Malay, Aklan
              </small>
            </p>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/baling.jpg">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Balinghai Beach" data-lang-es="Playa Balinghai" data-lang-fr="Plage Balinghai"
                data-lang-de="Balinghai Strand" data-lang-zh="巴林海沙滩" data-lang-jp="バリンハイビーチ"
                data-lang-ru="Пляж Балингхай" data-lang-it="Spiaggia di Balinghai" data-lang-pt="Praia de Balinghai"
                data-lang-ar="شاطئ بالينغهاي"><i class="bx bx-water icon"></i>
                Balinghai Beach
              </b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small data-lang-en="Road-C, Malay, Aklan" data-lang-es="Camino-C, Malay, Aklan"
                data-lang-fr="Route-C, Malay, Aklan" data-lang-de="Straße-C, Malay, Aklan" data-lang-zh="马来，阿克兰的C路"
                data-lang-jp="マレー、アklanのC通り" data-lang-ru="Дорога-C, Малай, Аклан" data-lang-it="Strada-C, Malay, Aklan"
                data-lang-pt="Estrada-C, Malay, Aklan" data-lang-ar="الطريق-C، مالاي، أكلان">
                Road-C, Malay, Aklan
              </small>
            </p>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/tambisan.jpg">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Tambisaan Beach" data-lang-es="Playa Tambisaan" data-lang-fr="Plage Tambisaan"
                data-lang-de="Tambisaan Strand" data-lang-zh="坦比萨安沙滩" data-lang-jp="タンビサアンビーチ"
                data-lang-ru="Пляж Тамбисан" data-lang-it="Spiaggia di Tambisaan" data-lang-pt="Praia de Tambisaan"
                data-lang-ar="شاطئ تامبيسان"><i class="bx bx-water icon"></i>
                Tambisaan Beach
              </b><br>

              <i class="bx bx-map icon" style=" color: #32b4ff;"></i>
              <small data-lang-en="Malay, Aklan" data-lang-es="Malay, Aklan" data-lang-fr="Malay, Aklan"
                data-lang-de="Malay, Aklan" data-lang-zh="马来，阿克兰" data-lang-jp="マレー、アklan" data-lang-ru="Малай, Аклан"
                data-lang-it="Malay, Aklan" data-lang-pt="Malay, Aklan" data-lang-ar="مالاي، أكلان">
                Malay, Aklan
              </small>
            </p>
          </div>
        </div>
      </section>
    </main>



    <main>
      <div class="text">

      </div>
      <header>
        <h1 data-lang-en="Top Hottest Products in Boracay" data-lang-es="Los Productos Más Populares"
          data-lang-fr="Produits Les Plus Tendance" data-lang-de="Die Beliebtesten Produkte" data-lang-zh="最热门的产品"
          data-lang-jp="最も人気のある製品 " data-lang-ru="Самые Популярные Продукты " data-lang-it="I Prodotti Più Popolari"
          data-lang-pt="Os Produtos Mais Populares" data-lang-ar="أكثر المنتجات شهرة "><i class="bx bx-gift icon"
            style="color: red;"></i>Top Hottest Products</h1>
        <p>
          <span class="span3">&#139;</span>
          <span class="span3">&#155;</span>

        </p>
      </header>
      <p class="p2">Discover the Paradise: Explore the Philippines with us!!</p>
      <section class="section6">
        <div class="product">
          <picture>
            <img src="../places/boracay/1_20240923_211810_0000.png" alt="Shell Keychains">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Shell Keychains" data-lang-es="Llaveros de Concha" data-lang-fr="Porte-clés Coquillage"
                data-lang-de="Muschel-Schlüsselanhänger" data-lang-zh="贝壳钥匙链" data-lang-jp="シェルキーホルダー"
                data-lang-ru="Брелоки с ракушками" data-lang-it="Portachiavi con Conchiglie"
                data-lang-pt="Chaveiros de Conchas" data-lang-ar="ميداليات الصدف"><i
                  class="bx bx-shopping-bag icon"></i>Shell Keychains</b><br>
            </p>
            <samp>₱500.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="../include/boracaymarket.php" data-lang-en="Buy Now!!" data-lang-es="¡Compra Ahora!"
              data-lang-fr="Acheter Maintenant!" data-lang-de="Jetzt Kaufen!" data-lang-zh="立即购买！" data-lang-jp="今すぐ購入！"
              data-lang-ru="Купить Сейчас!" data-lang-it="Acquista Ora!" data-lang-pt="Compre Agora!"
              data-lang-ar="اشتري الآن!!">Buy Now</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/2_20240923_211811_0001.png" alt="Beaded Bracelets">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Beaded Bracelets" data-lang-es="Pulseras de Cuentas" data-lang-fr="Bracelets en Perles"
                data-lang-de="Perlenarmbänder" data-lang-zh="珠饰手链" data-lang-jp="ビーズブレスレット"
                data-lang-ru="Браслеты с Бусинами" data-lang-it="Braccialetti di Perline"
                data-lang-pt="Pulseiras de Miçangas" data-lang-ar="أساور خرز"><i
                  class="bx bx-shopping-bag icon"></i>Beaded Bracelets</b><br>
            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="../include/boracaymarket.php" data-lang-en="Buy Now!!" data-lang-es="¡Compra Ahora!"
              data-lang-fr="Acheter Maintenant!" data-lang-de="Jetzt Kaufen!" data-lang-zh="立即购买！" data-lang-jp="今すぐ購入！"
              data-lang-ru="Купить Сейчас!" data-lang-it="Acquista Ora!" data-lang-pt="Compre Agora!"
              data-lang-ar="اشتري الآن!!">Buy Now</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/3_20240923_211811_0002.png" alt="Handwoven Bag">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Handwoven Bag" data-lang-es="Bolsa Tejida" data-lang-fr="Sac Tissé"
                data-lang-de="Handgewebte Tasche" data-lang-zh="手工编织包" data-lang-jp="手織りバッグ"
                data-lang-ru="Ручная плетеная сумка" data-lang-it="Borsa Intrecciata" data-lang-pt="Bolsa Feita à Mão"
                data-lang-ar="حقيبة منسوجة"><i class="bx bx-shopping-bag icon"></i>Handwoven Bag</b><br>
            </p>
            <samp>₱500.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="../include/boracaymarket.php" data-lang-en="Buy Now!!" data-lang-es="¡Compra Ahora!"
              data-lang-fr="Acheter Maintenant!" data-lang-de="Jetzt Kaufen!" data-lang-zh="立即购买！" data-lang-jp="今すぐ購入！"
              data-lang-ru="Купить Сейчас!" data-lang-it="Acquista Ora!" data-lang-pt="Compre Agora!"
              data-lang-ar="اشتري الآن!!">Buy Now</a>
          </div>
        </div>

        <!-- Additional products follow the same format -->

        <div class="product">
          <picture>
            <img src="../places/boracay/4_20240923_211811_0003.png" alt="White Beach Sarong">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="White Beach Sarong" data-lang-es="Sarong de Playa Blanco"
                data-lang-fr="Paréo de Plage Blanc" data-lang-de="Weißer Strand-Sarong" data-lang-zh="白色沙滩纱笼"
                data-lang-jp="ホワイトビーチサロン" data-lang-ru="Белый Пляжный Парео" data-lang-it="Sarong da Spiaggia Bianco"
                data-lang-pt="Sarong de Praia Branco" data-lang-ar="سارونج شاطئ أبيض"><i
                  class="bx bx-shopping-bag icon"></i>White Beach Sarong</b><br>
            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="../include/boracaymarket.php" data-lang-en="Buy Now!!" data-lang-es="¡Compra Ahora!"
              data-lang-fr="Acheter Maintenant!" data-lang-de="Jetzt Kaufen!" data-lang-zh="立即购买！" data-lang-jp="今すぐ購入！"
              data-lang-ru="Купить Сейчас!" data-lang-it="Acquista Ora!" data-lang-pt="Compre Agora!"
              data-lang-ar="اشتري الآن!!">Buy Now</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/5_20240923_211811_0004.png" alt="Bamboo Craft Wooden Figure">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Bamboo Craft Wooden Figure" data-lang-es="Figura de Madera de Bambú"
                data-lang-fr="Figurine en Bois de Bambou" data-lang-de="Bambuskunst-Holzfigur" data-lang-zh="竹制工艺木雕"
                data-lang-jp="竹工芸木製フィギュア" data-lang-ru="Бамбуковая Деревянная Фигура"
                data-lang-it="Figura di Legno in Bambù" data-lang-pt="Figura de Madeira de Bambu"
                data-lang-ar="تمثال خشبي من الخيزران"><i class="bx bx-shopping-bag icon"></i>Bamboo Craft Wooden
                Figure</b><br>
            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#" data-lang-en="Buy Now!!" data-lang-es="¡Compra Ahora!"
              data-lang-fr="Acheter Maintenant!" data-lang-de="Jetzt Kaufen!" data-lang-zh="立即购买！" data-lang-jp="今すぐ購入！"
              data-lang-ru="Купить Сейчас!" data-lang-it="Acquista Ora!" data-lang-pt="Compre Agora!"
              data-lang-ar="اشتري الآن!!"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/6_20240923_211811_0005.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Boracay Island Tee" data-lang-es="Camiseta de la Isla de Boracay"
                data-lang-fr="T-shirt de l'île de Boracay" data-lang-de="Boracay-Insel T-Shirt" data-lang-zh="博拉凯岛T恤"
                data-lang-jp="ボラカイ島のTシャツ" data-lang-ru="Футболка Острова Борокай"
                data-lang-it="T-shirt Isola di Boracay" data-lang-pt="Camiseta da Ilha de Boracay"
                data-lang-ar="تي شيرت جزيرة بوراكاي"><i class="bx bx-shopping-bag icon"></i>
                Boracay Island Tee
              </b><br>
            </p>
            <samp>₱600.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/7_20240923_211811_0006.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Coral Reef Wall Art" data-lang-es="Arte de Pared de Arrecife de Coral"
                data-lang-fr="Art Mural de Récif de Corail" data-lang-de="Wandkunst des Korallenriffs"
                data-lang-zh="珊瑚礁墙面艺术" data-lang-jp="サンゴ礁の壁アート" data-lang-ru="Настенное искусство кораллового рифа"
                data-lang-it="Arte Murale della Barriera Corallina" data-lang-pt="Arte de Parede de Recifes de Coral"
                data-lang-ar="فن الحائط للشعاب المرجانية"><i class="bx bx-shopping-bag icon"></i>
                Coral Reef Wall Art
              </b><br>
            </p>
            <samp>₱1000.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/8_20240923_211811_0007.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Pinoy Straw Hat" data-lang-es="Sombrero de Paja Pinoy"
                data-lang-fr="Chapeau de Paille Pinoy" data-lang-de="Pinoy-Strohhut" data-lang-zh="菲律宾草帽"
                data-lang-jp="ピノイストローハット" data-lang-ru="Филиппинская соломенная шляпа"
                data-lang-it="Cappello di Paglia Pinoy" data-lang-pt="Chapéu de Palha Pinoy"
                data-lang-ar="قبعة القش الفلبينية"><i class="bx bx-shopping-bag icon"></i>
                Pinoy Straw Hat
              </b><br>
            </p>
            <samp>₱200.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/9_20240923_211811_0008.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Beach Towel" data-lang-es="Toalla de Playa" data-lang-fr="Serviette de Plage"
                data-lang-de="Strandtuch" data-lang-zh="沙滩毛巾" data-lang-jp="ビーチタオル" data-lang-ru="Пляжное Полотенце"
                data-lang-it="Asciugamano da Spiaggia" data-lang-pt="Toalha de Praia" data-lang-ar="منشفة الشاطئ"><i
                  class="bx bx-shopping-bag icon"></i>
                Beach Towel
              </b><br>
            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/10_20240923_211811_0009.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Fridge Magnet" data-lang-es="Imán de Nevera" data-lang-fr="Aimant de Frigo"
                data-lang-de="Kühlschrankmagnet" data-lang-zh="冰箱磁铁" data-lang-jp="冷蔵庫用マグネット"
                data-lang-ru="Холодильный Магнит" data-lang-it="Magnete da Frigo" data-lang-pt="Imã de Geladeira"
                data-lang-ar="مغناطيس الثلاجة"><i class="bx bx-shopping-bag icon"></i>
                Fridge Magnet
              </b><br>
            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/11_20240923_211811_0010.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Coconut Soap" data-lang-es="Jabón de Coco" data-lang-fr="Savon de Noix de Coco"
                data-lang-de="Kokosnuss-Seife" data-lang-zh="椰子肥皂" data-lang-jp="ココナッツソープ" data-lang-ru="Кокосовое Мыло"
                data-lang-it="Sapone di Cocco" data-lang-pt="Sabão de Coco" data-lang-ar="صابون جوز الهند"><i
                  class="bx bx-shopping-bag icon"></i>
                Coconut Soap
              </b><br>
            </p>
            <samp>₱700.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/12_20240923_211811_0011.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Sundet Art Fit" data-lang-es="Sundet Art Fit" data-lang-fr="Sundet Art Fit"
                data-lang-de="Sundet Art Fit" data-lang-zh="Sundet Art Fit" data-lang-jp="Sundet Art Fit"
                data-lang-ru="Sundet Art Fit" data-lang-it="Sundet Art Fit" data-lang-pt="Sundet Art Fit"
                data-lang-ar="Sundet Art Fit"><i class="bx bx-shopping-bag icon"></i>
                Sundet Art Fit
              </b><br>
            </p>
            <samp>₱150.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>

      </section>

      <section class="sec2">
        <h1>Explore Now!!!</h1>
        <p>Discover the Paradise: Explore the Philippines with us!!</p>
        <div class="container2">
          <div class="main-video">
            <div class="Video">
              <video class="secvid" src="../Places/Pampanga/barundon.mp4" controls unmuted autoplay></video>
              <h3 class="title"><i class="bx bx-map icon" style="color: red;"></i>Barundon(Camias, Porac, Pampanga)</h3>

            </div>

          </div>

          <div class="video-list">
            <div class="vid">
              <video src="../img/12.mp4" muted></video>
              <h3 class="title">Bamboo Park</h3>
            </div>

            <div class="vid">
              <video src="../img/florida.mp4" muted></video>
              <h3 class="title">Floridablanca</h3>
            </div>

            <div class="vid">
              <video
                src="../vids/Montalban Trilogy Version 2 _ Mt. Susong Dalaga _ Mt. Parawagan _ Mt. Lagyo(720P_HD).mp4"
                muted></video>
              <h3 class="title">Susung Dalaga</h3>
            </div>

            <div class="vid">
              <video src="../vids/Nabuclod Mountain View in Floridablanca_ Pampanga(720P_HD).mp4" muted></video>
              <h3 class="title">Nabuclod</h3>
            </div>

            <div class="vid">
              <video src="../yes we are/Forest Lake Florida blanca park.mp4" muted></video>
              <h3 class="title">Forest Lake Floridablanca Pampanga</h3>
            </div>

            <div class="vid">
              <video src="../vids/Facebook 692100841679786(720p).mp4" muted></video>
              <h3 class="title">Sumuclab Lagoon</h3>
            </div>

            <div class="vid">
              <video src="../vids/lv_0_20231205084131.mp4" muted></video>
              <h3 class="title">Dara Falls</h3>
            </div>

            <div class="vid">
              <video src="../vids/lv_0_20231205084601.mp4" muted></video>
              <h3 class="title">Barundon View Deck</h3>
            </div>

            <div class="vid">
              <video src="../vids/lv_0_20231205085158.mp4" muted></video>
              <h3 class="title">Ilog Kamalig</h3>
            </div>
          </div>


          <script>
            // Your JavaScript code goes here
            let listVideo = document.querySelectorAll('.video-list .vid');
            let mainVideo = document.querySelector('.main-video video');
            let title = document.querySelector('.main-video .title');

            listVideo.forEach(video => {
              video.onclick = () => {
                listVideo.forEach(vid => vid.classList.remove('active'));
                video.classList.add('active');
                if (video.classList.contains('active')) {
                  let src = video.children[0].getAttribute('src');
                  mainVideo.src = src;
                  let text = video.children[1].innerHTML;
                  title.innerHTML = text;

                };

              };
            });
          </script>
      </Section>

      <script src="../js/home.js"></script>
      <script src="../js/chatbot.js"></script>
      <script src="../js/index.js"></script>
      <script src="../js/darkmode.js"></script>
      <script src="../js/language.js"></script>
      <script src="../js/explore.js" defer></script>
      <script src="../js/script.js"></script>
      <script src="js/swiper-bundle.min.js"></script>
      <script src="../js/product.js"></script>
      <script src="../js/explore2.js" defer></script>
      <script type="text/javascript" src="../js/fin.js"></script>
</body>

</html>