<?php
require '../../secrets.php';
require '../../lib/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') exit;

$dbconn = pg_connect("password=$db_pass");
if (!check_auth($dbconn)) { pg_close($dbconn); http_response_code(403); exit; }

if (!isset($_POST['title'], $_POST['image-url'], $_POST['content'])) {
    pg_close($dbconn);
    http_response_code(400);
    exit;
}

$title = $_POST['title'];
$image_url = $_POST['image-url'];
$content = $_POST['content'];

$filepath = '../md/'.uniqid('', false).'.md';
if (false === file_put_contents("$filepath", $content)) {
    pg_close($dbconn);
    http_response_code(500);
    exit;
}

$filepath = str_replace('../', '/', $filepath);
$query = 'INSERT INTO articles (title, markdown_url, image_url)
VALUES ($1, $2, $3)';
pg_query_params($dbconn, $query, [$title, $filepath, $image_url]);
pg_close($dbconn);

header('Location: /');
?>
