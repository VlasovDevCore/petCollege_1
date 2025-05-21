<?php 

    session_start();
    if(!isset($_SESSION['user_registr'])){
        header('Location: users/login.php');
        exit;
    } else {

if (isset($_SESSION['message_check'])) {
  echo '<div id="notification" class="bg-danger position-fixed end-0 text-light bottom-0 p-3 m-2" style="z-index: 9999;">' . $_SESSION['message_check'] . '</div>';
  unset($_SESSION['message_check']);
}

?>

<?php 

include '../assets/inc/db.php';

$search_find = $_GET['search'];

include '../assets/modul/head.php'

?>

<?php include '../assets/modul/header.php'; ?>

<div class="container mt-0">
	<div class="row">
	    <div class="col-12 p-0">
	    	<div class="container mt-3 text-center">
                <h3 class="my-4">Список медецинских регистраторов</h3>
		    	<form action="<?= $_SERVER['SCRIPT_NAME'] ?>">
		    		<div class="row justify-content-end mb-3">
		    			<div class="col-8 p-2">
<?php 
if ($search_find) {
	echo "
<div class=\"text-end\">
	<a href=\"list_registr.php\" class=\"text-secondary text-decoration-underline\">Открыть весь список</a>
</div>";
} else{}
?>
		    			</div>
		    			<div class="d-flex col-xl-4 col-12 flex-row gap-2">
			    			<input type="text" name="search" value="<?php echo $search_find; ?>" class="form-control" placeholder="Поиск мед.регистр...">
		    				<button class="btn btn-dark" type="submit">Поиск</button>
		    			</div>
	    			</div>
		    	</form>
		<div style="overflow-x: auto;white-space: nowrap;">
 		    <table class="table table-light table-bordered table-hover text-center"  border="1">
	  				<thead>
					    <tr>
					      	<td class="p-2">#</td>
					      	<td class="p-2">Логин</td>
					      	<td class="p-2">Статус</td>
					    </tr> 
					</thead>
			
				<tbody class="table-group-divider"> 
<?php

include '../assets/inc/function/search_regist.php';

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

$pages_sql = "SELECT COUNT(*) FROM `users`";
$result = mysqli_query($link, $pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $size_page);

$sql = "SELECT * FROM `users` LIMIT $offset, $size_page";

$res_data = mysqli_query($link, $sql);
while($row = mysqli_fetch_array($res_data)){?>
			<tr>
		      	<td class="p-2"><?php echo ''.$row['id'].'' ?></td>
		      	<td class="p-2"><?php echo ''.$row['login'].'' ?></td>

<?php 

$status = ''.$row['status'].'';

$status_name = "";

if (!$status == 0) {
	$status_name = "<span class=\"bg-success p-1 rounded-1\"><a href='../assets/inc/function/undate_regist.php?id=".$row['id']."' class='text-white'>Активирован</a></span>";
} else {
	$status_name = "<span class=\"bg-danger p-1 rounded-1\"><a href='../assets/inc/function/update_regist.php?id=".$row['id']."' class='text-white'>Не активирован</a></span>";
} 


?>

		      	<td class="p-2" width="20%"><?php echo $status_name ?></td>
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
    setTimeout(() => {
      document.querySelector("#notification").remove();
  }, 5000)  
</script>
<script>
var elem = document.querySelector('#list_registr');
elem.setAttribute('class', 'nav-link active');
</script>

</main>

<?php } ?>
</body>
</html>