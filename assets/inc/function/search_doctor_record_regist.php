<?php

if (isset($_REQUEST['search'])) {
	$inputSearch = $_REQUEST['search'];
} else {
	$inputSearch = "";
}

// Создаём SQL запрос
$sql = "SELECT * FROM `doctor_list` WHERE `id` = '$inputSearch' || `specialization` = '$inputSearch' || `office` = '$inputSearch' || `internal_phone` = '$inputSearch' || `working_hours` = '$inputSearch' || `status` = '$inputSearch'";

// Отправляем SQL запрос
$result = $link -> query($sql);

function doesItExist(array $arr) {
	// Создаём новый массив
	$data = array(
	'id' => $arr['id'] != false ? $arr['id'] : 'Нет данных',
	'office' => $arr['office'] != false ? $arr['office'] : 'Нет данных',
	'internal_phone' => $arr['internal_phone'] != false ? $arr['internal_phone'] : 'Нет данных',
	'working_hours' => $arr['working_hours'] != false ? $arr['working_hours'] : 'Нет данных',
	'status' => $arr['status'] != false ? $arr['status'] : 'Нет данных'
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
<td class=\"p-2\">". $row['office'] ."</td>
<td class=\"p-2\">". $row['internal_phone'] ."</td>
<td class=\"p-2\">". $row['working_hours'] ."</td>
<td class=\"p-2\"><a href=\"page/record_patients.php?doctor=".$row['id']."\">Записаться к врачу</a></td>
</tr>
";

}
// Если данных нет
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