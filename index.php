<?php
require_once __DIR__.'/includes/bootstrap.php';
$page = $_GET['page'] ?? 'home';
$allowed = ['home','colleges','college','courses','distance','login','register','student','admin','admission'];
if (!in_array($page,$allowed,true)) $page='home';
include __DIR__.'/includes/header.php';
if ($page==='home') include __DIR__.'/pages/home.php';
elseif ($page==='colleges') include __DIR__.'/pages/colleges.php';
elseif ($page==='college') include __DIR__.'/pages/college.php';
elseif ($page==='courses') include __DIR__.'/pages/courses.php';
elseif ($page==='distance') include __DIR__.'/pages/distance.php';
elseif ($page==='login') include __DIR__.'/pages/login.php';
elseif ($page==='register') include __DIR__.'/pages/register.php';
elseif ($page==='student') include __DIR__.'/pages/student.php';
elseif ($page==='admin') include __DIR__.'/pages/admin.php';
elseif ($page==='admission') include __DIR__.'/pages/admission.php';
include __DIR__.'/includes/footer.php';
