<?php
include '../../assets/modul/head.php';

    session_start();
    include('../../assets/inc/config.php');
    if (isset($_POST['login_auth'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];

        if (isset($_POST['status'])) {
            $status = $_POST['status'];
        }
        
        $query = $connection->prepare("SELECT * FROM users WHERE login=:login");
        $query->bindParam("login", $login, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            echo '<div class="text-center pt-5 w-100 position-absolute top-0 start-50 translate-middle">
    <span class="bg-danger p-3 text-white">Неверные данные!</span>
</div>';
        } else {
            if (0 == $result['status']) {
                echo '<div class="text-center pt-5 w-100 position-absolute top-0 start-50 translate-middle">
                    <span class="bg-danger p-3 text-white">У вас нет прав доступа!</span>
                </div>';
                } else {
                    if (password_verify($password, $result['password'])) {
                        $_SESSION['user_registr'] = $result['id'];
                        header('Location: /registrar/');
                    } else {
                        echo '<div class="text-center w-100 pt-5 position-absolute top-0 start-50 translate-middle">
            <span class="bg-danger p-3 text-white">Неверные данные!</span>
        </div>';
                    }
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
            <h5 class="mb-3">Авторизация мед.работника</h5>
            <div class="form-element mb-2">
                <label class="form-label">Логин</label>
                <input type="text" class="form-control" name="login" minlength="3" maxlength="20" placeholder="ivanivanov" required />
            </div>
            <div class="form-element mb-3">
                <label class="form-label">Пароль</label>
                <input type="password" class="form-control" maxlength="50" name="password" placeholder="············" required />
            </div>
            <button type="submit" name="login_auth" class="btn btn-primary w-100" value="login_auth">Авторизация</button>
        </form>
        
    </div>
    <div class="mt-2 text-end">
        <a href="register">Регистрация</a>
    </div>
</div>