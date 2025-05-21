<?php 
session_start();
if(!isset($_SESSION['user_patients'])){
    header('Location: patients/login.php');
    exit;
} else {

    include 'assets/inc/db.php';
    include 'assets/modul/head_patients.php';

    $day = date ("d"); 
    $month = date ("m"); 
    $year = date ("Y"); 

    $date_delete = ''. $year . $month . $day .'';
    
    $patients_active = $_SESSION['user_patients'];

    ?>


    <div class="container-fluid">
        <div class="row">

            <?php include 'assets/modul/header_patients.php'; ?>

            <div class="col-12 p-0">
                <div class="container mt-3">

                    <h3 class="my-3">Мои прошлые записи</h3>
                <div style="overflow-x: auto;white-space: nowrap;">
                    <table class="table table-light table-bordered table-hover text-center"  border="1">
                        <thead>
                          <tr>
                            <td class="p-2">№ Записи</td>
                            <td class="p-2">Специальность</td>
                            <td class="p-2">Кабинет</td>
                            <td class="p-2">Пациент</td>
                            <td class="p-2">Время</td>
                            <td class="p-2">День</td>
                            <td class="p-2">Месяц</td>
                            <td class="p-2">Год</td>
                        </tr> 
                    </thead>

                    <tbody class="table-group-divider"> 

                        <?php


                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }

                        $size_page = 10;
                        $offset = ($page-1) * $size_page;

                        $pages_sql = "SELECT COUNT(*) FROM doctor_list, patients, record_patients_time, record_patients_list WHERE
                        record_patients_list.date_del < '$date_delete' AND 
                        record_patients_list.doctor = doctor_list.id AND 
                        record_patients_list.patients = patients.id AND 
                        record_patients_list.time = record_patients_time.id AND
                        record_patients_list.patients = '$patients_active' 
                        ORDER BY `record_patients_list`.`month`, `record_patients_list`.`day`";
                        $result = mysqli_query($link, $pages_sql);
                        $total_rows = mysqli_fetch_array($result)[0];
                        $total_pages = ceil($total_rows / $size_page);

                        $sql = "SELECT * FROM doctor_list, patients, record_patients_time, record_patients_list WHERE
                        record_patients_list.date_del < '$date_delete' AND 
                        record_patients_list.doctor = doctor_list.id AND 
                        record_patients_list.patients = patients.id AND 
                        record_patients_list.time = record_patients_time.id AND
                        record_patients_list.patients = '$patients_active' 
                        ORDER BY `record_patients_list`.`month`, `record_patients_list`.`day` LIMIT $offset, $size_page";

                        $res_data = mysqli_query($link, $sql);
                        while($row = mysqli_fetch_array($res_data)){?>
                            <tr>
                                <td class="p-2"><?php echo ''.$row['id'].'' ?></td>
                                <td class="p-2"><?php echo ''.$row['specialization'].'' ?></td>
                                <td class="p-2"><?php echo ''.$row['office'].'' ?></td>
                                <td class="p-2"><?php echo ''.$row['login'].'' ?></td>
                                <td class="p-2"><?php echo ''.$row['time_name'].'' ?></td>
                                <td class="p-2"><?php echo ''.$row['day'].'' ?></td>
                                <td class="p-2"><?php echo ''.$row['month'].'' ?></td>
                                <td class="p-2"><?php echo ''.$row['year'].'' ?></td>
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
            <?php if ($total_list) { ?>
                <nav class="mt-4">
                    <ul class="pagination pagination-xl justify-content-center">
                        <li class="page-item"><a href="?page=1" class="page-link text-dark border">Начало</a></li>
                        <li class="<?php if($page <= 1){ echo 'disabled'; } ?> page-item">
                            <a href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>" class="page-link text-dark border">Назад</a>
                        </li>
                        <li class="page-item">
                                <a href="" class="disabled page-link text-dark border"><?php echo $page ?></a>
                        </li>
                        <li class="<?php if($page >= $total_pages){ echo 'disabled'; } ?> page-item">
                                <a href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?page=".($page + 1); } ?>" class="page-link text-dark border">Далее</a>
                        </li>
                        <li class="page-item"><a href="?page=<?php echo $total_pages; ?>" class="page-link text-dark border">Последнее</a></li>
                    </ul>
                </nav>
            <?php } ?>

                </div>
            </div>
        </div>
    </div>

    <script>
        var elem = document.querySelector('#past');
        elem.setAttribute('class', 'nav-link active');
    </script>
</main>

<?php } ?>

</body>
</html>
