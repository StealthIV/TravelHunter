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
        <h1 data-lang-en="Top Hottest Products in Pampanga" data-lang-es="Los productos más populares en Pampanga"
          data-lang-fr="Les produits les plus populaires à Pampanga" data-lang-de="Die heißesten Produkte in Pampanga"
          data-lang-zh=" 邦板牙最热门的产品" data-lang-jp=" パンパンガで最も人気のある商品" data-lang-ru="Самые популярные товары в Пампанге"
          data-lang-it=" I prodotti più popolari a Pampanga" data-lang-pt="Os produtos mais populares em Pampanga"
          data-lang-ar="المنتجات الأكثر شعبية في بامبانغا">Top Hottest Products in Pampanga</h1>
        <p>
          <span class="span1">&#139;</span>
          <span class="span1">&#155;</span>

        </p>
      </header>
      <section class="section6">
        <div class="product">
          <picture>
            <img src="../places/boracay/dried mangoes.jpg" alt="Dried Mangoes">
          </picture>
          <div class="detail">
            <p data-lang-en="Dried Mangoes" data-lang-es="Mangos Secos" data-lang-fr="Mangues Séchés"
              data-lang-de="Getrocknete Mangos" data-lang-zh="干芒果" data-lang-jp="ドライマンゴー" data-lang-ru="Сушеные манго"
              data-lang-it="Mango Essiccati" data-lang-pt="Mangas Secas" data-lang-ar="Mangue مجفف">
              <b>Dried Mangoes</b><br>
            </p>
            <samp>₱500.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Kapeng-Barako.png" alt="Barako Coffee">
          </picture>
          <div class="detail">
            <p data-lang-en="Barako Coffee" data-lang-es="Café Barako" data-lang-fr="Café Barako"
              data-lang-de="Barako Kaffee" data-lang-zh="巴拉克咖啡" data-lang-jp="バラココーヒー" data-lang-ru="Кофе Барако"
              data-lang-it="Caffè Barako" data-lang-pt="Café Barako" data-lang-ar="قهوة باراكو">
              <b>Barako Coffee</b><br>
            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Handicrafts.jpg" alt="Handicrafts">
          </picture>
          <div class="detail">
            <p data-lang-en="Handicrafts" data-lang-es="Artesanías" data-lang-fr="Artisanat" data-lang-de="Handwerk"
              data-lang-zh="手工艺品" data-lang-jp="手工芸品" data-lang-ru="Ручные изделия" data-lang-it="Artigianato"
              data-lang-pt="Artesanato" data-lang-ar="الحرف اليدوية">
              <b>Handicrafts</b><br>
            </p>
            <samp>₱500.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/keychains.jpg" alt="Keychains">
          </picture>
          <div class="detail">
            <p data-lang-en="Keychains" data-lang-es="Llaveros" data-lang-fr="Porte-clés"
              data-lang-de="Schlüsselanhänger" data-lang-zh="钥匙扣" data-lang-jp="キーチェーン" data-lang-ru="Брелоки"
              data-lang-it="Portachiavi" data-lang-pt="Chaveiros" data-lang-ar="سلاسل المفاتيح">
              <b>Keychains</b><br>
            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Buko Pie.jpg" alt="Buko Pie">
          </picture>
          <div class="detail">
            <p data-lang-en="Buko Pie" data-lang-es="Pastel de Buko" data-lang-fr="Tarte de Buko"
              data-lang-de="Buko-Kuchen" data-lang-zh="椰子派" data-lang-jp="ブコパイ" data-lang-ru="Пирог Букко"
              data-lang-it="Torta di Buko" data-lang-pt="Torta de Buko" data-lang-ar="فطيرة بوكو">
              <b>Buko Pie</b><br>
            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Beachwear.jpg" alt="Beachwear">
          </picture>
          <div class="detail">
            <p data-lang-en="Beachwear" data-lang-es="Ropa de Playa" data-lang-fr="Vêtements de Plage"
              data-lang-de="Strandbekleidung" data-lang-zh="沙滩服装" data-lang-jp="ビーチウェア" data-lang-ru="Пляжная одежда"
              data-lang-it="Abbigliamento da Spiaggia" data-lang-pt="Roupa de Praia" data-lang-ar="ملابس شاطئية">
              <b>Beachwear</b><br>
            </p>
            <samp>₱600.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Seafood.jpg" alt="Seafoods">
          </picture>
          <div class="detail">
            <p data-lang-en="Seafoods" data-lang-es="Mariscos" data-lang-fr="Fruits de Mer" data-lang-de="Meeresfrüchte"
              data-lang-zh="海鲜" data-lang-jp="シーフード" data-lang-ru="Морепродукты" data-lang-it="Frutti di Mare"
              data-lang-pt="Frutos do Mar" data-lang-ar="المأكولات البحرية">
              <b>Seafoods</b><br>
            </p>
            <samp>₱1000.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Ref Magnet.jpg" alt="Ref Magnet">
          </picture>
          <div class="detail">
            <p data-lang-en="Ref Magnet" data-lang-es="Imán de Nevera" data-lang-fr="Aimant de Réfrigérateur"
              data-lang-de="Kühlschrankmagnet" data-lang-zh="冰箱磁铁" data-lang-jp="冷蔵庫マグネット"
              data-lang-ru="Магнит для холодильника" data-lang-it="Magnete da Frigo" data-lang-pt="Ímã de Geladeira"
              data-lang-ar="مغناطيس ثلاجة">
              <b>Ref Magnet</b><br>
            </p>
            <samp>₱200.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/sunny.jpg" alt="Product Nine">
          </picture>
          <div class="detail">
            <p data-lang-en="Product Nine" data-lang-es="Producto Nueve" data-lang-fr="Produit Neuf"
              data-lang-de="Produkt Neun" data-lang-zh="产品九" data-lang-jp="製品9" data-lang-ru="Продукт девять"
              data-lang-it="Prodotto Nove" data-lang-pt="Produto Nove" data-lang-ar="المنتج تسعة">
              <b>Product Nine</b><br>
              <small>New arrival</small>
            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Piaya.png" alt="Piaya">
          </picture>
          <div class="detail">
            <p data-lang-en="Piaya" data-lang-es="Piaya" data-lang-fr="Piaya" data-lang-de="Piaya" data-lang-zh="皮亚"
              data-lang-jp="ピアヤ" data-lang-ru="Пиая" data-lang-it="Piaya" data-lang-pt="Piaya" data-lang-ar="بيايا">
              <b>Piaya</b><br>
            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/T’nalak Cloth.jpeg" alt="T’nalak Cloth">
          </picture>
          <div class="detail">
            <p data-lang-en="T’nalak Cloth" data-lang-es="Tela T’nalak" data-lang-fr="Tissu T’nalak"
              data-lang-de="T’nalak-Stoff" data-lang-zh="特纳拉克布" data-lang-jp="トゥナラク布" data-lang-ru="Ткань Т’nalak"
              data-lang-it="Tessuto T’nalak" data-lang-pt="Tecido T’nalak" data-lang-ar="قماش T’nalak">
              <b>T’nalak Cloth</b><br>
            </p>
            <samp>₱700.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Banana Chips.jpeg" alt="Banana Chips">
          </picture>
          <div class="detail">
            <p data-lang-en="Banana Chips" data-lang-es="Chips de Plátano" data-lang-fr="Chips de Banane"
              data-lang-de="Bananenchips" data-lang-zh="香蕉片" data-lang-jp="バナナチップ" data-lang-ru="Банановые чипсы"
              data-lang-it="Chips di Banana" data-lang-pt="Chips de Banana" data-lang-ar="رقائق الموز">
              <b>Banana Chips</b><br>
            </p>
            <samp>₱150.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
      </section>
    </main>











    <main>
      <div class="text">

      </div>
      <header>
        <h1 data-lang-en="Top Hottest Products" data-lang-es="Los Productos Más Populares"
          data-lang-fr="Produits Les Plus Tendance" data-lang-de="Die Beliebtesten Produkte" data-lang-zh="最热门的产品"
          data-lang-jp="最も人気のある製品 " data-lang-ru="Самые Популярные Продукты " data-lang-it="I Prodotti Più Popolari"
          data-lang-pt="Os Produtos Mais Populares" data-lang-ar="أكثر المنتجات شهرة ">Top Hottest Products</h1>
        <p>
          <span class="span2">&#139;</span>
          <span class="span2">&#155;</span>

        </p>
      </header>
      <section class="section6">
        <div class="product">
          <picture>
            <img src="../places/boracay/dried mangoes.jpg">
          </picture>
          <div class="detail">
            <p>
              <b>Dried Mangoes</b><br>

            </p>
            <samp>₱500.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Kapeng-Barako.png">
          </picture>
          <div class="detail">
            <p>
              <b>Barako Coffee</b><br>

            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Handicrafts.jpg">
          </picture>
          <div class="detail">
            <p>
              <b>Handicrafts</b><br>

            </p>
            <samp>₱500.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/keychains.jpg">
          </picture>
          <div class="detail">
            <p>
              <b>Keychains</b><br>

            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Buko Pie.jpg">
          </picture>
          <div class="detail">
            <p>
              <b>Buko Pie</b><br>

            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Beachwear.jpg">
          </picture>
          <div class="detail">
            <p>
              <b>Beachwear</b><br>

            </p>
            <samp>₱600.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Seafood.jpg">
          </picture>
          <div class="detail">
            <p>
              <b>Seafoods</b><br>

            </p>
            <samp>₱1000.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Ref Magnet.jpg">
          </picture>
          <div class="detail">
            <p>
              <b>Ref Magnet</b><br>

            </p>
            <samp>₱200.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/sunny.jpg">
          </picture>
          <div class="detail">
            <p>
              <b>Product Nine</b><br>
              <small>New arrival</small>
            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Piaya.png">
          </picture>
          <div class="detail">
            <p>
              <b>Piaya</b><br>

            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/T’nalak Cloth.jpeg">
          </picture>
          <div class="detail">
            <p>
              <b>T’nalak Cloth </b><br>

            </p>
            <samp>₱700.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Banana Chips.jpeg">
          </picture>
          <div class="detail">
            <p>
              <b>Banana Chips</b><br>

            </p>
            <samp>₱150.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
      </section>
    </main>




    <main>
      <div class="text">

      </div>
      <header>
        <h1 data-lang-en="Top Hottest Products" data-lang-es="Los Productos Más Populares"
          data-lang-fr="Produits Les Plus Tendance" data-lang-de="Die Beliebtesten Produkte" data-lang-zh="最热门的产品"
          data-lang-jp="最も人気のある製品 " data-lang-ru="Самые Популярные Продукты " data-lang-it="I Prodotti Più Popolari"
          data-lang-pt="Os Produtos Mais Populares" data-lang-ar="أكثر المنتجات شهرة ">Top Hottest Products</h1>
        <p>
          <span class="span3">&#139;</span>
          <span class="span3">&#155;</span>

        </p>
      </header>
      <section class="section6">
        <div class="product">
          <picture>
            <img src="../places/boracay/dried mangoes.jpg">
          </picture>
          <div class="detail">
            <p>
              <b>Dried Mangoes</b><br>

            </p>
            <samp>₱500.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Kapeng-Barako.png">
          </picture>
          <div class="detail">
            <p>
              <b>Barako Coffee</b><br>

            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Handicrafts.jpg">
          </picture>
          <div class="detail">
            <p>
              <b>Handicrafts</b><br>

            </p>
            <samp>₱500.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/keychains.jpg">
          </picture>
          <div class="detail">
            <p>
              <b>Keychains</b><br>

            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Buko Pie.jpg">
          </picture>
          <div class="detail">
            <p>
              <b>Buko Pie</b><br>

            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Beachwear.jpg">
          </picture>
          <div class="detail">
            <p>
              <b>Beachwear</b><br>

            </p>
            <samp>₱600.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Seafood.jpg">
          </picture>
          <div class="detail">
            <p>
              <b>Seafoods</b><br>

            </p>
            <samp>₱1000.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Ref Magnet.jpg">
          </picture>
          <div class="detail">
            <p>
              <b>Ref Magnet</b><br>

            </p>
            <samp>₱200.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/sunny.jpg">
          </picture>
          <div class="detail">
            <p>
              <b>Product Nine</b><br>
              <small>New arrival</small>
            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Piaya.png">
          </picture>
          <div class="detail">
            <p>
              <b>Piaya</b><br>

            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/T’nalak Cloth.jpeg">
          </picture>
          <div class="detail">
            <p>
              <b>T’nalak Cloth </b><br>

            </p>
            <samp>₱700.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/Banana Chips.jpeg">
          </picture>
          <div class="detail">
            <p>
              <b>Banana Chips</b><br>

            </p>
            <samp>₱150.00</samp>
          </div>
          <div class="button7">

            <a class="a1" href="#">Buy Now!!</a>
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
  <script src="../js/fin.js"></script>
  <script src="../js/product.js"></script>
  <script src="../js/market1.js"></script>
</body>

</html>