<style>
tr{
  height: 65px;
}
</style>

<?php

// местоположение скрипта
$self = $_SERVER['PHP_SELF'];

// проверяем, если в переменная month была установлена в URL-адресе,
//либо используем PHP функцию date(), чтобы установить текущий месяц.
if(isset($_GET['month'])) 
	$month = $_GET['month'];
elseif(isset($_GET['viewmonth'])) 
	$month = $_GET['viewmonth'];
else 
	$month = date('m');

// Теперь мы проверим, если переменная года устанавливается в URL,
//либо использовать PHP функцию date(),
//чтобы установить текущий год, если текущий год не установлен в URL-адресе.
if(isset($_GET['year'])) 
	$year = $_GET['year'];
elseif(isset($_GET['viewyear'])) 
	$year = $_GET['viewyear'];
else 
	$year = date('Y');

if($month == '12') 
	$next_year = $year + 1;
else 
	$next_year = $year;
	
	
$Month_r = array(
"1" => "Январь",
"2" => "Февраль",
"3" => "Март",
"4" => "Апрель",
"5" => "Май",
"6" => "Июнь",
"7" => "Июль",
"8" => "Август",
"9" => "Сентябрь",
"10" => "Октябрь",
"11" => "Ноябрь",
"12" => "Декабрь"); 

$first_of_month = mktime(0, 0, 0, $month, 1, $year);

// Массив имен всех дней в неделю
$day_headings = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

$maxdays = date('t', $first_of_month);
$date_info = getdate($first_of_month);
$month = $date_info['mon'];
$year = $date_info['year'];

// Если текущий месяц это январь,
//и мы пролистываем календарь задом наперед число,
//обозначающее год, должно уменьшаться на один. 
if($month == '1') 
	$last_year = $year-1;
else 
	$last_year = $year;

// Вычитаем один день с первого дня месяца,
//чтобы получить в конец прошлого месяца
$timestamp_last_month = $first_of_month - (24*60*60);
$last_month = date("m", $timestamp_last_month);

// Проверяем, что если месяц декабрь,
//на следующий месяц равен 1, а не 13
if($month == '12') 
	$next_month = '1';
else 
	$next_month = $month+1;
	
$calendar = "
<table class='w-100 text-center bg-white rounded overflow-hidden' height='380px';>
    <tr class='registr_kalendar user_kalendar'>
        <td colspan='7' class='text-light fw-light py-2 registr_kalendar user_kalendar'>
            <a style='margin-left: 20px; color: #ffffff; float: left;' href='$self?month=".$last_month."&year=".$last_year."&doctor=".$id_doctor."'>&lt;&lt;</a>
           ".$Month_r[$month]." ".$year."
            <a style='margin-right: 20px; color: #ffffff; float: right;' href='$self?month=".$next_month."&year=".$next_year."&doctor=".$id_doctor."'>&gt;&gt;</a>
        </td>
    </tr>
    <tr>
        <td class='datehead py-2'>Пн</td>
        <td class='datehead py-2'>Вт</td>
        <td class='datehead py-2'>Ср</td>
        <td class='datehead py-2'>Чт</td>
        <td class='datehead py-2'>Пт</td>
        <td class='datehead text-danger py-2'>Сб</td>
		<td class='datehead text-danger py-2'>Вс</td>
    </tr>
    <tr>"; 

// очищаем имя класса css
$class = "";

$weekday = $date_info['wday'];

// Приводим к числа к формату 1 - понедельник, ..., 6 - суббота
$weekday = $weekday-1; 
if($weekday == -1) $weekday=6;

// станавливаем текущий день как единица 1
$day = 1;

// выводим ширину календаря
if($weekday > 0) 
	$calendar .= "<td colspan='$weekday'> </td>";
	
while($day <= $maxdays)
{
	// если суббота, выволдим новую колонку.
    if($weekday == 7) {
		$calendar .= "</tr><tr>";
		$weekday = 0;
	}
	
	$linkDate = mktime(0, 0, 0, $month, $day, $year);

	// проверяем, если распечатанная дата является сегодняшней датой.
	//если так, используем другой класс css, чтобы выделить её 
    if((($day < 10 and "0$day" == date('d')) or ($day >= 10 and "$day" == date('d'))) and (($month < 10 and "0$month" == date('m')) or ($month >= 10 and "$month" == date('m'))) and $year == date('Y')){
	     $class = " cal";
	     $today_class = "text-dark fw-bold";
		 }
	//в противном случае, печатаем только ссылку на вкладку
    else {
		$d = date('m/d/Y', $linkDate);

	    $class = "cal bg-white p-2";
	    $today_class = "link-dark";	    
	}
	
	//Меняем ссылки с выходным днем
	if($weekday == 5 || $weekday == 6) {
		$red='text-danger'; 
		$link_red='doctor='.$id_doctor.'&month='.$month.'&year='.$year.'&weekend=1';
	}
	else {
		$red='';
		$link_red='day='.$day.'&weekday='.$weekday.'&month='.$month.'&year='.$year.'&doctor='.$id_doctor.'';
	} 	
	
	if (date('j.n.Y') == $day . '.' . $month . '.' . $year) {
    	$disabled = '';
	} elseif (time() > strtotime($day . '.' . $month . '.' . $year)) {
		$red='btn disabled';
	    $disabled = 'btn disabled';
	} else {
	    $disabled = 'fw-semibold';
	}

    $calendar .= "
        <td class='{$class}'><span><a class='{$today_class} {$red} {$disabled}' role='button' aria-disabled='true' href=\"?{$link_red}\">{$day}</a></span>
        </td>";
    $day++;
    $weekday++;	
}

if($weekday != 7) 
	$calendar .= "<td colspan='" . (7 - $weekday) . "'> </td>";

// выводим сам календарь
echo $calendar . "</tr></table>"; 

// $months = array('Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');

// echo "<form action='$self' method='get'>
// 		<div class='mt-4 row d-flex justify-content-end'>

// 			<div class='col-3'>
// 				<select name='doctor' type class='form-select' style='opacity: 0;'> 


// 				";
// // <option value='selected'>$id_doctor</option>

// for($i=date('Y'); $i<=(date('Y')+20); $i++)
// {
	
// 	echo "<option value=\"".($id_doctor)."\"$selected>".$id_doctor."</option>";
// }

// echo "</select>
// 		</div>";

// echo "<div class='col-3'>
// 				<select name='month' class='form-select'>";
	
// for($i=0; $i<=11; $i++) {
// 	echo "<option value='".($i+1)."'";
// 	if($month == $i+1) 
// 		echo "selected = 'selected'";
// 	echo ">".$months[$i]."</option>";
// }

// echo "</select>
// 		</div>";

// echo "		<div class='col-3'>
// 		<select name='year' class='form-select' style='float: left;'>";

// for($i=date('Y'); $i<=(date('Y')+20); $i++)
// {
// 	$selected = ($year == $i ? "selected = 'selected'" : '');
	
// 	echo "<option value=\"".($i)."\"$selected>".$i."</option>";
// }

// echo "</select>
// 		</div>
// 			<div class='col-2'>
// 				<input type='submit' class='btn w-100 btn-primary' value='смотреть' />
// 			</div>
// 		</div>
// 	</form>";

if($month != date('m') || $year != date('Y'))
	echo "<a class='text-center text-white p-2 rounded w-100 registr_kalendar user_kalendar my-3' style='float: right; font-size: 12px; padding-top: 5px;' href='".$self."?month=".date('m')."&year=".date('Y')."&doctor=".$id_doctor."'>&lt;&lt; Вернуться к текущей дате</a>";
?>