<?php


if (isset($_REQUEST['search'])) {
	$inputSearch = $_REQUEST['search'];
} else {
	$inputSearch = "";
}

// Создаём SQL запрос

$sql = "SELECT * FROM doctor_list, patients, record_patients_time, record_patients_list WHERE record_patients_list.date_del > '2023-04-01' AND record_patients_list.doctor = doctor_list.id AND record_patients_list.patients = patients.id AND record_patients_list.time = record_patients_time.id AND record_patients_list.id = '$inputSearch' ORDER BY `record_patients_list`.`month`, `record_patients_list`.`day`; ";

// Отправляем SQL запрос
$result = $link -> query($sql);

function doesItExist(array $arr) {
	// Создаём новый массив
	$data = array(
	'id' => $arr['id'] != false ? $arr['id'] : 'Нет данных',
	'login' => $arr['login'] != false ? $arr['login'] : 'Нет данных',
	'sector_card' => $arr['sector_card'] != false ? $arr['sector_card'] : 'Нет данных',
);
return $data; // Возвращаем этот массив
}

function countPeople($result) { 
// Проверка на то, что строк больше нуля
if ($result -> num_rows > 0) {
// Цикл для вывода данных
	while ($row = $result -> fetch_assoc()) {
	// Получаем массив с строками которые нужно выводить
$arr = doesItExist($row);
// Вывод данных
echo "<tr>
<td class=\"p-2\">". $row['id'] ."</td>
<td class=\"p-2\">". $row['specialization'] ."</td>
<td class=\"p-2\">". $row['login'] ."</td>
<td class=\"p-2\">". $row['time_name'] ."</td>
<td class=\"p-2\">". $row['day'] ."</td>
<td class=\"p-2\">". $row['month'] ."</td>
<td class=\"p-2\">". $row['year'] ."</td>
<td class=\"p-2\">
    <a href=\"?del_id=". $row['id'] ."\" class=\"link-dark\">".$row['registr_id']."</i>
    </a>
</td>
<td class=\"p-2\">
    <a href=\"?del_id=". $row['id'] ."\" class=\"link-dark\">
        <i class=\"bi bi-trash3\"></i>
    </a>
</td>
</tr>
";

}
// Если данных нет
} else {

    echo "<tr>
<td colspan=\"8\">
<p class=\"mb-0 fs-5 fw-light mt-4\">Результатов <span class=\"fw-bold\">не найдено</span></p>
<p class=\"mb-4 mt-2\"><i class=\"bi bi-exclamation-circle-fill text-danger fs-2\"></i></p>
</td>
</tr>";


}
}

?>