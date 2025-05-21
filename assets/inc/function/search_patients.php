<?php
if (isset($_REQUEST['search'])) {
	$inputSearch = $_REQUEST['search'];
} else {
	$inputSearch = "";
}

$sql = "SELECT * FROM `patients` WHERE `id` = '$inputSearch' || `login` = '$inputSearch' || `sector_card` = '$inputSearch'";

$result = $link -> query($sql);

function doesItExist(array $arr) {
	$data = array(
		'id' => $arr['id'] != false ? $arr['id'] : 'Нет данных',
		'login' => $arr['login'] != false ? $arr['login'] : 'Нет данных',
		'sector_card' => $arr['sector_card'] != false ? $arr['sector_card'] : 'Нет данных',
	);
return $data; 
}
function countPeople($result) { 
	if ($result -> num_rows > 0) {
		while ($row = $result -> fetch_assoc()) {
			$arr = doesItExist($row);
			echo "<tr>
			<td class=\"p-2\">". $row['id'] ."</td>
			<td class=\"p-2\">". $row['login'] ."</td>
			<td class=\"p-2\">". $row['sector_card'] ."</td>
			<td class=\"p-2\">". date("d.m.Y H:i",strtotime($row['date'])) ."</td>
			<td class=\"p-2\"><a href=\"setting?patients=".$row['id']."\"><i class=\"bi bi-card-checklist\"></i></a></td>
			<td class=\"p-2\"><a href=\"?del_id=".$row['id']."\"><i class=\"bi bi-trash3\"></i></a></td>
			</tr>
			";

		}
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



