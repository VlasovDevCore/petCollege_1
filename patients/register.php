<?php
    include '../assets/modul/head_patients.php';
    
    session_start();
    include('../assets/inc/config.php');
    if (isset($_POST['register'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $query = $connection->prepare("SELECT * FROM patients WHERE login=:login");
        $query->bindParam("login", $login, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            $_SESSION['message_bg'] = 'bg-danger';
            $_SESSION['message'] = 'Этот логин уже занят!';
        }
        if ($query->rowCount() == 0) {
            $query = $connection->prepare("INSERT INTO patients(password,login) VALUES (:password_hash,:login)");
            $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
            $query->bindParam("login", $login, PDO::PARAM_STR);
            $result = $query->execute();
            if ($result) {
                $_SESSION['message_bg'] = 'bg-success';
                $_SESSION['message'] = 'Регистрация прошла успешо!';
            } else {
                $_SESSION['message_bg'] = 'bg-danger';
                $_SESSION['message'] = 'Неверные данные!';
            }
        }
    }

if (isset($_SESSION['message'])) {
  echo '<div id="notification" class="' . $_SESSION['message_bg'] . ' position-fixed end-0 text-light bottom-0 p-3 m-2" style="z-index: 9999;">' . $_SESSION['message'] . '</div>';
  unset($_SESSION['message_bg']);
  unset($_SESSION['message']);
}
?>

<div class="container-fluid">
    <div class="row">

        <div class="col-4 px-5 py-4 bg-white text-black position-relative d-none d-lg-block">
            <h2 class="fw-bold">EMIAS</h2>
            <p class="fw-bold fs-3 mt-5">Добро пожаловать на сайт мед. поликлиники</p>
            <div class="w-100 position-absolute start-0 bottom-0">
                <img src="../image/fon_patients_new.svg" class="cntr-img" alt="">
            </div>

        </div>

        <div class="col-lg-8 col-12 d-flex align-items-center" style="height: 100vh; background: #228be6;">
            <div class="text-white mx-auto" style="width: 400px;">
                <h2 class="fw-bold">Регистрация</h2>
                <p class="fw-light">Зарегистрируйтесь в системе, чтоб получить доступ к порталу</p>

                <form method="post" action="" name="signup-form">
                    <div class="form-element mb-2">
                        <input type="text" class="form-control rounded-0 border-0 p-3 px-4" name="login" minlength="3" maxlength="20" placeholder="Логин" required />
                        <small>От 3 до 20 значений</small>
                    </div>
                    <div class="form-element mb-3">
                        <input type="password" class="form-control rounded-0 border-0 p-3 px-4 mt-3" minlength="8" maxlength="50" name="password" placeholder="Пароль" required />
                        <small>От 8 до 50 значений</small>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" name="register" class="btn mb-0 text-white rounded-0 p-2 px-3 mb-3" style="background: #000;" value="login_auth">Регистрация</button>
                        <a href="login.php" class="p-2 text-white mb-0">Авторизация</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
setTimeout(() => {
  document.querySelector("#notification").remove();
}, 5000)  
</script>