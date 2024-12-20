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

} catch (PDOException $error) {
  echo $error->getMessage() . '';
  exit;
}

?>

<?php
// Check if the user is logged in
if (isset($_SESSION['id'])) {
  $user_id = $_SESSION['id'];

  try {
    // Fetch the user's details from the database using user_id
    $stmt = $pdoConnect->prepare("SELECT UserName, FullName, PassWord, image FROM user WHERE id = :user_id");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
      // Extract user details
      $email = $user['UserName'];
      $full_name = $user['FullName'];
      $password = $user['PassWord'];
      $profile_image = !empty($user['image']) ? $user['image'] : 'img/default_profile.jpg'; // Fallback to default image
    } else {
      // Handle the case where user details are not found
      echo "User details not found.";
      exit();
    }
  } catch (PDOException $e) {
    // Handle database connection error or query failure
    echo "Error: " . $e->getMessage();
    exit();
  }
} else {
  // Redirect to the login page if the user is not logged in
  header("Location: login.php");
  exit();
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
  <link rel="stylesheet" href="../style/boracay.css" />
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
  <?php include_once 'nav.php'; ?>
  <section class="overlay"></section>

  <Section class="main">
    <div class="pano">

      <div class="main1">
        <h4 data-lang-en="Boracay" data-lang-es="Boracay" data-lang-fr="Boracay" data-lang-de="Boracay"
          data-lang-zh="长滩岛" data-lang-jp="ボラカイ" data-lang-ru="Боракай" data-lang-it="Boracay" data-lang-pt="Boracay"
          data-lang-ar="بوراكاي">Boracay</h4>

        <p data-lang-en="It's more fun in Boracay Philippines!!"
          data-lang-es="¡Es más divertido en Boracay, Filipinas!!"
          data-lang-fr="C'est plus amusant à Boracay, Philippines !!"
          data-lang-de="Es macht mehr Spaß in Boracay, Philippinen!!" data-lang-zh="在菲律宾的长滩岛更有趣！！"
          data-lang-jp="ボラカイではもっと楽しいです！！" data-lang-ru="На Боракае веселей, Филиппины!!"
          data-lang-it="È più divertente a Boracay, Filippine!!" data-lang-pt="É mais divertido em Boracay, Filipinas!!"
          data-lang-ar="إنه أكثر متعة في بوراكاي، الفلبين!!">It's more fun in Boracay Philippines!!</p>

        <button class="button" type="button">
          <a href="../include/boracaybook.php" data-lang-en="Book Now!!" data-lang-es="¡Reserva Ahora!!"
            data-lang-fr="Réservez Maintenant!!" data-lang-de="Jetzt Buchen!!" data-lang-zh="立即预订！！"
            data-lang-jp="今すぐ予約！！" data-lang-ru="Забронируйте Сейчас!!" data-lang-it="Prenota Ora!!"
            data-lang-pt="Reserve Agora!!" data-lang-ar="احجز الآن!!">Book Now</a>
        </button>

        <button class="button">
          <a href="../include/boracayfeed.php" data-lang-en="Newsfeed!!" data-lang-es="¡Feed de Noticias!!"
            data-lang-fr="Fil d'Actualités!!" data-lang-de="Nachrichtenticker!!" data-lang-zh="新闻动态！！"
            data-lang-jp="ニュースフィード！！" data-lang-ru="Новости!!" data-lang-it="Notizie!!"
            data-lang-pt="Feed de Notícias!!" data-lang-ar="موجز الأخبار!!">Newsfeed</a>
        </button>

        <button class="button">
          <a href="../img/Travel Hunter.pdf" download="Travel Hunter.pdf"
            data-lang-en="Offline"
            data-lang-es="Sin conexión"
            data-lang-fr="Hors ligne"
            data-lang-de="Offline"
            data-lang-zh="离线"
            data-lang-jp="オフライン"
            data-lang-ru="Офлайн"
            data-lang-it="Offline"
            data-lang-pt="Offline"
            data-lang-ar="غير متصل">Offline</a>
        </button>
      </div>


    </div>

    <div class="history">
      <div class="container">
        <div class="tour__head">

        </div>

        <div class="image-container"></div>
        <div class="place-name" id="place-name">Shangri-La Hotel </div>
        
      </div>
    </div>
    </div>
  </section>
  <div class="img">

    <main>




      <div id="carousel" class="carousel">

        <div id='item_1' class="hideLeft" >
          <img src="../places/boracay/1.jpg" >
        </div>

        <div id='item_2' class="prevLeftSecond">
          <img src="../places/boracay/2.jpg">
        </div>

        <div id='item_3' class="prev">
          <img src="../places/boracay/4.jpg">
        </div>

        <div id='item_4' class="selected">
          <img src="../places/boracay/5.jpg" class="clickable-image">
        </div>

        <div id='item_5' class="next">
          <img src="../img/qqq.jpg">
        </div>

        <div id='item_6' class="nextRightSecond">
          <img src="../places/boracay/7.jpg">
        </div>

        <div id='item_7' class="hideRight">
          <img src="../places/boracay/8.jpg">
        </div>

        <div id='item_8' class="hideRight">
          <img src="../places/boracay/9.jpg">
        </div>

      </div>

      <div class="buttons">
        <button class="button-82-pushable" role="button" id="prev"><span class="button-82-shadow"></span><span
            class="button-82-edge"></span></span></button>


        <button class="button-82-pushable" role="button" id="next"><span class="button-82-shadow"></span><span
            class="button-82-edge"></span></button>
      </div>

    </main>
  </div>
  <section class="package">
    <main>
      <header>
        <h1 data-lang-en="Boracay Tour Package" data-lang-es="Paquete de Tour a Boracay"
          data-lang-fr="Forfait Tour à Boracay" data-lang-de="Boracay Tour Paket" data-lang-zh="长滩岛旅游套餐"
          data-lang-jp="ボラカイツアーパッケージ" data-lang-ru="Турпакет на Борacay" data-lang-it="Pacchetto Tour Boracay"
          data-lang-pt="Pacote de Tour em Boracay" data-lang-ar="باقة جولة بوراكاي"><i class="bx bx-package icon"
            style="color: red;"></i>
          Boracay Tour Package
        </h1>
        <p>
          <span class="span1">&#139;</span>
          <span class="span1">&#155;</span>
        </p>
      </header>

      <p class="p2">Discover the Paradise: Explore the Philippines with us!!</p>
      <section class="section6">
        <div class="product">
          <picture>
            <img src="../img/gg.png" alt="Platinum Package">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Platinum Package" data-lang-es="Paquete Platino" data-lang-fr="Forfait Platine"
                data-lang-de="Platin Paket" data-lang-zh="白金套餐" data-lang-jp="プラチナパッケージ" data-lang-ru="Платиновый пакет"
                data-lang-it="Pacchetto Platino" data-lang-pt="Pacote Platina" data-lang-ar="باقة بلاتينية">Platinum
                Package</b><br>
              <small data-lang-en="-Hotel 6 star or Mansion" data-lang-es="-Hotel 6 estrellas o Mansión"
                data-lang-fr="-Hôtel 6 étoiles ou Manoir" data-lang-de="-6-Sterne-Hotel oder Herrenhaus"
                data-lang-zh="-6星级酒店或豪宅" data-lang-jp="-6つ星ホテルまたはマンション" data-lang-ru="-Отель 6 звезд или особняк"
                data-lang-it="-Hotel 6 stelle o Villa" data-lang-pt="-Hotel 6 estrelas ou Mansão"
                data-lang-ar="-فندق 6 نجوم أو قصر">-Hotel 6 star or Mansion</small><br>
              <small data-lang-en="-Tour Guide" data-lang-es="-Guía turístico" data-lang-fr="-Guide touristique"
                data-lang-de="-Reiseleiter" data-lang-zh="-导游" data-lang-jp="-ツアーガイド" data-lang-ru="-Экскурсовод"
                data-lang-it="-Guida turistica" data-lang-pt="-Guia turístico" data-lang-ar="-مرشد سياحي">-Tour
                Guide</small><br>
              <small data-lang-en="-Transport" data-lang-es="-Transporte" data-lang-fr="-Transport"
                data-lang-de="-Transport" data-lang-zh="-交通" data-lang-jp="-輸送" data-lang-ru="-Транспорт"
                data-lang-it="-Trasporto" data-lang-pt="-Transporte" data-lang-ar="-نقل">-Transport</small><br>
              <small data-lang-en="-Destinations" data-lang-es="-Destinos" data-lang-fr="-Destinations"
                data-lang-de="-Ziele" data-lang-zh="-目的地" data-lang-jp="-目的地" data-lang-ru="-Направления"
                data-lang-it="-Destinazioni" data-lang-pt="-Destinos" data-lang-ar="-وجهات">-Destinations</small><br>
              <small data-lang-en="-Breakfast and Fine Dining" data-lang-es="-Desayuno y Alta Cocina"
                data-lang-fr="-Petit-déjeuner et Gastronomie" data-lang-de="-Frühstück und Feinschmeckerei"
                data-lang-zh="-早餐和高档餐饮" data-lang-jp="-朝食と高級ダイニング" data-lang-ru="-Завтрак и изысканная кухня"
                data-lang-it="-Colazione e Ristorazione di Lusso" data-lang-pt="-Café da manhã e Jantar Fino"
                data-lang-ar="-الإفطار والعشاء الفاخر">-Breakfast and Fine Dining</small><br>
              <small data-lang-en="-Premium Souvenir" data-lang-es="-Souvenir Premium" data-lang-fr="-Souvenir Premium"
                data-lang-de="-Premium Souvenir" data-lang-zh="-高级纪念品" data-lang-jp="-プレミアムお土産"
                data-lang-ru="-Премиум-сувенир" data-lang-it="-Souvenir Premium" data-lang-pt="-Souvenir Premium"
                data-lang-ar="-تذكار مميز">-Premium Souvenir</small>
            </p>
            <samp>₱10,899.00</samp>
          </div>
          <div class="button7">
            <p class="star"></p>
            <a class="a1" href="#" data-lang-en="Book Now!!" data-lang-es="¡Reserva Ahora!!"
              data-lang-fr="Réservez Maintenant!!" data-lang-de="Jetzt Buchen!!" data-lang-zh="立即预订！！"
              data-lang-jp="今すぐ予約！！" data-lang-ru="Забронируйте Сейчас!!" data-lang-it="Prenota Ora!!"
              data-lang-pt="Reserve Agora!!" data-lang-ar="احجز الآن!!">Book Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../img/gg.png" alt="Platinum Package">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Gold Package" data-lang-es="Paquete Oro" data-lang-fr="Forfait Or"
                data-lang-de="Gold Paket" data-lang-zh="金套餐" data-lang-jp="ゴールドパッケージ" data-lang-ru="Золотой пакет"
                data-lang-it="Pacchetto Oro" data-lang-pt="Pacote Ouro" data-lang-ar="باقة ذهبية">Gold Package</b><br>
              <small data-lang-en="-Hotel 5 star or Standard Villa" data-lang-es="-Hotel 5 estrellas o Villa Estándar"
                data-lang-fr="-Hôtel 5 étoiles ou Villa Standard" data-lang-de="-5-Sterne-Hotel oder Standardvilla"
                data-lang-zh="-5星级酒店或标准别墅" data-lang-jp="-5つ星ホテルまたはスタンダードヴィラ"
                data-lang-ru="-Отель 5 звезд или стандартная вилла" data-lang-it="-Hotel 5 stelle o Villa Standard"
                data-lang-pt="-Hotel 5 estrelas ou Villa Padrão" data-lang-ar="-فندق 5 نجوم أو فيلا قياسية">-Hotel 5
                star or Standard Villa</small><br>
              <small data-lang-en="-Tour Guide" data-lang-es="-Guía turístico" data-lang-fr="-Guide touristique"
                data-lang-de="-Reiseleiter" data-lang-zh="-导游" data-lang-jp="-ツアーガイド" data-lang-ru="-Экскурсовод"
                data-lang-it="-Guida turistica" data-lang-pt="-Guia turístico" data-lang-ar="-مرشد سياحي">-Tour
                Guide</small><br>
              <small data-lang-en="-Transport" data-lang-es="-Transporte" data-lang-fr="-Transport"
                data-lang-de="-Transport" data-lang-zh="-交通" data-lang-jp="-輸送" data-lang-ru="-Транспорт"
                data-lang-it="-Trasporto" data-lang-pt="-Transporte" data-lang-ar="-نقل">-Transport</small><br>
              <small data-lang-en="-Destinations" data-lang-es="-Destinos" data-lang-fr="-Destinations"
                data-lang-de="-Ziele" data-lang-zh="-目的地" data-lang-jp="-目的地" data-lang-ru="-Направления"
                data-lang-it="-Destinazioni" data-lang-pt="-Destinos" data-lang-ar="-وجهات">-Destinations</small><br>
              <small data-lang-en="-Breakfast and Fine Dining" data-lang-es="-Desayuno y Alta Cocina"
                data-lang-fr="-Petit-déjeuner et Gastronomie" data-lang-de="-Frühstück und Feinschmeckerei"
                data-lang-zh="-早餐和高档餐饮" data-lang-jp="-朝食と高級ダイニング" data-lang-ru="-Завтрак и изысканная кухня"
                data-lang-it="-Colazione e Ristorazione di Lusso" data-lang-pt="-Café da manhã e Jantar Fino"
                data-lang-ar="-الإفطار والعشاء الفاخر">-Breakfast and Fine Dining</small><br>
            </p>
            <samp>₱9,899.00</samp>
          </div>
          <div class="button7">
            <p class="star"></p>
            <a class="a1" href="#" data-lang-en="Book Now!!" data-lang-es="¡Reserva Ahora!!"
              data-lang-fr="Réservez Maintenant!!" data-lang-de="Jetzt Buchen!!" data-lang-zh="立即预订！！"
              data-lang-jp="今すぐ予約！！" data-lang-ru="Забронируйте Сейчас!!" data-lang-it="Prenota Ora!!"
              data-lang-pt="Reserve Agora!!" data-lang-ar="احجز الآن!!">Book Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../img/gg.png" alt="Platinum Package">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Silver Package" data-lang-es="Paquete Plata" data-lang-fr="Forfait Argent"
                data-lang-de="Silber Paket" data-lang-zh="银套餐" data-lang-jp="シルバーパッケージ" data-lang-ru="Серебряный пакет"
                data-lang-it="Pacchetto Argento" data-lang-pt="Pacote Prata" data-lang-ar="باقة فضية">Silver
                Package</b><br>
              <small data-lang-en="-Hotel 4 star" data-lang-es="-Hotel 4 estrellas" data-lang-fr="-Hôtel 4 étoiles"
                data-lang-de="-4-Sterne-Hotel" data-lang-zh="-4星级酒店" data-lang-jp="-4つ星ホテル"
                data-lang-ru="-Отель 4 звезды" data-lang-it="-Hotel 4 stelle" data-lang-pt="-Hotel 4 estrelas"
                data-lang-ar="-فندق 4 نجوم">-Hotel 4 star</small><br>
              <small data-lang-en="-Tour Guide" data-lang-es="-Guía turístico" data-lang-fr="-Guide touristique"
                data-lang-de="-Reiseleiter" data-lang-zh="-导游" data-lang-jp="-ツアーガイド" data-lang-ru="-Экскурсовод"
                data-lang-it="-Guida turistica" data-lang-pt="-Guia turístico" data-lang-ar="-مرشد سياحي">-Tour
                Guide</small><br>
              <small data-lang-en="-Transport" data-lang-es="-Transporte" data-lang-fr="-Transport"
                data-lang-de="-Transport" data-lang-zh="-交通" data-lang-jp="-輸送" data-lang-ru="-Транспорт"
                data-lang-it="-Trasporto" data-lang-pt="-Transporte" data-lang-ar="-نقل">-Transport</small><br>
              <small data-lang-en="-Destinations" data-lang-es="-Destinos" data-lang-fr="-Destinations"
                data-lang-de="-Ziele" data-lang-zh="-目的地" data-lang-jp="-目的地" data-lang-ru="-Направления"
                data-lang-it="-Destinazioni" data-lang-pt="-Destinos" data-lang-ar="-وجهات">-Destinations</small><br>
              <small data-lang-en="-Breakfast" data-lang-es="-Desayuno" data-lang-fr="-Petit-déjeuner"
                data-lang-de="-Frühstück" data-lang-zh="-早餐" data-lang-jp="-朝食" data-lang-ru="-Завтрак"
                data-lang-it="-Colazione" data-lang-pt="-Café da manhã" data-lang-ar="-الإفطار">-Breakfast</small>
            </p>
            <samp>₱8,899.00</samp>
          </div>
          <div class="button7">
            <p class="star"></p>
            <a class="a1" href="#" data-lang-en="Book Now!!" data-lang-es="¡Reserva Ahora!!"
              data-lang-fr="Réservez Maintenant!!" data-lang-de="Jetzt Buchen!!" data-lang-zh="立即预订！！"
              data-lang-jp="今すぐ予約！！" data-lang-ru="Забронируйте Сейчас!!" data-lang-it="Prenota Ora!!"
              data-lang-pt="Reserve Agora!!" data-lang-ar="احجز الآن!!">Book Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../img/gg.png" alt="Platinum Package">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Bronze Package" data-lang-es="Paquete Bronce" data-lang-fr="Forfait Bronze"
                data-lang-de="Bronze Paket" data-lang-zh="铜套餐" data-lang-jp="ブロンズパッケージ" data-lang-ru="Бронзовый пакет"
                data-lang-it="Pacchetto Bronzo" data-lang-pt="Pacote Bronze" data-lang-ar="باقة برونزية">Bronze
                Package</b><br>
              <small data-lang-en="-Hotel 3 star" data-lang-es="-Hotel 3 estrellas" data-lang-fr="-Hôtel 3 étoiles"
                data-lang-de="-3-Sterne-Hotel" data-lang-zh="-3星级酒店" data-lang-jp="-3つ星ホテル"
                data-lang-ru="-Отель 3 звезды" data-lang-it="-Hotel 3 stelle" data-lang-pt="-Hotel 3 estrelas"
                data-lang-ar="-فندق 3 نجوم">-Hotel 3 star</small><br>
              <small data-lang-en="-Tour Guide" data-lang-es="-Guía turístico" data-lang-fr="-Guide touristique"
                data-lang-de="-Reiseleiter" data-lang-zh="-导游" data-lang-jp="-ツアーガイド" data-lang-ru="-Экскурсовод"
                data-lang-it="-Guida turistica" data-lang-pt="-Guia turístico" data-lang-ar="-مرشد سياحي">-Tour
                Guide</small><br>
              <small data-lang-en="-Transport" data-lang-es="-Transporte" data-lang-fr="-Transport"
                data-lang-de="-Transport" data-lang-zh="-交通" data-lang-jp="-輸送" data-lang-ru="-Транспорт"
                data-lang-it="-Trasporto" data-lang-pt="-Transporte" data-lang-ar="-نقل">-Transport</small><br>
              <small data-lang-en="-Destinations" data-lang-es="-Destinos" data-lang-fr="-Destinations"
                data-lang-de="-Ziele" data-lang-zh="-目的地" data-lang-jp="-目的地" data-lang-ru="-Направления"
                data-lang-it="-Destinazioni" data-lang-pt="-Destinos" data-lang-ar="-وجهات">-Destinations</small><br>
              <small data-lang-en="-Breakfast" data-lang-es="-Desayuno" data-lang-fr="-Petit-déjeuner"
                data-lang-de="-Frühstück" data-lang-zh="-早餐" data-lang-jp="-朝食" data-lang-ru="-Завтрак"
                data-lang-it="-Colazione" data-lang-pt="-Café da manhã" data-lang-ar="-الإفطار">-Breakfast</small>
            </p>
            <samp>₱6,999.00</samp>
          </div>
          <div class="button7">
            <p class="star"></p>
            <a class="a1" href="#" data-lang-en="Book Now!!" data-lang-es="¡Reserva Ahora!!"
              data-lang-fr="Réservez Maintenant!!" data-lang-de="Jetzt Buchen!!" data-lang-zh="立即预订！！"
              data-lang-jp="今すぐ予約！！" data-lang-ru="Забронируйте Сейчас!!" data-lang-it="Prenota Ora!!"
              data-lang-pt="Reserve Agora!!" data-lang-ar="احجز الآن!!">Book Now!!</a>
          </div>
        </div>



        <div class="product">
          <picture>
            <img src="../img/gg.png" alt="Platinum Package">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Platinum Package" data-lang-es="Paquete Platino" data-lang-fr="Forfait Platine"
                data-lang-de="Platin Paket" data-lang-zh="白金套餐" data-lang-jp="プラチナパッケージ" data-lang-ru="Платиновый пакет"
                data-lang-it="Pacchetto Platino" data-lang-pt="Pacote Platina" data-lang-ar="باقة بلاتينية">Platinum
                Package</b><br>
              <small data-lang-en="-Hotel 6 star or Mansion" data-lang-es="-Hotel 6 estrellas o Mansión"
                data-lang-fr="-Hôtel 6 étoiles ou Manoir" data-lang-de="-6-Sterne-Hotel oder Herrenhaus"
                data-lang-zh="-6星级酒店或豪宅" data-lang-jp="-6つ星ホテルまたはマンション" data-lang-ru="-Отель 6 звезд или особняк"
                data-lang-it="-Hotel 6 stelle o Villa" data-lang-pt="-Hotel 6 estrelas ou Mansão"
                data-lang-ar="-فندق 6 نجوم أو قصر">-Hotel 6 star or Mansion</small><br>
              <small data-lang-en="-Tour Guide" data-lang-es="-Guía turístico" data-lang-fr="-Guide touristique"
                data-lang-de="-Reiseleiter" data-lang-zh="-导游" data-lang-jp="-ツアーガイド" data-lang-ru="-Экскурсовод"
                data-lang-it="-Guida turistica" data-lang-pt="-Guia turístico" data-lang-ar="-مرشد سياحي">-Tour
                Guide</small><br>
              <small data-lang-en="-Transport" data-lang-es="-Transporte" data-lang-fr="-Transport"
                data-lang-de="-Transport" data-lang-zh="-交通" data-lang-jp="-輸送" data-lang-ru="-Транспорт"
                data-lang-it="-Trasporto" data-lang-pt="-Transporte" data-lang-ar="-نقل">-Transport</small><br>
              <small data-lang-en="-Destinations" data-lang-es="-Destinos" data-lang-fr="-Destinations"
                data-lang-de="-Ziele" data-lang-zh="-目的地" data-lang-jp="-目的地" data-lang-ru="-Направления"
                data-lang-it="-Destinazioni" data-lang-pt="-Destinos" data-lang-ar="-وجهات">-Destinations</small><br>
              <small data-lang-en="-Breakfast and Fine Dining" data-lang-es="-Desayuno y Alta Cocina"
                data-lang-fr="-Petit-déjeuner et Gastronomie" data-lang-de="-Frühstück und Feinschmeckerei"
                data-lang-zh="-早餐和高档餐饮" data-lang-jp="-朝食と高級ダイニング" data-lang-ru="-Завтрак и изысканная кухня"
                data-lang-it="-Colazione e Ristorazione di Lusso" data-lang-pt="-Café da manhã e Jantar Fino"
                data-lang-ar="-الإفطار والعشاء الفاخر">-Breakfast and Fine Dining</small><br>
              <small data-lang-en="-Premium Souvenir" data-lang-es="-Souvenir Premium" data-lang-fr="-Souvenir Premium"
                data-lang-de="-Premium Souvenir" data-lang-zh="-高级纪念品" data-lang-jp="-プレミアムお土産"
                data-lang-ru="-Премиум-сувенир" data-lang-it="-Souvenir Premium" data-lang-pt="-Souvenir Premium"
                data-lang-ar="-تذكار مميز">-Premium Souvenir</small>
            </p>
            <samp>₱10,899.00</samp>
          </div>
          <div class="button7">
            <p class="star"></p>
            <a class="a1" href="#" data-lang-en="Book Now!!" data-lang-es="¡Reserva Ahora!!"
              data-lang-fr="Réservez Maintenant!!" data-lang-de="Jetzt Buchen!!" data-lang-zh="立即预订！！"
              data-lang-jp="今すぐ予約！！" data-lang-ru="Забронируйте Сейчас!!" data-lang-it="Prenota Ora!!"
              data-lang-pt="Reserve Agora!!" data-lang-ar="احجز الآن!!">Book Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../img/gg.png" alt="Platinum Package">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Gold Package" data-lang-es="Paquete Oro" data-lang-fr="Forfait Or"
                data-lang-de="Gold Paket" data-lang-zh="金套餐" data-lang-jp="ゴールドパッケージ" data-lang-ru="Золотой пакет"
                data-lang-it="Pacchetto Oro" data-lang-pt="Pacote Ouro" data-lang-ar="باقة ذهبية">Gold Package</b><br>
              <small data-lang-en="-Hotel 5 star or Standard Villa" data-lang-es="-Hotel 5 estrellas o Villa Estándar"
                data-lang-fr="-Hôtel 5 étoiles ou Villa Standard" data-lang-de="-5-Sterne-Hotel oder Standardvilla"
                data-lang-zh="-5星级酒店或标准别墅" data-lang-jp="-5つ星ホテルまたはスタンダードヴィラ"
                data-lang-ru="-Отель 5 звезд или стандартная вилла" data-lang-it="-Hotel 5 stelle o Villa Standard"
                data-lang-pt="-Hotel 5 estrelas ou Villa Padrão" data-lang-ar="-فندق 5 نجوم أو فيلا قياسية">-Hotel 5
                star or Standard Villa</small><br>
              <small data-lang-en="-Tour Guide" data-lang-es="-Guía turístico" data-lang-fr="-Guide touristique"
                data-lang-de="-Reiseleiter" data-lang-zh="-导游" data-lang-jp="-ツアーガイド" data-lang-ru="-Экскурсовод"
                data-lang-it="-Guida turistica" data-lang-pt="-Guia turístico" data-lang-ar="-مرشد سياحي">-Tour
                Guide</small><br>
              <small data-lang-en="-Transport" data-lang-es="-Transporte" data-lang-fr="-Transport"
                data-lang-de="-Transport" data-lang-zh="-交通" data-lang-jp="-輸送" data-lang-ru="-Транспорт"
                data-lang-it="-Trasporto" data-lang-pt="-Transporte" data-lang-ar="-نقل">-Transport</small><br>
              <small data-lang-en="-Destinations" data-lang-es="-Destinos" data-lang-fr="-Destinations"
                data-lang-de="-Ziele" data-lang-zh="-目的地" data-lang-jp="-目的地" data-lang-ru="-Направления"
                data-lang-it="-Destinazioni" data-lang-pt="-Destinos" data-lang-ar="-وجهات">-Destinations</small><br>
              <small data-lang-en="-Breakfast and Fine Dining" data-lang-es="-Desayuno y Alta Cocina"
                data-lang-fr="-Petit-déjeuner et Gastronomie" data-lang-de="-Frühstück und Feinschmeckerei"
                data-lang-zh="-早餐和高档餐饮" data-lang-jp="-朝食と高級ダイニング" data-lang-ru="-Завтрак и изысканная кухня"
                data-lang-it="-Colazione e Ristorazione di Lusso" data-lang-pt="-Café da manhã e Jantar Fino"
                data-lang-ar="-الإفطار والعشاء الفاخر">-Breakfast and Fine Dining</small><br>
            </p>
            <samp>₱9,899.00</samp>
          </div>
          <div class="button7">
            <p class="star"></p>
            <a class="a1" href="#" data-lang-en="Book Now!!" data-lang-es="¡Reserva Ahora!!"
              data-lang-fr="Réservez Maintenant!!" data-lang-de="Jetzt Buchen!!" data-lang-zh="立即预订！！"
              data-lang-jp="今すぐ予約！！" data-lang-ru="Забронируйте Сейчас!!" data-lang-it="Prenota Ora!!"
              data-lang-pt="Reserve Agora!!" data-lang-ar="احجز الآن!!">Book Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../img/gg.png" alt="Platinum Package">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Silver Package" data-lang-es="Paquete Plata" data-lang-fr="Forfait Argent"
                data-lang-de="Silber Paket" data-lang-zh="银套餐" data-lang-jp="シルバーパッケージ" data-lang-ru="Серебряный пакет"
                data-lang-it="Pacchetto Argento" data-lang-pt="Pacote Prata" data-lang-ar="باقة فضية">Silver
                Package</b><br>
              <small data-lang-en="-Hotel 4 star" data-lang-es="-Hotel 4 estrellas" data-lang-fr="-Hôtel 4 étoiles"
                data-lang-de="-4-Sterne-Hotel" data-lang-zh="-4星级酒店" data-lang-jp="-4つ星ホテル"
                data-lang-ru="-Отель 4 звезды" data-lang-it="-Hotel 4 stelle" data-lang-pt="-Hotel 4 estrelas"
                data-lang-ar="-فندق 4 نجوم">-Hotel 4 star</small><br>
              <small data-lang-en="-Tour Guide" data-lang-es="-Guía turístico" data-lang-fr="-Guide touristique"
                data-lang-de="-Reiseleiter" data-lang-zh="-导游" data-lang-jp="-ツアーガイド" data-lang-ru="-Экскурсовод"
                data-lang-it="-Guida turistica" data-lang-pt="-Guia turístico" data-lang-ar="-مرشد سياحي">-Tour
                Guide</small><br>
              <small data-lang-en="-Transport" data-lang-es="-Transporte" data-lang-fr="-Transport"
                data-lang-de="-Transport" data-lang-zh="-交通" data-lang-jp="-輸送" data-lang-ru="-Транспорт"
                data-lang-it="-Trasporto" data-lang-pt="-Transporte" data-lang-ar="-نقل">-Transport</small><br>
              <small data-lang-en="-Destinations" data-lang-es="-Destinos" data-lang-fr="-Destinations"
                data-lang-de="-Ziele" data-lang-zh="-目的地" data-lang-jp="-目的地" data-lang-ru="-Направления"
                data-lang-it="-Destinazioni" data-lang-pt="-Destinos" data-lang-ar="-وجهات">-Destinations</small><br>
              <small data-lang-en="-Breakfast" data-lang-es="-Desayuno" data-lang-fr="-Petit-déjeuner"
                data-lang-de="-Frühstück" data-lang-zh="-早餐" data-lang-jp="-朝食" data-lang-ru="-Завтрак"
                data-lang-it="-Colazione" data-lang-pt="-Café da manhã" data-lang-ar="-الإفطار">-Breakfast</small>
            </p>
            <samp>₱8,899.00</samp>
          </div>
          <div class="button7">
            <p class="star"></p>
            <a class="a1" href="#" data-lang-en="Book Now!!" data-lang-es="¡Reserva Ahora!!"
              data-lang-fr="Réservez Maintenant!!" data-lang-de="Jetzt Buchen!!" data-lang-zh="立即预订！！"
              data-lang-jp="今すぐ予約！！" data-lang-ru="Забронируйте Сейчас!!" data-lang-it="Prenota Ora!!"
              data-lang-pt="Reserve Agora!!" data-lang-ar="احجز الآن!!">Book Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../img/gg.png" alt="Platinum Package">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Bronze Package" data-lang-es="Paquete Bronce" data-lang-fr="Forfait Bronze"
                data-lang-de="Bronze Paket" data-lang-zh="铜套餐" data-lang-jp="ブロンズパッケージ" data-lang-ru="Бронзовый пакет"
                data-lang-it="Pacchetto Bronzo" data-lang-pt="Pacote Bronze" data-lang-ar="باقة برونزية">Bronze
                Package</b><br>
              <small data-lang-en="-Hotel 3 star" data-lang-es="-Hotel 3 estrellas" data-lang-fr="-Hôtel 3 étoiles"
                data-lang-de="-3-Sterne-Hotel" data-lang-zh="-3星级酒店" data-lang-jp="-3つ星ホテル"
                data-lang-ru="-Отель 3 звезды" data-lang-it="-Hotel 3 stelle" data-lang-pt="-Hotel 3 estrelas"
                data-lang-ar="-فندق 3 نجوم">-Hotel 3 star</small><br>
              <small data-lang-en="-Tour Guide" data-lang-es="-Guía turístico" data-lang-fr="-Guide touristique"
                data-lang-de="-Reiseleiter" data-lang-zh="-导游" data-lang-jp="-ツアーガイド" data-lang-ru="-Экскурсовод"
                data-lang-it="-Guida turistica" data-lang-pt="-Guia turístico" data-lang-ar="-مرشد سياحي">-Tour
                Guide</small><br>
              <small data-lang-en="-Transport" data-lang-es="-Transporte" data-lang-fr="-Transport"
                data-lang-de="-Transport" data-lang-zh="-交通" data-lang-jp="-輸送" data-lang-ru="-Транспорт"
                data-lang-it="-Trasporto" data-lang-pt="-Transporte" data-lang-ar="-نقل">-Transport</small><br>
              <small data-lang-en="-Destinations" data-lang-es="-Destinos" data-lang-fr="-Destinations"
                data-lang-de="-Ziele" data-lang-zh="-目的地" data-lang-jp="-目的地" data-lang-ru="-Направления"
                data-lang-it="-Destinazioni" data-lang-pt="-Destinos" data-lang-ar="-وجهات">-Destinations</small><br>
              <small data-lang-en="-Breakfast" data-lang-es="-Desayuno" data-lang-fr="-Petit-déjeuner"
                data-lang-de="-Frühstück" data-lang-zh="-早餐" data-lang-jp="-朝食" data-lang-ru="-Завтрак"
                data-lang-it="-Colazione" data-lang-pt="-Café da manhã" data-lang-ar="-الإفطار">-Breakfast</small>
            </p>
            <samp>₱6,999.00</samp>
          </div>
          <div class="button7">
            <p class="star"></p>
            <a class="a1" href="#" data-lang-en="Book Now!!" data-lang-es="¡Reserva Ahora!!"
              data-lang-fr="Réservez Maintenant!!" data-lang-de="Jetzt Buchen!!" data-lang-zh="立即预订！！"
              data-lang-jp="今すぐ予約！！" data-lang-ru="Забронируйте Сейчас!!" data-lang-it="Prenota Ora!!"
              data-lang-pt="Reserve Agora!!" data-lang-ar="احجز الآن!!">Book Now!!</a>
          </div>
        </div>




        <div class="product">
          <picture>
            <img src="../img/gg.png" alt="Platinum Package">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Platinum Package" data-lang-es="Paquete Platino" data-lang-fr="Forfait Platine"
                data-lang-de="Platin Paket" data-lang-zh="白金套餐" data-lang-jp="プラチナパッケージ" data-lang-ru="Платиновый пакет"
                data-lang-it="Pacchetto Platino" data-lang-pt="Pacote Platina" data-lang-ar="باقة بلاتينية">Platinum
                Package</b><br>
              <small data-lang-en="-Hotel 6 star or Mansion" data-lang-es="-Hotel 6 estrellas o Mansión"
                data-lang-fr="-Hôtel 6 étoiles ou Manoir" data-lang-de="-6-Sterne-Hotel oder Herrenhaus"
                data-lang-zh="-6星级酒店或豪宅" data-lang-jp="-6つ星ホテルまたはマンション" data-lang-ru="-Отель 6 звезд или особняк"
                data-lang-it="-Hotel 6 stelle o Villa" data-lang-pt="-Hotel 6 estrelas ou Mansão"
                data-lang-ar="-فندق 6 نجوم أو قصر">-Hotel 6 star or Mansion</small><br>
              <small data-lang-en="-Tour Guide" data-lang-es="-Guía turístico" data-lang-fr="-Guide touristique"
                data-lang-de="-Reiseleiter" data-lang-zh="-导游" data-lang-jp="-ツアーガイド" data-lang-ru="-Экскурсовод"
                data-lang-it="-Guida turistica" data-lang-pt="-Guia turístico" data-lang-ar="-مرشد سياحي">-Tour
                Guide</small><br>
              <small data-lang-en="-Transport" data-lang-es="-Transporte" data-lang-fr="-Transport"
                data-lang-de="-Transport" data-lang-zh="-交通" data-lang-jp="-輸送" data-lang-ru="-Транспорт"
                data-lang-it="-Trasporto" data-lang-pt="-Transporte" data-lang-ar="-نقل">-Transport</small><br>
              <small data-lang-en="-Destinations" data-lang-es="-Destinos" data-lang-fr="-Destinations"
                data-lang-de="-Ziele" data-lang-zh="-目的地" data-lang-jp="-目的地" data-lang-ru="-Направления"
                data-lang-it="-Destinazioni" data-lang-pt="-Destinos" data-lang-ar="-وجهات">-Destinations</small><br>
              <small data-lang-en="-Breakfast and Fine Dining" data-lang-es="-Desayuno y Alta Cocina"
                data-lang-fr="-Petit-déjeuner et Gastronomie" data-lang-de="-Frühstück und Feinschmeckerei"
                data-lang-zh="-早餐和高档餐饮" data-lang-jp="-朝食と高級ダイニング" data-lang-ru="-Завтрак и изысканная кухня"
                data-lang-it="-Colazione e Ristorazione di Lusso" data-lang-pt="-Café da manhã e Jantar Fino"
                data-lang-ar="-الإفطار والعشاء الفاخر">-Breakfast and Fine Dining</small><br>
              <small data-lang-en="-Premium Souvenir" data-lang-es="-Souvenir Premium" data-lang-fr="-Souvenir Premium"
                data-lang-de="-Premium Souvenir" data-lang-zh="-高级纪念品" data-lang-jp="-プレミアムお土産"
                data-lang-ru="-Премиум-сувенир" data-lang-it="-Souvenir Premium" data-lang-pt="-Souvenir Premium"
                data-lang-ar="-تذكار مميز">-Premium Souvenir</small>
            </p>
            <samp>₱10,899.00</samp>
          </div>
          <div class="button7">
            <p class="star"></p>
            <a class="a1" href="#" data-lang-en="Book Now!!" data-lang-es="¡Reserva Ahora!!"
              data-lang-fr="Réservez Maintenant!!" data-lang-de="Jetzt Buchen!!" data-lang-zh="立即预订！！"
              data-lang-jp="今すぐ予約！！" data-lang-ru="Забронируйте Сейчас!!" data-lang-it="Prenota Ora!!"
              data-lang-pt="Reserve Agora!!" data-lang-ar="احجز الآن!!">Book Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../img/gg.png" alt="Platinum Package">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Gold Package" data-lang-es="Paquete Oro" data-lang-fr="Forfait Or"
                data-lang-de="Gold Paket" data-lang-zh="金套餐" data-lang-jp="ゴールドパッケージ" data-lang-ru="Золотой пакет"
                data-lang-it="Pacchetto Oro" data-lang-pt="Pacote Ouro" data-lang-ar="باقة ذهبية">Gold Package</b><br>
              <small data-lang-en="-Hotel 5 star or Standard Villa" data-lang-es="-Hotel 5 estrellas o Villa Estándar"
                data-lang-fr="-Hôtel 5 étoiles ou Villa Standard" data-lang-de="-5-Sterne-Hotel oder Standardvilla"
                data-lang-zh="-5星级酒店或标准别墅" data-lang-jp="-5つ星ホテルまたはスタンダードヴィラ"
                data-lang-ru="-Отель 5 звезд или стандартная вилла" data-lang-it="-Hotel 5 stelle o Villa Standard"
                data-lang-pt="-Hotel 5 estrelas ou Villa Padrão" data-lang-ar="-فندق 5 نجوم أو فيلا قياسية">-Hotel 5
                star or Standard Villa</small><br>
              <small data-lang-en="-Tour Guide" data-lang-es="-Guía turístico" data-lang-fr="-Guide touristique"
                data-lang-de="-Reiseleiter" data-lang-zh="-导游" data-lang-jp="-ツアーガイド" data-lang-ru="-Экскурсовод"
                data-lang-it="-Guida turistica" data-lang-pt="-Guia turístico" data-lang-ar="-مرشد سياحي">-Tour
                Guide</small><br>
              <small data-lang-en="-Transport" data-lang-es="-Transporte" data-lang-fr="-Transport"
                data-lang-de="-Transport" data-lang-zh="-交通" data-lang-jp="-輸送" data-lang-ru="-Транспорт"
                data-lang-it="-Trasporto" data-lang-pt="-Transporte" data-lang-ar="-نقل">-Transport</small><br>
              <small data-lang-en="-Destinations" data-lang-es="-Destinos" data-lang-fr="-Destinations"
                data-lang-de="-Ziele" data-lang-zh="-目的地" data-lang-jp="-目的地" data-lang-ru="-Направления"
                data-lang-it="-Destinazioni" data-lang-pt="-Destinos" data-lang-ar="-وجهات">-Destinations</small><br>
              <small data-lang-en="-Breakfast and Fine Dining" data-lang-es="-Desayuno y Alta Cocina"
                data-lang-fr="-Petit-déjeuner et Gastronomie" data-lang-de="-Frühstück und Feinschmeckerei"
                data-lang-zh="-早餐和高档餐饮" data-lang-jp="-朝食と高級ダイニング" data-lang-ru="-Завтрак и изысканная кухня"
                data-lang-it="-Colazione e Ristorazione di Lusso" data-lang-pt="-Café da manhã e Jantar Fino"
                data-lang-ar="-الإفطار والعشاء الفاخر">-Breakfast and Fine Dining</small><br>
            </p>
            <samp>₱9,899.00</samp>
          </div>
          <div class="button7">
            <p class="star"></p>
            <a class="a1" href="#" data-lang-en="Book Now!!" data-lang-es="¡Reserva Ahora!!"
              data-lang-fr="Réservez Maintenant!!" data-lang-de="Jetzt Buchen!!" data-lang-zh="立即预订！！"
              data-lang-jp="今すぐ予約！！" data-lang-ru="Забронируйте Сейчас!!" data-lang-it="Prenota Ora!!"
              data-lang-pt="Reserve Agora!!" data-lang-ar="احجز الآن!!">Book Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../img/gg.png" alt="Platinum Package">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Silver Package" data-lang-es="Paquete Plata" data-lang-fr="Forfait Argent"
                data-lang-de="Silber Paket" data-lang-zh="银套餐" data-lang-jp="シルバーパッケージ" data-lang-ru="Серебряный пакет"
                data-lang-it="Pacchetto Argento" data-lang-pt="Pacote Prata" data-lang-ar="باقة فضية">Silver
                Package</b><br>
              <small data-lang-en="-Hotel 4 star" data-lang-es="-Hotel 4 estrellas" data-lang-fr="-Hôtel 4 étoiles"
                data-lang-de="-4-Sterne-Hotel" data-lang-zh="-4星级酒店" data-lang-jp="-4つ星ホテル"
                data-lang-ru="-Отель 4 звезды" data-lang-it="-Hotel 4 stelle" data-lang-pt="-Hotel 4 estrelas"
                data-lang-ar="-فندق 4 نجوم">-Hotel 4 star</small><br>
              <small data-lang-en="-Tour Guide" data-lang-es="-Guía turístico" data-lang-fr="-Guide touristique"
                data-lang-de="-Reiseleiter" data-lang-zh="-导游" data-lang-jp="-ツアーガイド" data-lang-ru="-Экскурсовод"
                data-lang-it="-Guida turistica" data-lang-pt="-Guia turístico" data-lang-ar="-مرشد سياحي">-Tour
                Guide</small><br>
              <small data-lang-en="-Transport" data-lang-es="-Transporte" data-lang-fr="-Transport"
                data-lang-de="-Transport" data-lang-zh="-交通" data-lang-jp="-輸送" data-lang-ru="-Транспорт"
                data-lang-it="-Trasporto" data-lang-pt="-Transporte" data-lang-ar="-نقل">-Transport</small><br>
              <small data-lang-en="-Destinations" data-lang-es="-Destinos" data-lang-fr="-Destinations"
                data-lang-de="-Ziele" data-lang-zh="-目的地" data-lang-jp="-目的地" data-lang-ru="-Направления"
                data-lang-it="-Destinazioni" data-lang-pt="-Destinos" data-lang-ar="-وجهات">-Destinations</small><br>
              <small data-lang-en="-Breakfast" data-lang-es="-Desayuno" data-lang-fr="-Petit-déjeuner"
                data-lang-de="-Frühstück" data-lang-zh="-早餐" data-lang-jp="-朝食" data-lang-ru="-Завтрак"
                data-lang-it="-Colazione" data-lang-pt="-Café da manhã" data-lang-ar="-الإفطار">-Breakfast</small>
            </p>
            <samp>₱8,899.00</samp>
          </div>
          <div class="button7">
            <p class="star"></p>
            <a class="a1" href="#" data-lang-en="Book Now!!" data-lang-es="¡Reserva Ahora!!"
              data-lang-fr="Réservez Maintenant!!" data-lang-de="Jetzt Buchen!!" data-lang-zh="立即预订！！"
              data-lang-jp="今すぐ予約！！" data-lang-ru="Забронируйте Сейчас!!" data-lang-it="Prenota Ora!!"
              data-lang-pt="Reserve Agora!!" data-lang-ar="احجز الآن!!">Book Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../img/gg.png" alt="Platinum Package">
          </picture>
          <div class="detail">
            <p>
              <b data-lang-en="Bronze Package" data-lang-es="Paquete Bronce" data-lang-fr="Forfait Bronze"
                data-lang-de="Bronze Paket" data-lang-zh="铜套餐" data-lang-jp="ブロンズパッケージ" data-lang-ru="Бронзовый пакет"
                data-lang-it="Pacchetto Bronzo" data-lang-pt="Pacote Bronze" data-lang-ar="باقة برونزية">Bronze
                Package</b><br>
              <small data-lang-en="-Hotel 3 star" data-lang-es="-Hotel 3 estrellas" data-lang-fr="-Hôtel 3 étoiles"
                data-lang-de="-3-Sterne-Hotel" data-lang-zh="-3星级酒店" data-lang-jp="-3つ星ホテル"
                data-lang-ru="-Отель 3 звезды" data-lang-it="-Hotel 3 stelle" data-lang-pt="-Hotel 3 estrelas"
                data-lang-ar="-فندق 3 نجوم">-Hotel 3 star</small><br>
              <small data-lang-en="-Tour Guide" data-lang-es="-Guía turístico" data-lang-fr="-Guide touristique"
                data-lang-de="-Reiseleiter" data-lang-zh="-导游" data-lang-jp="-ツアーガイド" data-lang-ru="-Экскурсовод"
                data-lang-it="-Guida turistica" data-lang-pt="-Guia turístico" data-lang-ar="-مرشد سياحي">-Tour
                Guide</small><br>
              <small data-lang-en="-Transport" data-lang-es="-Transporte" data-lang-fr="-Transport"
                data-lang-de="-Transport" data-lang-zh="-交通" data-lang-jp="-輸送" data-lang-ru="-Транспорт"
                data-lang-it="-Trasporto" data-lang-pt="-Transporte" data-lang-ar="-نقل">-Transport</small><br>
              <small data-lang-en="-Destinations" data-lang-es="-Destinos" data-lang-fr="-Destinations"
                data-lang-de="-Ziele" data-lang-zh="-目的地" data-lang-jp="-目的地" data-lang-ru="-Направления"
                data-lang-it="-Destinazioni" data-lang-pt="-Destinos" data-lang-ar="-وجهات">-Destinations</small><br>
              <small data-lang-en="-Breakfast" data-lang-es="-Desayuno" data-lang-fr="-Petit-déjeuner"
                data-lang-de="-Frühstück" data-lang-zh="-早餐" data-lang-jp="-朝食" data-lang-ru="-Завтрак"
                data-lang-it="-Colazione" data-lang-pt="-Café da manhã" data-lang-ar="-الإفطار">-Breakfast</small>
            </p>
            <samp>₱6,999.00</samp>
          </div>
          <div class="button7">
            <p class="star"></p>
            <a class="a1" href="#" data-lang-en="Book Now!!" data-lang-es="¡Reserva Ahora!!"
              data-lang-fr="Réservez Maintenant!!" data-lang-de="Jetzt Buchen!!" data-lang-zh="立即预订！！"
              data-lang-jp="今すぐ予約！！" data-lang-ru="Забронируйте Сейчас!!" data-lang-it="Prenota Ora!!"
              data-lang-pt="Reserve Agora!!" data-lang-ar="احجز الآن!!">Book Now!!</a>
          </div>
        </div>
      </section>

    </main>



    <main>

<header>
  <h1><i class="bx bx-home icon" style="color: red;"></i>Top Hottest Accomodations</h1>
  <p>
    <span class="span4">&#139;</span>
    <span class="span4">&#155;</span>
  </p>
</header>

<p class="p2">Discover the Paradise: Explore the Philippines with us!!</p>
<section class="section6">
  <div class="product">
    <picture>
      <img src="../places/boracay/shangrila.jpg">
    </picture>
    <div class="detail">
      <p>
        <b class="sh1"> <i class="bx bx-home-smile icon" style="color: blue;"></i><a href="../include/boracayhotel.php" style=" text-decoration: none;">Shangri-La Hotels and Resorts</a></b><br>

        <i class="bx bx-map icon" style="color: blue;"></i>
        <small>Barangay Yapak, Boracay Island, Malay, Aklan 5608</small>
      </p>

    </div>
    <div class="button7">


    </div>
  </div>
  <div class="product">
    <picture>
      <img src="../places/boracay/mandala.jpg">
    </picture>
    <div class="detail">
      <p>
      
        <b class="sh1"> <i class="bx bx-home-smile icon" style="color: blue;"></i><a href="../include/boracayhotel.php" style=" text-decoration: none;">Mandala Spa and Resort Villas</a></b><br>
        <i class="bx bx-map icon" style="color: blue ;"></i>
        <small> Station 3, Barangay Manoc-Manoc, Boracay Island</small>
      </p>

    </div>
    <div class="button7">


    </div>
  </div>
  <div class="product">
    <picture>
      <img src="../places/boracay/fairways.jpg">
    </picture>
    <div class="detail">
      <p>
      
        <b class="sh1"> <i class="bx bx-home-smile icon" style="color: blue;"></i><a href="../include/boracayhotel.php" style=" text-decoration: none;">Fairways & Bluewater Boracay</a></b><br>
        <i class="bx bx-map icon" style="color: blue;"></i>
        <small>Station 1, Balabag and Yapak, Balabag, 5608 Boracay</small>
      </p>

    </div>
    <div class="button7">


    </div>
  </div>
  <div class="product">
    <picture>
      <img src="../places/boracay/henann.jpg">
    </picture>
    <div class="detail">
      <p>
        
        <b class="sh1"> <i class="bx bx-home-smile icon" style="color: blue;"></i><a href="../include/boracayhotel.php" style=" text-decoration: none;">Henann Crystal Sands Resort</a></b><br>
        <i class="bx bx-map icon" style="color: blue;"></i>
        <small>Station 1 (In between boat station 1 and D'mall) Boracay Island.</small>
      </p>

    </div>
    <div class="button7">


    </div>
  </div>
  <div class="product">
    <picture>
      <img src="../places/boracay/astoria.jpg">
    </picture>
    <div class="detail">
      <p>
        <b class="sh1">Astoria Current</b><br>

        <i class="bx bx-map icon" style="color: blue;"></i>
        <small>Sitio Mangayad, Brgy. Manoc Manoc, Station 3, Malay</small>
      </p>

    </div>
    <div class="button7">


    </div>
  </div>
  <div class="product">
    <picture>
      <img src="../places/boracay/mandarin.jpg">
    </picture>
    <div class="detail">
      <p>
        <b class="sh1">Mandarin Bay Resort & Spa</b><br>

        <i class="bx bx-map icon" style="color: blue;"></i>
        <small>Beachfront, Station 2, Boracay, Malay</small>
      </p>

    </div>
    <div class="button7">


    </div>
  </div>
  <div class="product">
    <picture>
      <img src="../places/boracay/movenpick.jpg">
    </picture>
    <div class="detail">
      <p>
        <b class="sh1">Mövenpick Resort & Spa Boracay</b><br>

        <i class="bx bx-map icon" style="color: blue;"></i>
        <small>Punta Bunga Cove, Barangay Yapak, Boracay Island, Malay</small>
      </p>

    </div>
    <div class="button7">


    </div>
  </div>
  <div class="product">
    <picture>
      <img src="../places/boracay/hue.jpg">
    </picture>
    <div class="detail">
      <p>
        <b class="sh1">Hue Hotels and Resorts Boracay</b><br>

        <i class="bx bx-map icon" style="color: blue;"></i>
        <small>Station 2, Hue Hotels and Resorts Boracay </small>
      </p>

    </div>
    <div class="button7">


    </div>
  </div>
  <div class="product">
    <picture>
      <img src="../places/boracay/belmont.jpg">
    </picture>
    <div class="detail">
      <p>
        <b class="sh1">Belmont Hotel Boracay</b><br>

        <i class="bx bx-map icon" style="color: blue;"></i>
        <small>Newcoast Drive, Boracay Newcoast, Barangay Yapak, Boracay Island, Malay</small>
      </p>

    </div>
    <div class="button7">

    </div>
  </div>
  <div class="product">
    <picture>
      <img src="../places/boracay/lind1.jpg">
    </picture>
    <div class="detail">
      <p>
        <b class="sh1">The Lind Boracay</b><br>

        <i class="bx bx-map icon" style="color: blue;"></i>
        <small>Station 1, Malay</small>
      </p>

    </div>
    <div class="button7">


    </div>
  </div>
  <div class="product">
    <picture>
      <img src="../places/boracay/savoy.jpg">
    </picture>
    <div class="detail">
      <p>
        <b>Savoy Hotel Boracay Newcoast</b><br>

        <i class="bx bx-map icon" style="color: blue;"></i>
        <small>Newcoast Drive Malay</small>
      </p>

    </div>
    <div class="button7">


    </div>
  </div>
  <div class="product">
    <picture>
      <img src="../places/boracay/lacarmela.png">
    </picture>
    <div class="detail">
      <p>
        <b class="sh1"> La Carmela de Boracay Resort Hotel</b><br>

        <i class="bx bx-map icon" style="color: blue;"></i>
        <small>Station 2, Balabag, Boracay Island, Malay</small>
      </p>

    </div>
    <div class="button7">

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
        <h1 data-lang-en="Top Hottest Restaurants" data-lang-es="Los Restaurantes Más Populares"
          data-lang-fr="Les Restaurants les Plus Populaires" data-lang-de="Die Beliebtesten Restaurants"
          data-lang-zh="最热门的餐厅" data-lang-jp="最も人気のあるレストラン" data-lang-ru="Самые Популярные Рестораны"
          data-lang-it="I Ristoranti Più Popolari" data-lang-pt="Os Restaurantes Mais Populares"
          data-lang-ar="أشهر المطاعم"><i class="bx bx-home icon" style="color: red;"></i>Top Hottest Restaurants</h1>

        <p>
          <span class="span3">&#139;</span>
          <span class="span3">&#155;</span>
        </p>
      </header>
      <p class="p2">Discover the Paradise: Explore the Philippines with us!!</p>
      <section class="section6">
        <!-- Nalka Seafood Restaurant -->
        <div class="product">
          <picture>
            <img src="../places/boracay/nalka1.png" alt="Nalka Seafood Restaurant">
          </picture>
          <div class="detail">
            <p>
              <b class="sh1" data-lang-en="Nalka Seafood Restaurant" data-lang-es="Restaurante de Mariscos Nalka"
                data-lang-fr="Restaurant de Fruits de Mer Nalka" data-lang-de="Nalka Fischrestaurant"
                data-lang-zh="纳尔卡海鲜餐厅" data-lang-jp="ナルカシーフードレストラン" data-lang-ru="Налка Рыбный Ресторан"
                data-lang-it="Ristorante di Pesce Nalka" data-lang-pt="Restaurante de Mariscos Nalka"
                data-lang-ar="مطعم نالكا للمأكولات البحرية"><a href="../include/boracayresto.php">Nalka Seafood
                  Resturant</a></b><br>

              <i class="bx bx-map icon" style="color: blue;"></i>
              <small data-lang-en="Malay, Aklan" data-lang-es="Malayo, Aklan" data-lang-fr="Malay, Aklan"
                data-lang-de="Malay, Aklan" data-lang-zh="阿克兰，马来" data-lang-jp="アクラン、マレー" data-lang-ru="Малай, Аклан"
                data-lang-it="Malay, Aklan" data-lang-pt="Malay, Aklan" data-lang-ar="مالاي، أكلان">Malay, Aklan</small>
            </p>
          </div>
          <div class="button7">

          </div>
        </div>

        <!-- Café Maruja -->
        <div class="product">
          <picture>
            <img src="../places/boracay/maruha.jpg" alt="Café Maruja">
          </picture>
          <div class="detail">
            <p>
              <b class="sh1" data-lang-en="Café Maruja" data-lang-es="Café Maruja" data-lang-fr="Café Maruja"
                data-lang-de="Café Maruja" data-lang-zh="卡菲马鲁亚" data-lang-jp="カフェマルハ" data-lang-ru="Кафе Маруха"
                data-lang-it="Café Maruja" data-lang-pt="Café Maruja" data-lang-ar="مقهى ماروجا">Café Maruja</b><br>

              <i class="bx bx-map icon" style="color: blue;"></i>
              <small data-lang-en="Station 3 Beachfront, Boracay Island 5608"
                data-lang-es="Frente a la Playa de la Estación 3, Isla de Boracay 5608"
                data-lang-fr="Front de mer de la Station 3, Île de Boracay 5608"
                data-lang-de="Station 3, Strandfront, Boracay 5608" data-lang-zh="车站3海滨，长滩岛5608"
                data-lang-jp="ステーション3ビーチフロント、ボラカイ島5608" data-lang-ru="Станция 3, Борокай 5608"
                data-lang-it="Lungomare della Stazione 3, Isola di Boracay 5608"
                data-lang-pt="Frente à Praia da Estação 3, Ilha de Boracay 5608"
                data-lang-ar="شاطئ ستيشن 3، جزيرة بوراكاي 5608">Station 3 Beachfront, Boracay Island 5608</small>
            </p>
          </div>
          <div class="button7">

          </div>
        </div>

        <!-- Café del Sol -->
        <div class="product">
          <picture>
            <img src="../places/boracay/cafe del sol.jpg" alt="Café del Sol">
          </picture>
          <div class="detail">
            <p>
              <b class="sh1" data-lang-en="Café del Sol" data-lang-es="Café del Sol" data-lang-fr="Café del Sol"
                data-lang-de="Café del Sol" data-lang-zh="太阳咖啡馆" data-lang-jp="カフェデソル" data-lang-ru="Кафе дель Соль"
                data-lang-it="Café del Sol" data-lang-pt="Café del Sol" data-lang-ar="مقهى ديل سول"><a href="../include/boracayresto.php">Cafe Del Sol</a></b><br>


              <i class="bx bx-map icon" style="color: blue;"></i>
              <small data-lang-en="Beachfront D'Mall of Boracay, Station 2, Malay, 5608 Aklan"
                data-lang-es="Frente a la Playa D'Mall de Boracay, Estación 2, Malay, 5608 Aklan"
                data-lang-fr="Front de mer D'Mall de Boracay, Station 2, Malay, 5608 Aklan"
                data-lang-de="Strandfront D'Mall von Boracay, Station 2, Malay, 5608 Aklan"
                data-lang-zh="长滩岛D'Mall海滨，2号站，阿克兰5608，马来" data-lang-jp="ボラカイ島のD'Mallビーチフロント、ステーション2、アクラン5608、マレー"
                data-lang-ru="Д'Молл, станция 2, Малай, 5608 Аклан"
                data-lang-it="Lungomare D'Mall di Boracay, Stazione 2, Malay, 5608 Aklan"
                data-lang-pt="Frente à Praia D'Mall de Boracay, Estação 2, Malay, 5608 Aklan"
                data-lang-ar="دي مول بوراكاي، ستيشن 2، مالاي، أكلان 5608">Beachfront D'Mall of Boracay, Station 2,
                Malay, 5608 Aklan</small>
            </p>
          </div>
          <div class="button7">

          </div>
        </div>

        <!-- Barlo Restaurant -->
        <div class="product">
          <picture>
            <img src="../places/boracay/barlo.jpg" alt="Barlo Restaurant">
          </picture>
          <div class="detail">
            <p>
              <b class="sh1" data-lang-en="Barlo Restaurant" data-lang-es="Restaurante Barlo"
                data-lang-fr="Restaurant Barlo" data-lang-de="Barlo Restaurant" data-lang-zh="巴洛餐厅"
                data-lang-jp="バーロレストラン" data-lang-ru="Ресторан Барло" data-lang-it="Ristorante Barlo"
                data-lang-pt="Restaurante Barlo" data-lang-ar="مطعم بارلو">Barlo Restaurant</b><br>

              <i class="bx bx-map icon" style="color: blue;"></i>
              <small data-lang-en="Station 1, Boracay" data-lang-es="Estación 1, Boracay"
                data-lang-fr="Station 1, Boracay" data-lang-de="Station 1, Boracay" data-lang-zh="长滩岛，站1"
                data-lang-jp="ステーション1、ボラカイ" data-lang-ru="Станция 1, Боракай" data-lang-it="Stazione 1, Boracay"
                data-lang-pt="Estação 1, Boracay" data-lang-ar="ستيشن 1، بوراكاي">Station 1, Boracay</small>
            </p>
          </div>
          <div class="button7">

          </div>
        </div>

        <!-- Los Indios Bravos -->
        <div class="product">
          <picture>
            <img src="../places/boracay/losindios.png" alt="Los Indios Bravos">
          </picture>
          <div class="detail">
            <p>
              <b class="sh1" data-lang-en="Los Indios Bravos" data-lang-es="Los Indios Bravos"
                data-lang-fr="Los Indios Bravos" data-lang-de="Los Indios Bravos" data-lang-zh="洛斯印第安勇士"
                data-lang-jp="ロスインディオスブラボス" data-lang-ru="Лос Индьос Бравос" data-lang-it="Los Indios Bravos"
                data-lang-pt="Los Indios Bravos" data-lang-ar="لوس إنديوس برافوس">Los Indios Bravos</b><br>

              <i class="bx bx-map icon" style="color: blue;"></i>
              <small data-lang-en="704 Sitio Pinaongon White House Beach Resort, Malay, Aklan Province 5608"
                data-lang-es="704 Sitio Pinaongon White House Beach Resort, Malay, Provincia de Aklan 5608"
                data-lang-fr="704 Sitio Pinaongon White House Beach Resort, Malay, Province d'Aklan 5608"
                data-lang-de="704 Sitio Pinaongon White House Beach Resort, Malay, Provinz Aklan 5608"
                data-lang-zh="阿克兰省马来白宫海滩度假村，704号皮瑙恩贡" data-lang-jp="アクラン州マレー、704シティオピナオンゴンホワイトハウスビーチリゾート"
                data-lang-ru="704 Ситио Пинаонгон, Малай, Провинция Аклан 5608"
                data-lang-it="704 Sitio Pinaongon White House Beach Resort, Malay, Provincia di Aklan 5608"
                data-lang-pt="704 Sitio Pinaongon White House Beach Resort, Malay, Província de Aklan 5608"
                data-lang-ar="منتجع شاطئ البيت الأبيض 704، موقع بيناونغون، مالاي، مقاطعة أكلان 5608">704 Sitio Pinaongon
                White House Beach Resort, Malay, Aklan Province 5608</small>
            </p>
          </div>
          <div class="button7">

          </div>
        </div>

        <!-- Vhub Dampa Seafood Grill and Restaurant -->
        <div class="product">
          <picture>
            <img src="../places/boracay/dampa.jpg" alt="Vhub Dampa Seafood Grill and Restaurant">
          </picture>
          <div class="detail">
            <p>
              <b class="sh1" data-lang-en="Vhub Dampa Seafood Grill and Restaurant"
                data-lang-es="Restaurante y Parrilla de Mariscos Vhub Dampa"
                data-lang-fr="Restaurant et Grillade de Fruits de Mer Vhub Dampa"
                data-lang-de="Vhub Dampa Fischgrillrestaurant" data-lang-zh="Vhub丹帕海鲜烧烤餐厅"
                data-lang-jp="Vhubダンパシーフードグリル＆レストラン" data-lang-ru="Ресторан и гриль Vhub Dampa Seafood"
                data-lang-it="Vhub Dampa Ristorante e Grigliata di Pesce"
                data-lang-pt="Restaurante e Churrascaria de Mariscos Vhub Dampa"
                data-lang-ar="مطعم وشواء المأكولات البحرية فيهاب دامبا">Vhub Dampa Seafood Grill and Restaurant</b><br>

              <i class="bx bx-map icon" style="color: blue;"></i>
              <small data-lang-en="Station 3, Front Beach Malay" data-lang-es="Estación 3, Playa Frontal de Malay"
                data-lang-fr="Station 3, Front de Plage Malay" data-lang-de="Station 3, Strandfront Malay"
                data-lang-zh="长滩岛马来前滩3号站" data-lang-jp="マレーフロントビーチ、ステーション3" data-lang-ru="Станция 3, Малай, Пляж"
                data-lang-it="Stazione 3, Spiaggia Frontale Malay" data-lang-pt="Estação 3, Praia da Frente Malay"
                data-lang-ar="ستيشن 3، الشاطئ الأمامي مالاي">Station 3, Front Beach Malay</small>
            </p>
          </div>
          <div class="button7">

          </div>
        </div>

        <!-- Meze Wrap -->
        <div class="product">
          <picture>
            <img src="../places/boracay/meze.png" alt="Meze Wrap">
          </picture>
          <div class="detail">
            <p>
              <b class="sh1" data-lang-en="Meze Wrap" data-lang-es="Meze Wrap" data-lang-fr="Meze Wrap"
                data-lang-de="Meze Wrap" data-lang-zh="梅兹卷" data-lang-jp="メゼラップ" data-lang-ru="Мезе Ролл"
                data-lang-it="Meze Wrap" data-lang-pt="Meze Wrap" data-lang-ar="ميز راب">Meze Wrap</b><br>

              <i class="bx bx-map icon" style="color: blue;"></i>
              <small data-lang-en="Main Road, Barangay Balabag (near BPI D'mall)"
                data-lang-es="Carretera Principal, Barangay Balabag (cerca de BPI D'mall)"
                data-lang-fr="Route Principale, Barangay Balabag (près de BPI D'mall)"
                data-lang-de="Hauptstraße, Barangay Balabag (in der Nähe von BPI D'mall)"
                data-lang-zh="巴拉巴格村主路（近BPI D'mall）" data-lang-jp="バランガイ・バラバグのメインロード（BPI D'mallの近く）"
                data-lang-ru="Главная дорога, Барангай Балабаг (рядом с BPI D'mall)"
                data-lang-it="Strada Principale, Barangay Balabag (vicino a BPI D'mall)"
                data-lang-pt="Estrada Principal, Barangay Balabag (perto de BPI D'mall)"
                data-lang-ar="الطريق الرئيسي، بارانغاي بالاباغ (بالقرب من بي بي آي دي مول)">Main Road, Barangay Balabag
                (near BPI D'mall)</small>
            </p>
          </div>
          <div class="button7">

          </div>
        </div>

        <!-- SpiceBird -->
        <div class="product">
          <picture>
            <img src="../places/boracay/spice.jpg" alt="SpiceBird">
          </picture>
          <div class="detail">
            <p>
              <b class="sh1" data-lang-en="SpiceBird" data-lang-es="SpiceBird" data-lang-fr="SpiceBird"
                data-lang-de="SpiceBird" data-lang-zh="香料鸟" data-lang-jp="スパイスバード" data-lang-ru="Спайс Бёрд"
                data-lang-it="SpiceBird" data-lang-pt="SpiceBird" data-lang-ar="سبايس بيرد">SpiceBird</b><br>

              <i class="bx bx-map icon" style="color: blue;"></i>
              <small data-lang-en="D'Mall Boracay, Station 2" data-lang-es="D'Mall Boracay, Estación 2"
                data-lang-fr="D'Mall Boracay, Station 2" data-lang-de="D'Mall Boracay, Station 2"
                data-lang-zh="长滩岛D'mall，2号站" data-lang-jp="ボラカイ島のD'mall、ステーション2"
                data-lang-ru="Д'Молл, Станция 2, Боракай" data-lang-it="D'Mall Boracay, Stazione 2"
                data-lang-pt="D'Mall Boracay, Estação 2" data-lang-ar="دي مول بوراكاي، ستيشن 2">D'Mall Boracay, Station
                2</small>
            </p>
          </div>
          <div class="button7">

          </div>
        </div>

        <!-- The Sunny Side Cafe -->
        <div class="product">
          <picture>
            <img src="../places/boracay/sunny.jpg" alt="The Sunny Side Cafe">
          </picture>
          <div class="detail">
            <p>
              <b class="sh1" data-lang-en="The Sunny Side Cafe" data-lang-es="El Café Lado Soleado"
                data-lang-fr="Le Café du Côté Ensoleillé" data-lang-de="Das Sonnige Café" data-lang-zh="阳光咖啡馆"
                data-lang-jp="サニーサイドカフェ" data-lang-ru="Солнечное Кафе" data-lang-it="The Sunny Side Cafe"
                data-lang-pt="O Café do Lado Ensolarado" data-lang-ar="مقهى الجانب المشمس">The Sunny Side Cafe</b><br>

              <i class="bx bx-map icon" style="color: blue;"></i>
              <small data-lang-en="Station 3 Beachfront" data-lang-es="Frente a la Playa de la Estación 3"
                data-lang-fr="Front de mer de la Station 3" data-lang-de="Strandfront Station 3" data-lang-zh="长滩岛3号站海滨"
                data-lang-jp="ボラカイ島、ステーション3ビーチフロント" data-lang-ru="Станция 3, Пляж, Боракай"
                data-lang-it="Stazione 3, Lungomare" data-lang-pt="Frente à Praia da Estação 3"
                data-lang-ar="شاطئ ستيشن 3">Station 3 Beachfront</small>
            </p>
          </div>
          <div class="button7">

          </div>
        </div>

        <!-- Blackfish Coffee Bar -->
        <div class="product">
          <picture>
            <img src="../places/boracay/blackfish.jpg" alt="Blackfish Coffee Bar">
          </picture>
          <div class="detail">
            <p>
              <b class="sh1" data-lang-en="Blackfish Coffee Bar" data-lang-es="Bar de Café Blackfish"
                data-lang-fr="Bar à Café Blackfish" data-lang-de="Blackfish Kaffee-Bar" data-lang-zh="黑鱼咖啡吧"
                data-lang-jp="ブラックフィッシュコーヒーバー" data-lang-ru="Кофейня Blackfish" data-lang-it="Blackfish Coffee Bar"
                data-lang-pt="Bar de Café Blackfish" data-lang-ar="مقهى بلاكفيش">Blackfish Coffee Bar</b><br>

              <i class="bx bx-map icon" style="color: blue;"></i>
              <small data-lang-en="Brgy. Balabag, Station 1" data-lang-es="Brgy. Balabag, Estación 1"
                data-lang-fr="Brgy. Balabag, Station 1" data-lang-de="Brgy. Balabag, Station 1"
                data-lang-zh="Balabag村，长滩岛1号站" data-lang-jp="バランガイ・バラバグ、ステーション1"
                data-lang-ru="Барангай Балабаг, Станция 1" data-lang-it="Brgy. Balabag, Stazione 1"
                data-lang-pt="Brgy. Balabag, Estação 1" data-lang-ar="بارانغاي بالاباغ، ستيشن 1">Brgy. Balabag, Station
                1</small>
            </p>
          </div>
          <div class="button7">

          </div>
        </div>

        <!-- Little Taj Boracay -->
        <div class="product">
          <picture>
            <img src="../places/boracay/littletaj.jpeg" alt="Little Taj Boracay">
          </picture>
          <div class="detail">
            <p>
              <b class="sh1" data-lang-en="Little Taj Boracay" data-lang-es="Pequeño Taj Boracay"
                data-lang-fr="Petit Taj Boracay" data-lang-de="Kleiner Taj Boracay" data-lang-zh="小泰姬长滩岛"
                data-lang-jp="リトルタージ・ボラカイ" data-lang-ru="Маленький Тадж Боракай" data-lang-it="Little Taj Boracay"
                data-lang-pt="Pequeno Taj Boracay" data-lang-ar="ليتل تاج بوراكاي">Little Taj Boracay</b><br>

              <i class="bx bx-map icon" style="color: blue;"></i>
              <small data-lang-en="Dmall Boracay, Station 2 (next to Epic)"
                data-lang-es="Dmall Boracay, Estación 2 (junto a Epic)"
                data-lang-fr="Dmall Boracay, Station 2 (à côté d'Epic)"
                data-lang-de="Dmall Boracay, Station 2 (neben Epic)" data-lang-zh="长滩岛Dmall，2号站（Epic旁）"
                data-lang-jp="ボラカイ島のDmall、ステーション2（Epicの隣）" data-lang-ru="Д'Молл Боракай, Станция 2 (рядом с Epic)"
                data-lang-it="Dmall Boracay, Stazione 2 (accanto a Epic)"
                data-lang-pt="Dmall Boracay, Estação 2 (ao lado de Epic)"
                data-lang-ar="دي مول بوراكاي، ستيشن 2 (بجوار Epic)">Dmall Boracay, Station 2 (next to Epic)</small>
            </p>
          </div>
          <div class="button7">

          </div>
        </div>

        <!-- Congas Restaurant -->
        <div class="product">
          <picture>
            <img src="../places/boracay/congas.jpg" alt="Congas Restaurant">
          </picture>
          <div class="detail">
            <p>
              <b class="sh1" data-lang-en="Congas Restaurant" data-lang-es="Restaurante Congas"
                data-lang-fr="Restaurant Congas" data-lang-de="Congas Restaurant" data-lang-zh="Congas餐厅"
                data-lang-jp="コンガスレストラン" data-lang-ru="Ресторан Congas" data-lang-it="Ristorante Congas"
                data-lang-pt="Restaurante Congas" data-lang-ar="مطعم كونغاس">Congas Restaurant</b><br>

              <i class="bx bx-map icon" style="color: blue;"></i>
              <small data-lang-en="Bolabog & Angol, Malay, Philippines" data-lang-es="Bolabog y Angol, Malay, Filipinas"
                data-lang-fr="Bolabog et Angol, Malay, Philippines" data-lang-de="Bolabog & Angol, Malay, Philippinen"
                data-lang-zh="菲律宾长滩岛Bolabog和Angol" data-lang-jp="ボラカイ島ボラボグとアンゴール、フィリピン"
                data-lang-ru="Болабог и Ангол, Малай, Филиппины" data-lang-it="Bolabog & Angol, Malay, Filippine"
                data-lang-pt="Bolabog e Angol, Malay, Filipinas" data-lang-ar="بولابوغ وأنغول، مالاي، الفلبين">Bolabog &
                Angol, Malay, Philippines</small>
            </p>
          </div>
          <div class="button7">

          </div>
        </div>
      </section>


    </main>




    <main>
      <header>
        <h1 data-lang-en="Boracay Water Activities" data-lang-es="Paquete de Tour en Boracay"
          data-lang-fr="Forfait Tour à Boracay" data-lang-de="Boracay Tour-Paket" data-lang-zh="博拉acay旅游套餐"
          data-lang-jp="ボラカイツアーパッケージ" data-lang-ru="Турпакет на Борокай" data-lang-it="Pacchetto Tour di Boracay"
          data-lang-pt="Pacote de Tour em Boracay" data-lang-ar="حزمة جولة بوراكاي"><i class="bx bx-run icon"
            style="color: red;"></i>Boracay Water Activities</h1>
        <p>
          <span class="span2">&#139;</span>
          <span class="span2">&#155;</span>
        </p>
      </header>
      <p class="p2">Discover the Paradise: Explore the Philippines with us!!</p>
      <section class="section6">
        <div class="product">
          <picture>
          <img src="../img/a1.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Catamaran sailing" 
       data-lang-es="Navegación en Catamarán" 
       data-lang-fr="Navigation en Catamaran" 
       data-lang-de="Katamaran Segeln" 
       data-lang-zh="双体船航行" 
       data-lang-jp="カタマランセーリング" 
       data-lang-ru="Плавание на катамаране" 
       data-lang-it="Vela in Catamarano" 
       data-lang-pt="Navegação de Catamarã" 
       data-lang-ar="الإبحار في الكاتاماران">Catamaran sailing
</b><br>

<i class="bx bx-map icon" style="color: red;"></i>
                <small data-lang-en="Shangrila Hotel, Boracay" 
       data-lang-es="Hotel Shangrila, Boracay" 
       data-lang-fr="Hôtel Shangrila, Boracay" 
       data-lang-de="Shangrila Hotel, Boracay" 
       data-lang-zh="香格里拉酒店，博拉凯" 
       data-lang-jp="シャングリラホテル、ボラカイ" 
       data-lang-ru="Отель Шангрила, Боракай" 
       data-lang-it="Hotel Shangrila, Boracay" 
       data-lang-pt="Hotel Shangrila, Boracay" 
       data-lang-ar="فندق شانغريلا، بوراكاي">Shangrila Hotel, Boracay
</small>
            </p>

          </div>
          <div class="button7">
          

          </div>
        </div>
        <div class="product">
          <picture>
          <img src="../img/a2.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Banana and fly-fish rides" 
       data-lang-es="Paseos en Banana y Fly-Fish" 
       data-lang-fr="Balades en Banana et Fly-Fish" 
       data-lang-de="Bananen- und Fly-Fish-Fahrten" 
       data-lang-zh="香蕉船和飞鱼项目" 
       data-lang-jp="バナナボートとフライフィッシュライド" 
       data-lang-ru="Прокат на банане и флайфиш" 
       data-lang-it="Giri in Banana e Fly-Fish" 
       data-lang-pt="Passeios de Banana e Fly-Fish" 
       data-lang-ar="ركوب الموز وركوب الطائر">Banana and fly-fish rides
</b><br>


<i class="bx bx-map icon" style="color: red;"></i>
                <small data-lang-en="Shangrila Hotel, Boracay" 
       data-lang-es="Hotel Shangrila, Boracay" 
       data-lang-fr="Hôtel Shangrila, Boracay" 
       data-lang-de="Shangrila Hotel, Boracay" 
       data-lang-zh="香格里拉酒店，博拉凯" 
       data-lang-jp="シャングリラホテル、ボラカイ" 
       data-lang-ru="Отель Шангрила, Боракай" 
       data-lang-it="Hotel Shangrila, Boracay" 
       data-lang-pt="Hotel Shangrila, Boracay" 
       data-lang-ar="فندق شانغريلا، بوراكاي">Shangrila Hotel, Boracay
</small>
            </p>

          </div>
          <div class="button7">
           

          </div>
        </div>
        <div class="product">
          <picture>
          <img src="../img/a3.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Jet skiing" 
       data-lang-es="Paseo en Motonieve" 
       data-lang-fr="Jet Ski" 
       data-lang-de="Jetski fahren" 
       data-lang-zh="摩托艇" 
       data-lang-jp="ジェットスキー" 
       data-lang-ru="Джет-ски" 
       data-lang-it="Moto d'acqua" 
       data-lang-pt="Jet ski" 
       data-lang-ar="التزلج على الجيت سكي">Jet skiing
</b><br>


<i class="bx bx-map icon" style="color: red;"></i>
                <small data-lang-en="Shangrila Hotel, Boracay" 
       data-lang-es="Hotel Shangrila, Boracay" 
       data-lang-fr="Hôtel Shangrila, Boracay" 
       data-lang-de="Shangrila Hotel, Boracay" 
       data-lang-zh="香格里拉酒店，博拉凯" 
       data-lang-jp="シャングリラホテル、ボラカイ" 
       data-lang-ru="Отель Шангрила, Боракай" 
       data-lang-it="Hotel Shangrila, Boracay" 
       data-lang-pt="Hotel Shangrila, Boracay" 
       data-lang-ar="فندق شانغريلا، بوراكاي">Shangrila Hotel, Boracay
</small>
            </p>

          </div>
          <div class="button7">
           

          </div>
        </div>
        <div class="product">
          <picture>
          <img src="../img/a4.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Kayaking" 
       data-lang-es="Kayak" 
       data-lang-fr="Kayak" 
       data-lang-de="Kajakfahren" 
       data-lang-zh="皮划艇" 
       data-lang-jp="カヤック" 
       data-lang-ru="Каякинг" 
       data-lang-it="Kayak" 
       data-lang-pt="Canoagem" 
       data-lang-ar="التجديف بالكاياك">Kayaking
</b><br>

<i class="bx bx-map icon" style="color: red;"></i>
                <small data-lang-en="Shangrila Hotel, Boracay" 
       data-lang-es="Hotel Shangrila, Boracay" 
       data-lang-fr="Hôtel Shangrila, Boracay" 
       data-lang-de="Shangrila Hotel, Boracay" 
       data-lang-zh="香格里拉酒店，博拉凯" 
       data-lang-jp="シャングリラホテル、ボラカイ" 
       data-lang-ru="Отель Шангрила, Боракай" 
       data-lang-it="Hotel Shangrila, Boracay" 
       data-lang-pt="Hotel Shangrila, Boracay" 
       data-lang-ar="فندق شانغريلا، بوراكاي">Shangrila Hotel, Boracay
</small>
            </p>

          </div>
          <div class="button7">
           

          </div>
        </div>
       
        <div class="product">
          <picture>
          <img src="../img/a1.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Catamaran sailing" 
       data-lang-es="Navegación en Catamarán" 
       data-lang-fr="Navigation en Catamaran" 
       data-lang-de="Katamaran Segeln" 
       data-lang-zh="双体船航行" 
       data-lang-jp="カタマランセーリング" 
       data-lang-ru="Плавание на катамаране" 
       data-lang-it="Vela in Catamarano" 
       data-lang-pt="Navegação de Catamarã" 
       data-lang-ar="الإبحار في الكاتاماران">Catamaran sailing
</b><br>

<i class="bx bx-map icon" style="color: red;"></i>
                <small data-lang-en="Shangrila Hotel, Boracay" 
       data-lang-es="Hotel Shangrila, Boracay" 
       data-lang-fr="Hôtel Shangrila, Boracay" 
       data-lang-de="Shangrila Hotel, Boracay" 
       data-lang-zh="香格里拉酒店，博拉凯" 
       data-lang-jp="シャングリラホテル、ボラカイ" 
       data-lang-ru="Отель Шангрила, Боракай" 
       data-lang-it="Hotel Shangrila, Boracay" 
       data-lang-pt="Hotel Shangrila, Boracay" 
       data-lang-ar="فندق شانغريلا، بوراكاي">Shangrila Hotel, Boracay
</small>
            </p>

          </div>
          <div class="button7">
          

          </div>
        </div>
        <div class="product">
          <picture>
          <img src="../img/a2.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Banana and fly-fish rides" 
       data-lang-es="Paseos en Banana y Fly-Fish" 
       data-lang-fr="Balades en Banana et Fly-Fish" 
       data-lang-de="Bananen- und Fly-Fish-Fahrten" 
       data-lang-zh="香蕉船和飞鱼项目" 
       data-lang-jp="バナナボートとフライフィッシュライド" 
       data-lang-ru="Прокат на банане и флайфиш" 
       data-lang-it="Giri in Banana e Fly-Fish" 
       data-lang-pt="Passeios de Banana e Fly-Fish" 
       data-lang-ar="ركوب الموز وركوب الطائر">Banana and fly-fish rides
</b><br>


<i class="bx bx-map icon" style="color: red;"></i>
                <small data-lang-en="Shangrila Hotel, Boracay" 
       data-lang-es="Hotel Shangrila, Boracay" 
       data-lang-fr="Hôtel Shangrila, Boracay" 
       data-lang-de="Shangrila Hotel, Boracay" 
       data-lang-zh="香格里拉酒店，博拉凯" 
       data-lang-jp="シャングリラホテル、ボラカイ" 
       data-lang-ru="Отель Шангрила, Боракай" 
       data-lang-it="Hotel Shangrila, Boracay" 
       data-lang-pt="Hotel Shangrila, Boracay" 
       data-lang-ar="فندق شانغريلا، بوراكاي">Shangrila Hotel, Boracay
</small>
            </p>

          </div>
          <div class="button7">
           

          </div>
        </div>
        <div class="product">
          <picture>
          <img src="../img/a3.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Jet skiing" 
       data-lang-es="Paseo en Motonieve" 
       data-lang-fr="Jet Ski" 
       data-lang-de="Jetski fahren" 
       data-lang-zh="摩托艇" 
       data-lang-jp="ジェットスキー" 
       data-lang-ru="Джет-ски" 
       data-lang-it="Moto d'acqua" 
       data-lang-pt="Jet ski" 
       data-lang-ar="التزلج على الجيت سكي">Jet skiing
</b><br>


<i class="bx bx-map icon" style="color: red;"></i>
                <small data-lang-en="Shangrila Hotel, Boracay" 
       data-lang-es="Hotel Shangrila, Boracay" 
       data-lang-fr="Hôtel Shangrila, Boracay" 
       data-lang-de="Shangrila Hotel, Boracay" 
       data-lang-zh="香格里拉酒店，博拉凯" 
       data-lang-jp="シャングリラホテル、ボラカイ" 
       data-lang-ru="Отель Шангрила, Боракай" 
       data-lang-it="Hotel Shangrila, Boracay" 
       data-lang-pt="Hotel Shangrila, Boracay" 
       data-lang-ar="فندق شانغريلا، بوراكاي">Shangrila Hotel, Boracay
</small>
            </p>

          </div>
          <div class="button7">
           

          </div>
        </div>
        <div class="product">
          <picture>
          <img src="../img/a4.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Kayaking" 
       data-lang-es="Kayak" 
       data-lang-fr="Kayak" 
       data-lang-de="Kajakfahren" 
       data-lang-zh="皮划艇" 
       data-lang-jp="カヤック" 
       data-lang-ru="Каякинг" 
       data-lang-it="Kayak" 
       data-lang-pt="Canoagem" 
       data-lang-ar="التجديف بالكاياك">Kayaking
</b><br>

<i class="bx bx-map icon" style="color: red;"></i>
                <small data-lang-en="Shangrila Hotel, Boracay" 
       data-lang-es="Hotel Shangrila, Boracay" 
       data-lang-fr="Hôtel Shangrila, Boracay" 
       data-lang-de="Shangrila Hotel, Boracay" 
       data-lang-zh="香格里拉酒店，博拉凯" 
       data-lang-jp="シャングリラホテル、ボラカイ" 
       data-lang-ru="Отель Шангрила, Боракай" 
       data-lang-it="Hotel Shangrila, Boracay" 
       data-lang-pt="Hotel Shangrila, Boracay" 
       data-lang-ar="فندق شانغريلا، بوراكاي">Shangrila Hotel, Boracay
</small>
            </p>

          </div>
          <div class="button7">
           

          </div>
        </div>

        <div class="product">
          <picture>
          <img src="../img/a1.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Catamaran sailing" 
       data-lang-es="Navegación en Catamarán" 
       data-lang-fr="Navigation en Catamaran" 
       data-lang-de="Katamaran Segeln" 
       data-lang-zh="双体船航行" 
       data-lang-jp="カタマランセーリング" 
       data-lang-ru="Плавание на катамаране" 
       data-lang-it="Vela in Catamarano" 
       data-lang-pt="Navegação de Catamarã" 
       data-lang-ar="الإبحار في الكاتاماران">Catamaran sailing
</b><br>

<i class="bx bx-map icon" style="color: red;"></i>
                <small data-lang-en="Shangrila Hotel, Boracay" 
       data-lang-es="Hotel Shangrila, Boracay" 
       data-lang-fr="Hôtel Shangrila, Boracay" 
       data-lang-de="Shangrila Hotel, Boracay" 
       data-lang-zh="香格里拉酒店，博拉凯" 
       data-lang-jp="シャングリラホテル、ボラカイ" 
       data-lang-ru="Отель Шангрила, Боракай" 
       data-lang-it="Hotel Shangrila, Boracay" 
       data-lang-pt="Hotel Shangrila, Boracay" 
       data-lang-ar="فندق شانغريلا، بوراكاي">Shangrila Hotel, Boracay
</small>
            </p>

          </div>
          <div class="button7">
          

          </div>
        </div>
        <div class="product">
          <picture>
          <img src="../img/a2.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Banana and fly-fish rides" 
       data-lang-es="Paseos en Banana y Fly-Fish" 
       data-lang-fr="Balades en Banana et Fly-Fish" 
       data-lang-de="Bananen- und Fly-Fish-Fahrten" 
       data-lang-zh="香蕉船和飞鱼项目" 
       data-lang-jp="バナナボートとフライフィッシュライド" 
       data-lang-ru="Прокат на банане и флайфиш" 
       data-lang-it="Giri in Banana e Fly-Fish" 
       data-lang-pt="Passeios de Banana e Fly-Fish" 
       data-lang-ar="ركوب الموز وركوب الطائر">Banana and fly-fish rides
</b><br>


<i class="bx bx-map icon" style="color: red;"></i>
                <small data-lang-en="Shangrila Hotel, Boracay" 
       data-lang-es="Hotel Shangrila, Boracay" 
       data-lang-fr="Hôtel Shangrila, Boracay" 
       data-lang-de="Shangrila Hotel, Boracay" 
       data-lang-zh="香格里拉酒店，博拉凯" 
       data-lang-jp="シャングリラホテル、ボラカイ" 
       data-lang-ru="Отель Шангрила, Боракай" 
       data-lang-it="Hotel Shangrila, Boracay" 
       data-lang-pt="Hotel Shangrila, Boracay" 
       data-lang-ar="فندق شانغريلا، بوراكاي">Shangrila Hotel, Boracay
</small>
            </p>

          </div>
          <div class="button7">
           

          </div>
        </div>
        <div class="product">
          <picture>
          <img src="../img/a3.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Jet skiing" 
       data-lang-es="Paseo en Motonieve" 
       data-lang-fr="Jet Ski" 
       data-lang-de="Jetski fahren" 
       data-lang-zh="摩托艇" 
       data-lang-jp="ジェットスキー" 
       data-lang-ru="Джет-ски" 
       data-lang-it="Moto d'acqua" 
       data-lang-pt="Jet ski" 
       data-lang-ar="التزلج على الجيت سكي">Jet skiing
</b><br>


<i class="bx bx-map icon" style="color: red;"></i>
                <small data-lang-en="Shangrila Hotel, Boracay" 
       data-lang-es="Hotel Shangrila, Boracay" 
       data-lang-fr="Hôtel Shangrila, Boracay" 
       data-lang-de="Shangrila Hotel, Boracay" 
       data-lang-zh="香格里拉酒店，博拉凯" 
       data-lang-jp="シャングリラホテル、ボラカイ" 
       data-lang-ru="Отель Шангрила, Боракай" 
       data-lang-it="Hotel Shangrila, Boracay" 
       data-lang-pt="Hotel Shangrila, Boracay" 
       data-lang-ar="فندق شانغريلا، بوراكاي">Shangrila Hotel, Boracay
</small>
            </p>

          </div>
          <div class="button7">
           

          </div>
        </div>
        <div class="product">
          <picture>
          <img src="../img/a4.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Kayaking" 
       data-lang-es="Kayak" 
       data-lang-fr="Kayak" 
       data-lang-de="Kajakfahren" 
       data-lang-zh="皮划艇" 
       data-lang-jp="カヤック" 
       data-lang-ru="Каякинг" 
       data-lang-it="Kayak" 
       data-lang-pt="Canoagem" 
       data-lang-ar="التجديف بالكاياك">Kayaking
</b><br>

<i class="bx bx-map icon" style="color: red;"></i>
                <small data-lang-en="Shangrila Hotel, Boracay" 
       data-lang-es="Hotel Shangrila, Boracay" 
       data-lang-fr="Hôtel Shangrila, Boracay" 
       data-lang-de="Shangrila Hotel, Boracay" 
       data-lang-zh="香格里拉酒店，博拉凯" 
       data-lang-jp="シャングリラホテル、ボラカイ" 
       data-lang-ru="Отель Шангрила, Боракай" 
       data-lang-it="Hotel Shangrila, Boracay" 
       data-lang-pt="Hotel Shangrila, Boracay" 
       data-lang-ar="فندق شانغريلا، بوراكاي">Shangrila Hotel, Boracay
</small>
            </p>

          </div>
          <div class="button7">
           

          </div>
        </div>
        
      </section>
    </main>





  

    <main>
      <div class="marvs">
        <div class="text">

        </div>
        <header>
          <h1 data-lang-en="Top Hottest Products in Boracay" data-lang-es="Los Productos Más Populares" data-lang-fr="Produits Les Plus Tendance"
            data-lang-de="Die Beliebtesten Produkte" data-lang-zh="最热门的产品" data-lang-jp="最も人気のある製品 "
            data-lang-ru="Самые Популярные Продукты " data-lang-it="I Prodotti Più Popolari"
            data-lang-pt="Os Produtos Mais Populares" data-lang-ar="أكثر المنتجات شهرة "><i class="bx bx-cart icon"   style=" color: red;"></i>Top Hottest Products in Boracay</h1>
          <p>
            <span class="span3">&#139;</span>
            <span class="span3">&#155;</span>

          </p>
        </header>
        <p class="p2">Boracay is renowned for its unique local products, such as handmade jewelry, vibrant beachwear, and artisanal crafts, capturing the essence of this tropical paradise.</p>
        <section class="section6">
          <div class="product">
            <picture>
              <img src="../places/boracay/1_20240923_211810_0000.png" alt="Shell Keychains" class="clickable-image">
            </picture>
            <div class="detail">
              <p>
                <b data-lang-en="Shell Keychains" data-lang-es="Llaveros de Concha" data-lang-fr="Porte-clés Coquillage"
                  data-lang-de="Muschel-Schlüsselanhänger" data-lang-zh="贝壳钥匙链" data-lang-jp="シェルキーホルダー"
                  data-lang-ru="Брелоки с ракушками" data-lang-it="Portachiavi con Conchiglie"
                  data-lang-pt="Chaveiros de Conchas" data-lang-ar="ميداليات الصدف">Shell Keychains (₱500.00)</b><br>

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
              <img src="../places/boracay/2_20240923_211811_0001.png" alt="Beaded Bracelets" class="clickable-image">
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
              <img src="../places/boracay/3_20240923_211811_0002.png" alt="Handwoven Bag" class="clickable-image">
            </picture>
            <div class="detail">
              <p>
                <b data-lang-en="Handwoven Bag" data-lang-es="Bolsa Tejida" data-lang-fr="Sac Tissé"
                  data-lang-de="Handgewebte Tasche" data-lang-zh="手工编织包" data-lang-jp="手織りバッグ"
                  data-lang-ru="Ручная плетеная сумка" data-lang-it="Borsa Intrecciata"
                  data-lang-pt="Bolsa Feita à Mão" data-lang-ar="حقيبة منسوجة">Handwoven Bag (₱500.00)</b><br>


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
              <img src="../places/boracay/4_20240923_211811_0003.png" alt="White Beach Sarong" class="clickable-image">
            </picture>
            <div class="detail">
              <p>
                <b data-lang-en="White Beach Sarong" data-lang-es="Sarong de Playa Blanco" data-lang-fr="Paréo de Plage Blanc"
                  data-lang-de="Weißer Strand-Sarong" data-lang-zh="白色沙滩纱笼" data-lang-jp="ホワイトビーチサロン"
                  data-lang-ru="Белый Пляжный Парео" data-lang-it="Sarong da Spiaggia Bianco"
                  data-lang-pt="Sarong de Praia Branco" data-lang-ar="سارونج شاطئ أبيض">White Beach Sarong (₱300.00)</b><br>


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
              <img src="../places/boracay/5_20240923_211811_0004.png" alt="Bamboo Craft Wooden Figure">
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
        <section class="sec2">
          <h1>Explore Now!!!</h1>
          <p>Discover the Paradise: Explore the Philippines with us!!</p>
          <div class="container2">
            <div class="main-video">
              <div class="Video">
                <video class="secvid" src="../Places/Pampanga/barundon.mp4" controls muted autoplay></video>
                <h3 class="title">Barundon <br><i class="bx bx-map icon" style="color: blue;"></i>Camias, Porac, Pampanga
                </h3>

              </div>

            </div>

            <div class="video-list">
              <div class="vid">
                <video src="../Places/Pampanga/barundon.mp4" muted></video>
                <h3 class="title">Bamboo Park</h3>
              </div>

              <div class="vid">
                <video src="../Places/Pampanga/caposes island.mp4" muted></video>
                <h3 class="title">Summer Place Palakol</h3>
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

        <section class="mapa">

          <div class="maps">
            <h5>Interactive Map</h5>

            <div class="fremas">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d35046.36441104783!2d121.90658652462383!3d11.969282395587411!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a53c2f324b4ee7%3A0xa738e81e5e6dda36!2sBoracay!5e1!3m2!1sen!2sph!4v1726750259691!5m2!1sen!2sph"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

          </div>
          <div class="loc">

            <h6>Here are more bits about Boracay.</h6><br>
            <i class="bx bx-map icon"><span class="sp"></span><span class="text">Location: </span> Boracay is within the
              municipality of Malay, province of Aklan in the Philippines. Mainland Aklan is part of Panay Island.</i>
            <i class="bx bx-flag icon"><span class="sp"></span><span class="text">Languages:</span> Aklanon and Ati are
              the native languages. But locals, especially those working in the tourism industry, can fluently speak and
              understand Tagalog and English.</i>
            <i class="bx bx-time icon"><span class="sp"></span><span class="text">Time Zone:</span> UTC+8 (Philippine
              Standard Time). The Philippines is in the same time zone as Singapore and Beijing, one hour ahead of
              Thailand, and one hour behind Japan.</i>
            <i class="bx bx-money icon"><span class="sp"></span><span class="text">Currency:</span> Philippine peso (PHP,
              ₱). PHP100 is around USD 1.81, EUR 1.66, SGD 2.45 (as of July 2023).</i>
            <i class="bx bx-money icon"><span class="sp"></span><span class="text">Modes of payment:</span> CASH,
              primarily. Some establishments accept credit cards, but most smaller stores and eateries accept only cash or
              GCash.
            </i><br><br>
          </div>
        </section>
  </section>
  </Section>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/105/three.min.js"></script>
  <script src="../js/panolens.min.js"></script>
  <script src="../js/main.js"></script>
  <script src="../js/palawan.js"></script>
  <script src="../js/home.js"></script>
  <script src="../js/darkmode.js"></script>
  <script src="../js/language.js"></script>
  <script src="../js/script.js"></script>
  <script src="../js/boracay.js"></script>
  <script src="../js/index.js"></script>
  <script type="text/javascript" src="../js/fin2.js"></script>
  <script src="../js/app.js"></script>


</body>

</html>