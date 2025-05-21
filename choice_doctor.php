<?php 
session_start();
if(!isset($_SESSION['user_patients'])){
	header('Location: patients/login.php');
	exit;
} else {

	include 'assets/inc/db.php';

	$search_find = $_GET['search'];
	
	include 'assets/modul/head_patients.php';

	?>


	<div class="container-fluid">
		<div class="row">

			<?php include 'assets/modul/header_patients.php'; ?>

			<div class="col-12 p-0">
				<div class="container mt-3">
					<h3 class="my-4 text-center">Выбор доктора</h3>
<form action="<?= $_SERVER['SCRIPT_NAME'] ?>">
	<div class="row justify-content-start mb-3">
		<div class="col-8 p-2">

			<div class="col-md-6 col-12">
				<?php 
				if ($search_find) {
					echo "
					<div class=\"text-start ps-2\">
					<a href=\"/choice_doctor.php\" class=\"text-secondary text-decoration-underline\">Открыть весь список</a>
					</div>";
				} else{}
				?>
			</div>

		</div>
		<div class="d-flex col-md-4 col-12 flex-row gap-2">
			<input type="text" name="search" value="<?php echo $search_find; ?>" class="form-control" placeholder="Поиск доктора...">
			<button class="btn btn-primary" type="submit">Поиск</button>
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
									<td class="p-2">Время работы</td>
									<td class="p-2">Запись</td>
								</tr> 
							</thead>
							
							<tbody class="table-group-divider"> 
<?php
	include 'assets/inc/function/search_doctor_record.php';

	if ($search_find) {
		countPeople($result); // Функция вывода пользователей
	} else { 
?>

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
		<td class="p-2"><?php echo ''.$row['working_hours'].'' ?></td>
		<td class="p-2"><a href="page/record_patients.php?doctor=<?php echo ''.$row['id'].'' ?>">Записаться к врачу</a></td>
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
	var elem = document.querySelector('#record_patients');
	elem.setAttribute('class', 'nav-link active');
</script>
</main>

<?php } ?>

</body>
</html>
