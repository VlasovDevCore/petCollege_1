<?php 

    session_start();
    if(!isset($_SESSION['user_patients'])){
        header('Location: /patients/login.php');
        exit;
    } else {
        
?>

<?php 

include '../assets/inc/db.php';
include '../assets/modul/head_patients.php';
include '../assets/modul/header_patients.php'; 

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

<style>
    .user_kalendar{
        background: #0089ff;
    }
</style>

<div class="container mt-0 col-10">
	<div class="row">

<form action="record.php" method="POST" id="form1" class="p-0">
    <div class="row mb-3">
        <div class="d-flex flex-column gap-2">

<?php 
$sql = "SELECT * FROM `doctor_list` WHERE `id` = $id_doctor";

$res_data = mysqli_query($link, $sql);
while($row = mysqli_fetch_array($res_data)){?>
    <p class="mb-0 fw-light fs-5 mt-5">Специальность: <span class="fs-4 fw-semibold"><?php echo $row['specialization']; ?></span> 
    <p class="w-100"><a href="/choice_doctor.php" class="text-secondary text-decoration-underline">Выбор другого доктора</a></p>
<?php }?>


       </div>
</div>
<?php 

if (isset($_GET['day'])) {
    $num_day = $_GET['day'];
} else {
 $num_day = 0;
}
if (isset($_GET['month'])) {
    $num_month = $_GET['month'];
} else {
    $num_month = 0;
}

// $num_day = $_GET['day'];
// $num_month = $_GET['month'];

$num_padded_day = $num_day;
if ($num_day != floor($num_day)) {
    $num_padded_day = sprintf("%2.2f", $num_day);
}
if ($num_day < 10 && $num_day >= 0)
   $num_padded_day = "0" . $num_padded_day;


$num_padded_month = $num_month;
if ($num_month != floor($num_month)) {
    $num_padded_month = sprintf("%2.2f", $num_month);
}
if ($num_month < 10 && $num_month >= 0)
   $num_padded_month = "0" . $num_padded_month;

$day = date ("d"); 
$month = date ("m"); 
$year = date ("Y"); 

$date_delete = ''. $year . $month . $day .'';
?>

    <input type="hidden" id="example" name="time" value="">
    <input type="hidden" id="date" name="date" value="

    <?php echo $_GET['year'] . "-" . $num_padded_month . "-" . $num_padded_day; ?> 

    ">
    <input type="hidden" id="day" name="day" value="<?php echo $day_input; ?>">
    <input type="hidden" id="month" name="month" value="<?php echo $month_input; ?>">
    <input type="hidden" id="year" name="year" value="<?php echo $year_input; ?>">
    <input type="hidden" id="doctor" name="doctor" value="<?php echo $id_doctor; ?>">



<div style="overflow-x: auto;white-space: nowrap;">
            <?php include '../assets/inc/function/kalendar.php'; ?>
</div>


        <div class="my-4">


<? 
$sql = "SELECT * FROM `patients` WHERE `id` = ".$_SESSION['user_patients']."";

$res_data = mysqli_query($link, $sql);
while($row = mysqli_fetch_array($res_data)){?>

    <p class="mb-0 fw-light fs-5">Пациент: <span class="fw-bold fs-4"><?php echo $row['login']; ?></span>

    <input type="hidden" name="patients" value="<?php echo $row['id']; ?>">
<? } ?> 
</form>

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
    echo '<div class="bg-white rounded p-4 text-center mb-5 border">
        <p class="mb-0 fs-5 fw-light">Выберите <span class="fw-bold">дату</span> на календаре!</p>
        <p class="mb-0 mt-2"><i class="bi bi-calendar4-week fs-2"></i></p>
    </div>';
} else {
    echo '<div class="bg-white rounded p-4 text-center mb-5 border">
        <p class="mb-0 fs-5 fw-light">В этот день у доктора выходной!</p>
        <p class="mb-0 mt-2"><i class="bi bi-calendar4-week fs-2"></i></p>
    </div>';
}

} else{

echo '<div class="bg-white rounded p-3 mb-5">';

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


echo '<button class="w-100 btn btn-primary" onclick="submitForms()" type="submit">Записаться</button>';
echo '</div>';
?>





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

<script>
var elem = document.querySelector('#record_patients');
elem.setAttribute('class', 'nav-link active');
</script>