<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://unpkg.com/boxicons/css/boxicons.min.css" rel="stylesheet">

<?php
require_once '../connect/dbcon.php';

// Fetch new notifications for the logged-in user only
$user_id = $_SESSION['id'];  // Get the current logged-in user's ID
$query = "SELECT name, created_at, status, read_status FROM notifications WHERE user_id = :user_id ORDER BY created_at DESC";


$stmt = $pdoConnect->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);  // Bind user_id to the query
$stmt->execute();
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
  .notification-icon {
    font-size: 24px;
    margin-left: 50px;
    color: #007bff;
    cursor: pointer;
    position: relative;
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
    background-color: #fff;
    color: black;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 15px;
    max-width: 300px;
    position: absolute;
    left: 435px;
    top: 10px;
    max-height: 300px;
    overflow-y: auto;
  }

  .notification-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .notification-item {
    margin-bottom: 10px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
  }

  .notification-item:last-child {
    border-bottom: none;
  }

  .notification-title {
    font-weight: bold;
    color: #333;
  }

  .notification-text {
    color: #555;
    font-size: 14px;
  }

  .notification-text span {
    font-weight: bold;
  }

  .notification-item.unread {
    background-color: #f0f8ff;
    /* Light color for unread notifications */
    font-weight: bold;
  }

  .notification-item.read {
    background-color: #ffffff;
    font-weight: normal;
  }

  /* Dark Mode Styles */
  .dark-mode {
    background: #000000;
    /* Dark background */
  }

  .dark-mode .logo .menu-icon,
  .dark-mode .nav-link .icon,
  .dark-mode .notification-icon {
    color: #ffffff;
    /* Dark mode icon color */
  }

  .dark-mode .logo .logo-name,
  .dark-mode .nav-link .link,
  .dark-mode .profile span,
  .dark-mode .language {
    color: #f3f3f3;
    /* Dark mode text color */
  }

  .dark-mode .sidebar {
    background-color: #000000;
    /* Dark mode sidebar */
  }

  .dark-mode .lists .nav-link:hover {
    background-color: #6f90eb;
    /* Dark mode hover color */
  }

  .dark-mode .notification-container,
  .dark-mode .dropdown-content {
    background-color: #333333;
    /* Dark mode background for dropdowns */
    color: #f3f3f3;
    /* Dark mode dropdown text color */
  }

  #darkModeToggle {
    position: absolute;
    margin-left: 1300px;
    bottom: 15px;
    margin-bottom: 2px;
    border-radius: 50%;
    background-color: #4caf50;
    border: none;
    color: white;
    width: 40px;
    /* Set the width */
    height: 40px;
    /* Set the height */
    display: inline-flex;
    justify-content: center;
    align-items: center;
    font-size: 18px;
    /* Adjust font size to make the icon smaller */
    padding: 5px;
    /* Adjust padding to control the inner spacing */
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
      <option value="en">🇺🇸 English</option>
      <option value="es">🇪🇸 Spanish</option>
      <option value="fr">🇫🇷 French</option>
      <option value="de">🇩🇪 German</option>
      <option value="zh">🇨🇳 Chinese</option>
      <option value="jp">🇯🇵 Japanese</option>
      <option value="ru">🇷🇺 Russian</option>
      <option value="it">🇮🇹 Italian</option>
      <option value="pt">🇵🇹 Portuguese</option>
      <option value="ar">🇸🇦 Arabic</option>
    </select>
  </div>

  <?php
  $unreadCount = 0;
  foreach ($notifications as $notification) {
    if ($notification['read_status'] == 0) {
      $unreadCount++;
    }
  }
  ?>
  <span class="notification-icon" onclick="toggleNotifications()" aria-expanded="false"
    aria-controls="notificationContainer">
    <i class="fas fa-bell"></i>
    <?php if ($unreadCount > 0): ?>
      <span class="notification-badge"><?php echo $unreadCount; ?></span>
    <?php endif; ?>
  </span>

  </div>

  <div class="notification-container" id="notificationContainer">
    <h3>Notifications</h3>
    <?php if (empty($notifications)): ?>
      <p>No new notifications at the moment.</p>
    <?php else: ?>
      <ul class="notification-list">
        <?php foreach ($notifications as $notification): ?>
          <li class="notification-item <?php echo $notification['read_status'] == 0 ? 'unread' : 'read'; ?>">
            <div class="notification-title"><?php echo htmlspecialchars($notification['name']); ?></div>
            <div class="notification-text">
              <span>Date:</span> <?php echo htmlspecialchars($notification['created_at']); ?><br>
              <?php if (!empty($notification['status'])): ?>
                <span>Status:</span> <?php echo htmlspecialchars($notification['status']); ?>
              <?php endif; ?>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>

  <script>
    function toggleNotifications() {
      var container = document.getElementById('notificationContainer');
      var badge = document.querySelector('.notification-badge'); // Select the badge
      var isExpanded = container.style.display === 'block';

      container.style.display = isExpanded ? 'none' : 'block';

      // Hide the badge when notifications are displayed
      if (!isExpanded) {
        badge.style.display = 'none'; // Hide the badge

        // AJAX call to mark notifications as read
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "mark_notifications_read.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(); // You can send any additional data if necessary
      }

      // Update aria-expanded attribute 
      document.querySelector('.notification-icon').setAttribute('aria-expanded', !isExpanded);
    }
  </script>

  <div class="profile">
    <span id="name-span"><?php echo htmlspecialchars($full_name); ?></span>
    <div class="dropdown">
      <img src="<?php echo $profile_image; ?>" alt="Profile Picture" class="user">
      <div class="dropdown-content">
        <a href="profile.php">Profile</a>
        <a href="../include/logout.php">Logout</a>
      </div>
    </div>
  </div>

  <button onclick="toggleDarkMode()" id="darkModeToggle">
    <i class="fas fa-moon" id="toggleIcon"></i>
  </button>

  <script src="../js/darkmode.js"></script>


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
          <a href="../include/place.php" class="nav-link">
            <i class="bx bx-map icon"></i>
            <span class="link" data-lang-en="Place" data-lang-es=" Lugar" data-lang-fr="Lieu" data-lang-de="Ort"
              data-lang-zh="地点" data-lang-jp="場所 (Basho)" data-lang-ru=" Место" data-lang-it="Luogo"
              data-lang-pt="Local" data-lang-ar="الفئات">Place</span>
          </a>
        </li>
        <li class="list">
          <a href="../include/marketplace.php" class="nav-link">
            <i class="bx bx-cart icon"></i>
            <span class="link" data-lang-en="Marketplace" data-lang-es="Mercado" data-lang-fr="Marché"
              data-lang-de="Marktplatz" data-lang-zh=" 市场" data-lang-jp="マーケットプレイス " data-lang-ru="Торговая площадка"
              data-lang-it="Mercato" data-lang-pt="Mercado" data-lang-ar="السوق">Marketplace</span>
          </a>
        </li>
        <li class="list">
          <a href="../social/social.php" class="nav-link">
            <i class="bx bx-camera icon"></i>
            <span class="link" data-lang-en="Social Media" data-lang-es=" Redes sociales" data-lang-fr="Médias sociaux"
              data-lang-de="Soziale Medien" data-lang-zh="社交媒体" data-lang-jp="ソーシャルメディア" data-lang-ru="Социальные сети"
              data-lang-it="Social Media" data-lang-pt="Mídias Sociais" data-lang-ar="وسائل التواصل الاجتماعي">Social
              Media</span>
          </a>
        </li>
        <li class="list">
          <a href="../include/whether.php" class="nav-link">
            <i class="bx bx-cloud icon"></i>
            <span class="link" data-lang-en="Weather Forecast" data-lang-es=" Pronóstico del tiempo"
              data-lang-fr="Prévisions météorologiques" data-lang-de="Wettervorhersage" data-lang-zh="天气预报"
              data-lang-jp="天気予報 (Tenki Yohō)" data-lang-ru="Прогноз погоды" data-lang-it="Previsioni del tempo"
              data-lang-pt="Previsão do Tempo" data-lang-ar="توقعات الطقس">Weather Forecast</span>
          </a>
        </li>
        <li class="list">
          <a href="../include/itenerary.php" class="nav-link">
            <i class="bx bx-note icon"></i>
            <span class="link" data-lang-en="My Itinerary" data-lang-es="Mi itinerario" data-lang-fr="Mon itinéraire"
              data-lang-de="Meine Reiseroute" data-lang-zh="我的行程" data-lang-jp="私の旅程 (Watashi no Ritei)"
              data-lang-ru="Мой маршрут" data-lang-it="Il mio itinerario" data-lang-pt="Meu Itinerário"
              data-lang-ar="مسار رحلتي">My Itinerary</span>
          </a>
        </li>
        <li class="list">
          <a href="../include/categories.php" class="nav-link">
            <i class="bx bx-menu icon"></i>
            <span class="link" data-lang-en="Categories" data-lang-es="Categorías" data-lang-fr="d'accueil"
              data-lang-de="Kategorien" data-lang-zh="分类" data-lang-jp="カテゴリ (Kategori)" data-lang-ru=" Категории"
              data-lang-it="Categorie" data-lang-pt="Categorias" data-lang-ar="الفئات">Booking History</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>