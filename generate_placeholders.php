<?php
$w = 120;
$h = 80;
$f = 5;

// Music placeholder - light blue
$img = imagecreatetruecolor($w, $h);
$bg = imagecolorallocate($img, 227, 242, 253);
$fg = imagecolorallocate($img, 30, 136, 229);
imagefill($img, 0, 0, $bg);
imagerectangle($img, 0, 0, $w - 1, $h - 1, $fg);
$l = 'MUSIC';
$tw = imagefontwidth($f) * strlen($l);
$th = imagefontheight($f);
imagestring($img, $f, (int)(($w - $tw) / 2), (int)(($h - $th) / 2), $l, $fg);
imagepng($img, 'public/images/placeholder-music.png');
imagedestroy($img);
echo "music ok\n";

// Video placeholder - light red
$img = imagecreatetruecolor($w, $h);
$bg = imagecolorallocate($img, 255, 235, 238);
$fg = imagecolorallocate($img, 229, 57, 53);
imagefill($img, 0, 0, $bg);
imagerectangle($img, 0, 0, $w - 1, $h - 1, $fg);
$l = 'VIDEO';
$tw = imagefontwidth($f) * strlen($l);
imagestring($img, $f, (int)(($w - $tw) / 2), (int)(($h - $th) / 2), $l, $fg);
imagepng($img, 'public/images/placeholder-video.png');
imagedestroy($img);
echo "video ok\n";

// Image placeholder - light green
$img = imagecreatetruecolor($w, $h);
$bg = imagecolorallocate($img, 232, 245, 233);
$fg = imagecolorallocate($img, 56, 142, 60);
imagefill($img, 0, 0, $bg);
imagerectangle($img, 0, 0, $w - 1, $h - 1, $fg);
$l = 'IMAGE';
$tw = imagefontwidth($f) * strlen($l);
imagestring($img, $f, (int)(($w - $tw) / 2), (int)(($h - $th) / 2), $l, $fg);
imagepng($img, 'public/images/placeholder-image.png');
imagedestroy($img);
echo "image ok\n";
