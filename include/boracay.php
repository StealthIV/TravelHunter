<?php
session_start();
if (!isset($_SESSION["UserName"])) {
  header("location: index.php");
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
    <link rel="stylesheet" href="css/swiper-bundle.min.css" />
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    
  </head>
  <body>
   <?php require_once 'nav.php'?>
    <section class="overlay"></section>

    <Section class="main">
      <div class="history">
        <div class="container">
            <div class="tour__head">
                
            </div>

            <div class="image-container"></div>
        </div>
      </div>

      <div class="main1">
         <h4>Boracay</h4>
         <p>It's more fun in Boracay Philippines!!</p>
         <button class="button" type="button" ><a href="../include/boracaybook.html">Book Now!!</a></button>
         <button class="button" ><a href="../include/boracayfeed.html">Newsfeed!!</a></button>
         <button class="button" ><a href="../include/boracayfeed.html">Offline</a></button>
  
      </div>

 
      <div class="img">
        <main>

          <div id="carousel" class="carousel">
          
             <div id='item_1' class="hideLeft">
              <img src="../pampanga/Travel Hunter - 9.png">
            </div>
          
            <div id='item_2' class="prevLeftSecond">
              <img src="../pampanga/Travel Hunter - 7.png">
            </div>
          
            <div id='item_3' class="prev">
              <img src="../pampanga/Travel Hunter - 6.png">
            </div>
          
            <div id='item_4' class="selected">
              <img src="../pampanga/Travel Hunter - 8.png">
            </div>
          
            <div id='item_5' class="next">
              <img src="../pampanga/Travel Hunter - 10.png">
            </div>
          
            <div id='item_6' class="nextRightSecond">
              <img src="../palawan/Travel Hunter - 1.png">
            </div>
          
            <div id='item_7' class="hideRight">
              <img src="../palawan/Travel Hunter - 2.png">
            </div>
          
            <div id='item_8' class="hideRight">
              <img src="../palawan/Travel Hunter - 3.png">
            </div>
          
          </div>
          
          <div class="buttons">
              <button class="button-82-pushable" role="button" id="prev"><span class="button-82-shadow"></span><span class="button-82-edge"></span></span></button>
          
          
              <button class="button-82-pushable" role="button" id="next"><span class="button-82-shadow"></span><span class="button-82-edge"></span></button>
          </div>
          
          </main>
          </div>
          
      <section class="package">
        
        <div class="container">
          <h4>Tour Packages</h4>
            <!-- Filterable Images / Cards Section -->
            <div class="row px-2 mt-4 gap-3" id="filterable-cards">
              <div class="card p-0" data-name="nature">
                <img src="../img/bpackage1.jpg" alt="img">
                <div class="card-body">
                  <h6 class="card-title">Platinum Package</h6>
                  <p class="card-text">- Hotel 6 Star or Mansion</p>
                  <p class="card-text">- Tour Guide</p>
                  <p class="card-text">- Transport</p>
                  <p class="card-text">- Destinations</p>
                  <p class="card-text">- Breakfast and Fine Dining</p>
                  <p class="card-text">- Premium Souveinirs</p>
                </div>
              </div>
              <div class="card p-0" data-name="nature">
                <img src="../img/bpackage2.jpg" alt="img">
                <div class="card-body">
                  <h6 class="card-title">Gold Package</h6>
                  <p class="card-text">- Hotel 5 Star or Standard Villa</p>
                  <p class="card-text">- Tour Guide</p>
                  <p class="card-text">- Transport</p>
                  <p class="card-text">- Destinations</p>
                  <p class="card-text">- Breakfast and Dinner</p>
                
                </div>
              </div>
              <div class="card p-0" data-name="nature">
                <img src="../img/bpackage3.jpg" alt="img">
                <div class="card-body">
                  <h6 class="card-title">Silver Package</h6>
                  <p class="card-text">- Hotel 4 Star</p>
                  <p class="card-text">- Tour Guide</p>
                  <p class="card-text">- Transport</p>
                  <p class="card-text">- Destinations</p>
                  <p class="card-text">- Breakfast</p>
                </div>
              </div>
              <div class="card p-0" data-name="nature">
                <img src="../img/bpackage4.jpg" alt="img">
                <div class="card-body">
                  <h6 class="card-title">Bronze Package</h6>
                  <p class="card-text">- Hotel 3 Star </p>
                  <p class="card-text">- Tour Guide</p>
                  <p class="card-text">- Transport</p>
                  <p class="card-text">- Destinations</p>
                  <p class="card-text">- Breakfast</p>
                </div>
              </div>
            </div>
          </div>






        <div class="container1">
            <!-- Images Filter Buttons Section -->
             <h3>Souveinirs</h3>
            <!-- Filterable Images / Cards Section -->
            <div class="row px-2 mt-4 gap-3" id="filterable-cards">
              <div class="card p-0" data-name="nature">
                <img src="../img/bags.jpg" alt="img">
                <div class="card-body">
                  <h6 class="card-title">Boracay Bags</h6>
                  <p class="card-text">Price: 500</p>
                  <button class="buy" >Buy Now!!</button>
                </div>
              </div>
              <div class="card p-0" data-name="nature">
                <img src="../img/barrelman.jpg" alt="img">
                <div class="card-body">
                  <h6 class="card-title">Barrel Man</h6>
                  <p class="card-text">Price: 300</p>
                  <button class="buy" >Buy Now!!</button>
                </div>
              </div>
              <div class="card p-0" data-name="nature">
                <img src="../img/driedmang.jpg" alt="img">
                <div class="card-body">
                  <h6 class="card-title">Dried Manggo</h6>
                  <p class="card-text">Price: 200</p>
                  <button class="buy" >Buy Now!!</button>
                </div>
              </div>
              <div class="card p-0" data-name="cars">
                <img src="../img/tshirt.jpg" alt="img">
                <div class="card-body">
                  <h6 class="card-title">Boracay T-shirts</h6>
                  <p class="card-text">Price: 250</p>
                  <button class="buy" >Buy Now!!</button>
                </div>
              </div>
              <div class="card p-0" data-name="cars">
                <img src="../img/seafoods.jpg" alt="img">
                <div class="card-body">
                  <h6 class="card-title">labster</h6>
                  <p class="card-text">Price: 500 per kg</p>
                  <button class="buy" >Buy Now!!</button>
                </div>
              </div>
              <div class="card p-0" data-name="cars">
                <img src="../img/pukashel.jpg" alt="img">
                <div class="card-body">
                  <h6 class="card-title">Boracay Puka Shells</h6>
                  <p class="card-text">Price: 150</p>
                  <button class="buy" >Buy Now!!</button>
                </div>
              </div>
              <div class="card p-0" data-name="people">
                <img src="../img/sanbottle.jpg" alt="img">
                <div class="card-body">
                  <h6 class="card-title">Sand Bottle Keychain</h6>
                  <p class="card-text">Price: 150</p>
                  <button class="buy" >Buy Now!!</button>
                </div>
              </div>
              <div class="card p-0" data-name="people">
                <img src="../img/baskets.jpg" alt="img">
                <div class="card-body">
                  <h6 class="card-title">Boracay Baskets</h6>
                  <p class="card-text">Price: 500</p>
                  <button class="buy" >Buy Now!!</button>
                </div>
              </div>
            </div>
          </div>

          <div class="maps">
            <h5>Interactive Map</h5>
            
            <div class="frame">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d35046.36441104783!2d121.90658652462383!3d11.969282395587411!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a53c2f324b4ee7%3A0xa738e81e5e6dda36!2sBoracay!5e1!3m2!1sen!2sph!4v1724036916060!5m2!1sen!2sph" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
          <div class="loc">
            
             <h6>Here are more bits about Boracay.</h6><br>
             <i class="bx bx-map icon"><span class="sp"></span><span class="text">Location: </span> Boracay is within the municipality of Malay, province of Aklan in the Philippines. Mainland Aklan is part of Panay Island.</i>
             <i class="bx bx-flag icon"><span class="sp"></span><span class="text">Languages:</span> Aklanon and Ati are the native languages. But locals, especially those working in the tourism industry, can fluently speak and understand Tagalog and English.</i>
             <i class="bx bx-time icon"><span class="sp"></span><span class="text">Time Zone:</span> UTC+8 (Philippine Standard Time). The Philippines is in the same time zone as Singapore and Beijing, one hour ahead of Thailand, and one hour behind Japan.</i>
             <i class="bx bx-money icon"><span class="sp"></span><span class="text">Currency:</span> Philippine peso (PHP, ₱). PHP100 is around USD 1.81, EUR 1.66, SGD 2.45 (as of July 2023).</i>
             <i class="bx bx-money icon"><span class="sp"></span><span class="text">Modes of payment:</span> CASH, primarily. Some establishments accept credit cards, but most smaller stores and eateries accept only cash or GCash.
             </i><br><br>
            </div>
        </div>

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
    
   
  </body>
</html>