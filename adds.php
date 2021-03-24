<?php
require_once ('functions.php');
require 'conBD.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $required_fields = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
    $errors = [];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = "form__item--invalid";
            $form_error = 'form--invalid';
        }
        if ($field == 'lot-rate') {
            if (!filter_var($_POST[$field], FILTER_VALIDATE_INT)) {
                $errors[$field] = 'Начальная цена должна быть корректной';
            }
            if (intval($_POST[$field]) <= 0) {
                $errors[$field] = 'Начальная цена должна быть корректной';
            }
        }
        if ($field == 'lot-step') {
            if (!filter_var($_POST[$field], FILTER_VALIDATE_INT)) {
                $errors[$field] = 'Шаг ставки должен быть корректным';
            }
            if (intval($_POST[$field]) < 0) {
                $errors[$field] = 'Начальная цена должна быть корректной';
            }
        }
    }
	 if(isset($_FILES['lotPhotos'])){
        $finfo = finfo_open(FILEINFO_MINE_TYPE);
        $file_name = $_FILES['lotPhotos']['name'];
        $file_path = __DIR__ . '/img/';
        $file_tmpname = $_FILES['lotPhotos']['tmp_name'];
        $file_type = finfo_file($finfo, $file_tmpname);
        if($file_type == 'image/gif'){
            move_uploaded_file($_FILES['lotPhotos']['tmp_name'], $file_path . $file_name);
        }
        $file_url = 'img/' . $file_name;
    }

    if(count($errors) !== 0) {
        $page_content = compile_template('add.php',
            ['errors' => $errors,
                'categories_list' => $categories_list]);
    } else {
        $lot = [
                "image" => file_url ? 'img/user.jpg' : '',
                "name" => $_POST['lot-name'],
                "start_price" => $_POST['lot-rate'],
                "rate" => $_POST['lot-step'],
                "timer" => $_POST['lot-date'],
                "category" => $_POST['category'],
                "description" => $_POST['message'],
                "account_id" => $_SESSION['auth']['account_id']
        ];
		$page_content = compile_template('add.php',
        ['lot' => $currentlot,
            'categories_list' => $categories_list,
            'lotID' => $lotID,
            'data_list' => $data_list,
            'rates' => [],
            'price' => $lot['start_price']+$lot['rate']
        ]);
        $con = mysqli_connect('localhost', 'root', '', 'yeticave');
        mysqli_set_charset($con, 'utf8');
        $sql = "SELECT categ_id FROM Categories WHERE categ_name='{$lot['category']}'";
        $result = mysqli_querry($con, $sql);
        $lot['category'] = mysqli_fetch_assoc($result)['categ_id'];

        $sql = "INSERT INTO lots(lot_name, lot_discr, lot_image, lot_categ_id, lot_first_price, lot_comp_date, lot_step)
        VALUE ('{$lot['lot_name']}', '{$lot['lot_discr']}', '{$lot['lot_categ_id']}', '{$lot['lot_first_price']}', '{$lot['lot_comp_date']}', '{$lot['lot_step']}')";
        $result = mysqli_querry($con, $sql);
        if(!!$result)
            echo mysqli_error($con);


    }

}
else {
    $page_content = compile_template('add.php',
        ['categories_list' => $categories_list,
            'data_list' => $data_list
        ]);

}

$layout_content = compile_template('layout.php',
    ['page_layout' => 'Главная страница',
        'is_auth' => $is_auth,
        'user_avatar' => $user_avatar,
        'user_name' => $user_name,
        'page_content' => $page_content,
        'categories_list' => $categories_list
    ]);

print($layout_content);
?>