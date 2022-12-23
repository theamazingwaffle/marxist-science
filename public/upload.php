<?php
header('Content-Type: application/json; charset=utf-8');
$ok = true;

// TODO: Error handling and setting the correct request headers, depending on
// the context.

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $target_dir = "uploads/";
    $file = $_FILES["fileToUpload"];
    $target_file = $target_dir . basename($file["name"]);
    if (file_exists($target_file)) {
        $ok = false;
    }

    move_uploaded_file($file["tmp_name"], $target_file);

    $data = array(
        "uploaded-content-url" => "/" . $target_file
    );
    echo json_encode($data);
}
?>
