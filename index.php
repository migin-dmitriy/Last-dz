
<!doctype html>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
    <title></title>
    <<link rel="stylesheet" href="assets/css/style.css">

</head>
<body bgcolor="#ffa07a">
<div    class = "reg-form">

    <h1>Регистрация</h1>
    <form action="form.php" method="post">

        <input type = "text" class = "form-control" name="surname" id = "surname" placeholder="Введите Фамилию" /><br>

        <input type = "text" class = "form-control" name="name" id = "name" placeholder="Введите Имя" /><br>

        <input type = "email" class = "form-control" name="email" id = "name" placeholder="Введите email" /><br>

        <input type = "price" class = "form-control" name="price" id = "price" placeholder="Введите возвраст" /><br>

        <button type="submit">Отправить</button>

    </form>
    <?php q($_POST) ?>
    </div>

    <?php $validate = valid($_POST)?>
    <?php if (!empty($validate['error']) and $validate['error']): ?>
        <?php foreach ($validate['messages'] as $message): ?>
            <p style="color: red">
                <?= $message ?>
            </p>
        <?php endforeach;  ?>
    <?php endif;?>
    <?php if (!empty($validate['success']) and $validate['success']):?>
        <?php foreach ($validate['messages'] as $message):?>
            <p style="color: green">
                <?= $message ?>
            </p>
        <?php endforeach;?>
    <?php endif;?>

    <style lang="html">

        .reg-form {
            text-align: left;
            width: 40%;
        }

        .content label, input {
            width: 70%;
            display: block;
            padding: 5px;
        }

    </style>
