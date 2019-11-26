<?php
session_start();

include_once("functions/montage.php");

$montages = get_all_montage();
?>
<!DOCTYPE html>
<HTML>
  <header>
    <link rel="stylesheet" type="text/css" href="style/gallery.css">
    <meta charset="UTF-8">
    <title>CAMAGRU - gallery</title>
  </header>
  <body>
    <?php include('ligma/header.php') ?>
      <div class="body">
        <?php if(isset($_SESSION['id'])) { ?>
        <div class="main">
    		  <div class="select">
      			<img class="thumbnail" src="img/cadre.png"></img>
      			<input id="cadre.png" type="radio" name="img" value="./img/cadre.png" onclick="onCheckBoxChecked(this)">
      			<img class="thumbnail" src="img/dragon.png"></img>
      			<input id="dragon.png" type="radio" name="img" value="./img/dragon.png" onclick="onCheckBoxChecked(this)">
      			<img class="thumbnail" src="img/hat.png"></img>
      			<input id="hat.png" type="radio" name="img" value="./img/hat.png" onclick="onCheckBoxChecked(this)">
            <img class="thumbnail" src="img/dio.png"></img>
      			<input id="dio.png" type="radio" name="img" value="./img/dio.png" onclick="onCheckBoxChecked(this)">
            <img class="thumbnail" src="img/heaven.png"></img>
      			<input id="heaven.png" type="radio" name="img" value="./img/heaven.png" onclick="onCheckBoxChecked(this)">
    		  </div>
          <video class="cam" id="video" playsinline autoplay></video>
          <!-- <button class="butts" id="snap">capture</button> -->
          <img id="hat" style="display:none;" src="img/hat.png"></img>
          <img id="dragon" style="display:none;" src="img/dragon.png"></img>
          <img id="cadre" style="display:none;" src="img/cadre.png"></img>
          <img id="dio" style="display:none;" src="img/dio.png"></img>
          <img id="heaven" style="display:none;" src="img/heaven.png"></img>
    		  <div class="capture" id="pickImage">
            <img class="camera" src="img/camera.png"></img>
          </div>
          <canvas id="canvas" style="display:none;" width="640" height="480"></canvas>
          <div class="captureFile" id="pickFile">
            <img class="camera" src="img/camera.png"></img>
          </div>
          <input type="file" id="take-picture" style="display:none;" accept="image/*">
        </div>
        <div class="side">
			<div class="title">Montages</div>
      <div id="miniatures">
        <?php
          $gallery = "";
          if ($montages != null) {
            for ($i = 0; $montages[$i] ; $i++) {
              $class = "icon";
              if ($montages[$i]['userid'] === $_SESSION['id']) {
                $class .= " removable";
              }
              $gallery .= "<img class=\"" . $class . "\" src=\"./montage/" . $montages[$i]['img'] . "\" data-userid=\"" . $montages[$i]['userid'] . "\"></img>";
            }
            echo $gallery;
          }
        ?>
      </div>
		</div>
        <?php } else { ?>
          You need to connect to use the gallery
        <?php } ?>
      </div>
    <?php include('ligma/footer.php') ?>
  </body>
  <?php if(isset($_SESSION['id'])) { ?>
  <script type="text/javascript" src="js/webcam.js"></script>
  <script type="text/javascript" src="js/drop.js"></script>
  <script type="text/javascript" src="js/import.js"></script>
  <?php } ?>
</HTML>