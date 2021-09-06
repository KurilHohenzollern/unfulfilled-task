<?php

require_once 'ListModel.php';

$model = new ListModel();
if (!empty($_POST)) {
    $action = $_POST["action"];
    switch ($action) {
        case 'addTask':
            $model->addTask($_POST['name'], $_POST['mail'], $_POST['text']);
            break;
        default:
            die("Неизвестное действие");
    }

    header("Location: user_panel.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>HTML5</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
<div class="container">
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Имя</th>
            <th scope="col">Почта</th>
            <th scope="col">Текст задачи</th>
            <th scope="col">Выполнение</th>
        </tr>
        </thead>
        <tbody>

        <?php
        //перебираем параметры задач
        $parameters = $model->getTask();
        foreach ($parameters as $parameter) : ?>
            <tr>
                <th scope="row"><?=$parameter[0]?></th>
                <td><?=$parameter[1]?></td>
                <td><?=$parameter[2]?></td>
                <td><?=$parameter[3]?></td>
            </tr>

        <?php
        endforeach;
        ?>
        </tbody>
        <body>
        <div class="container">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <td></td>
                </tr>
                </thead>
            </table>
            <tr>
                <th scope="row">
                    <h3>Поставить задачу</h3>
                    <form method="POST" action="user_panel.php">
        <div>
            <tr> <label for="name">Имя</label>
                <input type="text" name="name" value="">
        </div>
        <div>
            <label for="mail">Почта</label>
            <input type="text" name="mail" value="">
        </div>
        <div>
            <label for="text">Текст задачи</label>
            <input type="text" name="text" value="">
        </div>
        <input type="submit" value="Задать">
        <input type="hidden" name="action" value="addTask">
        </form>
        </th>
        </tr>

        <body>
        <a href="auth.php">Войти как администратор</a>
        </body>

        </body>
</html>
