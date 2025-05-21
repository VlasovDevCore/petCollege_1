<?php 

session_start();
if(!isset($_SESSION['user_registr'])){
    header('Location: patients/login.php');
    exit;
} else {

include '../assets/modul/head.php';
include '../assets/modul/header.php';
include '../assets/inc/db.php';

$id_doctor = $_GET['doctor'];

$sql = "SELECT * FROM `doctor_list` WHERE `id` = ".$id_doctor."";

$res_data = mysqli_query($link, $sql);
while($row = mysqli_fetch_array($res_data)){
    $specialization = $row['specialization'];
    $office = $row['office'];
    $internal_phone = $row['internal_phone'];
    $working_hours = $row['working_hours'];
    $change_doctors = $row['change_doctors'];
    $status = $row['status'];
}
    
    if ($status == "Выходной") {
        $status_id = 1;
    } else {
        $status_id = 2;
    }

?>


    <main>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-5 col-11 my-5 p-3 border bg-white rounded">
<?php if (!$admin == 0) { ?>            
            <p class="fw-bold border-bottom pb-3">Настройка данных доктора</p>

		<form action="../assets/inc/function/update_doctor.php" method="POST"> 

            <label for="id_doctor" class="form-label">id:</label>
            <input type="text" class="form-control" name="id_doctor" value="<?php echo $id_doctor; ?>" disabled/>
            <input type="hidden" class="form-control" name="id_doctor" value="<?php echo $id_doctor; ?>"/>
            
            <label for="specialization" class="form-label mt-2">Специализация:</label>
            <input type="text" class="form-control" name="specialization" value="<?php echo $specialization; ?>" disabled/>

            <label for="office" class="form-label mt-2">Кабинет:</label>
            <input type="text" class="form-control" name="office" placeholder="Не указано" value="<?php echo $office; ?>" disabled/>

            <label for="internal_phone" class="form-label mt-2">Внутрений телефон:</label>
            <input type="text" class="form-control" name="internal_phone" placeholder="Не указано" value="<?php echo $internal_phone; ?>" disabled/>

            <label for="time" class="form-label mt-2">Время работы:</label>
            <select name="time" id="" class="form-select">

                <?php if ($change_doctors == 1) {?>
                    <option value="1">7:30 - 14:30</option>
                    <option value="2">15:00 - 21:30</option>
                <?php } else { ?>
                    <option value="2">15:00 - 21:30</option>
                    <option value="1">7:30 - 14:30</option>
                <?php } ?>

            </select>

            <label for="status" class="form-label mt-2">Статус:</label>
            <select name="status" id="" class="form-select">

                <?php if ($status_id == 1) {?>
                    <option value="Выходной">Выходной</option>
                    <option value="На работе">На работе</option>
                <?php } else { ?>
                    <option value="На работе">На работе</option>
                    <option value="Выходной">Выходной</option>
                <?php } ?>

            </select>

            <input type="submit" class="mt-3 w-100 btn btn-dark" value="Сохранить">
        </form>


        <a href="list_patients" class="mt-3 w-100 btn btn-dark">Вернуться обратно</a>
<?php } else { ?>

    <p class="fw-bold border-bottom pb-3">У вас нет прав доступа</p>
    <a href="list_patients" class="mt-3 w-100 btn btn-dark">Вернуться обратно</a>
<?php } ?>  
        </div>
    </div>
</div>

    </main>
</body>
</html>

<?php } ?>