<?php
session_start();

// Generate a random CAPTCHA code
$captcha_code = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 6);
$_SESSION['captcha_code'] = $captcha_code;

// Create an image
$width = 120;
$height = 40;
$image = imagecreate($width, $height);

// Set background and text colors
$background_color = imagecolorallocate($image, 255, 255, 255); // White background
$text_color = imagecolorallocate($image, 0, 0, 0); // Black text

// Add noise (optional)
for ($i = 0; $i < 50; $i++) {
    $noise_color = imagecolorallocate($image, rand(100, 255), rand(100, 255), rand(100, 255));
    imagesetpixel($image, rand(0, $width), rand(0, $height), $noise_color);
}

// Add the CAPTCHA code to the image
$font_size = 20;
$font = __DIR__ . '/arial.ttf'; // Path to a .ttf font file (ensure you have this font or change the path)
if (file_exists($font)) {
    imagettftext($image, $font_size, 0, 10, 30, $text_color, $font, $captcha_code);
} else {
    imagestring($image, 5, 10, 10, $captcha_code, $text_color);
}

// Set the content type header
header('Content-Type: image/png');

// Output the image
imagepng($image);

// Free up memory
imagedestroy($image);
