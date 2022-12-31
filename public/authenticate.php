<?php
header('Location: /login.php');

require '../secrets.php';
require '../lib/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') exit;

$next_page = isset($_COOKIE['next_page']) ? $_COOKIE['next_page'] : '/';
setcookie("next_page", "", time() - 3600);
$dbconn = pg_connect("password=$db_pass");
if (check_auth($dbconn)) { header("Location: $next_page"); pg_close($dbconn); exit; }

if (!isset($_REQUEST['password'])) { pg_close($dbconn); exit; }
$pass = $_REQUEST['password'];
$session = authenticate($dbconn, 'admin', $pass);

var_dump($session);
if (!$session) { pg_close($dbconn); exit; }

setcookie('session', $session);
header("Location: $next_page");

pg_close($dbconn);
?>
