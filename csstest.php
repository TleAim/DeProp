<?php
include 'init.php';
?>

<div class="container text-center bg-secondary">

<div class="p-3"><button class="button"> button </button></div>

<div class="p-3"><button class="btn2"> btn2 </button></div>

<div class="p-3 btn4 "><button class=""> btn4 </button></div>

<div class="pt-3 " >
    <button id="NextStep">Next Step
        <div class="arrow-wrapper">
            <div class="arrow"></div>
        </div>
    </button>
    </div>

</div>

<?php
  $temp = "https://goo.gl/maps/65T7gme4Wznp8UnW7";
  $urlmaps1 = "https://goo.gl/maps/";
  $urlmaps2 = "https://www.google.com/maps";
  $map = "";

 if (stripos($temp,$urlmaps1 ) !== false) { $map = $temp; } 
 if (stripos($temp,$urlmaps2 ) !== false) { $map = $temp; } 

 // $temp = "https://www.google.com/maps/place/Secret+specialty+coffee/@13.2956736,100.9241465,15z/data=!4m6!3m5!1s0x3102b56ddf45be9d:0x149447fdfa6a5163!8m2!3d13.3012589!4d100.9383672!16s%2Fg%2F11sgv4y21m";

  $pos = stripos($temp, $urldetect1);
  echo "POSITION :".$pos;
  echo $map;
?>


<?php
$text = "This is a sample text.";
$substring = "sample";

// Use strpos to find the position of the substring
$position = strpos($text, $substring);

if ($position !== false) {
    echo "The substring '$substring' was found at position $position.";
} else {
    echo "The substring '$substring' was not found.";
}
?>
