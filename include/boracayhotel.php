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
  <link rel="stylesheet" href="../style/boracayhotel.css" />
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
          data-lang-ar="بوراكاي">Shangrila Hotel</h4>

        <p data-lang-en="It's more fun in Boracay Philippines!!"
          data-lang-es="¡Es más divertido en Boracay, Filipinas!!"
          data-lang-fr="C'est plus amusant à Boracay, Philippines !!"
          data-lang-de="Es macht mehr Spaß in Boracay, Philippinen!!" data-lang-zh="在菲律宾的长滩岛更有趣！！"
          data-lang-jp="ボラカイではもっと楽しいです！！" data-lang-ru="На Боракае веселей, Филиппины!!"
          data-lang-it="È più divertente a Boracay, Filippine!!" data-lang-pt="É mais divertido em Boracay, Filipinas!!"
          data-lang-ar="إنه أكثر متعة في بوراكاي، الفلبين!!">It's more fun in Boracay Philippines!!</p>

       
      </div>


    </div>

    <div class="history">
      <div class="container">
        <div class="tour__head">

        </div>

        <div class="image-container"></div>
      </div>
    </div>
    </div>
  </section>

  <div class="img">
   
    <main>

      <div id="carousel" class="carousel">

        <div id='item_1' class="hideLeft">
          <img src="../img/q.jpg">
        </div>

        <div id='item_2' class="prevLeftSecond">
        <img src="../img/qq.jpg">
        </div>

        <div id='item_3' class="prev">
        <img src="../img/qqq.jpg">
        </div>

        <div id='item_4' class="selected">
        <img src="../img/qqqq.jpg">
        </div>

        <div id='item_5' class="next">
        <img src="../img/qqqqq.jpg">
        </div>

        <div id='item_6' class="nextRightSecond">
        <img src="../img/qqqqq.jpg">
        </div>

        <div id='item_7' class="hideRight">
        <img src="../img/qq.jpg">
        </div>

        <div id='item_8' class="hideRight">
        <img src="../img/qq.jpg">
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
    <h1 data-lang-en="Room Type" data-lang-es="Paquete de Tour en Boracay"
      data-lang-fr="Forfait Tour à Boracay" data-lang-de="Boracay Tour-Paket" data-lang-zh="博拉acay旅游套餐"
      data-lang-jp="ボラカイツアーパッケージ" data-lang-ru="Турпакет на Борокай" data-lang-it="Pacchetto Tour di Boracay"
      data-lang-pt="Pacote de Tour em Boracay" data-lang-ar="حزمة جولة بوراكاي"><i class="bx bx-run icon"
        style="color: red;"></i>Room Type</h1>
    <p>
      <span class="span3">&#139;</span>
      <span class="span3">&#155;</span>
    </p>
  </header>
  <p class="p2">Discover the Paradise: Explore the Philippines with us!!</p>
  <section class="section6">
    <div class="product">
      <picture>
        <img src="../places/boracay/Zipline Boracay.jpg"  alt="Zipline in Boracay">
      </picture>
      <div class="detail">
        <p>
          <b class="sh1" data-lang-en="Zipline Boracay" data-lang-es="Tirolina Boracay" data-lang-fr="Tyrolienne à Boracay"
            data-lang-de="Zipline Boracay" data-lang-zh="博拉acay滑索" data-lang-jp="ボラカイジップライン"
            data-lang-ru="Зиплайн на Борокае" data-lang-it="Zipline Boracay" data-lang-pt="Tirolina Boracay"
            data-lang-ar="زيبلاين بوراكاي" ><a href="../include/boracayresto.php">Zipline Boracay</a></b><br>

          <i class="bx bx-map icon" style="color: red;"></i>
          <small data-lang-en="Station 3 Beach front, Boracay Island 5608"
            data-lang-es="Frente a la playa de la estación 3, Isla Boracay 5608"
            data-lang-fr="Front de mer Station 3, Île Boracay 5608"
            data-lang-de="Strandstation 3, Boracay-Insel 5608" data-lang-zh="博拉acay岛站3海滩前5608"
            data-lang-jp="ボラカイ島ステーション3のビーチフロント5608" data-lang-ru="Береговая линия станции 3, остров Борокай 5608"
            data-lang-it="Fronte spiaggia Stazione 3, Isola Boracay 5608"
            data-lang-pt="Frente para a praia da Estação 3, Ilha Boracay 5608"
            data-lang-ar="واجهة الشاطئ لمحطة 3، جزيرة بوراكاي 5608">Station 3 Beach front, Boracay Island
            5608</small>
        </p>
      </div>
    </div>
    <div class="product">
      <picture>
        <img src="../places/boracay/Kite Surf on Bulabog Beach.jpg" alt="Kite Surf on Bulabog Beach">
      </picture>
      <div class="detail">
        <p>
          <b class="sh1" data-lang-en="Kite Surf on Bulabog Beach" data-lang-es="Kite Surf en Playa Bulabog"
            data-lang-fr="Kite Surf sur la plage de Bulabog" data-lang-de="Kitesurfen am Bulabog Beach"
            data-lang-zh="布拉博格海滩的风筝冲浪" data-lang-jp="ブルボグビーチでのカイトサーフィン" data-lang-ru="Кайтсерфинг на пляже Булобог"
            data-lang-it="Kite Surf a Bulabog Beach" data-lang-pt="Kite Surf na Praia de Bulabog"
            data-lang-ar="ركوب الأمواج بالطائرات الورقية على شاطئ بولابوج">Kite Surf on Bulabog Beach</b><br>

          <i class="bx bx-map icon" style="color: red;"></i>
          <small data-lang-en="Station 3 Beach front, Boracay Island 5608"
            data-lang-es="Frente a la playa de la estación 3, Isla Boracay 5608"
            data-lang-fr="Front de mer Station 3, Île Boracay 5608"
            data-lang-de="Strandstation 3, Boracay-Insel 5608" data-lang-zh="博拉acay岛站3海滩前5608"
            data-lang-jp="ボラカイ島ステーション3のビーチフロント5608" data-lang-ru="Береговая линия станции 3, остров Борокай 5608"
            data-lang-it="Fronte spiaggia Stazione 3, Isola Boracay 5608"
            data-lang-pt="Frente para a praia da Estação 3, Ilha Boracay 5608"
            data-lang-ar="واجهة الشاطئ لمحطة 3، جزيرة بوراكاي 5608">Station 3 Beach front, Boracay Island
            5608</small>
        </p>
      </div>
    </div>
    <div class="product">
      <picture>
        <img src="../places/boracay/Ride the Zorb.jpg" alt="Ride the Zorb">
      </picture>
      <div class="detail">
        <p>
          <b class="sh1" data-lang-en="Ride the Zorb" data-lang-es="Montar el Zorb" data-lang-fr="Montez le Zorb"
            data-lang-de="Fahren Sie mit dem Zorb" data-lang-zh="乘坐Zorb" data-lang-jp="ゾーブに乗る"
            data-lang-ru="Покатайтесь на Зорбе" data-lang-it="Fai un giro sul Zorb" data-lang-pt="Andar no Zorb"
            data-lang-ar="ركوب الزورب">Ride the Zorb</b><br>

          <i class="bx bx-map icon" style="color: red;"></i>
          <small data-lang-en="Beach front Dmall of Boracay Station 2, Boracay, Malay, 5608 Aklan"
            data-lang-es="Frente a la playa Dmall de Boracay Estación 2, Boracay, Malay, 5608 Aklan"
            data-lang-fr="Front de mer Dmall de Boracay Station 2, Boracay, Malay, 5608 Aklan"
            data-lang-de="Strandstation Dmall von Boracay Station 2, Boracay, Malay, 5608 Aklan"
            data-lang-zh="博拉acay站2的Dmall海滩前5608 Aklan" data-lang-jp="ボラカイ島マレー5608のDMallビーチフロントステーション2"
            data-lang-ru="Береговая линия Dmall Борокая, станция 2, Борокай, Малай, 5608 Аклан"
            data-lang-it="Fronte spiaggia Dmall di Boracay Stazione 2, Boracay, Malay, 5608 Aklan"
            data-lang-pt="Frente para a praia Dmall de Boracay Estação 2, Boracay, Malay, 5608 Aklan"
            data-lang-ar="واجهة الشاطئ لـ Dmall من بوراكاي محطة 2، بوراكاي، مالاي، 5608 أكلان">Beach front Dmall of
            Boracay Station 2, Boracay, Malay, 5608 Aklan</small>
        </p>
      </div>
    </div>
    <div class="product">
      <picture>
        <img src="../places/boracay/Go Island Hopping.jpg" alt="Go Island Hopping">
      </picture>
      <div class="detail">
        <p>
          <b class="sh1" data-lang-en="Go Island Hopping" data-lang-es="Ir de Isla en Isla"
            data-lang-fr="Faire de l'Île à l'Île" data-lang-de="Insel-Hopping machen" data-lang-zh="去岛屿跳跃"
            data-lang-jp="アイランドホッピングをする" data-lang-ru="Ходить на острова" data-lang-it="Fai Island Hopping"
            data-lang-pt="Ir de Ilha em Ilha" data-lang-ar="اذهب في رحلة بين الجزر">Go Island Hopping</b><br>

          <i class="bx bx-map icon" style="color: red;"></i>
          <small data-lang-en="Station 1, Boracay" data-lang-es="Estación 1, Boracay"
            data-lang-fr="Station 1, Boracay" data-lang-de="Station 1, Boracay" data-lang-zh="博拉acay站1"
            data-lang-jp="ボラカイ島ステーション1" data-lang-ru="Станция 1, Борокай" data-lang-it="Stazione 1, Boracay"
            data-lang-pt="Estação 1, Boracay" data-lang-ar="المحطة 1، بوراكاي">Station 1, Boracay</small>
        </p>
      </div>
    </div>
    <div class="product">
      <picture>
        <img src="../places/boracay/Ride the Banana Boat.jpg" alt="Ride the Banana Boat">
      </picture>
      <div class="detail">
        <p>
          <b class="sh1" data-lang-en="Ride the Banana Boat" data-lang-es="Montar el Banana Boat"
            data-lang-fr="Montez le Banana Boat" data-lang-de="Fahren Sie mit dem Banana Boat"
            data-lang-zh="乘坐香蕉船" data-lang-jp="バナナボートに乗る" data-lang-ru="Прокатитесь на банановой лодке"
            data-lang-it="Fai un giro sul Banana Boat" data-lang-pt="Andar no Banana Boat"
            data-lang-ar="ركوب القارب الموزي">Ride the Banana Boat</b><br>

          <i class="bx bx-map icon" style="color: red;"></i>
          <small data-lang-en="White Beach, Boracay, Malay, 5608 Aklan" data-lang-es="Playa Blanca, Boracay, Malay, 5608 Aklan"
            data-lang-fr="Plage Blanche, Boracay, Malay, 5608 Aklan" data-lang-de="Weißer Strand, Boracay, Malay, 5608 Aklan"
            data-lang-zh="白沙滩，博拉acay，马来，5608阿克兰" data-lang-jp="ホワイトビーチ、ボラカイ、マレー、5608アクラン"
            data-lang-ru="Белый пляж, Борокай, Малай, 5608 Аклан" data-lang-it="Spiaggia Bianca, Boracay, Malay, 5608 Aklan"
            data-lang-pt="Praia Branca, Boracay, Malay, 5608 Aklan" data-lang-ar="الشاطئ الأبيض، بوراكاي، مالاي، 5608 أكلان">
            White Beach, Boracay, Malay, 5608 Aklan</small>
        </p>
      </div>
    </div>
    <div class="product">
      <picture>
        <img src="../places/boracay/Zipline Boracay.jpg" alt="Zipline in Boracay">
      </picture>
      <div class="detail">
        <p>
          <b class="sh1" data-lang-en="Zipline Boracay" data-lang-es="Tirolina Boracay" data-lang-fr="Tyrolienne à Boracay"
            data-lang-de="Zipline Boracay" data-lang-zh="博拉acay滑索" data-lang-jp="ボラカイジップライン"
            data-lang-ru="Зиплайн на Борокае" data-lang-it="Zipline Boracay" data-lang-pt="Tirolina Boracay"
            data-lang-ar="زيبلاين بوراكاي">Zipline Boracay</b><br>

          <i class="bx bx-map icon" style="color: red;"></i>
          <small data-lang-en="Station 3 Beach front, Boracay Island 5608"
            data-lang-es="Frente a la playa de la estación 3, Isla Boracay 5608"
            data-lang-fr="Front de mer Station 3, Île Boracay 5608"
            data-lang-de="Strandstation 3, Boracay-Insel 5608" data-lang-zh="博拉acay岛站3海滩前5608"
            data-lang-jp="ボラカイ島ステーション3のビーチフロント5608" data-lang-ru="Береговая линия станции 3, остров Борокай 5608"
            data-lang-it="Fronte spiaggia Stazione 3, Isola Boracay 5608"
            data-lang-pt="Frente para a praia da Estação 3, Ilha Boracay 5608"
            data-lang-ar="واجهة الشاطئ لمحطة 3، جزيرة بوراكاي 5608">Station 3 Beach front, Boracay Island
            5608</small>
        </p>
      </div>
    </div>
    <div class="product">
      <picture>
        <img src="../places/boracay/Kite Surf on Bulabog Beach.jpg" alt="Kite Surf on Bulabog Beach">
      </picture>
      <div class="detail">
        <p>
          <b class="sh1" data-lang-en="Kite Surf on Bulabog Beach" data-lang-es="Kite Surf en Playa Bulabog"
            data-lang-fr="Kite Surf sur la plage de Bulabog" data-lang-de="Kitesurfen am Bulabog Beach"
            data-lang-zh="布拉博格海滩的风筝冲浪" data-lang-jp="ブルボグビーチでのカイトサーフィン" data-lang-ru="Кайтсерфинг на пляже Булобог"
            data-lang-it="Kite Surf a Bulabog Beach" data-lang-pt="Kite Surf na Praia de Bulabog"
            data-lang-ar="ركوب الأمواج بالطائرات الورقية على شاطئ بولابوج">Kite Surf on Bulabog Beach</b><br>

          <i class="bx bx-map icon" style="color: red;"></i>
          <small data-lang-en="Station 3 Beach front, Boracay Island 5608"
            data-lang-es="Frente a la playa de la estación 3, Isla Boracay 5608"
            data-lang-fr="Front de mer Station 3, Île Boracay 5608"
            data-lang-de="Strandstation 3, Boracay-Insel 5608" data-lang-zh="博拉acay岛站3海滩前5608"
            data-lang-jp="ボラカイ島ステーション3のビーチフロント5608" data-lang-ru="Береговая линия станции 3, остров Борокай 5608"
            data-lang-it="Fronte spiaggia Stazione 3, Isola Boracay 5608"
            data-lang-pt="Frente para a praia da Estação 3, Ilha Boracay 5608"
            data-lang-ar="واجهة الشاطئ لمحطة 3، جزيرة بوراكاي 5608">Station 3 Beach front, Boracay Island
            5608</small>
        </p>
      </div>
    </div>
    <div class="product">
      <picture>
        <img src="../places/boracay/Ride the Zorb.jpg" alt="Ride the Zorb">
      </picture>
      <div class="detail">
        <p>
          <b class="sh1" data-lang-en="Ride the Zorb" data-lang-es="Montar el Zorb" data-lang-fr="Montez le Zorb"
            data-lang-de="Fahren Sie mit dem Zorb" data-lang-zh="乘坐Zorb" data-lang-jp="ゾーブに乗る"
            data-lang-ru="Покатайтесь на Зорбе" data-lang-it="Fai un giro sul Zorb" data-lang-pt="Andar no Zorb"
            data-lang-ar="ركوب الزورب">Ride the Zorb</b><br>

          <i class="bx bx-map icon" style="color: red;"></i>
          <small data-lang-en="Beach front Dmall of Boracay Station 2, Boracay, Malay, 5608 Aklan"
            data-lang-es="Frente a la playa Dmall de Boracay Estación 2, Boracay, Malay, 5608 Aklan"
            data-lang-fr="Front de mer Dmall de Boracay Station 2, Boracay, Malay, 5608 Aklan"
            data-lang-de="Strandstation Dmall von Boracay Station 2, Boracay, Malay, 5608 Aklan"
            data-lang-zh="博拉acay站2的Dmall海滩前5608 Aklan" data-lang-jp="ボラカイ島マレー5608のDMallビーチフロントステーション2"
            data-lang-ru="Береговая линия Dmall Борокая, станция 2, Борокай, Малай, 5608 Аклан"
            data-lang-it="Fronte spiaggia Dmall di Boracay Stazione 2, Boracay, Malay, 5608 Aklan"
            data-lang-pt="Frente para a praia Dmall de Boracay Estação 2, Boracay, Malay, 5608 Aklan"
            data-lang-ar="واجهة الشاطئ لـ Dmall من بوراكاي محطة 2، بوراكاي، مالاي، 5608 أكلان">Beach front Dmall of
            Boracay Station 2, Boracay, Malay, 5608 Aklan</small>
        </p>
      </div>
    </div>
    <div class="product">
      <picture>
        <img src="../places/boracay/Go Island Hopping.jpg" alt="Go Island Hopping">
      </picture>
      <div class="detail">
        <p>
          <b class="sh1" data-lang-en="Go Island Hopping" data-lang-es="Ir de Isla en Isla"
            data-lang-fr="Faire de l'Île à l'Île" data-lang-de="Insel-Hopping machen" data-lang-zh="去岛屿跳跃"
            data-lang-jp="アイランドホッピングをする" data-lang-ru="Ходить на острова" data-lang-it="Fai Island Hopping"
            data-lang-pt="Ir de Ilha em Ilha" data-lang-ar="اذهب في رحلة بين الجزر">Go Island Hopping</b><br>

          <i class="bx bx-map icon" style="color: red;"></i>
          <small data-lang-en="Station 1, Boracay" data-lang-es="Estación 1, Boracay"
            data-lang-fr="Station 1, Boracay" data-lang-de="Station 1, Boracay" data-lang-zh="博拉acay站1"
            data-lang-jp="ボラカイ島ステーション1" data-lang-ru="Станция 1, Борокай" data-lang-it="Stazione 1, Boracay"
            data-lang-pt="Estação 1, Boracay" data-lang-ar="المحطة 1، بوراكاي">Station 1, Boracay</small>
        </p>
      </div>
    </div>
    <div class="product">
      <picture>
        <img src="../places/boracay/Ride the Banana Boat.jpg" alt="Ride the Banana Boat">
      </picture>
      <div class="detail">
        <p>
          <b class="sh1" data-lang-en="Ride the Banana Boat" data-lang-es="Montar el Banana Boat"
            data-lang-fr="Montez le Banana Boat" data-lang-de="Fahren Sie mit dem Banana Boat"
            data-lang-zh="乘坐香蕉船" data-lang-jp="バナナボートに乗る" data-lang-ru="Прокатитесь на банановой лодке"
            data-lang-it="Fai un giro sul Banana Boat" data-lang-pt="Andar no Banana Boat"
            data-lang-ar="ركوب القارب الموزي">Ride the Banana Boat</b><br>

          <i class="bx bx-map icon" style="color: red;"></i>
          <small data-lang-en="White Beach, Boracay, Malay, 5608 Aklan" data-lang-es="Playa Blanca, Boracay, Malay, 5608 Aklan"
            data-lang-fr="Plage Blanche, Boracay, Malay, 5608 Aklan" data-lang-de="Weißer Strand, Boracay, Malay, 5608 Aklan"
            data-lang-zh="白沙滩，博拉acay，马来，5608阿克兰" data-lang-jp="ホワイトビーチ、ボラカイ、マレー、5608アクラン"
            data-lang-ru="Белый пляж, Борокай, Малай, 5608 Аклан" data-lang-it="Spiaggia Bianca, Boracay, Malay, 5608 Aklan"
            data-lang-pt="Praia Branca, Boracay, Malay, 5608 Aklan" data-lang-ar="الشاطئ الأبيض، بوراكاي، مالاي، 5608 أكلان">
            White Beach, Boracay, Malay, 5608 Aklan</small>
        </p>
      </div>
    </div>
    <div class="product">
      <picture>
        <img src="../places/boracay/Zipline Boracay.jpg" alt="Zipline in Boracay">
      </picture>
      <div class="detail">
        <p>
          <b class="sh1" data-lang-en="Zipline Boracay" data-lang-es="Tirolina Boracay" data-lang-fr="Tyrolienne à Boracay"
            data-lang-de="Zipline Boracay" data-lang-zh="博拉acay滑索" data-lang-jp="ボラカイジップライン"
            data-lang-ru="Зиплайн на Борокае" data-lang-it="Zipline Boracay" data-lang-pt="Tirolina Boracay"
            data-lang-ar="زيبلاين بوراكاي">Zipline Boracay</b><br>

          <i class="bx bx-map icon" style="color: red;"></i>
          <small data-lang-en="Station 3 Beach front, Boracay Island 5608"
            data-lang-es="Frente a la playa de la estación 3, Isla Boracay 5608"
            data-lang-fr="Front de mer Station 3, Île Boracay 5608"
            data-lang-de="Strandstation 3, Boracay-Insel 5608" data-lang-zh="博拉acay岛站3海滩前5608"
            data-lang-jp="ボラカイ島ステーション3のビーチフロント5608" data-lang-ru="Береговая линия станции 3, остров Борокай 5608"
            data-lang-it="Fronte spiaggia Stazione 3, Isola Boracay 5608"
            data-lang-pt="Frente para a praia da Estação 3, Ilha Boracay 5608"
            data-lang-ar="واجهة الشاطئ لمحطة 3، جزيرة بوراكاي 5608">Station 3 Beach front, Boracay Island
            5608</small>
        </p>
      </div>
    </div>
    <div class="product">
      <picture>
        <img src="../places/boracay/Kite Surf on Bulabog Beach.jpg" alt="Kite Surf on Bulabog Beach">
      </picture>
      <div class="detail">
        <p>
          <b class="sh1" data-lang-en="Kite Surf on Bulabog Beach" data-lang-es="Kite Surf en Playa Bulabog"
            data-lang-fr="Kite Surf sur la plage de Bulabog" data-lang-de="Kitesurfen am Bulabog Beach"
            data-lang-zh="布拉博格海滩的风筝冲浪" data-lang-jp="ブルボグビーチでのカイトサーフィン" data-lang-ru="Кайтсерфинг на пляже Булобог"
            data-lang-it="Kite Surf a Bulabog Beach" data-lang-pt="Kite Surf na Praia de Bulabog"
            data-lang-ar="ركوب الأمواج بالطائرات الورقية على شاطئ بولابوج">Kite Surf on Bulabog Beach</b><br>

          <i class="bx bx-map icon" style="color: red;"></i>
          <small data-lang-en="Station 3 Beach front, Boracay Island 5608"
            data-lang-es="Frente a la playa de la estación 3, Isla Boracay 5608"
            data-lang-fr="Front de mer Station 3, Île Boracay 5608"
            data-lang-de="Strandstation 3, Boracay-Insel 5608" data-lang-zh="博拉acay岛站3海滩前5608"
            data-lang-jp="ボラカイ島ステーション3のビーチフロント5608" data-lang-ru="Береговая линия станции 3, остров Борокай 5608"
            data-lang-it="Fronte spiaggia Stazione 3, Isola Boracay 5608"
            data-lang-pt="Frente para a praia da Estação 3, Ilha Boracay 5608"
            data-lang-ar="واجهة الشاطئ لمحطة 3، جزيرة بوراكاي 5608">Station 3 Beach front, Boracay Island
            5608</small>
        </p>
      </div>
    </div>
    <div class="product">
      <picture>
        <img src="../places/boracay/Ride the Zorb.jpg" alt="Ride the Zorb">
      </picture>
      <div class="detail">
        <p>
          <b class="sh1" data-lang-en="Ride the Zorb" data-lang-es="Montar el Zorb" data-lang-fr="Montez le Zorb"
            data-lang-de="Fahren Sie mit dem Zorb" data-lang-zh="乘坐Zorb" data-lang-jp="ゾーブに乗る"
            data-lang-ru="Покатайтесь на Зорбе" data-lang-it="Fai un giro sul Zorb" data-lang-pt="Andar no Zorb"
            data-lang-ar="ركوب الزورب">Ride the Zorb</b><br>

          <i class="bx bx-map icon" style="color: red;"></i>
          <small data-lang-en="Beach front Dmall of Boracay Station 2, Boracay, Malay, 5608 Aklan"
            data-lang-es="Frente a la playa Dmall de Boracay Estación 2, Boracay, Malay, 5608 Aklan"
            data-lang-fr="Front de mer Dmall de Boracay Station 2, Boracay, Malay, 5608 Aklan"
            data-lang-de="Strandstation Dmall von Boracay Station 2, Boracay, Malay, 5608 Aklan"
            data-lang-zh="博拉acay站2的Dmall海滩前5608 Aklan" data-lang-jp="ボラカイ島マレー5608のDMallビーチフロントステーション2"
            data-lang-ru="Береговая линия Dmall Борокая, станция 2, Борокай, Малай, 5608 Аклан"
            data-lang-it="Fronte spiaggia Dmall di Boracay Stazione 2, Boracay, Malay, 5608 Aklan"
            data-lang-pt="Frente para a praia Dmall de Boracay Estação 2, Boracay, Malay, 5608 Aklan"
            data-lang-ar="واجهة الشاطئ لـ Dmall من بوراكاي محطة 2، بوراكاي، مالاي، 5608 أكلان">Beach front Dmall of
            Boracay Station 2, Boracay, Malay, 5608 Aklan</small>
        </p>
      </div>
    </div>
  
  </section>
