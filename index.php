<?php 
session_start();
if(!isset($_SESSION['user_patients'])){
    header('Location: patients/login.php');
    exit;
} else {

    include 'assets/modul/head_patients.php';
    include 'assets/modul/header_patients.php';

$day = date ("d"); 
$month = date ("m"); 
$year = date ("Y"); 

$date_delete = ''. $year . $month . $day .'';

if (isset($_GET['del_id'])) { //проверяем, есть ли переменная
//удаляем строку из таблицы
    header('Location: /');
    $sql = mysqli_query($link, "DELETE FROM `record_patients_list` WHERE `id` = {$_GET['del_id']}");
    $sql = mysqli_query($link, "DELETE FROM `record_patients_date` WHERE `id` = {$_GET['del_id']}");

}

if (isset($_SESSION['message_auth'])) {
  echo '<div id="notification" class="' . $_SESSION['message_bg_auth'] . ' position-fixed end-0 text-light bottom-0 p-3 m-2" style="z-index: 9999;">' . $_SESSION['message_auth'] . '</div>';
  unset($_SESSION['message_bg_auth']);
  unset($_SESSION['message_auth']);
}
?>

<main>
    <div class="container mt-0">

        <div class="d-flex justify-content-start mb-3 bg-warning p-1 bg-opacity-25 border border-3 border-warning border-opacity-50 mt-5">
            <i class="ms-2 bi-exclamation-circle text-warning fs-1 p-0"></i>
            <div class="p-1 ms-2">
                <h5 class="mb-1">Важно</h5>
                <span>При себе иметь полис и № записи</span>
            </div>
        </div>

        <div class="d-flex justify-content-between mb-2">
            <h3>Мои записи</h3>
            <a href="choice_doctor.php" class="btn btn-success text-white p-2"><i class="bi bi-plus-lg"></i> Записаться</a>
        </div>

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
                        <td class="p-2">Удалить</td>
                    </tr> 
                </thead>

                <tbody class="table-group-divider">
                    <?php 

                    include 'assets/inc/db.php';

                    $patients_active = $_SESSION['user_patients'];

                    $sql = "SELECT * FROM doctor_list, patients, record_patients_time, record_patients_list WHERE
                     record_patients_list.date_del >= '$date_delete' AND 
                     record_patients_list.doctor = doctor_list.id AND 
                     record_patients_list.patients = patients.id AND 
                     record_patients_list.time = record_patients_time.id AND
                     record_patients_list.patients = '$patients_active' 
                     ORDER BY `record_patients_list`.`month`, `record_patients_list`.`day`";

                    $res_data = mysqli_query($link, $sql);
                    while($row = mysqli_fetch_array($res_data)){
                        ?>

                        <tr>
                            <td class="p-2"><?php echo ''.$row['id'].'' ?></td>
                            <td class="p-2"><?php echo ''.$row['specialization'].'' ?></td>
                            <td class="p-2"><?php echo ''.$row['office'].'' ?></td>
                            <td class="p-2"><?php echo ''.$row['login'].'' ?></td>
                            <td class="p-2"><?php echo ''.$row['time_name'].'' ?></td>
                            <td class="p-2"><?php echo ''.$row['day'].'' ?></td>
                            <td class="p-2"><?php echo ''.$row['month'].'' ?></td>
                            <td class="p-2"><?php echo ''.$row['year'].'' ?></td>
                            <td class="p-2">
                                <a href="/?del_id=<?php echo ''.$row['id'].'' ?>" class="link-dark">
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

    </main>
</body>
</html>

<script>
    var elem = document.querySelector('#home');
    elem.setAttribute('class', 'nav-link active');

    setTimeout(() => {
      document.querySelector("#notification").remove();
  }, 5000)  
</script>

<?php } ?>