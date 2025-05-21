<?php 
include($_SERVER['DOCUMENT_ROOT'] . "/assets/inc/db.php");

$sql = "SELECT * FROM `users` WHERE `id` = ".$_SESSION['user_registr']."";

$res_data = mysqli_query($link, $sql);
while($row = mysqli_fetch_array($res_data)){

$login = $row['login'];
$admin = $row['admin'];

} 

?>

<header class="container-fluid p-0 bg-white position-relative">
	<div class="d-flex flex-wrap align-items-center justify-content-between justify-content-lg-between border-bottom px-4 py-3 bg-dark">

<a class="text-white fs-5 fw-bold" data-bs-toggle="offcanvas" href="#offcanvasWithBothOptions" role="button" aria-controls="offcanvasExample">
	<i class="bi bi-list me-1"></i> <span class="d-md-inline-block d-none">Меню</span>
</a>

<a href="/" class="d-flex align-items-center col-auto text-dark text-decoration-none position-absolute top-50 start-50 translate-middle">
	<span class="fs-4 fw-bold text-white title-intro d-md-inline-block d-none">MRIS</span>
</a>

<ul class="nav col-auto">
	<li><p class="mb-0 fw-light text-white p-1 me-3"><?php echo $login; ?></li>
	<li><a href="/registrar/users/clear.php" class="nav-link py-1 text-white link-white" style="background: #383e44;">Выйти</i></a></li>
</ul>

	</div>
</header>

<div class="offcanvas offcanvas-start border-0" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
	<div class="offcanvas-header border-bottom">
	    <h5 class="offcanvas-title ps-3 fs-4 d-md-none d-inline-block" id="offcanvasWithBothOptionsLabel">MRIS</h5>
	    <h5 class="offcanvas-title ps-3 fs-4 d-md-inline-block d-none" id="offcanvasWithBothOptionsLabel">Меню</h5>
	    <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
	</div>
  	<div class="offcanvas-body">

<nav class="nav flex-column">
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          	<a href="/registrar/" class="nav-link text-dark" id="home" aria-current="page">Статистика поликлиники</a>
        </li>
        <hr>
        <li class="nav-item">
          	<a href="/registrar/choice_doctor" class="nav-link text-dark" id="record_patients" aria-current="page">Запись к врачу</a>
        </li>
        <li class="nav-item">
          	<a href="/registrar/list_record" class="nav-link text-dark" id="list_record" aria-current="page">Список записанных пациентов</a>
        </li>
        <li class="nav-item">
          	<a href="/registrar/list_past_record" class="nav-link text-dark" id="list_past_record" aria-current="page">Список прошлых записей</a>
        </li>
        <hr>
        <li class="nav-item">
          	<a href="/registrar/list_doctors" class="nav-link text-dark" id="list_doctors" aria-current="page">Список врачей</a>
        </li>
        <li class="nav-item">
          	<a href="/registrar/list_patients" class="nav-link text-dark" id="list_patients" aria-current="page">Список пациентов</a>
        </li>
        <li class="nav-item">
          	<a href="/registrar/list_registr" class="nav-link text-dark" id="list_registr" aria-current="page">Список мед. регистр.</a>
        </li>
        <hr>
    </ul>
</nav>

<div class="ps-3 mt-3">
	<p class="fw-bold mb-2">Контакты</p>

    <p class="mb-1">Главврач: +7(800) 800-80-80</p>
</div>

  	</div>
</div>
