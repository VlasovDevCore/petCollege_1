<?php 

    session_start();
    if(!isset($_SESSION['user_registr'])){
        header('Location: ../users/login.php');
        exit;
    } else {
        
?>

<?php 

include '../../assets/inc/db.php';

include '../../assets/modul/head.php'; 
include '../../assets/modul/header.php'; 


if (isset($_GET['weekend'])) {
    $weekend = $_GET['weekend'];
} else {
    $weekend = 0;
}

if (isset($_GET['day'])) {
    $day_input = $_GET['day'];
}
if (isset($_GET['month'])) {
    $month_input = $_GET['month'];
}
if (isset($_GET['year'])) {
    $year_input = $_GET['year'];
}

$id_doctor = $_GET['doctor'];


?>

<style type="text/css">
    .registr_kalendar{
        background-color: #212529;
    }
</style>

<div class="container mt-0 col-10">
	<div class="row">

            <?php include '../../assets/modul/record_input.php'; ?>

<div style="overflow-x: auto;white-space: nowrap;">
            <?php include '../../assets/inc/function/kalendar.php'; ?>
</div>

        <div class="mb-3 mt-3 bg-white p-4 rounded border">
            <p class="fs-5 fw-light mb-2 " for="patients">Выбор пациента</p>
            <select class="w-100 select_patients " name="patients" form="form1" required>
                <option value="0">...</option>
<?php 
$sql = "SELECT * FROM `patients`";

$res_data = mysqli_query($link, $sql);
while($row = mysqli_fetch_array($res_data)){?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['login']; ?> (<?php echo $row['id']; ?>)</option>
<?php    }?> 
            </select>
        </div>

<?php 

if (isset($_GET['day'])) {
    $day = $_GET['day'];
} else {
    $day = 0;
}

if (isset($_GET['weekday'])) {
    $weekday = $_GET['weekday'];
} 

if (isset($_GET['month'])) {
    $month = $_GET['month'];
} 
if (isset($_GET['year'])) {
    $year = $_GET['year'];
} 

$date_records = $day.".".$month.".".$year."</br>";

$days = array( 0 => "Понедельник" , "Вторник" , "Среда" , "Четверг" , "Пятница" , "Суббота" , "Воскресенье" );

?>


</br>


<?php 

if(!$day){

if (!$weekend) {
    echo '<div class="bg-white rounded p-4 mb-5 text-center border">
        <p class="mb-0 fs-5 fw-light">Выберите <span class="fw-bold">дату</span> на календаре!</p>
        <p class="mb-0 mt-2"><i class="bi bi-calendar4-week fs-2"></i></p>
    </div>';
} else {
    echo '<div class="bg-white rounded p-4 mb-5 text-center border">
        <p class="mb-0 fs-5 fw-light">В этот день у доктора выходной!</p>
        <p class="mb-0 mt-2"><i class="bi bi-calendar4-week fs-2"></i></p>
    </div>';
}

} else{

echo '<div class="bg-white rounded p-3 mb-5 border">';

echo '
<div class="">
    <p class="fs-5 fw-light">Выбранная дата: <span class="fw-bold">'.$day.'.'.$month.'.'.$year.'</span></p>
</div>';

$result = $link->query('SELECT `change_doctors` FROM `doctor_list` WHERE `id` = '. $id_doctor .'');
    while($row = $result->fetch_assoc()){
        $change_doctors = ''.$row['change_doctors'].'';
    }

$result = $link->query('SELECT * FROM record_patients_time WHERE `change` = '.$change_doctors.' AND id NOT IN (SELECT time_id_disabled FROM record_patients_date WHERE `doctor_id` = '. $id_doctor .'
 AND  `day` = '.$day.' AND `month` = '.$month.' AND `year` = '.$year.'); ');
     while($row = $result->fetch_assoc())
 {

 echo '
        <div class="form_radio_btn mb-3">
             <input type="radio" id="'.$row['id'].'" name="contact" value="'.$row['id'].'" onchange="document.getElementById(\'example\').value = this.value" <?php  echo $disabled_1; ?>
            <label for="'.$row['id'].'">'.$row['time_name'].'</label>
         </div> 
 ';

 }
?>
 
</br>

<?php 

$result = $link->query('SELECT * FROM record_patients_date,record_patients_time WHERE `doctor_id` = '. $id_doctor .' AND `day` = '. $day .' AND `month` = '. $month .' AND `year` = '. $year .' AND record_patients_date.time_id_disabled = record_patients_time.id');

while($row = $result->fetch_assoc()){
    $id_if = ''.$row['id'].'';
}

if (!isset($id_if)) {
    $id_if = 0;
}

if ($id_if > 0) {
    echo '<p>Записанное время:</p>';
}

$result = $link->query('SELECT * FROM record_patients_date,record_patients_time WHERE `doctor_id` = '. $id_doctor .' AND `day` = '. $day .' AND `month` = '. $month .' AND `year` = '. $year .' AND record_patients_date.time_id_disabled = record_patients_time.id');

while($row = $result->fetch_assoc()){

echo '
        <div class="form_radio_btn mb-3">
            <input type="radio" id="'.$row['id'].'" name="contact" value="'.$row['id'].'" onchange="document.getElementById(\'example\').value = this.value" '.$row['disabled'].'>
            <label for="'.$row['id'].'">'.$row['time_name'].'</label>
        </div> 
';

    }


echo '<button class="w-100 btn btn-dark" onclick="submitForms()" type="submit">Записаться</button>';
echo '</div>';
?>
          </br></br>




<?php 
}
?>

<script>
submitForms = function(){
    document.getElementById("form1").submit();
}   
</script>

		    </div>
	    </div>
	</div>
</div>

    <script src="main.js"></script>

<link rel="stylesheet" href="https://snipp.ru/cdn/select2/4.0.13/dist/css/select2.min.css">

<script src="https://snipp.ru/cdn/jquery/2.1.1/jquery.min.js"></script>
<script src="https://snipp.ru/cdn/select2/4.0.13/dist/js/select2.min.js"></script>
<script src="https://snipp.ru/cdn/select2/4.0.13/dist/js/i18n/ru.js"></script>

<script>
$(document).ready(function() {
    $('.select_patients').select2({
        placeholder: "...",
        maximumSelectionLength: 10,
        language: "ru"
    });
});
</script>		    				
</main>
<script>
var elem = document.querySelector('#record_patients');
elem.setAttribute('class', 'nav-link active');
</script>

<?php } ?>

</body>
</html>



<!-- SELECT * FROM record_patients_time,record_patients_date WHERE record_patients_time.id = record_patients_date.time_id_disabled AND `change` = '1';  -->

<!-- SELECT * FROM record_patients_time WHERE id AND `change` = 1 NOT IN (SELECT time_id_disabled FROM record_patients_date WHERE `day` = '12' AND `month` = '12' AND `year` = '2022');  -->