<?php 

    session_start();
    if(!isset($_SESSION['user_registr'])){
        header('Location: users/login.php');
        exit;
    } else {
   
include '../assets/inc/db.php';

if (isset($_GET['del_id'])) { 
	$sql = mysqli_query($link, "DELETE FROM `patients` WHERE `id` = {$_GET['del_id']}");
}

$search_find = $_GET['search'];

include '../assets/modul/head.php';

?>

<div class="container-fluid">
	<div class="row">
			<?php include '../assets/modul/header.php'; ?>
	    <div class="col-12 p-0">
	    	<div class="container mt-3 text-center">
                <h3 class="my-4">Список пациентов</h3>
		    	<form action="<?= $_SERVER['SCRIPT_NAME'] ?>">
		    		<div class="row justify-content-end mb-3">
		    			<div class="col-8 p-2">
<?php 
if ($search_find) {
	echo "
<div class=\"text-end\">
	<a href=\"/registrar/list_patients.php\" class=\"text-secondary text-decoration-underline\">Открыть весь список</a>
</div>";
} else{}
?>
		    			</div>
		    			<div class="d-flex col-xl-4 col-12 flex-row gap-2">
			    			<input type="text" name="search" value="<?php echo $search_find; ?>" class="form-control" placeholder="Поиск пациента...">
		    				<button class="btn btn-dark" type="submit">Поиск</button>
		    			</div>
	    			</div>
		    	</form>
		<div style="overflow-x: auto;white-space: nowrap;">
 		    <table class="table table-light table-bordered table-hover text-center"  border="1">
	  				<thead>
					    <tr>
					      	<td class="p-2">#</td>
					      	<td class="p-2 col-4">Логин</td>
					      	<td class="p-2">Сектор карты</td>
					      	<td class="p-2">Время поступления</td>
					      	<td class="p-2 col-1">Изменить</td>
					      	<td class="p-2 col-1">Удалить</td>
					    </tr> 
					</thead>
			
				<tbody class="table-group-divider"> 
<?php

include '../assets/inc/function/search_patients.php';

if ($search_find) {
	countPeople($result); // Функция вывода пользователей
} else{?>

<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$size_page = 10;
$offset = ($page-1) * $size_page;

$pages_sql = "SELECT COUNT(*) FROM `patients`";
$result = mysqli_query($link, $pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $size_page);

$sql = "SELECT * FROM `patients` LIMIT $offset, $size_page";

$res_data = mysqli_query($link, $sql);
while($row = mysqli_fetch_array($res_data)){?>
			<tr>
		      	<td class="p-2"><?php echo ''.$row['id'].'' ?></td>
		      	<td class="p-2"><?php echo ''.$row['login'].'' ?></td>
		      	<td class="p-2"><?php echo ''.$row['sector_card'].'' ?></td>

		      	<td class="p-2"><?php echo date("d.m.Y H:i",strtotime($row['date'])) ?></td>
		      	<td class="p-2"><a href="setting?patients=<?php echo ''.$row['id'].'' ?>"><i class="bi bi-card-checklist"></i></a></td>
		      	<td class="p-2"><a href="?del_id=<?php echo ''.$row['id'].'' ?>"><i class="bi bi-trash3"></i></a></td>
			</tr> 
<?php } ?>
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
var elem = document.querySelector('#list_patients');
elem.setAttribute('class', 'nav-link active');
</script>

</main>

<?php } ?>
</body>
</html>