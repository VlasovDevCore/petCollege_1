<?php

if (isset($_REQUEST['search'])) {
	$inputSearch = $_REQUEST['search'];
} else {
	$inputSearch = "";
}

// Получаем запрос
// $inputSearch = $_REQUEST['search']; 

// Создаём SQL запрос
$sql = "SELECT * FROM `users` WHERE `id` = '$inputSearch' || `login` = '$inputSearch'";

// Отправляем SQL запрос
$result = $link -> query($sql);
function doesItExist(array $arr) {
	// Создаём новый массив
	$data = array(
	'id' => $arr['id'] != false ? $arr['id'] : 'Нет данных',
	'login' => $arr['login'] != false ? $arr['login'] : 'Нет данных',
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

$status = ''.$row['status'].'';

$status_name = "";

if (!$status == 0) {
	$status_name = "<span class=\"bg-success p-1 rounded-1\"><a href='../assets/inc/function/undate_regist.php?id=".$row['id']."' class='text-white'>Активирован</a></span>";
} else {
	$status_name = "<span class=\"bg-danger p-1 rounded-1\"><a href='../assets/inc/function/update_regist.php?id=".$row['id']."' class='text-white'>Не активирован</a></span>";
} 

echo "<tr>
<td class=\"p-2\">". $row['id'] ."</td>
<td class=\"p-2\">". $row['login'] ."</td>
<td class=\"p-2\">". $status_name ."</td>
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