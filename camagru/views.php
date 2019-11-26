<?php
session_start();

include_once("functions/montage.php");
include_once("functions/like.php");
include_once("views.php");

$imagePerPages = 5;

$montages = get_montages(0, $imagePerPages);
$more = false;
$lastMontageId = 0;
if ($montages != "" && array_key_exists("more", $montages)) {
  $more = true;
  $lastMontageId = $montages[count($montages) - 2]['id'];
}
?>
<HTML>
  <header>
    <link rel="stylesheet" type="text/css" href="style/views.css">
    <link rel="stylesheet" type="text/css" href="style/modal.css">
    <meta charset="UTF-8">
    <title>Camagru</title>
    <script>
      function cmt()
      {
        // if (echo <?php isset($_POST['comment']) ?>)
        // {
          var element = document.createElement("div");
          element.appendChild(document.createTextNode(<?php $_SESSION['username'] ?> + ": " + <?php $_POST['comment'] ?>);
          document.getElementById("comment-box").appendChild(element);
        // }
      }
    </script>
  </header>
  <body>
    <?php include('ligma/header.php') ?>
    <div id="views">
      <?php
        $gallery = "";
        if ($montages != null && $montages['error'] == null) {
          for ($i = 0; $montages[$i] && $i < $imagePerPages; $i++) {
            $class = "icon";
            if ($montages[$i]['userid'] === $_SESSION['id']) {
              $class .= " removable";
            }
            $comments = get_comments($montages[$i]['img']);
            $j = 0;
            $commentsHTML = "";
            while ($comments[$j] != null) {
              $commentsHTML .= "<span class=\"comment\">" . htmlspecialchars($comments[$j]['username']) .": " . htmlspecialchars($comments[$j]['comment']) . "</span>";
              $j++;
            }
            $gallery .= "
            <div class=\"img\" data-img=\"" . $montages[$i]['img'] . "\">
              <img class=\"" . $class . "\" src=\"montage/" . $montages[$i]['img'] . "\"></img>
              <div id=\"buttons-like\">
                <img class=\"button-like\" src=\"img/up.png\" data-image=\"". $montages[$i]['img'] ."\"></img>
                <span class=\"nb-like\" data-src=\"". $montages[$i]['img'] ."\">" . get_nb_likes($montages[$i]['img']) . "</span>
                <img class=\"button-dislike\" src=\"img/down.png\" data-image=\"". $montages[$i]['img'] ."\"></img>
                <span class=\"nb-dislike\" data-src=\"". $montages[$i]['img'] ."\">" . get_nb_dislikes($montages[$i]['img']) . "</span>
              </div>"
              . $commentsHTML .
            "</div>";
          }
          echo $gallery;
        }
       ?>
     </div>
     <div id="modal">
      <div class="modal-content">
        <div class="modal-header">
          <span class="close">×</span>
        </div>
        <div class="modal-body">
          <img id="img-modal"></img>
        </div>
        <form class="modal-footer" action="views.php" method="POST">
          <textarea <?php if (!$_SESSION['id']) echo "disabled" ?> id="comment" name="comment" placeholder="Comment..." rows="5" cols="50" maxlength="255"></textarea>
          <button <?php if (!$_SESSION['id']) echo "disabled=\"true\"" ?> id="send-comment" onclick="cmt()" submit="OK">Send</button>
        </form>
      </div>
    </div>
    <?php if ($more == true) { ?>
    <div id="load-more" onclick="loadmore(<?php echo($lastMontageId) ?>, <?php echo($imagePerPages) ?>)">... LOAD MORE</div>
    <?php } ?>
    <?php include('ligma/footer.php') ?>
    <div id="comment-box" style="background-color: blue; width: 100%; height: 50px;">
    </div>
  </body>
  <script type="text/javascript" src="js/modal.js"></script>
  <script type="text/javascript" src="js/like.js"></script>
  <script type="text/javascript" src="js/loadmore.js"></script>
</html>