<?php

require_once 'ListModel.php';

$model = new ListModel();
if (!empty($_POST)) {
    $action = $_POST["action"] ;
    switch ($action) {
        case 'authAdmin':
            $model->authAdmin($_POST['login'], $_POST['password']);
            break;
        default:
            die("Неизвестное действие");
    }

    header("Location: admin_panel.php");
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<title>Вход</title>
</head>
<body>

			<div class="col">
				<h1>Форма</h1>
				<form action="auth.php" method="POST">
					<input type="text" name="login" class="form-control" id="login" placeholder="Логин"><br>
					<input type="password" name="password" class="form-control" id="password" placeholder="Пароль"><br>
					<button class="btn btn-success" name="action" value="authAdmin">Авторизоваться</button><br>
				</form>
			</div>

		</div>
	</div>

</body>
</html>
