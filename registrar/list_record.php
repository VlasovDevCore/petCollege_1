<?php 

    session_start();
    if(!isset($_SESSION['user_registr'])){
        header('Location: users/login.php');
        exit;
    } else {
   
include '../assets/inc/db.php';

if (isset($_GET['del_id'])) { //проверяем, есть ли переменная
//удаляем строку из таблицы
    header('Location: /registrar/list_record');
    $sql = mysqli_query($link, "DELETE FROM `record_patients_list` WHERE `id` = {$_GET['del_id']}");
    $sql = mysqli_query($link, "DELETE FROM `record_patients_date` WHERE `id` = {$_GET['del_id']}");

}

$search_find = $_GET['search'];

include '../assets/modul/head.php';

$day = date ("d"); 
$month = date ("m"); 
$year = date ("Y"); 

$date_delete = ''. $year . $month . $day .'';

?>

<div class="container-fluid">
    <div class="row">
            <?php include '../assets/modul/header.php'; ?>
        <div class="col-12 p-0">
            <div class="container mt-4 text-center">
                <h3 class="my-3">Список записанных пациентов</h3>
                <form action="<?= $_SERVER['SCRIPT_NAME'] ?>">
                    <div class="row d-flex justify-content-end mb-3">
                        <div class="col-12 text-end mb-3">
                            <a href="choice_doctor" class="btn btn-success"><i class="bi bi-plus-lg"></i> Записать</a>
                        </div>
                        <div class="col-8 p-2">
<?php 
if ($search_find) {
    echo "
<div class=\"text-end\">
    <a href=\"/registrar/list_record\" class=\"text-secondary text-decoration-underline\">Открыть весь список</a>
</div>";
} else{}
?>
                        </div>
                        <div class="d-flex col-xl-4 col-12 gap-2">
                            <input type="text" name="search" value="<?php echo $search_find; ?>" class="form-control" placeholder="№ Записи...">
                            <button class="btn btn-dark" type="submit">Поиск</button>
                        </div>
                    </div>
                </form>
        <div style="overflow-x: auto;white-space: nowrap;">
            <table class="table table-light table-bordered table-hover text-center"  border="1">
                    <thead>
                        <tr>
                            <td class="p-2">№ Записи</td>
                            <td class="p-2">Специальность</td>
                            <td class="p-2">Пациент</td>
                            <td class="p-2">Время</td>
                            <td class="p-2">День</td>
                            <td class="p-2">Месяц</td>
                            <td class="p-2">Год</td>
                            <td class="p-2">№ рег.</td>
                            <td class="p-2">Удалить</td>
                        </tr> 
                    </thead>
            
                <tbody class="table-group-divider"> 
<?php

include '../assets/inc/function/search_record.php';

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

$pages_sql = "SELECT COUNT(*) FROM doctor_list, patients, record_patients_time, record_patients_list WHERE
record_patients_list.date_del >= '$date_delete' AND 
record_patients_list.doctor = doctor_list.id AND 
record_patients_list.patients = patients.id AND 
record_patients_list.time = record_patients_time.id 
ORDER BY `record_patients_list`.`month`, `record_patients_list`.`day` LIMIT $offset, $size_page";
$result = mysqli_query($link, $pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $size_page);

$sql = "SELECT * FROM doctor_list, patients, record_patients_time, record_patients_list WHERE
record_patients_list.date_del >= '$date_delete' AND 
record_patients_list.doctor = doctor_list.id AND 
record_patients_list.patients = patients.id AND 
record_patients_list.time = record_patients_time.id 
ORDER BY `record_patients_list`.`month`, `record_patients_list`.`day` LIMIT $offset, $size_page";


$res_data = mysqli_query($link, $sql);
while($row = mysqli_fetch_array($res_data)){

$link_specialization = str_replace(' ', '+', ''.$row['specialization'].'');
$link_fio_patients = str_replace(' ', '+', ''.$row['login'].'');
    ?>
            <tr>
                <td class="p-2"><?php echo ''.$row['id'].'' ?></td>
                <td class="p-2">
                    <a href="list_doctors.php?search=<?php echo $link_specialization; ?>" class="link-dark"><?php echo ''.$row['specialization'].'' ?></a>
                </td>
                <td class="p-2">
                    <a href="list_patients.php?search=<?php echo $link_fio_patients; ?>" class="link-dark"><?php echo ''.$row['login'].'' ?></a>
                </td>
                <td class="p-2"><?php echo ''.$row['time_name'].'' ?></td>
                <td class="p-2"><?php echo ''.$row['day'].'' ?></td>
                <td class="p-2"><?php echo ''.$row['month'].'' ?></td>
                <td class="p-2"><?php echo ''.$row['year'].'' ?></td>
                <td class="p-2">

<?php 

if ($row['registr_id'] == "Самозапись") {?>
    <span><?php echo ''.$row['registr_id'].'' ?></span>
<?php } else { ?>
    <a href="list_registr.php?search=<?php echo ''.$row['registr_id'].'' ?>" class="link-dark">
        <?php echo ''.$row['registr_id'].'' ?>
    </a>
<?php } ?>

                </td>
                <td class="p-2">
                    <a href="?del_id=<?php echo ''.$row['id'].'' ?>" class="link-dark">
                        <i class="bi bi-trash3"></i>
                    </a>
                </td>
            </tr> 
<?php } 

            $res_data = mysqli_query($link, $sql);
            $row_list = mysqli_fetch_row($res_data);
            $total_list = $row_list[0]; 

            if (!$total_list) {?>
              <tr>
                    <td colspan="9">
                        <p class="mb-0 fs-5 fw-light mt-4">Записей <span class="fw-bold">не найдено</span></p>
                        <p class="mb-4 mt-2"><i class="bi bi-exclamation-circle-fill text-danger fs-1"></i></p>
                    </td>
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
var elem = document.querySelector('#list_record');
elem.setAttribute('class', 'nav-link active');
</script>

</main>

<?php } ?>
</body>
</html>