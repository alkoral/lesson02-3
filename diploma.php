<?php
$months = array( 1 => 'января' , 'февраля' , 'марта' , 'апреля' , 'мая' , 'июня' , 'июля' , 'августа' , 'сентября' , 'октября' , 'ноября' , 'декабря');

session_start();
$text = $_SESSION['user'];
$text_5 = $_SESSION['quest'];
//$text = $_COOKIE['user'];
$text_1 = "20-го";
$text_2 = "\"Нетология\"";
$text_3 = "за успешное прохождение учебного";
$text_4 = "теста под названием:";
//$text_5 = $_COOKIE['quest'];
$text_6 = "Грамота выдана ".date('d ' . $months[date('n')]);
$text_7 = date('y');
$text_8 = "а";

$image = imagecreatetruecolor(550, 773) or
	exit ("Ошибка при создании изображения");          
$bgcolor = imagecolorallocate($image, 255, 255, 255);
$textcolor = imagecolorallocate($image, 0, 0, 255);
$textcolor_1 = imagecolorallocate($image, 0, 0, 0);

$boxFile = __DIR__ . '/diploma.png';
	if (!file_exists($boxFile)) {
		echo "Такой картинки нет";
		exit;
	}

$imBox = imagecreatefrompng($boxFile);
imagefill($image, 0, 0, $bgcolor);
imagecopy($image, $imBox, 0, 0, 0, 0, 550, 773);

$fontFile = __DIR__ . '/MarckScript-Regular.ttf';
	if (!file_exists($fontFile)) {
		echo "Такого шрифта нет";
		exit;
	}

imagettftext($image, 25, 0, 130, 263, $textcolor, $fontFile, $text);
imagettftext($image, 20, 0, 250, 293, $textcolor, $fontFile, $text_1);
imagettftext($image, 20, 0, 200, 320, $textcolor, $fontFile, $text_2);
imagettftext($image, 20, 0, 90, 345, $textcolor, $fontFile, $text_3);
imagettftext($image, 20, 0, 135, 373, $textcolor, $fontFile, $text_4);
imagettftext($image, 15, 0, 70, 400, $textcolor_1, $fontFile, $text_5);
imagettftext($image, 20, 0, 80, 458, $textcolor, $fontFile, $text_6);
imagettftext($image, 20, 0, 455, 458, $textcolor, $fontFile, $text_7);
imagettftext($image, 20, 0, 510, 458, $textcolor, $fontFile, $text_8);

header ("Content-type: image/png");
imagepng ($image);
imagedestroy($image);
?>