<?php
header('Content-Type: application/json; charset=utf-8');

// TODO: Error handling and setting the correct request headers, depending on
// the context.

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $target_dir = "uploads/";
    $file = $_FILES["fileToUpload"];
    $splitName = explode('.', $file["name"]);
    $newFileName = uniqid('', false) . '.' . end($splitName);
    $target_file = $target_dir . basename($newFileName);

    $move_result = move_uploaded_file($file["tmp_name"], $target_file);

    $data = array(
        "content-url" => "/" . $target_file,
    );

    echo json_encode($data);
}
?>
