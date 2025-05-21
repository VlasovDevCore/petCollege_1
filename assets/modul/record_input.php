<form action="../../assets/inc/function/record_patients.php" method="POST" id="form1">
	<div class="row mb-3">
		<div class="d-flex flex-column gap-2 mt-5">

<?php 
$sql = "SELECT * FROM `doctor_list` WHERE `id` = $id_doctor";

$res_data = mysqli_query($link, $sql);
while($row = mysqli_fetch_array($res_data)){?>
    <p class="fw-light fs-5 mb-0">Специальность: <span class="fs-4 fw-semibold"><?php echo $row['specialization']; ?></span></p>
    <p class="w-100"><a href="/registrar/choice_doctor.php" class="text-secondary text-decoration-underline">Выбор другого доктора</a></p>
<?php    }?>
<?php  ?>


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

?>

    <input type="hidden" id="example" name="time" value="">
    <input type="hidden" id="date" name="date" value="<?php echo $_GET['year'] . "-" . $num_padded_month . "-" . $num_padded_day; ?>">
    <input type="hidden" id="day" name="day" value="<?php echo $day_input; ?>">
    <input type="hidden" id="month" name="month" value="<?php echo $month_input; ?>">
    <input type="hidden" id="year" name="year" value="<?php echo $year_input; ?>">
    <input type="hidden" id="doctor" name="doctor" value="<?php echo $id_doctor; ?>">
    <input type="hidden" id="registr_id" name="registr_id" value="<?php echo $login; ?>">

</form>

