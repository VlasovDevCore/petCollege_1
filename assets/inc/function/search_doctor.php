<?php
// Установить соединение с базой данных

if (isset($_REQUEST['search'])) {
    $inputSearch = mysqli_real_escape_string($link, $_REQUEST['search']);
} else {
    $inputSearch = "";
}

// Создаём SQL запрос
$sql = "SELECT * FROM `doctor_list` WHERE `id` = '$inputSearch' || `specialization` = '$inputSearch' || `office` = '$inputSearch' || `internal_phone` = '$inputSearch' || `working_hours` = '$inputSearch' || `status` = '$inputSearch'";

// Отправляем SQL запрос
$result = $link->query($sql);

function doesItExist(array $arr)
{
    // Создаём новый массив
    $data = array(
        'id' => isset($arr['id']) ? $arr['id'] : 'Нет данных',
        'specialization' => isset($arr['specialization']) ? $arr['specialization'] : 'Нет данных',
        'office' => isset($arr['office']) ? $arr['office'] : 'Нет данных',
        'internal_phone' => isset($arr['internal_phone']) ? $arr['internal_phone'] : 'Нет данных',
        'working_hours' => isset($arr['working_hours']) ? $arr['working_hours'] : 'Нет данных',
        'status' => isset($arr['status']) ? $arr['status'] : 'Нет данных'
    );
    return $data; // Возвращаем этот массив
}

function countPeople($result)
{
    global $link; // Добавляем эту строку, чтобы использовать соединение внутри функции

    // Проверка на то, что строк больше нуля
    if ($result->num_rows > 0) {
        // Цикл для вывода данных
        while ($row = $result->fetch_assoc()) {
            // Получаем массив с строками, которые нужно выводить
            $arr = doesItExist($row);

            $status = $row['status'];

            if ($status == "На работе") {
                $statusClass = "bg-success text-white";
            } elseif ($status == "Выходной") {
                $statusClass = "bg-warning text-dark";
            } else {
                $statusClass = "";
            }

            $sql = "SELECT * FROM `users` WHERE `id` = ".$_SESSION['user_registr']."";

            $res_data = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_array($res_data)) {
                $admin = $row['admin'];
            }


echo "<tr>
    <td class=\"p-2\">". $arr['id'] ."</td>
    <td class=\"p-2\">". $arr['specialization'] ."</td>
    <td class=\"p-2\">". $arr['office'] ."</td>
    <td class=\"p-2\">". $arr['internal_phone'] ."</td>
    <td class=\"p-2\">". $arr['working_hours'] ."</td>
    <td class=\"p-1\"><p class=\"mb-0 rounded ".$statusClass." p-1\">".$arr['status']." </p></td>";

if ($admin > 0) {
    echo "<td class=\"p-2\" width=\"20%\"><a href=\"setting_doctor?doctor=".$arr['id']."\">Изменить</a></td>";
} else {

}

echo "</tr>";

        }
    } else {
        echo "<tr>
            <td colspan=\"7\">
            <p class=\"mb-0 fs-5 fw-light mt-4\">Результатов <span class=\"fw-bold\">не найдено</span></p>
            <p class=\"mb-4 mt-2\"><i class=\"bi bi-exclamation-circle-fill text-danger fs-2\"></i></p>
            </td>
            </tr>";
    }
}
?>
