
<link rel="stylesheet" href="../../../assets/bootstrap/css/bootstrap.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
include '../db.php'; 

$doctor = $_POST['doctor'];
$patients = $_POST['patients'];
$time = $_POST['time'];
$day_null = $_POST['day'];
$month_null = $_POST['month'];
$year = $_POST['year'];
$date = $_POST['date'];
$registr_id = $_POST['registr_id'];   

$sql_time = "SELECT * FROM `record_patients_time` WHERE `id` = ".$time."";
$res_data = mysqli_query($link, $sql_time);
while($row = mysqli_fetch_array($res_data)){
    $time_name = $row['time_name'];
}

$sql_patient = "SELECT * FROM `patients` WHERE `id` = ".$patients."";
$res_data = mysqli_query($link, $sql_patient);
while($row = mysqli_fetch_array($res_data)){
    $login_name = $row['login'];
}

$sql_doctor = "SELECT * FROM `doctor_list` WHERE `id` = ".$doctor."";
$res_data = mysqli_query($link, $sql_doctor);
while($row = mysqli_fetch_array($res_data)){
    $specialization_name = $row['specialization'];
}

$sql_doctor = "SELECT * FROM `users` WHERE `id` = ".$registr_id."";
$res_data = mysqli_query($link, $sql_doctor);
while($row = mysqli_fetch_array($res_data)){
    $users_name = $row['login'];
}

if ($time == 0) {
    $time = 0;
}

$day = $day_null;
if ($day_null != floor($day_null)) {
    $day = sprintf("%2.2f", $day_null);
}
if ($day_null < 10 && $day_null >= 0)
   $day = "0" . $day;


$month = $month_null;
if ($month_null != floor($month_null)) {
    $month = sprintf("%2.2f", $month_null);
}
if ($month_null < 10 && $month_null >= 0)
   $month = "0" . $month;


// Вывод ID 
$result = $link->query('SELECT * FROM `record_patients_date` 
	WHERE
	 `day` = '.$day.' 
	 AND `month` = '.$month.' 
	 AND `year` = '.$year.' 
	 AND `doctor_id` = '.$doctor.'
	 AND `time_id_disabled` = '.$time.''
	);

	while($row = $result->fetch_assoc())
{
 $id = ''.$row['id'].''; 
}

if ($patients == 0 || $time == 0) {
    echo '<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-6 col-11 my-5 p-3 border bg-white rounded">
            <p class="fw-bold text-center fs-3 pb-3 px-3 mb-0">Не все данные были вписаны!</p>


            <a href="../../../registrar/page/record_patients.php?day='.$day.'&month='.$month.'&year='.$year.'&doctor='.$doctor.'" class="mt-3 w-100 btn btn-dark">Вернуться на запись пациента</a>
            <a href="../../../registrar/list_record.php" class="mt-3 w-100 btn btn-dark">Открыть список запиcанных пациентов</a>
        </div>
    </div>
</div>';
} else {

if (!$id) { // Если да, то обновляем

// Запись в таблицу листа
    $result = $link->query("INSERT INTO `record_patients_list` (`id`, `doctor`, `patients`, `time`, `day`, `month`, `year`, `date_del`, `registr_id`) VALUES (NULL, '{$doctor}', '{$patients}', '{$time}', '{$day}', '{$month}', '{$year}', '{$date}', '{$registr_id}')");


	$result = $link->query("INSERT INTO `record_patients_date` (`id`, `doctor_id`, `day`, `month`, `year`, `disabled`, `time_id_disabled`, `date_del`) VALUES (NULL, '{$doctor}', '{$day}', '{$month}', '{$year}', 'disabled', '{$time}', '{$date}')");

echo '<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-6 col-11 my-5 p-3 border bg-white rounded">
            <p class="fw-bold border-bottom pb-3">Успешная запись пациента</p>

            <label for="lable_2" class="form-label">Врач:</label>
            <input type="text" class="form-control" id="lable_2" name="" value="'. $specialization_name.'" disabled/>

            <label for="lable_2" class="form-label mt-3">Пациент:</label>
            <input type="text" class="form-control" id="lable_2" name="" value="'. $login_name .'" disabled/>

            <label for="lable_2" class="form-label mt-3">Время:</label>
            <input type="text" class="form-control" id="lable_2" name="" value="'. $time_name .'" disabled/>

            <label for="lable_2" class="form-label mt-3">День:</label>
            <input type="text" class="form-control" id="lable_2" name="" value="'. $day .'" disabled/>

            <label for="lable_2" class="form-label mt-3">Месяц:</label>
            <input type="text" class="form-control" id="lable_2" name="" value="'. $month .'" disabled/>

            <label for="lable_2" class="form-label mt-3">Год:</label>
            <input type="text" class="form-control" id="lable_2" name="" value="'. $year .'" disabled/>

            <label for="lable_2" class="form-label mt-3">ID кто записал:</label>
            <input type="text" class="form-control" id="lable_2" name="" value="'. $registr_id .'" disabled/>

            <a href="../../../registrar/list_record.php" class="mt-3 w-100 btn btn-dark">Открыть список запиcанных пациентов</a>
            <a href="../../../registrar/choice_doctor.php" class="mt-3 w-100 btn btn-dark">Вернуться на запись пациентов</a>
        </div>
    </div>
</div>';


} else{ // Если нет, то добовляем
	echo '<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-6 col-11 my-5 p-3 border bg-white rounded">
            <p class="fw-bold text-center fs-3 pb-3 px-3 mb-0">На данную даную дату и время уже есть запись</p>


            <a href="../../../registrar/list_record.php" class="mt-3 w-100 btn btn-dark">Открыть список запиcанных пациентов</a>
            <a href="../../../registrar/choice_doctor.php" class="mt-3 w-100 btn btn-dark">Вернуться на запись пациентов</a>
        </div>
    </div>
</div>';
} }

?>

<?php 

// $new_url = '/';
// header('Location: '.$new_url);

?>
