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
		$page_content = compile_template( 'add.php',
            ['categories_list' => $categories_list,
                'lot' => $currentLot,
                'lotID' => $lotID,
                'data_list' => $data_list,
                'lot_time_remaining' => $lot_time_remaining]);
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