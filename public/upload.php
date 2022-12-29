<?php
header('Content-Type: application/json; charset=utf-8');

$data = null;

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    if (!isset($_FILES["fileToUpload"]) || $_FILES["fileToUpload"]["size"] === 0) {
        http_response_code(400); // Bad Request
    } else {
        $target_dir = "uploads/";
        $file = $_FILES["fileToUpload"];
        $splitName = explode('.', $file["name"]);
        $newFileName = uniqid('', false) . '.' . end($splitName);
        $target_file = $target_dir . basename($newFileName);

        $move_result = move_uploaded_file($file["tmp_name"], $target_file);

        $data = array(
            "content-url" => "/" . $target_file,
        );
    }
}

echo json_encode($data);

?>
