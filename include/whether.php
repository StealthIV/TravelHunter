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
  <link rel="stylesheet" href="../style/whether.css">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />

</head>

<body>
  <?php require_once "nav.php" ?>

  <section class="overlay"></section>

  <section class="main">
    <h1 data-lang-en="Weather Forecast"
      data-lang-es="Pronóstico del Tiempo"
      data-lang-fr="Prévisions Météorologiques"
      data-lang-de="Wettervorhersage"
      data-lang-zh="天气预报"
      data-lang-jp="天気予報"
      data-lang-ru="Прогноз Погоды"
      data-lang-it="Previsione del Tempo"
      data-lang-pt="Previsão do Tempo"
      data-lang-ar="توقعات الطقس">
      Weather Forecast
    </h1>
    <div class="container">
      <div class="weather-input">
        <h3 data-lang-en="Enter a Destination"
          data-lang-es="Ingrese un Destino"
          data-lang-fr="Entrez une Destination"
          data-lang-de="Geben Sie ein Ziel ein"
          data-lang-zh="输入目的地"
          data-lang-jp="目的地を入力してください"
          data-lang-ru="Введите Назначение"
          data-lang-it="Inserisci una Destinazione"
          data-lang-pt="Digite um Destino"
          data-lang-ar="أدخل وجهة">
          Enter a Destination
        </h3>
        <input class="city-input" type="text"
          placeholder="E.g., Batanes, Palawan, Boracay"
          data-lang-en="E.g., Batanes, Palawan, Boracay"
          data-lang-es="Por ejemplo, Batanes, Palawan, Boracay"
          data-lang-fr="Par exemple, Batanes, Palawan, Boracay"
          data-lang-de="Z.B., Batanes, Palawan, Boracay"
          data-lang-zh="例如：巴塔尼斯、巴拉望、长滩"
          data-lang-jp="例：バタンガス、パラワン、ボラカイ"
          data-lang-ru="Например, Батанс, Палаван, Борокай"
          data-lang-it="Es. Batanes, Palawan, Boracay"
          data-lang-pt="Ex.: Batanes, Palawan, Boracay"
          data-lang-ar="مثال: باتانيس، بالاوان، بوراكاي">
        <button class="search-btn"
          data-lang-en="Search"
          data-lang-es="Buscar"
          data-lang-fr="Chercher"
          data-lang-de="Suchen"
          data-lang-zh="搜索"
          data-lang-jp="検索"
          data-lang-ru="Поиск"
          data-lang-it="Cerca"
          data-lang-pt="Pesquisar"
          data-lang-ar="بحث">
          Search
        </button>
        <div class="separator"></div>
        <button class="location-btn"
          data-lang-en="Use Current Location"
          data-lang-es="Usar Ubicación Actual"
          data-lang-fr="Utiliser la Position Actuelle"
          data-lang-de="Aktuellen Standort Verwenden"
          data-lang-zh="使用当前位置"
          data-lang-jp="現在地を使用"
          data-lang-ru="Использовать Текущее Местоположение"
          data-lang-it="Usa la Posizione Corrente"
          data-lang-pt="Usar Localização Atual"
          data-lang-ar="استخدام الموقع الحالي">
          Use Current Location
        </button>
      </div>
      <div class="weather-data">
        <div class="current-weather">
          <div class="details">
            <h2>_______ ( ______ )</h2>
            <h6 data-lang-en="Temperature: __°C"
              data-lang-es="Temperatura: __°C"
              data-lang-fr="Température: __°C"
              data-lang-de="Temperatur: __°C"
              data-lang-zh="温度：__°C"
              data-lang-jp="温度：__°C"
              data-lang-ru="Температура: __°C"
              data-lang-it="Temperatura: __°C"
              data-lang-pt="Temperatura: __°C"
              data-lang-ar="درجة الحرارة: __°C">
              Temperature: __°C
            </h6>
            <h6 data-lang-en="Wind: __ M/S"
              data-lang-es="Viento: __ M/S"
              data-lang-fr="Vent: __ M/S"
              data-lang-de="Wind: __ M/S"
              data-lang-zh="风速：__ M/S"
              data-lang-jp="風速：__ M/S"
              data-lang-ru="Ветер: __ M/S"
              data-lang-it="Vento: __ M/S"
              data-lang-pt="Vento: __ M/S"
              data-lang-ar="الرياح: __ م/ث">
              Wind: __ M/S
            </h6>
            <h6 data-lang-en="Humidity: __%"
              data-lang-es="Humedad: __%"
              data-lang-fr="Humidité: __%"
              data-lang-de="Luftfeuchtigkeit: __%"
              data-lang-zh="湿度：__%"
              data-lang-jp="湿度：__%"
              data-lang-ru="Влажность: __%"
              data-lang-it="Umidità: __%"
              data-lang-pt="Umidade: __%"
              data-lang-ar="الرطوبة: __%">
              Humidity: __%
            </h6>
          </div>
        </div>
        <div class="days-forecast">
          <h2 data-lang-en="5-Day Forecast"
            data-lang-es="Pronóstico de 5 Días"
            data-lang-fr="Prévisions sur 5 Jours"
            data-lang-de="5-Tage-Vorhersage"
            data-lang-zh="五天预报"
            data-lang-jp="5日間の予報"
            data-lang-ru="5-дневный Прогноз"
            data-lang-it="Previsione a 5 Giorni"
            data-lang-pt="Previsão para 5 Dias"
            data-lang-ar="توقعات لمدة 5 أيام">
            5-Day Forecast
          </h2>
          <ul class="weather-cards">
            <li class="card">
              <h3>( ______ )</h3>
              <h6 data-lang-en="Temp: __C"
                data-lang-es="Temp: __C"
                data-lang-fr="Temp: __C"
                data-lang-de="Temp: __C"
                data-lang-zh="温度：__C"
                data-lang-jp="温度：__C"
                data-lang-ru="Температура: __C"
                data-lang-it="Temp: __C"
                data-lang-pt="Temp: __C"
                data-lang-ar="درجة الحرارة: __C">
                Temp: __C
              </h6>
              <h6 data-lang-en="Wind: __ M/S"
                data-lang-es="Viento: __ M/S"
                data-lang-fr="Vent: __ M/S"
                data-lang-de="Wind: __ M/S"
                data-lang-zh="风速：__ M/S"
                data-lang-jp="風速：__ M/S"
                data-lang-ru="Ветер: __ M/S"
                data-lang-it="Vento: __ M/S"
                data-lang-pt="Vento: __ M/S"
                data-lang-ar="الرياح: __ م/ث">
                Wind: __ M/S
              </h6>
              <h6 data-lang-en="Humidity: __%"
                data-lang-es="Humedad: __%"
                data-lang-fr="Humidité: __%"
                data-lang-de="Luftfeuchtigkeit: __%"
                data-lang-zh="湿度：__%"
                data-lang-jp="湿度：__%"
                data-lang-ru="Влажность: __%"
                data-lang-it="Umidità: __%"
                data-lang-pt="Umidade: __%"
                data-lang-ar="الرطوبة: __%">
                Humidity: __%
              </h6>
            </li>
            <li class="card">
              <h3>( ______ )</h3>
              <h6 data-lang-en="Temp: __C"
                data-lang-es="Temp: __C"
                data-lang-fr="Temp: __C"
                data-lang-de="Temp: __C"
                data-lang-zh="温度：__C"
                data-lang-jp="温度：__C"
                data-lang-ru="Температура: __C"
                data-lang-it="Temp: __C"
                data-lang-pt="Temp: __C"
                data-lang-ar="درجة الحرارة: __C">
                Temp: __C
              </h6>
              <h6 data-lang-en="Wind: __ M/S"
                data-lang-es="Viento: __ M/S"
                data-lang-fr="Vent: __ M/S"
                data-lang-de="Wind: __ M/S"
                data-lang-zh="风速：__ M/S"
                data-lang-jp="風速：__ M/S"
                data-lang-ru="Ветер: __ M/S"
                data-lang-it="Vento: __ M/S"
                data-lang-pt="Vento: __ M/S"
                data-lang-ar="الرياح: __ م/ث">
                Wind: __ M/S
              </h6>
              <h6 data-lang-en="Humidity: __%"
                data-lang-es="Humedad: __%"
                data-lang-fr="Humidité: __%"
                data-lang-de="Luftfeuchtigkeit: __%"
                data-lang-zh="湿度：__%"
                data-lang-jp="湿度：__%"
                data-lang-ru="Влажность: __%"
                data-lang-it="Umidità: __%"
                data-lang-pt="Umidade: __%"
                data-lang-ar="الرطوبة: __%">
                Humidity: __%
              </h6>
            </li>
            <li class="card">
              <h3>( ______ )</h3>
              <h6 data-lang-en="Temp: __C"
                data-lang-es="Temp: __C"
                data-lang-fr="Temp: __C"
                data-lang-de="Temp: __C"
                data-lang-zh="温度：__C"
                data-lang-jp="温度：__C"
                data-lang-ru="Температура: __C"
                data-lang-it="Temp: __C"
                data-lang-pt="Temp: __C"
                data-lang-ar="درجة الحرارة: __C">
                Temp: __C
              </h6>
              <h6 data-lang-en="Wind: __ M/S"
                data-lang-es="Viento: __ M/S"
                data-lang-fr="Vent: __ M/S"
                data-lang-de="Wind: __ M/S"
                data-lang-zh="风速：__ M/S"
                data-lang-jp="風速：__ M/S"
                data-lang-ru="Ветер: __ M/S"
                data-lang-it="Vento: __ M/S"
                data-lang-pt="Vento: __ M/S"
                data-lang-ar="الرياح: __ م/ث">
                Wind: __ M/S
              </h6>
              <h6 data-lang-en="Humidity: __%"
                data-lang-es="Humedad: __%"
                data-lang-fr="Humidité: __%"
                data-lang-de="Luftfeuchtigkeit: __%"
                data-lang-zh="湿度：__%"
                data-lang-jp="湿度：__%"
                data-lang-ru="Влажность: __%"
                data-lang-it="Umidità: __%"
                data-lang-pt="Umidade: __%"
                data-lang-ar="الرطوبة: __%">
                Humidity: __%
              </h6>
            </li>
            <li class="card">
              <h3>( ______ )</h3>
              <h6 data-lang-en="Temp: __C"
                data-lang-es="Temp: __C"
                data-lang-fr="Temp: __C"
                data-lang-de="Temp: __C"
                data-lang-zh="温度：__C"
                data-lang-jp="温度：__C"
                data-lang-ru="Температура: __C"
                data-lang-it="Temp: __C"
                data-lang-pt="Temp: __C"
                data-lang-ar="درجة الحرارة: __C">
                Temp: __C
              </h6>
              <h6 data-lang-en="Wind: __ M/S"
                data-lang-es="Viento: __ M/S"
                data-lang-fr="Vent: __ M/S"
                data-lang-de="Wind: __ M/S"
                data-lang-zh="风速：__ M/S"
                data-lang-jp="風速：__ M/S"
                data-lang-ru="Ветер: __ M/S"
                data-lang-it="Vento: __ M/S"
                data-lang-pt="Vento: __ M/S"
                data-lang-ar="الرياح: __ م/ث">
                Wind: __ M/S
              </h6>
              <h6 data-lang-en="Humidity: __%"
                data-lang-es="Humedad: __%"
                data-lang-fr="Humidité: __%"
                data-lang-de="Luftfeuchtigkeit: __%"
                data-lang-zh="湿度：__%"
                data-lang-jp="湿度：__%"
                data-lang-ru="Влажность: __%"
                data-lang-it="Umidità: __%"
                data-lang-pt="Umidade: __%"
                data-lang-ar="الرطوبة: __%">
                Humidity: __%
              </h6>
            </li>
            <li class="card">
              <h3>( ______ )</h3>
              <h6 data-lang-en="Temp: __C"
                data-lang-es="Temp: __C"
                data-lang-fr="Temp: __C"
                data-lang-de="Temp: __C"
                data-lang-zh="温度：__C"
                data-lang-jp="温度：__C"
                data-lang-ru="Температура: __C"
                data-lang-it="Temp: __C"
                data-lang-pt="Temp: __C"
                data-lang-ar="درجة الحرارة: __C">
                Temp: __C
              </h6>
              <h6 data-lang-en="Wind: __ M/S"
                data-lang-es="Viento: __ M/S"
                data-lang-fr="Vent: __ M/S"
                data-lang-de="Wind: __ M/S"
                data-lang-zh="风速：__ M/S"
                data-lang-jp="風速：__ M/S"
                data-lang-ru="Ветер: __ M/S"
                data-lang-it="Vento: __ M/S"
                data-lang-pt="Vento: __ M/S"
                data-lang-ar="الرياح: __ م/ث">
                Wind: __ M/S
              </h6>
              <h6 data-lang-en="Humidity: __%"
                data-lang-es="Humedad: __%"
                data-lang-fr="Humidité: __%"
                data-lang-de="Luftfeuchtigkeit: __%"
                data-lang-zh="湿度：__%"
                data-lang-jp="湿度：__%"
                data-lang-ru="Влажность: __%"
                data-lang-it="Umidità: __%"
                data-lang-pt="Umidade: __%"
                data-lang-ar="الرطوبة: __%">
                Humidity: __%
              </h6>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <script src="../js/home.js"></script>
  <script src="../js/index.js"></script>
  <script src="../js/darkmode.js"></script>
  <script src="../js/language.js"></script>
  <script src="../js/explore.js" defer></script>
  <script src="../js/script.js"></script>
  <script src="js/swiper-bundle.min.js"></script>
  <script src="../js/product.js"></script>
  <script src="../js/explore2.js" defer></script>
  <script src="../js/whether.js" defer></script>
  <script type="text/javascript" src="../js/fin.js"></script>
</body>

</html>