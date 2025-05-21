<?php


if (isset($_REQUEST['search'])) {
	$inputSearch = $_REQUEST['search'];
} else {
	$inputSearch = "";
}

// Создаём SQL запрос
// $sql = "SELECT * FROM `patients` WHERE `id` = '$inputSearch' || `login` = '$inputSearch' || `sector_card` = '$inputSearch'";

$sql = "SELECT * FROM doctor_list, patients, record_patients_time, record_patients_list WHERE 

record_patients_date.id = '$inputSearch' 

ORDER BY `record_patients_list`.`month`, `record_patients_list`.`day` ASC";

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
<td class=\"p-2\">". $row['login'] ."</td>
<td class=\"p-2\">". $row['doctor_id'] ."</td>
<td class=\"p-2\"><a href=\"setting?patients=".$row['id']."\"><i class=\"bi bi-card-checklist\"></i></a></td>
<td class=\"p-2\"><a href=\"?del_id=".$row['id']."\"><i class=\"bi bi-trash3\"></i></a></td>
</tr>
";

}
// Если данных нет
} else {

    echo "<tr>
<td colspan=\"6\">
<p class=\"mb-0 fs-5 fw-light mt-4\">Результатов <span class=\"fw-bold\">не найдено</span></p>
<p class=\"mb-4 mt-2\"><i class=\"bi bi-exclamation-circle-fill text-danger fs-2\"></i></p>
</td>
</tr>";


}
}

?>