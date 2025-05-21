<?php 

    session_start();
    if(!isset($_SESSION['user_registr'])){
        header('Location: users/login.php');
        exit;
    } else {

?>

<?php 

include '../assets/inc/db.php';

$search_find = $_GET['search'];

include '../assets/modul/head.php'

?>

<div class="container-fluid">
	<div class="row">
			<?php include '../assets/modul/header.php'; ?>
	    <div class="col-12 p-0">
	    	<div class="container mt-3 text-center">
                <h3 class="my-4">Список врачей</h3>
		    	<form action="<?= $_SERVER['SCRIPT_NAME'] ?>">
		    		<div class="row mb-3">
<div class="col-12 text-end mb-3">
	
		<a href="?search=На+работе" class="mb-0 rounded bg-success text-white p-1 px-2 me-1">На работе</a>
		<a href="?search=Выходной" class="mb-0 rounded bg-warning text-dark p-1 px-2 me-1">Выходной</a>

</div>		    			
		    			<div class="col-xl-8 col-12 mb-3">
		    				<div class="row">

<div class="col-12">
<?php 
if ($search_find) {
	echo "
<div class=\"text-end\">
	<a href=\"/registrar/list_doctors.php\" class=\"text-secondary text-decoration-underline\">Открыть весь список</a>
</div>";
} else{}
?>
</div>
								</div>
		    			</div>
		    			<div class="d-flex col-xl-4 col-12 col-4 flex-row gap-2">
			    			<input type="text" name="search" value="<?php echo $search_find; ?>" class="form-control" placeholder="Поиск врача...">
		    				<button class="btn btn-dark" type="submit">Поиск</button>
		    			</div>
	    			</div>
		    	</form>
		<div style="overflow-x: auto;white-space: nowrap;">
 		    <table class="table table-light table-bordered table-hover text-center"  border="1">
	  			<thead>
					  <tr>
				      	<td class="p-2">#</td>
				      	<td class="p-2">Специальность</td>
				      	<td class="p-2">Кабинет</td>
				      	<td class="p-2">Внут-ий телефон</td>
				      	<td class="p-2">Время работы</td>
				      	<td class="p-2">Статус</td>

						<?php 
							if (!$admin == 0) {
								echo "<td class=\"p-2\" width=\"20%\">Изменить</td>";
							}
						?>

					  </tr> 
					</thead>
			
				<tbody class="table-group-divider"> 
<?php

include '../assets/inc/function/search_doctor.php';

if ($search_find) {
	countPeople($result); // Функция вывода пользователей
} else{?>

<?php


if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$size_page = 8;
$offset = ($page-1) * $size_page;

$pages_sql = "SELECT COUNT(*) FROM `doctor_list`";
$result = mysqli_query($link, $pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $size_page);

$sql = "SELECT * FROM `doctor_list` LIMIT $offset, $size_page";

$res_data = mysqli_query($link, $sql);
while($row = mysqli_fetch_array($res_data)){?>
			<tr>
		      	<td class="p-2"><?php echo ''.$row['id'].'' ?></td>
		      	<td class="p-2"><?php echo ''.$row['specialization'].'' ?></td>
		      	<td class="p-2"><?php echo ''.$row['office'].'' ?></td>
		      	<td class="p-2"><?php echo ''.$row['internal_phone'].'' ?></td>
		      	<td class="p-2"><?php echo ''.$row['working_hours'].'' ?></td>

<?php 
$status = ''.$row['status'].'';

if ($status == "На работе") {
	$status = "bg-success text-white";	
} elseif ($status == "Выходной") {
	$status = "bg-warning text-dark";
} 
?>

		      	<td class="p-1"><p class="mb-0 rounded <?php echo $status; ?> p-1"><?php echo ''.$row['status'].'' ?></p></td>

<?php 
	if (!$admin == 0) {
		echo "<td class=\"p-2\" width=\"20%\"><a href=\"setting_doctor?doctor=".$row['id']."\">Изменить</a></td>";
	}
?>
				

			</tr> 
<?php    }
?>

		</tbody> 
	</table>
</div>

<nav class="mt-4">
    <ul class="pagination pagination-xl justify-content-center">
    <li class="page-item d-md-block d-none"><a href="?page=1" class="page-link text-dark border">Начало</a></li>
    <li class="<?php if($page <= 1){ echo 'disabled'; } ?> page-item">
        <a href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>" class="page-link text-dark border">Назад</a>
    </li>
    <li class="page-item">
    		<a href="" class="disabled page-link text-dark border"><?php echo $page ?></a>
    </li>
    <li class="<?php if($page >= $total_pages){ echo 'disabled'; } ?> page-item">
        <a href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?page=".($page + 1); } ?>" class="page-link text-dark border">Далее</a>
    </li>
    <li class="page-item d-md-block d-none"><a href="?page=<?php echo $total_pages; ?>" class="page-link text-dark border">Последнее</a></li>
</ul>
</nav>

<?php } ?>

		    </div>
	    </div>
	</div>
</div>

<script>
var elem = document.querySelector('#list_doctors');
elem.setAttribute('class', 'nav-link active');
</script>
</main>
<?php } ?>
</body>
</html>
