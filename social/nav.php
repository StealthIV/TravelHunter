<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


<style>
  .notification-icon {
    font-size: 24px;
    margin-left: 50px;
    color: #007bff;
    cursor: pointer;
    position: relative;
    /* To position the notification badge */
  }

  .notification-badge {
    position: absolute;
    top: -5px;
    right: -10px;
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 12px;
  }

  .notification-container {
    display: none;
    /* Hide notifications by default */
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    max-width: 600px;
    margin: 10px auto;
  }
</style>

<nav>
  <div class="logo">
    <i class="bx bx-menu menu-icon"></i>
    <span class="logo-name" data-lang-en="Travel Hunter" data-lang-es="Cazador de viajes"
      data-lang-fr="Chasseur de voyages" data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
      data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi" data-lang-pt="Caçador de viagens"
      data-lang-ar="صياد السفر">TravelHunter</span>

      
    <select class="language" id="language-select" onchange="changeLanguage()">
      <option value="en">English</option>
      <option value="es">Spanish</option>
      <option value="fr">French</option>
      <option value="de">German</option>
      <option value="zh">Chinese</option>
      <option value="jp">Japanese</option>
      <option value="ru">Russian</option>
      <option value="it">Italian</option>
      <option value="pt">Portuguese</option>
      <option value="ar">Arabic</option>
    </select>
    <div>
      <span class="notification-icon" onclick="toggleNotifications()">
        <i class="fas fa-bell"></i>
        <?php if (!empty($notifications)): ?>
          <span class="notification-badge"><?php echo count($notifications); ?></span>
        <?php endif; ?>
      </span>
      
    </div>
    
  
    <div class="notification-container" id="notificationContainer">
      <h2>New Booking Requests</h2>
      <?php if (empty($notifications)): ?>
        <p>No new bookings at the moment.</p>
      <?php else: ?>
        <ul>
          <?php foreach ($notifications as $notification): ?>
            <li>
              <strong>Booking ID:</strong> <?php echo htmlspecialchars($notification['id']); ?><br>
              <strong>Name:</strong> <?php echo htmlspecialchars($notification['name']); ?><br>
              <strong>Date:</strong> <?php echo htmlspecialchars($notification['booking_date']); ?><br>
              <strong>Status:</strong> <?php echo htmlspecialchars($notification['status']); ?><br>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>

    <script>
      function toggleNotifications() {
        var container = document.getElementById('notificationContainer');
        container.style.display = (container.style.display === 'none' || container.style.display === '') ? 'block' : 'none';
      }
    </script>



    <div class="profile">
      <span id="name-span"><?php echo htmlspecialchars($first_name); ?></span>
      <div class="dropdown">
        <img src="<?php echo $profile_image; ?>" alt="Profile Picture" class="user">
        <div class="dropdown-content">
          <a href="profile.php">Profile</a>
          

          <a href="logout.php">Logout</a>
        </div>
      </div>
    </div>



    <div class="sidebar">
      <div class="logo">
        <i class="bx bx-menu menu-icon"></i>
        <span class="logo-name" data-lang-en="Travel Hunter" data-lang-es="Cazador de viajes"
          data-lang-fr="Chasseur de voyages" data-lang-de="Reisejäger" data-lang-zh="旅行猎人" data-lang-jp="トラベルハンター"
          data-lang-ru="Охотник за путешествиями" data-lang-it="Cacciatore di viaggi" data-lang-pt="Caçador de viagens"
          data-lang-ar="صياد السفر">TravelHunter</span>
      </div>

      <div class="bottom-content">
        <ul class="lists">
          <li class="list">
            <a href="../include/home.php" class="nav-link">
              <i class="bx bx-home-alt icon"></i>
              <span class="link" data-lang-en="Home" data-lang-es=" Inicio" data-lang-fr="d'accueil"
                data-lang-de=" Startseite" data-lang-zh="首页" data-lang-jp="ホーム (Hōmu)ー" data-lang-ru="Главная"
                data-lang-it=" Home" data-lang-pt="Início" data-lang-ar="الصفحة الرئيسية">Home</span>
            </a>
          </li>
          <li class="list">
            <a href="../include/categories.php" class="nav-link">
              <i class="bx bx-menu icon"></i>
              <span class="link" data-lang-en="Categories" data-lang-es="Categorías" data-lang-fr="d'accueil"
                data-lang-de="Kategorien" data-lang-zh="分类" data-lang-jp="カテゴリ (Kategori)" data-lang-ru=" Категории"
                data-lang-it="Categorie" data-lang-pt="Categorias" data-lang-ar="الفئات">Categories</span>
            </a>
          </li>
          <li class="list">
            <a href="../include/place.php" class="nav-link">
              <i class="bx bx-map icon"></i>
              <span class="link" data-lang-en="Place" data-lang-es=" Lugar" data-lang-fr="Lieu" data-lang-de="Ort"
                data-lang-zh="地点" data-lang-jp="場所 (Basho)" data-lang-ru=" Место" data-lang-it="Luogo"
                data-lang-pt="Local" data-lang-ar="الفئات">Place</span>
            </a>
          </li>
          <li class="list">
            <a href="../include/marketplace.php" class="nav-link">
              <i class="bx bx-gift icon"></i>
              <span class="link" data-lang-en="Marketplace" data-lang-es="Mercado" data-lang-fr="Marché"
                data-lang-de="Marktplatz" data-lang-zh=" 市场" data-lang-jp="マーケットプレイス " data-lang-ru="Торговая площадка"
                data-lang-it="Mercato" data-lang-pt="Mercado" data-lang-ar="السوق">Marketplace</span>
            </a>
          </li>
          <li class="list">
            <a href="../social/social.php" class="nav-link">
              <i class="bx bx-camera icon"></i>
              <span class="link" data-lang-en="Social Media" data-lang-es=" Redes sociales"
                data-lang-fr="Médias sociaux" data-lang-de="Soziale Medien" data-lang-zh="社交媒体" data-lang-jp="ソーシャルメディア"
                data-lang-ru="Социальные сети" data-lang-it="Social Media" data-lang-pt="Mídias Sociais"
                data-lang-ar="وسائل التواصل الاجتماعي">Social Media</span>
            </a>
          </li>
          <li class="list">
            <a href="../include/whether.php" class="nav-link">
              <i class="bx bx-cloud icon"></i>
              <span class="link" data-lang-en="Whether Forecast" data-lang-es=" Pronóstico del tiempo"
                data-lang-fr="Prévisions météorologiques" data-lang-de="Wettervorhersage" data-lang-zh="天气预报"
                data-lang-jp="天気予報 (Tenki Yohō)" data-lang-ru="Прогноз погоды" data-lang-it="Previsioni del tempo"
                data-lang-pt="Previsão do Tempo" data-lang-ar="توقعات الطقس">Whether Forecast</span>
            </a>
          </li>
          <li class="list">
            <a href="../include/itenerary.html" class="nav-link">
              <i class="bx bx-note icon"></i>
              <span class="link" data-lang-en="My Itinerary" data-lang-es="Mi itinerario" data-lang-fr="Mon itinéraire"
                data-lang-de="Meine Reiseroute" data-lang-zh="我的行程" data-lang-jp="私の旅程 (Watashi no Ritei)"
                data-lang-ru="Мой маршрут" data-lang-it="Il mio itinerario" data-lang-pt="Meu Itinerário"
                data-lang-ar="مسار رحلتي">My Itinerary</span>
            </a>
          </li>
        </ul>


      </div>
    </div>
  </div>
</nav>