<?php
function generateProfilePhoto($name) {

    $width = 100;
    $height = 100;
    $image = imagecreatetruecolor($width, $height);
    $background = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
    imagefill($image, 0, 0, $background);

    $patternColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
    for ($x = 0; $x < $width; $x += 10) {
        for ($y = 0; $y < $height; $y += 10) {
            imagefilledrectangle($image, $x, $y, $x + 10, $y + 10, $patternColor);
        }
    }

    $font = 30;
    $text = strtoupper($name);
    $textColor = imagecolorallocate($image, 255,255,255);
    $textX = ($width - imagefontwidth($font) * strlen($text)) / 2;
    $textY = ($height - imagefontheight($font)) / 2;
    imagestring($image, $font, $textX, $textY, $text, $textColor);

  
    header('Content-type: image/png');
    imagepng($image);

    imagedestroy($image);
}

$customerName = (isset($_GET['name'])) ? $_GET['name'] : null;

ob_start();

generateProfilePhoto($customerName);

ob_end_flush();
?>
