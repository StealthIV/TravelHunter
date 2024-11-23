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
        <div class="place-name" id="place-name">Shangri-La Hotel </div>
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
  <h1 data-lang-en="Room Type of Shangrila Hotel" 
    data-lang-es="Tipo de habitación del Hotel Shangrila" 
    data-lang-fr="Type de chambre de l'hôtel Shangrila" 
    data-lang-de="Zimmerart des Shangrila Hotels" 
    data-lang-zh="香格里拉酒店的房间类型" 
    data-lang-jp="シャングリラホテルの部屋タイプ" 
    data-lang-ru="Тип номера в отеле Шангрила" 
    data-lang-it="Tipologia di stanza dell'Hotel Shangrila" 
    data-lang-pt="Tipo de quarto do Hotel Shangrila" 
    data-lang-ar="نوع الغرفة في فندق شانغريلا">
    <i class="bx bx-run icon" style="color: red;"></i>Room Type of Shangrila Hotel
</h1>

    <p>
      <span class="span3">&#139;</span>
      <span class="span3">&#155;</span>
    </p>
  </header>
  <p class="p2">Discover the Paradise: Explore the Philippines with us!!</p>
  <section class="section6">
    <div class="product">
      <picture>
        <img src="../img/d1.jpg"  alt="Zipline in Boracay" class="clickable-image">
      </picture>
      <div class="detail">
        <p>
        <b class="sh1" 
    data-lang-en="Deluxe Room" 
    data-lang-es="Habitación Deluxe" 
    data-lang-fr="Chambre de Luxe" 
    data-lang-de="Deluxe-Zimmer" 
    data-lang-zh="豪华客房" 
    data-lang-jp="デラックスルーム" 
    data-lang-ru="Делюкс номер" 
    data-lang-it="Camera Deluxe" 
    data-lang-pt="Quarto Deluxe" 
    data-lang-ar="غرفة ديلوكس">
    <a href="../include/boracayresto.php">Deluxe Room</a>
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
    </div>
    <div class="product">
      <picture>
        <img src="../img/d2.jpg" alt="Kite Surf on Bulabog Beach" class="clickable-image">
      </picture>
      <div class="detail">
        <p>
        <b class="sh1" data-lang-en="Deluxe Seaview Room" 
       data-lang-es="Habitación Deluxe con Vista al Mar" 
       data-lang-fr="Chambre Deluxe avec Vue sur la Mer" 
       data-lang-de="Deluxe Zimmer mit Meerblick" 
       data-lang-zh="豪华海景房" 
       data-lang-jp="デラックス シービュー ルーム" 
       data-lang-ru="Номер Делюкс с видом на море" 
       data-lang-it="Camera Deluxe Vista Mare" 
       data-lang-pt="Quarto Deluxe com Vista para o Mar" 
       data-lang-ar="غرفة ديلوكس بإطلالة على البحر">Deluxe Seaview Room
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
    </div>
    <div class="product">
      <picture>
        <img src="../img/d3.jpg" alt="Ride the Zorb"  class="clickable-image">
      </picture>
      <div class="detail">
        <p>
        <b class="sh1" data-lang-en="Premier Seaview Room" 
       data-lang-es="Habitación Premier con Vista al Mar" 
       data-lang-fr="Chambre Premier avec Vue sur la Mer" 
       data-lang-de="Premier Zimmer mit Meerblick" 
       data-lang-zh="尊享海景房" 
       data-lang-jp="プレミア シービュー ルーム" 
       data-lang-ru="Номер Премьер с видом на море" 
       data-lang-it="Camera Premier Vista Mare" 
       data-lang-pt="Quarto Premier com Vista para o Mar" 
       data-lang-ar="غرفة بريميير بإطلالة على البحر">Premier Seaview Room
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
    </div>
    <div class="product">
      <picture>
        <img src="../img/d4.jpg" alt="Go Island Hopping">
      </picture>
      <div class="detail">
        <p>
        <b class="sh1" data-lang-en="Premier Family Seaview Room" 
       data-lang-es="Habitación Familiar Premier con Vista al Mar" 
       data-lang-fr="Chambre Familiale Premier avec Vue sur la Mer" 
       data-lang-de="Premier Familienzimmer mit Meerblick" 
       data-lang-zh="尊享家庭海景房" 
       data-lang-jp="プレミア ファミリー シービュー ルーム" 
       data-lang-ru="Семейный Номер Премьер с видом на море" 
       data-lang-it="Camera Familiare Premier Vista Mare" 
       data-lang-pt="Quarto Familiar Premier com Vista para o Mar" 
       data-lang-ar="غرفة عائلية بريميير بإطلالة على البحر">Premier Family Seaview Room
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
    </div>

    <div class="product">
      <picture>
        <img src="../img/d1.jpg"  alt="Zipline in Boracay" class="clickable-image">
      </picture>
      <div class="detail">
        <p>
        <b class="sh1" 
    data-lang-en="Deluxe Room" 
    data-lang-es="Habitación Deluxe" 
    data-lang-fr="Chambre de Luxe" 
    data-lang-de="Deluxe-Zimmer" 
    data-lang-zh="豪华客房" 
    data-lang-jp="デラックスルーム" 
    data-lang-ru="Делюкс номер" 
    data-lang-it="Camera Deluxe" 
    data-lang-pt="Quarto Deluxe" 
    data-lang-ar="غرفة ديلوكس">
    <a href="../include/boracayresto.php">Deluxe Room</a>
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
    </div>
    <div class="product">
      <picture>
        <img src="../img/d2.jpg" alt="Kite Surf on Bulabog Beach" class="clickable-image">
      </picture>
      <div class="detail">
        <p>
        <b class="sh1" data-lang-en="Deluxe Seaview Room" 
       data-lang-es="Habitación Deluxe con Vista al Mar" 
       data-lang-fr="Chambre Deluxe avec Vue sur la Mer" 
       data-lang-de="Deluxe Zimmer mit Meerblick" 
       data-lang-zh="豪华海景房" 
       data-lang-jp="デラックス シービュー ルーム" 
       data-lang-ru="Номер Делюкс с видом на море" 
       data-lang-it="Camera Deluxe Vista Mare" 
       data-lang-pt="Quarto Deluxe com Vista para o Mar" 
       data-lang-ar="غرفة ديلوكس بإطلالة على البحر">Deluxe Seaview Room
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
    </div>
    <div class="product">
      <picture>
        <img src="../img/d3.jpg" alt="Ride the Zorb"  class="clickable-image">
      </picture>
      <div class="detail">
        <p>
        <b class="sh1" data-lang-en="Premier Seaview Room" 
       data-lang-es="Habitación Premier con Vista al Mar" 
       data-lang-fr="Chambre Premier avec Vue sur la Mer" 
       data-lang-de="Premier Zimmer mit Meerblick" 
       data-lang-zh="尊享海景房" 
       data-lang-jp="プレミア シービュー ルーム" 
       data-lang-ru="Номер Премьер с видом на море" 
       data-lang-it="Camera Premier Vista Mare" 
       data-lang-pt="Quarto Premier com Vista para o Mar" 
       data-lang-ar="غرفة بريميير بإطلالة على البحر">Premier Seaview Room
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
    </div>
    <div class="product">
      <picture>
        <img src="../img/d4.jpg" alt="Go Island Hopping">
      </picture>
      <div class="detail">
        <p>
        <b class="sh1" data-lang-en="Premier Family Seaview Room" 
       data-lang-es="Habitación Familiar Premier con Vista al Mar" 
       data-lang-fr="Chambre Familiale Premier avec Vue sur la Mer" 
       data-lang-de="Premier Familienzimmer mit Meerblick" 
       data-lang-zh="尊享家庭海景房" 
       data-lang-jp="プレミア ファミリー シービュー ルーム" 
       data-lang-ru="Семейный Номер Премьер с видом на море" 
       data-lang-it="Camera Familiare Premier Vista Mare" 
       data-lang-pt="Quarto Familiar Premier com Vista para o Mar" 
       data-lang-ar="غرفة عائلية بريميير بإطلالة على البحر">Premier Family Seaview Room
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
    </div>


    <div class="product">
      <picture>
        <img src="../img/d1.jpg"  alt="Zipline in Boracay" class="clickable-image">
      </picture>
      <div class="detail">
        <p>
        <b class="sh1" 
    data-lang-en="Deluxe Room" 
    data-lang-es="Habitación Deluxe" 
    data-lang-fr="Chambre de Luxe" 
    data-lang-de="Deluxe-Zimmer" 
    data-lang-zh="豪华客房" 
    data-lang-jp="デラックスルーム" 
    data-lang-ru="Делюкс номер" 
    data-lang-it="Camera Deluxe" 
    data-lang-pt="Quarto Deluxe" 
    data-lang-ar="غرفة ديلوكس">
    <a href="../include/boracayresto.php">Deluxe Room</a>
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
    </div>
    <div class="product">
      <picture>
        <img src="../img/d2.jpg" alt="Kite Surf on Bulabog Beach" class="clickable-image">
      </picture>
      <div class="detail">
        <p>
        <b class="sh1" data-lang-en="Deluxe Seaview Room" 
       data-lang-es="Habitación Deluxe con Vista al Mar" 
       data-lang-fr="Chambre Deluxe avec Vue sur la Mer" 
       data-lang-de="Deluxe Zimmer mit Meerblick" 
       data-lang-zh="豪华海景房" 
       data-lang-jp="デラックス シービュー ルーム" 
       data-lang-ru="Номер Делюкс с видом на море" 
       data-lang-it="Camera Deluxe Vista Mare" 
       data-lang-pt="Quarto Deluxe com Vista para o Mar" 
       data-lang-ar="غرفة ديلوكس بإطلالة على البحر">Deluxe Seaview Room
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
    </div>
    <div class="product">
      <picture>
        <img src="../img/d3.jpg" alt="Ride the Zorb"  class="clickable-image">
      </picture>
      <div class="detail">
        <p>
        <b class="sh1" data-lang-en="Premier Seaview Room" 
       data-lang-es="Habitación Premier con Vista al Mar" 
       data-lang-fr="Chambre Premier avec Vue sur la Mer" 
       data-lang-de="Premier Zimmer mit Meerblick" 
       data-lang-zh="尊享海景房" 
       data-lang-jp="プレミア シービュー ルーム" 
       data-lang-ru="Номер Премьер с видом на море" 
       data-lang-it="Camera Premier Vista Mare" 
       data-lang-pt="Quarto Premier com Vista para o Mar" 
       data-lang-ar="غرفة بريميير بإطلالة على البحر">Premier Seaview Room
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
    </div>
    <div class="product">
      <picture>
        <img src="../img/d4.jpg" alt="Go Island Hopping">
      </picture>
      <div class="detail">
        <p>
        <b class="sh1" data-lang-en="Premier Family Seaview Room" 
       data-lang-es="Habitación Familiar Premier con Vista al Mar" 
       data-lang-fr="Chambre Familiale Premier avec Vue sur la Mer" 
       data-lang-de="Premier Familienzimmer mit Meerblick" 
       data-lang-zh="尊享家庭海景房" 
       data-lang-jp="プレミア ファミリー シービュー ルーム" 
       data-lang-ru="Семейный Номер Премьер с видом на море" 
       data-lang-it="Camera Familiare Premier Vista Mare" 
       data-lang-pt="Quarto Familiar Premier com Vista para o Mar" 
       data-lang-ar="غرفة عائلية بريميير بإطلالة على البحر">Premier Family Seaview Room
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
          <span class="span2">&#139;</span>
          <span class="span2">&#155;</span>
        </p>
      </header>
      <p class="p2">Discover the Paradise: Explore the Philippines with us!!</p>
      <section class="section6">
        <!-- Nalka Seafood Restaurant -->
        <div class="product">
          <picture>
            <img src="../img/v2.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Vintana Asian Café" 
       data-lang-es="Vintana Café Asiático" 
       data-lang-fr="Vintana Café Asiatique" 
       data-lang-de="Vintana Asiatisches Café" 
       data-lang-zh="Vintana 亚洲咖啡馆" 
       data-lang-jp="ヴィンタナ アジアンダイニング カフェ" 
       data-lang-ru="Винтана Азиатское Кафе" 
       data-lang-it="Vintana Caffè Asiatica" 
       data-lang-pt="Vintana Café Asiático" 
       data-lang-ar="فينتانا كافيه آسيوي">Vintana Asian Café
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

        <!-- Café Maruja -->
        <div class="product">
          <picture>
          <img src="../img/v3.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Cielo Poolside Restaurant & Bar" 
       data-lang-es="Cielo Restaurante y Bar junto a la Piscina" 
       data-lang-fr="Cielo Restaurant et Bar au Bord de la Piscine" 
       data-lang-de="Cielo Poolside Restaurant & Bar" 
       data-lang-zh="Cielo 游泳池旁餐厅与酒吧" 
       data-lang-jp="シエロ プールサイド レストラン＆バー" 
       data-lang-ru="Cielo Ресторан и Бар у Бассейна" 
       data-lang-it="Cielo Ristorante e Bar a Bordo Piscina" 
       data-lang-pt="Cielo Restaurante e Bar à Beira da Piscina" 
       data-lang-ar="سيويلو مطعم وبار بجانب المسبح">Cielo Poolside Restaurant & Bar
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

        <!-- Café del Sol -->
        <div class="product">
          <picture>
          <img src="../img/v5.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Sirena Seafood Restaurant and Clifftop Bar" 
       data-lang-es="Restaurante Sirena de Mariscos y Bar en la Cima del Acantilado" 
       data-lang-fr="Restaurant Sirena Fruits de Mer et Bar au Sommet de la Falaise" 
       data-lang-de="Sirena Seafood Restaurant und Clifftop Bar" 
       data-lang-zh="Sirena 海鲜餐厅与悬崖顶酒吧" 
       data-lang-jp="シレナ シーフード レストラン＆クリフトップ バー" 
       data-lang-ru="Ресторан морепродуктов Sirena и Бар на Вершине Утеса" 
       data-lang-it="Ristorante di Frutti di Mare Sirena e Bar sulla Sommità della Scogliera" 
       data-lang-pt="Restaurante de Frutos do Mar Sirena e Bar no Topo da Falésia" 
       data-lang-ar="مطعم سيرينا للمأكولات البحرية وبار قمة الجرف">Sirena Seafood Restaurant and Clifftop Bar
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

        <!-- Barlo Restaurant -->
        <div class="product">
          <picture>
          <img src="../img/v6.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Rima Mediterranean Treetop Dining" 
       data-lang-es="Rima Comedor Mediterráneo en las Copas de los Árboles" 
       data-lang-fr="Rima Dîner Méditerranéen dans les Arbres" 
       data-lang-de="Rima Mediterranes Essen in den Baumkronen" 
       data-lang-zh="Rima 地中海树顶餐厅" 
       data-lang-jp="リマ 地中海のツリートップ ダイニング" 
       data-lang-ru="Rima Средиземноморский Ужин на Вершине Деревьев" 
       data-lang-it="Rima Cena Mediterranea tra gli Alberi" 
       data-lang-pt="Rima Jantar Mediterrâneo nas Copas das Árvores" 
       data-lang-ar="ريما عشاء البحر الأبيض المتوسط في قمة الأشجار">Rima Mediterranean Treetop Dining
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
            <img src="../img/v2.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Vintana Asian Café" 
       data-lang-es="Vintana Café Asiático" 
       data-lang-fr="Vintana Café Asiatique" 
       data-lang-de="Vintana Asiatisches Café" 
       data-lang-zh="Vintana 亚洲咖啡馆" 
       data-lang-jp="ヴィンタナ アジアンダイニング カフェ" 
       data-lang-ru="Винтана Азиатское Кафе" 
       data-lang-it="Vintana Caffè Asiatica" 
       data-lang-pt="Vintana Café Asiático" 
       data-lang-ar="فينتانا كافيه آسيوي">Vintana Asian Café
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

        <!-- Café Maruja -->
        <div class="product">
          <picture>
          <img src="../img/v3.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Cielo Poolside Restaurant & Bar" 
       data-lang-es="Cielo Restaurante y Bar junto a la Piscina" 
       data-lang-fr="Cielo Restaurant et Bar au Bord de la Piscine" 
       data-lang-de="Cielo Poolside Restaurant & Bar" 
       data-lang-zh="Cielo 游泳池旁餐厅与酒吧" 
       data-lang-jp="シエロ プールサイド レストラン＆バー" 
       data-lang-ru="Cielo Ресторан и Бар у Бассейна" 
       data-lang-it="Cielo Ristorante e Bar a Bordo Piscina" 
       data-lang-pt="Cielo Restaurante e Bar à Beira da Piscina" 
       data-lang-ar="سيويلو مطعم وبار بجانب المسبح">Cielo Poolside Restaurant & Bar
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

        <!-- Café del Sol -->
        <div class="product">
          <picture>
          <img src="../img/v5.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Sirena Seafood Restaurant and Clifftop Bar" 
       data-lang-es="Restaurante Sirena de Mariscos y Bar en la Cima del Acantilado" 
       data-lang-fr="Restaurant Sirena Fruits de Mer et Bar au Sommet de la Falaise" 
       data-lang-de="Sirena Seafood Restaurant und Clifftop Bar" 
       data-lang-zh="Sirena 海鲜餐厅与悬崖顶酒吧" 
       data-lang-jp="シレナ シーフード レストラン＆クリフトップ バー" 
       data-lang-ru="Ресторан морепродуктов Sirena и Бар на Вершине Утеса" 
       data-lang-it="Ristorante di Frutti di Mare Sirena e Bar sulla Sommità della Scogliera" 
       data-lang-pt="Restaurante de Frutos do Mar Sirena e Bar no Topo da Falésia" 
       data-lang-ar="مطعم سيرينا للمأكولات البحرية وبار قمة الجرف">Sirena Seafood Restaurant and Clifftop Bar
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

        <!-- Barlo Restaurant -->
        <div class="product">
          <picture>
          <img src="../img/v6.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Rima Mediterranean Treetop Dining" 
       data-lang-es="Rima Comedor Mediterráneo en las Copas de los Árboles" 
       data-lang-fr="Rima Dîner Méditerranéen dans les Arbres" 
       data-lang-de="Rima Mediterranes Essen in den Baumkronen" 
       data-lang-zh="Rima 地中海树顶餐厅" 
       data-lang-jp="リマ 地中海のツリートップ ダイニング" 
       data-lang-ru="Rima Средиземноморский Ужин на Вершине Деревьев" 
       data-lang-it="Rima Cena Mediterranea tra gli Alberi" 
       data-lang-pt="Rima Jantar Mediterrâneo nas Copas das Árvores" 
       data-lang-ar="ريما عشاء البحر الأبيض المتوسط في قمة الأشجار">Rima Mediterranean Treetop Dining
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
            <img src="../img/v2.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Vintana Asian Café" 
       data-lang-es="Vintana Café Asiático" 
       data-lang-fr="Vintana Café Asiatique" 
       data-lang-de="Vintana Asiatisches Café" 
       data-lang-zh="Vintana 亚洲咖啡馆" 
       data-lang-jp="ヴィンタナ アジアンダイニング カフェ" 
       data-lang-ru="Винтана Азиатское Кафе" 
       data-lang-it="Vintana Caffè Asiatica" 
       data-lang-pt="Vintana Café Asiático" 
       data-lang-ar="فينتانا كافيه آسيوي">Vintana Asian Café
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

        <!-- Café Maruja -->
        <div class="product">
          <picture>
          <img src="../img/v3.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Cielo Poolside Restaurant & Bar" 
       data-lang-es="Cielo Restaurante y Bar junto a la Piscina" 
       data-lang-fr="Cielo Restaurant et Bar au Bord de la Piscine" 
       data-lang-de="Cielo Poolside Restaurant & Bar" 
       data-lang-zh="Cielo 游泳池旁餐厅与酒吧" 
       data-lang-jp="シエロ プールサイド レストラン＆バー" 
       data-lang-ru="Cielo Ресторан и Бар у Бассейна" 
       data-lang-it="Cielo Ristorante e Bar a Bordo Piscina" 
       data-lang-pt="Cielo Restaurante e Bar à Beira da Piscina" 
       data-lang-ar="سيويلو مطعم وبار بجانب المسبح">Cielo Poolside Restaurant & Bar
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

        <!-- Café del Sol -->
        <div class="product">
          <picture>
          <img src="../img/v5.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Sirena Seafood Restaurant and Clifftop Bar" 
       data-lang-es="Restaurante Sirena de Mariscos y Bar en la Cima del Acantilado" 
       data-lang-fr="Restaurant Sirena Fruits de Mer et Bar au Sommet de la Falaise" 
       data-lang-de="Sirena Seafood Restaurant und Clifftop Bar" 
       data-lang-zh="Sirena 海鲜餐厅与悬崖顶酒吧" 
       data-lang-jp="シレナ シーフード レストラン＆クリフトップ バー" 
       data-lang-ru="Ресторан морепродуктов Sirena и Бар на Вершине Утеса" 
       data-lang-it="Ristorante di Frutti di Mare Sirena e Bar sulla Sommità della Scogliera" 
       data-lang-pt="Restaurante de Frutos do Mar Sirena e Bar no Topo da Falésia" 
       data-lang-ar="مطعم سيرينا للمأكولات البحرية وبار قمة الجرف">Sirena Seafood Restaurant and Clifftop Bar
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

        <!-- Barlo Restaurant -->
        <div class="product">
          <picture>
          <img src="../img/v6.jpg" alt="Nalka Seafood Restaurant"  class="clickable-image">
          </picture>
          <div class="detail">
            <p>
            <b class="sh1" data-lang-en="Rima Mediterranean Treetop Dining" 
       data-lang-es="Rima Comedor Mediterráneo en las Copas de los Árboles" 
       data-lang-fr="Rima Dîner Méditerranéen dans les Arbres" 
       data-lang-de="Rima Mediterranes Essen in den Baumkronen" 
       data-lang-zh="Rima 地中海树顶餐厅" 
       data-lang-jp="リマ 地中海のツリートップ ダイニング" 
       data-lang-ru="Rima Средиземноморский Ужин на Вершине Деревьев" 
       data-lang-it="Rima Cena Mediterranea tra gli Alberi" 
       data-lang-pt="Rima Jantar Mediterrâneo nas Copas das Árvores" 
       data-lang-ar="ريما عشاء البحر الأبيض المتوسط في قمة الأشجار">Rima Mediterranean Treetop Dining
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

        <!-- Los Indios Bravos -->
        
      </section>


    </main>


    <main>

      <header>
      <h1 data-lang-en="Sports & Recreation" 
    data-lang-es="Deportes y Recreación" 
    data-lang-fr="Sports et Loisirs" 
    data-lang-de="Sport und Freizeit" 
    data-lang-zh="体育与娱乐" 
    data-lang-jp="スポーツ＆レクリエーション" 
    data-lang-ru="Спорт и Развлечения" 
    data-lang-it="Sport e Ricreazione" 
    data-lang-pt="Esportes e Recreação" 
    data-lang-ar="الرياضة والترفيه"><i class="bx bx-home icon" style="color: red;"></i>Sports & Recreation</h1>

        <p>
          <span class="span4">&#139;</span>
          <span class="span4">&#155;</span>

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