<?php

$host        =   'localhost';
$database    =   'dbname';
$port        =   '5432';
$user        =   'postgres';
$password    =   'password';
$charset     = 'utf8';

$conn   = new PDO ("pgsql:host={$host};port={$port};database ={$database};user={$user};password={$password}");
$arr    = $conn->query('select * from users ')->fetchAll(PDO::FETCH_ASSOC);





function q($post){
    global $conn;
    $st = $conn ->prepare ("insert into users (name, email, age) values (?, ?,  ?)");

    $st->execute([
        $post['name'],
        $post['email'],
        $post['age']
    ]);
}

function valid(array $post): array
{
    $validate = [
        'error' => false,
        'success' => false,
        'messages' => [],
    ];

    if (!empty($post['password']) and !empty($post['surname']) and !empty($post['name'] and !empty($post ['age']))) {


        $password = trim($post['password']);
        $surname = trim($post['surname']);
        $name = trim($post['name']);
        $age = trim($post['age']);

        $constraints = [

            'password' => 3,
            'surname' => 5,
            'name' => 4,
            'age' => 3
        ];


        $validateForm = validLoginPassword($password, $surname, $name,$age, $constraints );

        if (!$validateForm  ['login']) {
            $validate   ['error'] = true;

            array_push(
                $validate   ['messages'],
                "логин должен содержать больше {$constraints    ['login']}  символов"

            );

        }

        if (!$validateForm  ['password']) {
            $validate   ['error'] = true;

            array_push(
                $validate   ['messages'],
                "пароль должен содержать больше {$constraints    ['password']}  символов"

            );
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/iu', $password )){
            $validate['error'] = true;
            array_push(
                $validate['messages'],
                "Пароль не должно содержать русские буквы {$constraints ['password']}"
            );
        }

        if (!$validateForm  ['surname']) {
            $validate   ['error'] = true;

            array_push(
                $validate   ['messages'],
                "Фамилия должен содержать больше {$constraints    ['surname']}  символов"

            );
        }

        if (!$validateForm  ['name']) {
            $validate   ['error'] = true;

            array_push(
                $validate   ['messages'],
                "Имя должен содержать больше {$constraints    ['name']}  символов"

            );

        }

        if (!preg_match('/^[а-яА-Я]+$/iu', $name )){
            $validate['error'] = true;
            array_push(
                $validate['messages'],
                "В Имени не должно быть английского алфавита, цифр и спецсимволов"
            );
        }

        if (!$validate['error']) {
            $validate['success'] = true;
            array_push(
                $validate['messages'],
                "Ваш логин: {$age}",
                "Ваш пароль: {$password}",
                "Ваша Фамилия: {$surname}",
                "Ваше Имя: {$name}"

            );

        }
        if (!preg_match('/^[а-яА-Я]+$/iu', $surname )){
            $validate['error'] = true;
            array_push(
                $validate['messages'],
                "В Фамилии не должно быть английского алфавита, цифр и спецсимволов"
            );
        }

        return $validate;
    }
    return $validate;

}


function validLoginPassword(string $login, string $password, string $surname, string $name, array $constraints): array
{

    $validateForm = [
        'login' => true,
        'password' => true,
        'surname' => true,
        "name" => true
    ];

    if (strlen($login) < $constraints['login']) {
        $validateForm  ['login'] = false;
    }

    if (strlen($password) < $constraints['password']) {
        $validateForm  ['password'] = false;
    }

    if (strlen($surname) < $constraints['surname']) {
        $validateForm  ['surname'] = false;
    }

    if (strlen($name) < $constraints['name']) {
        $validateForm  ['name'] = false;
    }

    return $validateForm;
}
