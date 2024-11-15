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
  <title>Travel Hunter</title>
  <!-- CSS -->
  <link rel="stylesheet" href="../style/marketplace.css" />
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="css/swiper-bundle.min.css" />
</head>

<body>
  <?php require_once "nav.php"; ?>

  <section class="overlay"></section>

  <Section class="main">


  <main>
      <div class="text">

      </div>
      <header>
        <h1 data-lang-en="Top Hottest Products in Boracay" data-lang-es="Los Productos Más Populares" data-lang-fr="Produits Les Plus Tendance"
          data-lang-de="Die Beliebtesten Produkte" data-lang-zh="最热门的产品" data-lang-jp="最も人気のある製品 "
          data-lang-ru="Самые Популярные Продукты " data-lang-it="I Prodotti Più Popolari"
          data-lang-pt="Os Produtos Mais Populares" data-lang-ar="أكثر المنتجات شهرة "><i class="bx bx-cart icon"></i>Top Hottest Products in Boracay</h1>
        <p>
          <span class="span3">&#139;</span>
          <span class="span3">&#155;</span>

        </p>
      </header>
      <p class="p2">Boracay is renowned for its unique local products, such as handmade jewelry, vibrant beachwear, and artisanal crafts, capturing the essence of this tropical paradise.</p>
      <section class="section6">
        <div class="product">
          <picture>
            <img src="../places/boracay/1_20240923_211810_0000.png" alt="Shell Keychains"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Shell Keychains" data-lang-es="Llaveros de Concha" data-lang-fr="Porte-clés Coquillage"
                data-lang-de="Muschel-Schlüsselanhänger" data-lang-zh="贝壳钥匙链" data-lang-jp="シェルキーホルダー"
                data-lang-ru="Брелоки с ракушками" data-lang-it="Portachiavi con Conchiglie"
                data-lang-pt="Chaveiros de Conchas" data-lang-ar="ميداليات الصدف"><i class="bx bx-cart icon"></i>Shell Keychains (₱500.00)</b><br>

                <a href="https://maps.app.goo.gl/D62S8DkAw1XJh1Qm8"><i class="bx bx-map icon" style=" color: #32b4ff;"></i></a>
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
          <div class="button7">
            <a class="a1" href="#" data-lang-en="Buy Now!!" data-lang-es="¡Compra Ahora!" data-lang-fr="Acheter Maintenant!"
              data-lang-de="Jetzt Kaufen!" data-lang-zh="立即购买！" data-lang-jp="今すぐ購入！" data-lang-ru="Купить Сейчас!"
              data-lang-it="Acquista Ora!" data-lang-pt="Compre Agora!" data-lang-ar="اشتري الآن!!"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/2_20240923_211811_0001.png" alt="Beaded Bracelets"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Beaded Bracelets" data-lang-es="Pulseras de Cuentas" data-lang-fr="Bracelets en Perles"
                data-lang-de="Perlenarmbänder" data-lang-zh="珠饰手链" data-lang-jp="ビーズブレスレット"
                data-lang-ru="Браслеты с Бусинами" data-lang-it="Braccialetti di Perline"
                data-lang-pt="Pulseiras de Miçangas" data-lang-ar="أساور خرز"><i class="bx bx-cart icon"></i>Beaded Bracelets (₱300.00)</b><br>

                
                <a href="https://maps.app.goo.gl/D62S8DkAw1XJh1Qm8"><i class="bx bx-map icon" style=" color: #32b4ff;"></i></a>
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
          <div class="button7">
            <a class="a1" href="#" data-lang-en="Buy Now!!" data-lang-es="¡Compra Ahora!" data-lang-fr="Acheter Maintenant!"
              data-lang-de="Jetzt Kaufen!" data-lang-zh="立即购买！" data-lang-jp="今すぐ購入！" data-lang-ru="Купить Сейчас!"
              data-lang-it="Acquista Ora!" data-lang-pt="Compre Agora!" data-lang-ar="اشتري الآن!!"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/3_20240923_211811_0002.png" alt="Handwoven Bag"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Handwoven Bag" data-lang-es="Bolsa Tejida" data-lang-fr="Sac Tissé"
                data-lang-de="Handgewebte Tasche" data-lang-zh="手工编织包" data-lang-jp="手織りバッグ"
                data-lang-ru="Ручная плетеная сумка" data-lang-it="Borsa Intrecciata"
                data-lang-pt="Bolsa Feita à Mão" data-lang-ar="حقيبة منسوجة"><i class="bx bx-cart icon"></i>Handwoven Bag (₱500.00)</b><br>

                
                <a href="https://maps.app.goo.gl/D62S8DkAw1XJh1Qm8"><i class="bx bx-map icon" style=" color: #32b4ff;"></i></a>
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
          <div class="button7">
            <a class="a1" href="#" data-lang-en="Buy Now!!" data-lang-es="¡Compra Ahora!" data-lang-fr="Acheter Maintenant!"
              data-lang-de="Jetzt Kaufen!" data-lang-zh="立即购买！" data-lang-jp="今すぐ購入！" data-lang-ru="Купить Сейчас!"
              data-lang-it="Acquista Ora!" data-lang-pt="Compre Agora!" data-lang-ar="اشتري الآن!!"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>

        <!-- Additional products follow the same format -->

        <div class="product">
          <picture>
            <img src="../places/boracay/4_20240923_211811_0003.png" alt="White Beach Sarong">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="White Beach Sarong" data-lang-es="Sarong de Playa Blanco" data-lang-fr="Paréo de Plage Blanc"
                data-lang-de="Weißer Strand-Sarong" data-lang-zh="白色沙滩纱笼" data-lang-jp="ホワイトビーチサロン"
                data-lang-ru="Белый Пляжный Парео" data-lang-it="Sarong da Spiaggia Bianco"
                data-lang-pt="Sarong de Praia Branco" data-lang-ar="سارونج شاطئ أبيض"><i class="bx bx-cart icon"></i>White Beach Sarong (₱300.00)</b><br>

                
                <a href="https://maps.app.goo.gl/D62S8DkAw1XJh1Qm8"><i class="bx bx-map icon" style=" color: #32b4ff;"></i></a>
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
          <div class="button7">
            <a class="a1" href="#" data-lang-en="Buy Now!!" data-lang-es="¡Compra Ahora!" data-lang-fr="Acheter Maintenant!"
              data-lang-de="Jetzt Kaufen!" data-lang-zh="立即购买！" data-lang-jp="今すぐ購入！" data-lang-ru="Купить Сейчас!"
              data-lang-it="Acquista Ora!" data-lang-pt="Compre Agora!" data-lang-ar="اشتري الآن!!"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/5_20240923_211811_0004.png" alt="Bamboo Craft Wooden Figure"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Bamboo Craft Wooden Figure" data-lang-es="Figura de Madera de Bambú"
                data-lang-fr="Figurine en Bois de Bambou" data-lang-de="Bambuskunst-Holzfigur"
                data-lang-zh="竹制工艺木雕" data-lang-jp="竹工芸木製フィギュア"
                data-lang-ru="Бамбуковая Деревянная Фигура" data-lang-it="Figura di Legno in Bambù"
                data-lang-pt="Figura de Madeira de Bambu" data-lang-ar="تمثال خشبي من الخيزران">Bamboo Craft Wooden Figure (₱300.00)</b><br>

                <a href="https://maps.app.goo.gl/D62S8DkAw1XJh1Qm8"><i class="bx bx-map icon" style=" color: #32b4ff;"></i></a>
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
          <div class="button7">
            <a class="a1" href="#" data-lang-en="Buy Now!!" data-lang-es="¡Compra Ahora!" data-lang-fr="Acheter Maintenant!"
              data-lang-de="Jetzt Kaufen!" data-lang-zh="立即购买！" data-lang-jp="今すぐ購入！" data-lang-ru="Купить Сейчас!"
              data-lang-it="Acquista Ora!" data-lang-pt="Compre Agora!" data-lang-ar="اشتري الآن!!"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/6_20240923_211811_0005.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Boracay Island Tee"
                data-lang-es="Camiseta de la Isla de Boracay"
                data-lang-fr="T-shirt de l'île de Boracay"
                data-lang-de="Boracay-Insel T-Shirt"
                data-lang-zh="博拉凯岛T恤"
                data-lang-jp="ボラカイ島のTシャツ"
                data-lang-ru="Футболка Острова Борокай"
                data-lang-it="T-shirt Isola di Boracay"
                data-lang-pt="Camiseta da Ilha de Boracay"
                data-lang-ar="تي شيرت جزيرة بوراكاي">
                Boracay Island Tee (₱600.00)
              </b><br>


              <a href="https://maps.app.goo.gl/D62S8DkAw1XJh1Qm8"><i class="bx bx-map icon" style=" color: #32b4ff;"></i></a>
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
              <b data-lang-en="Coral Reef Wall Art"
                data-lang-es="Arte de Pared de Arrecife de Coral"
                data-lang-fr="Art Mural de Récif de Corail"
                data-lang-de="Wandkunst des Korallenriffs"
                data-lang-zh="珊瑚礁墙面艺术"
                data-lang-jp="サンゴ礁の壁アート"
                data-lang-ru="Настенное искусство кораллового рифа"
                data-lang-it="Arte Murale della Barriera Corallina"
                data-lang-pt="Arte de Parede de Recifes de Coral"
                data-lang-ar="فن الحائط للشعاب المرجانية">
                Coral Reef Wall Art (₱1000.00)
              </b><br>

              <a href="https://maps.app.goo.gl/D62S8DkAw1XJh1Qm8"><i class="bx bx-map icon" style=" color: #32b4ff;"></i></a>
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
              <b data-lang-en="Pinoy Straw Hat"
                data-lang-es="Sombrero de Paja Pinoy"
                data-lang-fr="Chapeau de Paille Pinoy"
                data-lang-de="Pinoy-Strohhut"
                data-lang-zh="菲律宾草帽"
                data-lang-jp="ピノイストローハット"
                data-lang-ru="Филиппинская соломенная шляпа"
                data-lang-it="Cappello di Paglia Pinoy"
                data-lang-pt="Chapéu de Palha Pinoy"
                data-lang-ar="قبعة القش الفلبينية">
                Pinoy Straw Hat (₱200.00)
              </b><br> 

              <a href="https://maps.app.goo.gl/D62S8DkAw1XJh1Qm8"><i class="bx bx-map icon" style=" color: #32b4ff;"></i></a>
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
              <b data-lang-en="Beach Towel"
                data-lang-es="Toalla de Playa"
                data-lang-fr="Serviette de Plage"
                data-lang-de="Strandtuch"
                data-lang-zh="沙滩毛巾"
                data-lang-jp="ビーチタオル"
                data-lang-ru="Пляжное Полотенце"
                data-lang-it="Asciugamano da Spiaggia"
                data-lang-pt="Toalha de Praia"
                data-lang-ar="منشفة الشاطئ">
                Beach Towel (₱300.00)
              </b><br>


              <a href="https://maps.app.goo.gl/D62S8DkAw1XJh1Qm8"><i class="bx bx-map icon" style=" color: #32b4ff;"></i></a>
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
              <b data-lang-en="Fridge Magnet"
                data-lang-es="Imán de Nevera"
                data-lang-fr="Aimant de Frigo"
                data-lang-de="Kühlschrankmagnet"
                data-lang-zh="冰箱磁铁"
                data-lang-jp="冷蔵庫用マグネット"
                data-lang-ru="Холодильный Магнит"
                data-lang-it="Magnete da Frigo"
                data-lang-pt="Imã de Geladeira"
                data-lang-ar="مغناطيس الثلاجة">
                Fridge Magnet (₱300.00)
              </b><br>

              <a href="https://maps.app.goo.gl/D62S8DkAw1XJh1Qm8"><i class="bx bx-map icon" style=" color: #32b4ff;"></i></a>
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
          <div class="button7">
            <a class="a1" href="#"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/11_20240923_211811_0010.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Coconut Soap"
                data-lang-es="Jabón de Coco"
                data-lang-fr="Savon de Noix de Coco"
                data-lang-de="Kokosnuss-Seife"
                data-lang-zh="椰子肥皂"
                data-lang-jp="ココナッツソープ"
                data-lang-ru="Кокосовое Мыло"
                data-lang-it="Sapone di Cocco"
                data-lang-pt="Sabão de Coco"
                data-lang-ar="صابون جوز الهند">
                Coconut Soap (₱700.00)
              </b><br>

              <a href="https://maps.app.goo.gl/D62S8DkAw1XJh1Qm8"><i class="bx bx-map icon" style=" color: #32b4ff;"></i></a>
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
          <div class="button7">
            <a class="a1" href="#"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/12_20240923_211811_0011.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Sundet Art Fit"
                data-lang-es="Sundet Art Fit"
                data-lang-fr="Sundet Art Fit"
                data-lang-de="Sundet Art Fit"
                data-lang-zh="Sundet Art Fit"
                data-lang-jp="Sundet Art Fit"
                data-lang-ru="Sundet Art Fit"
                data-lang-it="Sundet Art Fit"
                data-lang-pt="Sundet Art Fit"
                data-lang-ar="Sundet Art Fit">
                Sundet Art Fit (₱150.00)
              </b><br>

              <a href="https://maps.app.goo.gl/D62S8DkAw1XJh1Qm8"><i class="bx bx-map icon" style=" color: #32b4ff;"></i></a>
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
          <div class="button7">
            <a class="a1" href="#"><i class="bx bx-cart icon"></i>Buy Now!!</a>
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
      <div class="text">

      </div>
      <header>
        <h1 data-lang-en="Top Hottest Products in Pampanga" data-lang-es="Los productos más populares en Pampanga" data-lang-fr="Les produits les plus populaires à Pampanga"
          data-lang-de="Die heißesten Produkte in Pampanga" data-lang-zh=" 邦板牙最热门的产品" data-lang-jp=" パンパンガで最も人気のある商品"
          data-lang-ru="Самые популярные товары в Пампанге" data-lang-it=" I prodotti più popolari a Pampanga"
          data-lang-pt="Os produtos mais populares em Pampanga" data-lang-ar="المنتجات الأكثر شعبية في بامبانغا"><i class="bx bx-cart icon"></i>Top Hottest Products in Pampanga</h1>
        <p>
          <span class="span1">&#139;</span>
          <span class="span1">&#155;</span>

        </p>
      </header>
      <p class="p2">Experience the rich flavors of Pampanga with our unique products, from authentic Kapampangan dishes to handcrafted delicacies, made with pride and tradition!</p>
      <section class="section6">
        <div class="product">
          <picture>
            <img src="../places/Pampanga/1.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Parol"
                data-lang-es="Farolito"
                data-lang-fr="Lantern"
                data-lang-de="Laterne"
                data-lang-zh="灯笼"
                data-lang-jp="パロル"
                data-lang-ru="Парол"
                data-lang-it="Parol"
                data-lang-pt="Lanterna"
                data-lang-ar="بارول"><i class="bx bx-cart icon"></i>
                Parol(₱500.00)
              </b><br>

              <a href="https://maps.app.goo.gl/D62S8DkAw1XJh1Qm8"><i class="bx bx-map icon" style=" color: #32b4ff;"></i></a>
              <small data-lang-en="White Beach Station 1, Boracay Island, Malay, Philippines"
                data-lang-es="Estación 1 de Playa Blanca, Isla Boracay, Malay, Filipinas"
                data-lang-fr="Station 1 de la Plage Blanche, Île de Boracay, Malay, Philippines"
                data-lang-de="Weißer Strand Station 1, Boracay-Insel, Malay, Philippinen" data-lang-zh="白沙滩站1，菲律宾马来博拉凯岛"
                data-lang-jp="ホワイトビーチステーション1、ボラカイ島、マレーシア、フィリピン"
                data-lang-ru="Станция 1 Белого Пляжа, Остров Борокай, Малай, Филиппины"
                data-lang-it="Stazione 1 della Spiaggia Bianca, Isola di Boracay, Malay, Filippine"
                data-lang-pt="Estação 1 da Praia Branca, Ilha de Boracay, Malay, Filipinas"
                data-lang-ar="محطة 1 لشاطئ أبيض، جزيرة بوراكاي، مالاي، الفلبين">
                San fernando, Pampanga, Philippines
              </small>
            </p>
           
          </div>
          <div class="button7">
            <a class="a1" href="../include/boracaymarket.php"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/Pampanga/2.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Betis Wood Carvings"
                data-lang-es="Tallados en Madera de Betis"
                data-lang-fr="Sculptures en Bois de Betis"
                data-lang-de="Betis-Holzschnitzereien"
                data-lang-zh="贝蒂斯木雕"
                data-lang-jp="ベティス木彫り"
                data-lang-ru="Деревянные Резьбы Бетис"
                data-lang-it="Intagli in Legno di Betis"
                data-lang-pt="Esculturas em Madeira de Betis"
                data-lang-ar="نقوش خشبية من بيتيس"><i class="bx bx-cart icon"></i>
                Betis Wood Carvings(₱500.00)
              </b><br>

              <a href="https://maps.app.goo.gl/D62S8DkAw1XJh1Qm8"><i class="bx bx-map icon" style=" color: #32b4ff;"></i></a>
              <small data-lang-en="White Beach Station 1, Boracay Island, Malay, Philippines"
                data-lang-es="Estación 1 de Playa Blanca, Isla Boracay, Malay, Filipinas"
                data-lang-fr="Station 1 de la Plage Blanche, Île de Boracay, Malay, Philippines"
                data-lang-de="Weißer Strand Station 1, Boracay-Insel, Malay, Philippinen" data-lang-zh="白沙滩站1，菲律宾马来博拉凯岛"
                data-lang-jp="ホワイトビーチステーション1、ボラカイ島、マレーシア、フィリピン"
                data-lang-ru="Станция 1 Белого Пляжа, Остров Борокай, Малай, Филиппины"
                data-lang-it="Stazione 1 della Spiaggia Bianca, Isola di Boracay, Malay, Filippine"
                data-lang-pt="Estação 1 da Praia Branca, Ilha de Boracay, Malay, Filipinas"
                data-lang-ar="محطة 1 لشاطئ أبيض، جزيرة بوراكاي، مالاي، الفلبين">
                San fernando, Pampanga, Philippines
              </small>
            </p>
            
          </div>
          <div class="button7">
            <a class="a1" href="#"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/Pampanga/3.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Lacquareware"
                data-lang-es="Laca"
                data-lang-fr="Lacqué"
                data-lang-de="Lackwaren"
                data-lang-zh="漆器"
                data-lang-jp="ラッカー"
                data-lang-ru="Лаковые Изделия"
                data-lang-it="Laccato"
                data-lang-pt="Laca"
                data-lang-ar="اللاكر"><i class="bx bx-cart icon"></i>
                Lacquareware(₱500.00)
              </b><br>

              <a href="https://maps.app.goo.gl/D62S8DkAw1XJh1Qm8"><i class="bx bx-map icon" style=" color: #32b4ff;"></i></a>
              <small data-lang-en="White Beach Station 1, Boracay Island, Malay, Philippines"
                data-lang-es="Estación 1 de Playa Blanca, Isla Boracay, Malay, Filipinas"
                data-lang-fr="Station 1 de la Plage Blanche, Île de Boracay, Malay, Philippines"
                data-lang-de="Weißer Strand Station 1, Boracay-Insel, Malay, Philippinen" data-lang-zh="白沙滩站1，菲律宾马来博拉凯岛"
                data-lang-jp="ホワイトビーチステーション1、ボラカイ島、マレーシア、フィリピン"
                data-lang-ru="Станция 1 Белого Пляжа, Остров Борокай, Малай, Филиппины"
                data-lang-it="Stazione 1 della Spiaggia Bianca, Isola di Boracay, Malay, Filippine"
                data-lang-pt="Estação 1 da Praia Branca, Ilha de Boracay, Malay, Filipinas"
                data-lang-ar="محطة 1 لشاطئ أبيض، جزيرة بوراكاي، مالاي، الفلبين">
                San fernando, Pampanga, Philippines
              </small>
            </p>
           
          </div>
          <div class="button7">
            <a class="a1" href="#"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/Pampanga/4.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Handcrafted Furniture"
                data-lang-es="Muebles Hechos a Mano"
                data-lang-fr="Meubles Artisanaux"
                data-lang-de="Handgefertigte Möbel"
                data-lang-zh="手工家具"
                data-lang-jp="手作り家具"
                data-lang-ru="Ручная Мебель"
                data-lang-it="Mobili Artigianali"
                data-lang-pt="Móveis Artesanais"
                data-lang-ar="أثاث مصنوع يدوياً"><i class="bx bx-cart icon"></i>
                Handcrafted Furniture(₱300.00)
              </b><br>

              <a href="https://maps.app.goo.gl/D62S8DkAw1XJh1Qm8"><i class="bx bx-map icon" style=" color: #32b4ff;"></i></a>
              <small data-lang-en="White Beach Station 1, Boracay Island, Malay, Philippines"
                data-lang-es="Estación 1 de Playa Blanca, Isla Boracay, Malay, Filipinas"
                data-lang-fr="Station 1 de la Plage Blanche, Île de Boracay, Malay, Philippines"
                data-lang-de="Weißer Strand Station 1, Boracay-Insel, Malay, Philippinen" data-lang-zh="白沙滩站1，菲律宾马来博拉凯岛"
                data-lang-jp="ホワイトビーチステーション1、ボラカイ島、マレーシア、フィリピン"
                data-lang-ru="Станция 1 Белого Пляжа, Остров Борокай, Малай, Филиппины"
                data-lang-it="Stazione 1 della Spiaggia Bianca, Isola di Boracay, Malay, Filippine"
                data-lang-pt="Estação 1 da Praia Branca, Ilha de Boracay, Malay, Filipinas"
                data-lang-ar="محطة 1 لشاطئ أبيض، جزيرة بوراكاي، مالاي، الفلبين">
                San fernando, Pampanga, Philippines
              </small>
            </p>
           
          </div>
          <div class="button7">
            <a class="a1" href="#"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/Pampanga/5.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Handwoven Baskets"
                data-lang-es="Cestas Tejidas a Mano"
                data-lang-fr="Panier Tissé à la Main"
                data-lang-de="Handgewebte Körbe"
                data-lang-zh="手工编织篮子"
                data-lang-jp="手織りのバスケット"
                data-lang-ru="Ручные Корзины"
                data-lang-it="Cesti Intrecciati a Mano"
                data-lang-pt="Cestos Feitos à Mão"
                data-lang-ar="سلال مصنوعة يدوياً">
                Handwoven Baskets
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
            <img src="../places/Pampanga/6.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Pottery"
                data-lang-es="Cerámica"
                data-lang-fr="Poterie"
                data-lang-de="Töpferwaren"
                data-lang-zh="陶器"
                data-lang-jp="陶器"
                data-lang-ru="Керамика"
                data-lang-it="Ceramica"
                data-lang-pt="Cerâmica"
                data-lang-ar="الفخار">
                Pottery
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
            <img src="../places/Pampanga/7.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Kutkut Art"
                data-lang-es="Arte Kutkut"
                data-lang-fr="Art Kutkut"
                data-lang-de="Kutkut-Kunst"
                data-lang-zh="库特库特艺术"
                data-lang-jp="クットクットアート"
                data-lang-ru="Искусство Куткут"
                data-lang-it="Arte Kutkut"
                data-lang-pt="Arte Kutkut"
                data-lang-ar="فن كوتكوت">
                Kutkut Art
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
            <img src="../places/Pampanga/8.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Giant Lantern Miniature"
                data-lang-es="Miniatura de Linterna Gigante"
                data-lang-fr="Miniature de Lantern Géante"
                data-lang-de="Miniatur einer Riesenlaterne"
                data-lang-zh="巨型灯笼迷你版"
                data-lang-jp="巨大なランタンのミニチュア"
                data-lang-ru="Миниатюра Огромного Фонаря"
                data-lang-it="Miniatura della Lanterna Gigante"
                data-lang-pt="Miniatura da Lanterna Gigante"
                data-lang-ar="تمثال مصغر للفانوس العملاق">
                Giant Lantern Miniature
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
            <img src="../places/Pampanga/9.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Kampangan Textiles"
                data-lang-es="Textiles Kampangan"
                data-lang-fr="Textiles Kampangan"
                data-lang-de="Kampangan-Textilien"
                data-lang-zh="坎潘甘纺织品"
                data-lang-jp="カンパンガンの織物"
                data-lang-ru="Текстиль Кампанган"
                data-lang-it="Tessuti Kampangan"
                data-lang-pt="Têxteis Kampangan"
                data-lang-ar="منسوجات كامبانغ">
                Kampangan Textiles
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
            <img src="../places/Pampanga/10.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Handwoven Fans"
                data-lang-es="Abanicos Tejidos a Mano"
                data-lang-fr="Ventilateurs Tissés à la Main"
                data-lang-de="Handgewebte Fächer"
                data-lang-zh="手工编织的扇子"
                data-lang-jp="手織りの扇子"
                data-lang-ru="Ручные Вентиляторы"
                data-lang-it="Ventagli Intrecciati a Mano"
                data-lang-pt="Leques Feitos à Mão"
                data-lang-ar="مراوح مصنوعة يدوياً">
                Handwoven Fans
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
            <img src="../places/Pampanga/11.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Abaniko"
                data-lang-es="Abanico"
                data-lang-fr="Abanico"
                data-lang-de="Abaniko"
                data-lang-zh="阿巴尼科扇子"
                data-lang-jp="アバニコ"
                data-lang-ru="Абанико"
                data-lang-it="Abaniko"
                data-lang-pt="Abanico"
                data-lang-ar="أبانكو">
                Abaniko
              </b><br>
            </p>
            <samp>₱700.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/Pampanga/12.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Brass Ware"
                data-lang-es="Artículos de Latón"
                data-lang-fr="Articles en Laiton"
                data-lang-de="Messingwaren"
                data-lang-zh="黄铜器"
                data-lang-jp="真鍮製品"
                data-lang-ru="Бронзовые Изделия"
                data-lang-it="Articoli in Ottone"
                data-lang-pt="Artigos de Latão"
                data-lang-ar="الأدوات النحاسية">
                Brass Ware
              </b><br>
            </p>
            <samp>₱150.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>
      </section>

    </main>


   

    <main>
      <div class="text">

      </div>
      <header>
        <h1 data-lang-en="Top Hottest Products in Palawan" data-lang-es="Los Productos Más Populares" data-lang-fr="Produits Les Plus Tendance"
          data-lang-de="Die Beliebtesten Produkte" data-lang-zh="最热门的产品" data-lang-jp="最も人気のある製品 "
          data-lang-ru="Самые Популярные Продукты " data-lang-it="I Prodotti Più Popolari"
          data-lang-pt="Os Produtos Mais Populares" data-lang-ar="أكثر المنتجات شهرة "><i class="bx bx-cart icon"></i>Top Hottest Products in Palawan</h1>
        <p>
          <span class="span2">&#139;</span>
          <span class="span2">&#155;</span>

        </p>
      </header>
      <p class="p2">"Palawan offers a rich array of local products, from handwoven baskets and pearl jewelry to sustainably sourced natural beauty products, all reflecting the island’s vibrant culture and natural beauty."</p>
      <section class="section6">
        <div class="product">
          <picture>
            <img src="../places/palawan/1.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Tote Bag"
                data-lang-es="Bolsa de Mano"
                data-lang-fr="Sac à Dos"
                data-lang-de="Tote Tasche"
                data-lang-zh="手提包"
                data-lang-jp="トートバッグ"
                data-lang-ru="Сумка-тоут"
                data-lang-it="Borsa Tote"
                data-lang-pt="Bolsa Tote"
                data-lang-ar="حقيبة توت"><i class="bx bx-cart icon"></i>
                Tote Bag(₱500.00)
              </b><br>

              <a href="https://maps.app.goo.gl/D62S8DkAw1XJh1Qm8"><i class="bx bx-map icon" style=" color: #32b4ff;"></i></a>
              <small data-lang-en="White Beach Station 1, Boracay Island, Malay, Philippines"
                data-lang-es="Estación 1 de Playa Blanca, Isla Boracay, Malay, Filipinas"
                data-lang-fr="Station 1 de la Plage Blanche, Île de Boracay, Malay, Philippines"
                data-lang-de="Weißer Strand Station 1, Boracay-Insel, Malay, Philippinen" data-lang-zh="白沙滩站1，菲律宾马来博拉凯岛"
                data-lang-jp="ホワイトビーチステーション1、ボラカイ島、マレーシア、フィリピン"
                data-lang-ru="Станция 1 Белого Пляжа, Остров Борокай, Малай, Филиппины"
                data-lang-it="Stazione 1 della Spiaggia Bianca, Isola di Boracay, Malay, Filippine"
                data-lang-pt="Estação 1 da Praia Branca, Ilha de Boracay, Malay, Filipinas"
                data-lang-ar="محطة 1 لشاطئ أبيض، جزيرة بوراكاي، مالاي، الفلبين">
                Palawan, Philippines
              </small>

              
            </p>
          
          </div>
          <div class="button7">
            <a class="a1" href="#"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/palawan/2.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Ref Magnet"
                data-lang-es="Imán para Refrigerador"
                data-lang-fr="Magnète de Réfrigérateur"
                data-lang-de="Kühlschrankmagnet"
                data-lang-zh="冰箱磁铁"
                data-lang-jp="冷蔵庫マグネット"
                data-lang-ru="Магнит для Холодильника"
                data-lang-it="Magnete da Frigorifero"
                data-lang-pt="Ímã de Geladeira"
                data-lang-ar="مغناطيس ثلاجة"><i class="bx bx-cart icon"></i>
                Ref Magnet(₱300.00)
              </b><br>
              <a href="https://maps.app.goo.gl/D62S8DkAw1XJh1Qm8"><i class="bx bx-map icon" style=" color: #32b4ff;"></i></a>
              <small data-lang-en="White Beach Station 1, Boracay Island, Malay, Philippines"
                data-lang-es="Estación 1 de Playa Blanca, Isla Boracay, Malay, Filipinas"
                data-lang-fr="Station 1 de la Plage Blanche, Île de Boracay, Malay, Philippines"
                data-lang-de="Weißer Strand Station 1, Boracay-Insel, Malay, Philippinen" data-lang-zh="白沙滩站1，菲律宾马来博拉凯岛"
                data-lang-jp="ホワイトビーチステーション1、ボラカイ島、マレーシア、フィリピン"
                data-lang-ru="Станция 1 Белого Пляжа, Остров Борокай, Малай, Филиппины"
                data-lang-it="Stazione 1 della Spiaggia Bianca, Isola di Boracay, Malay, Filippine"
                data-lang-pt="Estação 1 da Praia Branca, Ilha de Boracay, Malay, Filipinas"
                data-lang-ar="محطة 1 لشاطئ أبيض، جزيرة بوراكاي، مالاي، الفلبين">
                Palawan, Philippines
              </small>

            </p>
          
          </div>
          <div class="button7">
            <a class="a1" href="#"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/palawan/3.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Keychains"
                data-lang-es="Llavero"
                data-lang-fr="Porte-clés"
                data-lang-de="Schlüsselanhänger"
                data-lang-zh="钥匙链"
                data-lang-jp="キーホルダー"
                data-lang-ru="Брелок"
                data-lang-it="Portachiavi"
                data-lang-pt="Chaveiro"
                data-lang-ar="حامل مفاتيح"><i class="bx bx-cart icon"></i>
                Keychains(₱300.00)
              </b><br>

              <a href="https://maps.app.goo.gl/D62S8DkAw1XJh1Qm8"><i class="bx bx-map icon" style=" color: #32b4ff;"></i></a>
              <small data-lang-en="White Beach Station 1, Boracay Island, Malay, Philippines"
                data-lang-es="Estación 1 de Playa Blanca, Isla Boracay, Malay, Filipinas"
                data-lang-fr="Station 1 de la Plage Blanche, Île de Boracay, Malay, Philippines"
                data-lang-de="Weißer Strand Station 1, Boracay-Insel, Malay, Philippinen" data-lang-zh="白沙滩站1，菲律宾马来博拉凯岛"
                data-lang-jp="ホワイトビーチステーション1、ボラカイ島、マレーシア、フィリピン"
                data-lang-ru="Станция 1 Белого Пляжа, Остров Борокай, Малай, Филиппины"
                data-lang-it="Stazione 1 della Spiaggia Bianca, Isola di Boracay, Malay, Filippine"
                data-lang-pt="Estação 1 da Praia Branca, Ilha de Boracay, Malay, Filipinas"
                data-lang-ar="محطة 1 لشاطئ أبيض، جزيرة بوراكاي، مالاي، الفلبين">
                Palawan, Philippines
              </small>

            </p>
          
          </div>
          <div class="button7">
            <a class="a1" href="#"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/palawan/4.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Handicrafts"
                data-lang-es="Artesanía"
                data-lang-fr="Artisanat"
                data-lang-de="Handwerkskunst"
                data-lang-zh="手工艺品"
                data-lang-jp="手工芸品"
                data-lang-ru="Ремесленные Изделия"
                data-lang-it="Artigianato"
                data-lang-pt="Artesanato"
                data-lang-ar="الحرف اليدوية"><i class="bx bx-cart icon"></i>
                Handicrafts(₱300.00)
              </b><br>
              <a href="https://maps.app.goo.gl/D62S8DkAw1XJh1Qm8"><i class="bx bx-map icon" style=" color: #32b4ff;"></i></a>
              <small data-lang-en="White Beach Station 1, Boracay Island, Malay, Philippines"
                data-lang-es="Estación 1 de Playa Blanca, Isla Boracay, Malay, Filipinas"
                data-lang-fr="Station 1 de la Plage Blanche, Île de Boracay, Malay, Philippines"
                data-lang-de="Weißer Strand Station 1, Boracay-Insel, Malay, Philippinen" data-lang-zh="白沙滩站1，菲律宾马来博拉凯岛"
                data-lang-jp="ホワイトビーチステーション1、ボラカイ島、マレーシア、フィリピン"
                data-lang-ru="Станция 1 Белого Пляжа, Остров Борокай, Малай, Филиппины"
                data-lang-it="Stazione 1 della Spiaggia Bianca, Isola di Boracay, Malay, Filippine"
                data-lang-pt="Estação 1 da Praia Branca, Ilha de Boracay, Malay, Filipinas"
                data-lang-ar="محطة 1 لشاطئ أبيض، جزيرة بوراكاي، مالاي، الفلبين">
                Palawan, Philippines
              </small>

            </p>
           
          </div>
          <div class="button7">
            <a class="a1" href="#"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/palawan/5.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Shell Necklace"
                data-lang-es="Collar de Conchas"
                data-lang-fr="Collier en Coquillages"
                data-lang-de="Muschel-Halskette"
                data-lang-zh="贝壳项链"
                data-lang-jp="貝のネックレス"
                data-lang-ru="Ракушечное Ожерелье"
                data-lang-it="Collana di Conchiglie"
                data-lang-pt="Colar de Conchas"
                data-lang-ar="قلادة صدفية">
                Shell Necklace(₱300.00)
              </b><br>

              <a href="https://maps.app.goo.gl/D62S8DkAw1XJh1Qm8"><i class="bx bx-map icon" style=" color: #32b4ff;"></i></a>
              <small data-lang-en="White Beach Station 1, Boracay Island, Malay, Philippines"
                data-lang-es="Estación 1 de Playa Blanca, Isla Boracay, Malay, Filipinas"
                data-lang-fr="Station 1 de la Plage Blanche, Île de Boracay, Malay, Philippines"
                data-lang-de="Weißer Strand Station 1, Boracay-Insel, Malay, Philippinen" data-lang-zh="白沙滩站1，菲律宾马来博拉凯岛"
                data-lang-jp="ホワイトビーチステーション1、ボラカイ島、マレーシア、フィリピン"
                data-lang-ru="Станция 1 Белого Пляжа, Остров Борокай, Малай, Филиппины"
                data-lang-it="Stazione 1 della Spiaggia Bianca, Isola di Boracay, Malay, Filippine"
                data-lang-pt="Estação 1 da Praia Branca, Ilha de Boracay, Malay, Filipinas"
                data-lang-ar="محطة 1 لشاطئ أبيض، جزيرة بوراكاي، مالاي، الفلبين">
                Palawan, Philippines
              </small>

            </p>
          
          </div>
          <div class="button7">
            <a class="a1" href="#"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/palawan/6.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Tshirts"
                data-lang-es="Camisetas"
                data-lang-fr="T-shirts"
                data-lang-de="T-Shirts"
                data-lang-zh="T恤"
                data-lang-jp="Tシャツ"
                data-lang-ru="Футболки"
                data-lang-it="Magliette"
                data-lang-pt="Camisetas"
                data-lang-ar="قمصان">
                Tshirts
              </b><br>

              <a href="https://maps.app.goo.gl/D62S8DkAw1XJh1Qm8"><i class="bx bx-map icon" style=" color: #32b4ff;"></i></a>
              <small data-lang-en="White Beach Station 1, Boracay Island, Malay, Philippines"
                data-lang-es="Estación 1 de Playa Blanca, Isla Boracay, Malay, Filipinas"
                data-lang-fr="Station 1 de la Plage Blanche, Île de Boracay, Malay, Philippines"
                data-lang-de="Weißer Strand Station 1, Boracay-Insel, Malay, Philippinen" data-lang-zh="白沙滩站1，菲律宾马来博拉凯岛"
                data-lang-jp="ホワイトビーチステーション1、ボラカイ島、マレーシア、フィリピン"
                data-lang-ru="Станция 1 Белого Пляжа, Остров Борокай, Малай, Филиппины"
                data-lang-it="Stazione 1 della Spiaggia Bianca, Isola di Boracay, Malay, Filippine"
                data-lang-pt="Estação 1 da Praia Branca, Ilha de Boracay, Malay, Filipinas"
                data-lang-ar="محطة 1 لشاطئ أبيض، جزيرة بوراكاي، مالاي، الفلبين">
                Palawan, Philippines
              </small>

            </p>
            <samp>₱600.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/palawan/1.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Tote Bag"
                data-lang-es="Bolsa de Mano"
                data-lang-fr="Sac à Dos"
                data-lang-de="Tote Tasche"
                data-lang-zh="手提包"
                data-lang-jp="トートバッグ"
                data-lang-ru="Сумка-тоут"
                data-lang-it="Borsa Tote"
                data-lang-pt="Bolsa Tote"
                data-lang-ar="حقيبة توت">
                Tote Bag
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
            <img src="../places/palawan/2.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Ref Magnet"
                data-lang-es="Imán para Refrigerador"
                data-lang-fr="Magnète de Réfrigérateur"
                data-lang-de="Kühlschrankmagnet"
                data-lang-zh="冰箱磁铁"
                data-lang-jp="冷蔵庫マグネット"
                data-lang-ru="Магнит для Холодильника"
                data-lang-it="Magnete da Frigorifero"
                data-lang-pt="Ímã de Geladeira"
                data-lang-ar="مغناطيس ثلاجة">
                Ref Magnet
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
            <img src="../places/palawan/3.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Keychains"
                data-lang-es="Llavero"
                data-lang-fr="Porte-clés"
                data-lang-de="Schlüsselanhänger"
                data-lang-zh="钥匙链"
                data-lang-jp="キーホルダー"
                data-lang-ru="Брелок"
                data-lang-it="Portachiavi"
                data-lang-pt="Chaveiro"
                data-lang-ar="حامل مفاتيح">
                Keychains
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
            <img src="../places/palawan/4.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Handicrafts"
                data-lang-es="Artesanía"
                data-lang-fr="Artisanat"
                data-lang-de="Handwerkskunst"
                data-lang-zh="手工艺品"
                data-lang-jp="手工芸品"
                data-lang-ru="Ремесленные Изделия"
                data-lang-it="Artigianato"
                data-lang-pt="Artesanato"
                data-lang-ar="الحرف اليدوية">
                Handicrafts
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
            <img src="../places/palawan/5.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Shell Necklace"
                data-lang-es="Collar de Conchas"
                data-lang-fr="Collier en Coquillages"
                data-lang-de="Muschel-Halskette"
                data-lang-zh="贝壳项链"
                data-lang-jp="貝のネックレス"
                data-lang-ru="Ракушечное Ожерелье"
                data-lang-it="Collana di Conchiglie"
                data-lang-pt="Colar de Conchas"
                data-lang-ar="قلادة صدفية">
                Shell Necklace
              </b><br>
            </p>
            <samp>₱700.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/palawan/6.png">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Tshirts"
                data-lang-es="Camisetas"
                data-lang-fr="T-shirts"
                data-lang-de="T-Shirts"
                data-lang-zh="T恤"
                data-lang-jp="Tシャツ"
                data-lang-ru="Футболки"
                data-lang-it="Magliette"
                data-lang-pt="Camisetas"
                data-lang-ar="قمصان">
                Tshirts
              </b><br>
            </p>
            <samp>₱150.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#"><i class="bx bx-cart icon"></i>Buy Now!!</a>
          </div>
        </div>
      </section>

    </main>
  </section>

  

  <script src="../js/home.js"></script>
  <script src="../js/darkmode.js"></script>
  <script src="../js/language.js"></script>
  <script src="../js/explore.js" defer></script>
  <script src="../js/script.js"></script>
  <script src="../js/fin2.js"></script>
  <script src="../js/product.js"></script>
  <script src="../js/market1.js"></script>
</body>

</html>