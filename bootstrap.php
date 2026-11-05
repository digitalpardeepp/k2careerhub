<?php
if (session_status()===PHP_SESSION_NONE) session_start();
define('APP_NAME','K2 Career Hub');
define('BASE_URL', rtrim(str_replace('\\','/',dirname($_SERVER['SCRIPT_NAME'])), '/'));
require_once __DIR__.'/db.php';
function h($v){return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8');}
function url($page='home',$params=[]){return BASE_URL.'/index.php?'.http_build_query(array_merge(['page'=>$page],$params));}
function logged_in(){return !empty($_SESSION['user']);}
function is_admin(){return logged_in() && ($_SESSION['user']['role']??'')==='admin';}
function require_login(){if(!logged_in()){header('Location: '.url('login'));exit;}}
function require_admin(){if(!is_admin()){http_response_code(403);echo '<div class="container"><h2>Access denied</h2><p>Admin access required.</p></div>';exit;}}
function flash($msg=null){if($msg!==null){$_SESSION['flash']=$msg;return;} $m=$_SESSION['flash']??'';unset($_SESSION['flash']);return $m;}
function csrf(){if(empty($_SESSION['csrf']))$_SESSION['csrf']=bin2hex(random_bytes(24));return $_SESSION['csrf'];}
function verify_csrf(){if(($_POST['csrf']??'')!==($_SESSION['csrf']??'')){http_response_code(400);exit('Invalid request token. Refresh and try again.');}}