</main>







    <main>
      <header>
        <h1 data-lang-en="Top Hottest Restaurants" data-lang-es="Los Restaurantes Más Populares"
          data-lang-fr="Les Restaurants les Plus Populaires" data-lang-de="Die Beliebtesten Restaurants"
          data-lang-zh="最热门的餐厅" data-lang-jp="最も人気のあるレストラン" data-lang-ru="Самые Популярные Рестораны"
          data-lang-it="I Ristoranti Più Popolari" data-lang-pt="Os Restaurantes Mais Populares"
          data-lang-ar="أشهر المطاعم"><i class="bx bx-home icon" style="color: red;"></i>Top Hottest Restaurants</h1>

        <p>
          <span class="span2">&#139;</span>
          <span class="span2">&#155;</span>
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
                data-lang-ar="مطعم نالكا للمأكولات البحرية"><a href="../include/boracayresto.php">Nalka Seafood Resturant</a></b><br>

                <i class="bx bx-map icon" style="color: red;"></i>
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

                <i class="bx bx-map icon" style="color: red;"></i>
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
                data-lang-it="Café del Sol" data-lang-pt="Café del Sol" data-lang-ar="مقهى ديل سول">Café del Sol</b><br>

                <i class="bx bx-map icon" style="color: red;"></i>
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
              <b class="sh1" data-lang-en="Barlo Restaurant" data-lang-es="Restaurante Barlo" data-lang-fr="Restaurant Barlo"
                data-lang-de="Barlo Restaurant" data-lang-zh="巴洛餐厅" data-lang-jp="バーロレストラン"
                data-lang-ru="Ресторан Барло" data-lang-it="Ristorante Barlo" data-lang-pt="Restaurante Barlo"
                data-lang-ar="مطعم بارلو">Barlo Restaurant</b><br>

                <i class="bx bx-map icon" style="color: red;"></i>
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
              <b class="sh1" data-lang-en="Los Indios Bravos" data-lang-es="Los Indios Bravos" data-lang-fr="Los Indios Bravos"
                data-lang-de="Los Indios Bravos" data-lang-zh="洛斯印第安勇士" data-lang-jp="ロスインディオスブラボス"
                data-lang-ru="Лос Индьос Бравос" data-lang-it="Los Indios Bravos" data-lang-pt="Los Indios Bravos"
                data-lang-ar="لوس إنديوس برافوس">Los Indios Bravos</b><br>

                <i class="bx bx-map icon" style="color: red;"></i>
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

                <i class="bx bx-map icon" style="color: red;"></i>
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
              <b class="sh1" data-lang-en="Meze Wrap" data-lang-es="Meze Wrap" data-lang-fr="Meze Wrap" data-lang-de="Meze Wrap"
                data-lang-zh="梅兹卷" data-lang-jp="メゼラップ" data-lang-ru="Мезе Ролл" data-lang-it="Meze Wrap"
                data-lang-pt="Meze Wrap" data-lang-ar="ميز راب">Meze Wrap</b><br>

                <i class="bx bx-map icon" style="color: red;"></i>
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
              <b class="sh1" data-lang-en="SpiceBird" data-lang-es="SpiceBird" data-lang-fr="SpiceBird" data-lang-de="SpiceBird"
                data-lang-zh="香料鸟" data-lang-jp="スパイスバード" data-lang-ru="Спайс Бёрд" data-lang-it="SpiceBird"
                data-lang-pt="SpiceBird" data-lang-ar="سبايس بيرد">SpiceBird</b><br>

                <i class="bx bx-map icon" style="color: red;"></i>
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

                <i class="bx bx-map icon" style="color: red;"></i>
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

                <i class="bx bx-map icon" style="color: red;"></i>
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
              <b class="sh1" data-lang-en="Little Taj Boracay" data-lang-es="Pequeño Taj Boracay" data-lang-fr="Petit Taj Boracay"
                data-lang-de="Kleiner Taj Boracay" data-lang-zh="小泰姬长滩岛" data-lang-jp="リトルタージ・ボラカイ"
                data-lang-ru="Маленький Тадж Боракай" data-lang-it="Little Taj Boracay"
                data-lang-pt="Pequeno Taj Boracay" data-lang-ar="ليتل تاج بوراكاي">Little Taj Boracay</b><br>

                <i class="bx bx-map icon" style="color: red;"></i>
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
              <b class="sh1" data-lang-en="Congas Restaurant" data-lang-es="Restaurante Congas" data-lang-fr="Restaurant Congas"
                data-lang-de="Congas Restaurant" data-lang-zh="Congas餐厅" data-lang-jp="コンガスレストラン"
                data-lang-ru="Ресторан Congas" data-lang-it="Ristorante Congas" data-lang-pt="Restaurante Congas"
                data-lang-ar="مطعم كونغاس">Congas Restaurant</b><br>

                <i class="bx bx-map icon" style="color: red;"></i>
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
              <b class="sh1">Shangri-La Hotels and Resorts</b><br>

              <i class="bx bx-map icon" style="color: red;"></i>
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
              <b class="sh1">Mandala Spa and Resort Villas</b><br>

              <i class="bx bx-map icon" style="color: red;"></i>
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
              <b class="sh1">Fairways & Bluewater Boracay</b><br>

              <i class="bx bx-map icon" style="color: red;"></i>
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
              <b class="sh1">Henann Crystal Sands Resort</b><br>

              <i class="bx bx-map icon" style="color: red;"></i>
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

              <i class="bx bx-map icon" style="color: red;"></i>
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

              <i class="bx bx-map icon" style="color: red;"></i>
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

              <i class="bx bx-map icon" style="color: red;"></i>
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

              <i class="bx bx-map icon" style="color: red;"></i>
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

              <i class="bx bx-map icon" style="color: red;"></i>
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

              <i class="bx bx-map icon" style="color: red;"></i>
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

              <i class="bx bx-map icon" style="color: red;"></i>
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

              <i class="bx bx-map icon" style="color: red;"></i>
              <small>Station 2, Balabag, Boracay Island, Malay</small>
            </p>

          </div>
          <div class="button7">

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
          data-lang-pt="Os Produtos Mais Populares" data-lang-ar="أكثر المنتجات شهرة ">Top Hottest Products in Boracay
        </h1>
        <p>
          <span class="span4">&#139;</span>
          <span class="span4">&#155;</span>

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
              <b class="sh1" data-lang-en="Shell Keychains" data-lang-es="Llaveros de Concha" data-lang-fr="Porte-clés Coquillage"
                data-lang-de="Muschel-Schlüsselanhänger" data-lang-zh="贝壳钥匙链" data-lang-jp="シェルキーホルダー"
                data-lang-ru="Брелоки с ракушками" data-lang-it="Portachiavi con Conchiglie"
                data-lang-pt="Chaveiros de Conchas" data-lang-ar="ميداليات الصدف">Shell Keychains</b><br>
            </p>
            <samp>₱500.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#" data-lang-en="Buy Now!!" data-lang-es="¡Compra Ahora!"
              data-lang-fr="Acheter Maintenant!" data-lang-de="Jetzt Kaufen!" data-lang-zh="立即购买！" data-lang-jp="今すぐ購入！"
              data-lang-ru="Купить Сейчас!" data-lang-it="Acquista Ora!" data-lang-pt="Compre Agora!"
              data-lang-ar="اشتري الآن!!">Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/2_20240923_211811_0001.png" alt="Beaded Bracelets">
          </picture>
          <div class="detail">
            <p>
              <b class="sh1" data-lang-en="Beaded Bracelets" data-lang-es="Pulseras de Cuentas" data-lang-fr="Bracelets en Perles"
                data-lang-de="Perlenarmbänder" data-lang-zh="珠饰手链" data-lang-jp="ビーズブレスレット"
                data-lang-ru="Браслеты с Бусинами" data-lang-it="Braccialetti di Perline"
                data-lang-pt="Pulseiras de Miçangas" data-lang-ar="أساور خرز">Beaded Bracelets</b><br>
            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#" data-lang-en="Buy Now!!" data-lang-es="¡Compra Ahora!"
              data-lang-fr="Acheter Maintenant!" data-lang-de="Jetzt Kaufen!" data-lang-zh="立即购买！" data-lang-jp="今すぐ購入！"
              data-lang-ru="Купить Сейчас!" data-lang-it="Acquista Ora!" data-lang-pt="Compre Agora!"
              data-lang-ar="اشتري الآن!!">Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/3_20240923_211811_0002.png" alt="Handwoven Bag">
          </picture>
          <div class="detail">
            <p>
              <b class="sh1" data-lang-en="Handwoven Bag" data-lang-es="Bolsa Tejida" data-lang-fr="Sac Tissé"
                data-lang-de="Handgewebte Tasche" data-lang-zh="手工编织包" data-lang-jp="手織りバッグ"
                data-lang-ru="Ручная плетеная сумка" data-lang-it="Borsa Intrecciata" data-lang-pt="Bolsa Feita à Mão"
                data-lang-ar="حقيبة منسوجة">Handwoven Bag</b><br>
            </p>
            <samp>₱500.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#" data-lang-en="Buy Now!!" data-lang-es="¡Compra Ahora!"
              data-lang-fr="Acheter Maintenant!" data-lang-de="Jetzt Kaufen!" data-lang-zh="立即购买！" data-lang-jp="今すぐ購入！"
              data-lang-ru="Купить Сейчас!" data-lang-it="Acquista Ora!" data-lang-pt="Compre Agora!"
              data-lang-ar="اشتري الآن!!">Buy Now!!</a>
          </div>
        </div>

        <!-- Additional products follow the same format -->

        <div class="product">
          <picture>
            <img src="../places/boracay/4_20240923_211811_0003.png" alt="White Beach Sarong">
          </picture>
          <div class="detail">
            <p>
              <b class="sh1" data-lang-en="White Beach Sarong" data-lang-es="Sarong de Playa Blanco"
                data-lang-fr="Paréo de Plage Blanc" data-lang-de="Weißer Strand-Sarong" data-lang-zh="白色沙滩纱笼"
                data-lang-jp="ホワイトビーチサロン" data-lang-ru="Белый Пляжный Парео" data-lang-it="Sarong da Spiaggia Bianco"
                data-lang-pt="Sarong de Praia Branco" data-lang-ar="سارونج شاطئ أبيض">White Beach Sarong</b><br>
            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#" data-lang-en="Buy Now!!" data-lang-es="¡Compra Ahora!"
              data-lang-fr="Acheter Maintenant!" data-lang-de="Jetzt Kaufen!" data-lang-zh="立即购买！" data-lang-jp="今すぐ購入！"
              data-lang-ru="Купить Сейчас!" data-lang-it="Acquista Ora!" data-lang-pt="Compre Agora!"
              data-lang-ar="اشتري الآن!!">Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/5_20240923_211811_0004.png" alt="Bamboo Craft Wooden Figure">
          </picture>
          <div class="detail">
            <p>
              <b class="sh1" data-lang-en="Bamboo Craft Wooden Figure" data-lang-es="Figura de Madera de Bambú"
                data-lang-fr="Figurine en Bois de Bambou" data-lang-de="Bambuskunst-Holzfigur" data-lang-zh="竹制工艺木雕"
                data-lang-jp="竹工芸木製フィギュア" data-lang-ru="Бамбуковая Деревянная Фигура"
                data-lang-it="Figura di Legno in Bambù" data-lang-pt="Figura de Madeira de Bambu"
                data-lang-ar="تمثال خشبي من الخيزران">Bamboo Craft Wooden Figure</b><br>
            </p>
            <samp>₱300.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#" data-lang-en="Buy Now!!" data-lang-es="¡Compra Ahora!"
              data-lang-fr="Acheter Maintenant!" data-lang-de="Jetzt Kaufen!" data-lang-zh="立即购买！" data-lang-jp="今すぐ購入！"
              data-lang-ru="Купить Сейчас!" data-lang-it="Acquista Ora!" data-lang-pt="Compre Agora!"
              data-lang-ar="اشتري الآن!!">Buy Now!!</a>
          </div>
        </div>
        <div class="product">
          <picture>
            <img src="../places/boracay/6_20240923_211811_0005.png">
          </picture>
          <div class="detail">
            <p>
              <b class="sh1" data-lang-en="Boracay Island Tee" data-lang-es="Camiseta de la Isla de Boracay"
                data-lang-fr="T-shirt de l'île de Boracay" data-lang-de="Boracay-Insel T-Shirt" data-lang-zh="博拉凯岛T恤"
                data-lang-jp="ボラカイ島のTシャツ" data-lang-ru="Футболка Острова Борокай"
                data-lang-it="T-shirt Isola di Boracay" data-lang-pt="Camiseta da Ilha de Boracay"
                data-lang-ar="تي شيرت جزيرة بوراكاي">
                Boracay Island Tee
              </b><br>
            </p>
            <samp>₱600.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/7_20240923_211811_0006.png">
          </picture>
          <div class="detail">
            <p>
              <b class="sh1" data-lang-en="Coral Reef Wall Art" data-lang-es="Arte de Pared de Arrecife de Coral"
                data-lang-fr="Art Mural de Récif de Corail" data-lang-de="Wandkunst des Korallenriffs"
                data-lang-zh="珊瑚礁墙面艺术" data-lang-jp="サンゴ礁の壁アート" data-lang-ru="Настенное искусство кораллового рифа"
                data-lang-it="Arte Murale della Barriera Corallina" data-lang-pt="Arte de Parede de Recifes de Coral"
                data-lang-ar="فن الحائط للشعاب المرجانية">
                Coral Reef Wall Art
              </b><br>
            </p>
            <samp>₱1000.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/8_20240923_211811_0007.png">
          </picture>
          <div class="detail">
            <p>
              <b class="sh1" data-lang-en="Pinoy Straw Hat" data-lang-es="Sombrero de Paja Pinoy"
                data-lang-fr="Chapeau de Paille Pinoy" data-lang-de="Pinoy-Strohhut" data-lang-zh="菲律宾草帽"
                data-lang-jp="ピノイストローハット" data-lang-ru="Филиппинская соломенная шляпа"
                data-lang-it="Cappello di Paglia Pinoy" data-lang-pt="Chapéu de Palha Pinoy"
                data-lang-ar="قبعة القش الفلبينية">
                Pinoy Straw Hat
              </b><br>
            </p>
            <samp>₱200.00</samp>
          </div>
          <div class="button7">
            <a class="a1" href="#">Buy Now!!</a>
          </div>
        </div>

        <div class="product">
          <picture>
            <img src="../places/boracay/9_20240923_211811_0008.png">
          </picture>
          <div class="detail">
            <p>
              <b class="sh1" data-lang-en="Beach Towel" data-lang-es="Toalla de Playa" data-lang-fr="Serviette de Plage"
                data-lang-de="Strandtuch" data-lang-zh="沙滩毛巾" data-lang-jp="ビーチタオル" data-lang-ru="Пляжное Полотенце"
                data-lang-it="Asciugamano da Spiaggia" data-lang-pt="Toalha de Praia" data-lang-ar="منشفة الشاطئ">
                Beach Towel
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
            <img src="../places/boracay/10_20240923_211811_0009.png">
          </picture>
          <div class="detail">
            <p>
              <b class="sh1" data-lang-en="Fridge Magnet" data-lang-es="Imán de Nevera" data-lang-fr="Aimant de Frigo"
                data-lang-de="Kühlschrankmagnet" data-lang-zh="冰箱磁铁" data-lang-jp="冷蔵庫用マグネット"
                data-lang-ru="Холодильный Магнит" data-lang-it="Magnete da Frigo" data-lang-pt="Imã de Geladeira"
                data-lang-ar="مغناطيس الثلاجة">
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
              <b class="sh1" data-lang-en="Coconut Soap" data-lang-es="Jabón de Coco" data-lang-fr="Savon de Noix de Coco"
                data-lang-de="Kokosnuss-Seife" data-lang-zh="椰子肥皂" data-lang-jp="ココナッツソープ" data-lang-ru="Кокосовое Мыло"
                data-lang-it="Sapone di Cocco" data-lang-pt="Sabão de Coco" data-lang-ar="صابون جوز الهند">
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
              <b class="sh1" data-lang-en="Sundet Art Fit" data-lang-es="Sundet Art Fit" data-lang-fr="Sundet Art Fit"
                data-lang-de="Sundet Art Fit" data-lang-zh="Sundet Art Fit" data-lang-jp="Sundet Art Fit"
                data-lang-ru="Sundet Art Fit" data-lang-it="Sundet Art Fit" data-lang-pt="Sundet Art Fit"
                data-lang-ar="Sundet Art Fit">
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
              <h3 class="title">Barundon <br><i class="bx bx-map icon" style="color: red;"></i>Camias, Porac, Pampanga
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
  <script src="../js/boracayhotel.js"></script>
  <script src="../js/palawan.js"></script>
  <script src="../js/home.js"></script>
  <script src="../js/darkmode.js"></script>
  <script src="../js/language.js"></script>
  <script src="../js/script.js"></script>
  <script src="../js/boracay.js"></script>
  <script src="../js/index.js"></script>
  <script type="text/javascript" src="../js/fin.js"></script>
  <script type="text/javascript" src="../js/fin2.js"></script>
  <script src="../js/app.js"></script>


</body>

</html>