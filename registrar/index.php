<?php 

    session_start();
    if(!isset($_SESSION['user_registr'])){
        header('Location: users/login.php');
        exit;
    } else {


include '../assets/inc/db.php';

$doctor_sql = "SELECT COUNT(*) FROM `doctor_list`";
$result_doctor = mysqli_query($link, $doctor_sql);
$row_doctor = mysqli_fetch_row($result_doctor);
$total_doctor = $row_doctor[0]; 

$patients_sql = "SELECT COUNT(*) FROM `patients`";
$result_patients = mysqli_query($link, $patients_sql);
$row_patients = mysqli_fetch_row($result_patients);
$total_patients = $row_patients[0]; 

$registr_sql = "SELECT COUNT(*) FROM `users`";
$result_registr = mysqli_query($link, $registr_sql);
$row_registr = mysqli_fetch_row($result_registr);
$total_registr = $row_registr[0]; 

$record_sql = "SELECT COUNT(*) FROM `record_patients_list`";
$result_record = mysqli_query($link, $record_sql);
$row_record = mysqli_fetch_row($result_record);
$total_record = $row_record[0]; 


?>

<?php 

include '../assets/modul/head.php';

?>
<div class="container-fluid">
	<div class="row">

			<?php include '../assets/modul/header.php'; ?>
			
	    <div class="col-12 p-0"> 
	    	<div class="container mt-4">
		    	<div class="row justify-content-center">
			    	<div class="col-11 col-md-4 border border-dark text-dark text-center pt-4 pb-3 m-3">
			    		<p>Прикрипленных пациентов:</p>	
			    		<h2><?php echo $total_patients; ?></h2>
			    	</div>
			    	<div class="col-11 col-md-4 border border-dark text-dark text-center m-3 pt-4 pb-3 m-3">
			    		<p>Всего врачей:</p>
			    		<h2><?php echo $total_doctor; ?></h2>	
			    	</div>
			    	<div class="col-11 col-md-4 border border-dark text-dark text-center pt-4 pb-3 m-3">
			    		<p>Сотрудников регистратуры:</p>	
			    		<h2><?php echo $total_registr; ?></h2>
			    	</div>
			    	<div class="col-11 col-md-4 border border-dark text-dark text-center pt-4 pb-3 m-3">
			    		<p>Все записи пациентов:</p>	
			    		<h2><?php echo $total_record; ?></h2>
			    	</div>
		    	</div>
	    	</div>
	    </div>
	</div>
</div>
<?php } ?>

<script>
var elem = document.querySelector('#home');
elem.setAttribute('class', 'nav-link active');
</script>
</main>
</body>
</html>