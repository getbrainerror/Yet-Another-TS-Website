<?php
//get Status Json
$json = file_get_contents('http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . '/api/status.php');
$tsData = json_decode($json, true);


$height = 150;
$width = 350;
$iH = $height - 1;
$iW = $width - 1;
$img = imagecreatetruecolor($width, $height);

$colorTextHex = "000000";
$colorBackgroundHex = "FFFFFF";
$colorBorderHex = "000000";

if(isset($_GET['bgcolor'])){
  $colorBackgroundHex = $_GET['bgcolor'];
}

if(isset($_GET['textcolor'])){
  $colorTextHex = $_GET['textcolor'];
}

if(isset($_GET['bordercolor'])){
  $colorBorderHex = $_GET['bordercolor'];
}
$colorBackground = imagecolorallocate($img, hexdec(substr($colorBackgroundHex,0,2)), hexdec(substr($colorBackgroundHex,2,2)), hexdec(substr($colorBackgroundHex,4,2)));
$colorText = imagecolorallocate($img, hexdec(substr($colorTextHex,0,2)), hexdec(substr($colorTextHex,2,2)), hexdec(substr($colorTextHex,4,2)));
$colorBorder = imagecolorallocate($img, hexdec(substr($colorBorderHex,0,2)), hexdec(substr($colorBorderHex,2,2)), hexdec(substr($colorBorderHex,4,2)));

$messagesLeft = array();
$messagesRight = array();

if($tsData['success'] == 'true'){
  $messagesLeft[] = "Serveradresse:";
  $messagesLeft[] = "Servername:";
  $messagesLeft[] = "Online:";
  $messagesLeft[] = "Version:";
  $messagesRight[] = $tsData['data']['publicAdress'];
  $messagesRight[] = $tsData['data']['name'];
  $messagesRight[] = $tsData['data']['clientsonline'] . "/" . $tsData['data']['maxclients'];
  $messagesRight[] = $tsData['data']['version'];
} else {
  $messagesLeft[] = "Serveradresse: ";
  $messagesLeft[] = "Servername:     ";
  $messagesLeft[] = "Version:";
  $messagesLeft[] = "Version:";
  $messagesRight[] = "Fehler";
  $messagesRight[] = "Fehler";
  $messagesRight[] = "Fehler";
  $messagesRight[] = "Fehler";
}


imagefill($img, 0, 0, $colorBackground);

$offsetHeightFactor = $iH / 6;
$offsetHeight = 30;
imagestring( $img, 4, 30, $offsetHeight, $messagesLeft[0], $colorText );
imagestring( $img, 4, 30, $offsetHeight + ($offsetHeightFactor * 1), $messagesLeft[1], $colorText );
imagestring( $img, 4, 30, $offsetHeight + ($offsetHeightFactor * 2), $messagesLeft[2], $colorText );
imagestring( $img, 4, 30, $offsetHeight + ($offsetHeightFactor * 3), $messagesLeft[3], $colorText );

imagestring( $img, 4, 180, $offsetHeight, $messagesRight[0], $colorText );
imagestring( $img, 4, 180, $offsetHeight + ($offsetHeightFactor * 1), $messagesRight[1], $colorText );
imagestring( $img, 4, 180, $offsetHeight + ($offsetHeightFactor * 2), $messagesRight[2], $colorText );
imagestring( $img, 4, 180, $offsetHeight + ($offsetHeightFactor * 3), $messagesRight[3], $colorText );


imagesetthickness ( $img, 3 );
//Border
imageline( $img, 0, 0, 0, $iH, $colorBorder );
imageline( $img, 0, 0, $iW, 0, $colorBorder );
imageline( $img, 0, $iH, $iW, $iH, $colorBorder );
imageline( $img, $iW, 0, $iW, $iH, $colorBorder );



header ("Content-type: image/png");
imagepng($img);

imagecolordeallocate( $img, $colorText );
imagecolordeallocate( $img, $colorText );
imagecolordeallocate( $img, $colorBackground );
imagedestroy( $img );

?>
