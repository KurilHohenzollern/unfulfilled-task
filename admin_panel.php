<?php

require_once 'ListModel.php';

$model = new ListModel();
if (!empty($_POST)) {
    $action = $_POST["action"] ;
    switch ($action) {
        case 'deleteTask':
            $model->deleteTask($_POST['id']);
                break;
        case 'editTask':
            $model->editTask( $_POST['text'], $_POST['id']);
                break;
        default:
            die("Неизвестное действие");
    }

    header("Location: admin_panel.php");
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
            <th scope="col">Выполнено</th>
            <th scope="col">Удалить</th>
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
                <td>
                    <form method="POST" action="/admin_panel.php">
                <input type="hidden" name="id" value="<?=$parameter[0]?>">
                <input type="checkbox" name="done" value="">
                    </form>
                </td>
                <td>
                    <form method="POST" action="/admin_panel.php">
                    <input type="hidden" name="id" value="<?=$parameter[0]?>">
                    <input type="submit" value="удалить">
                    <input type="hidden" name="action" value="deleteTask">
                    </form>
            </td>
            </tr>

        <?php
        endforeach;
        ?>
        </tbody>
    </table>
    <tr>
  <th scope="row">
<h3>Изменить задачу</h3>
    <form method="POST" action="/admin_panel.php">
        <div>
                <label for="id">Номер</label>
                <input type="text" name="id" value="">
        </div>

        <div>
                <label for="text">Текст задачи</label>
                <input type="text" name="text" value="">
        </div>

        <input type="submit" value="изменить">
        <input type="hidden" name="action" value="editTask">
    </form>
</th>
</tr>

</body>
<body>
<a href="exit.php">Выйти</a>
</body>
</html>



