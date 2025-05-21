<?php
include '../../assets/modul/head.php';

    session_start();
    include('../../assets/inc/config.php');
    if (isset($_POST['register'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $query = $connection->prepare("SELECT * FROM users WHERE login=:login");
        $query->bindParam("login", $login, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            echo '<div class="text-center w-100 pt-5 position-absolute top-0 start-50 translate-middle">
    <span class="bg-danger p-3 text-white">Этот логин уже зарегистрирован!</span>
</div>';
        }
        if ($query->rowCount() == 0) {
            $query = $connection->prepare("INSERT INTO users(password,login) VALUES (:password_hash,:login)");
            $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
            $query->bindParam("login", $login, PDO::PARAM_STR);
            $result = $query->execute();
            if ($result) {
                echo '<div class="text-center pt-5 w-100 position-absolute top-0 start-50 translate-middle">
    <span class="bg-success p-3 text-white">Регистрация прошла успешно!</span>
</div>';
            } else {
                echo '<div class="text-center pt-5 position-absolute top-0 start-50 translate-middle">
    <span class="bg-danger p-3 text-white">Неверные данные!</span>
</div>';
            }
        }
    }
?>

<div class="container col-md-6 col-lg-4 col-12">
    <div class="bg-white pt-0 overflow-hidden rounded-4 mt-5">
        <div style="height: 100px;">
            <img src="../../image/fon_patients.jpg" class="cntr-img" alt="">
        </div>
        <form method="post" action="" name="signup-form" class="p-3">
            <h5 class="mb-3">Регистрация мед.работника</h5>
            <div class="form-element mb-2">
                <label class="form-label">Логин<span class="text-danger">*</span> <small class="text-secondary">От 3 до 20 значений</small></label>
                <input type="text" class="form-control" name="login" minlength="3" maxlength="20" placeholder="ivanivanov" required />
            </div>
            <div class="form-element mb-3">
                <label class="form-label">Пароль<span class="text-danger">*</span> <small class="text-secondary">От 8 до 50 значений</small></label>
                <input type="password" class="form-control" minlength="8" maxlength="50" name="password" placeholder="············" required />
            </div>
            <button type="submit" name="register" class="btn btn-primary w-100" value="register">Регистрация</button>
        </form>
    </div>
    <div class="mt-2 text-end">
        <a href="login.php">Авторизация</a>
    </div>
</div>