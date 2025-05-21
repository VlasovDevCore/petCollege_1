<?php 

session_start();
if(!isset($_SESSION['user_registr'])){
    header('Location: patients/login.php');
    exit;
} else {

include '../assets/modul/head.php';
include '../assets/modul/header.php';
include '../assets/inc/db.php';

$id_patients = $_GET['patients'];

$sql = "SELECT * FROM `patients` WHERE `id` = ".$id_patients."";

$res_data = mysqli_query($link, $sql);
while($row = mysqli_fetch_array($res_data)){
    $login = $row['login'];
    $sector_card = $row['sector_card'];
}

if ($sector_card == 'Не указано') {
    $sector_card = "";
}

?>

    <main>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-5 col-11 my-5 p-3 border bg-white rounded">
            <p class="fw-bold border-bottom pb-3">Настройка данных</p>

		<form action="../assets/inc/function/setting_user.php" method="POST"> 

            <label for="fio" class="form-label">id:</label>
            <input type="text" class="form-control" name="" value="<?php echo $id_patients; ?>" disabled/>
            <input type="hidden" class="form-control" name="id_patients" value="<?php echo $id_patients; ?>"/>
            
            <label for="fio" class="form-label mt-2">ФИО:</label>
            <input type="text" class="form-control" value="<?php echo $login; ?>" disabled/>

            <label for="email" class="form-label mt-2">Cектор карты:</label>
            <input type="text" class="form-control" name="sector_card" placeholder="Не указано" value="<?php echo $sector_card; ?>"/>

            <input type="submit" class="mt-3 w-100 btn btn-dark" value="Сохранить">
        </form>


        <a href="list_patients" class="mt-3 w-100 btn btn-dark">Вернуться обратно</a>
        </div>
    </div>
</div>

    </main>
</body>
</html>

<?php } ?>