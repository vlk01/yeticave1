<?php
require ('conBD.php');
$is_auth = rand(0, 1);

$user_name = 'vlk01'; // укажите здесь ваше имя

//$categories_list = [
   // 'boards' => 'Доски и лыжи',
  //  'fasteners' => 'Крепления',
  //  'boots' => 'Ботинки',
 //   'clothes' => 'Одежда',
 //   'tools' => 'Инструменты',
//    'different' => 'Разное',
// ];
//$data_list = [
  //  [
 //       'name' => '2014 Rossignol District Snowboard',
 //       'category' => 'boards',
 //       'count' => '10999',
 //       'URL_img' => 'img/lot-1.jpg',
 //   ],
 //   [
 //       'name' => 'DC Ply Mens 2016/2017 Snowboard',
 //       'category' => 'boards',
 //       'count' => '159999',
  //      'URL_img' => 'img/lot-2.jpg',
  //  ],
 //   [
  //      'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
  //      'category' => 'fasteners',
 //       'count' => '8000',
  //      'URL_img' => 'img/lot-3.jpg',
 //   ],
  //  [
  //      'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
  //      'category' => 'boots',
 //       'count' => '10999',
  //      'URL_img' => 'img/lot-4.jpg',
  //  ],
 //   [
 //       'name' => 'Куртка для сноуборда DC Mutiny Charocal',
 //       'category' => 'clothes',
 //       'count' => '7500',
 //       'URL_img' => 'img/lot-5.jpg',
 //   ],
 //   [
 //       'name' => 'Маска Oakley Canopy',
//        'category' => 'different',
 //       'count' => '5400',
 //       'URL_img' => 'img/lot-6.jpg',
  //  ],
// ];

function compile_template($template, $template_data)
{
if (file_exists('templates/' . $template))
{
ob_start();
extract($template_data);
require_once ('templates/' . $template);
return ob_get_clean();
}
else{
return  '404';
}
}





function Sum_Price($sum, $withRubleElem)
{
ceil($sum);
if($sum<=1000)
{
return $sum;
}
else
{
$sum = number_format ($sum, 0, '.', ' ');
return $sum;
}
}


function My_Timer()
{
    $now = strtotime('now');
    $now2 = strtotime('tomorrow');
    $hours_in_sec = $now2 - $now;
    $hours = floor($hours_in_sec/3600);
    $minute = (($hours_in_sec/3600) - $hours)*60;
    $timer = sprintf('%02d:%02d', $hours, $minute);
    return $timer;
}


?>
