<?php
// DON'T OUTPUT ANYTHING HERE
if ($_SERVER["REQUEST_METHOD"] !== 'POST') {
    http_response_code(400);
} else {
    $data = array();
    $target_dir = "uploads/";

    if (!isset($_FILES["fileToUpload"]) || $_FILES["fileToUpload"]["size"] === 0) {
        http_response_code(400); // Bad Request
        $data["error"] = "No valid file provided";
    } else {
        $file = $_FILES["fileToUpload"];
        $splitName = explode('.', basename($file["name"]));
        $extension = end($splitName);

        if (strlen($extension) == 0) {
            http_response_code(400);
            $data["error"] = "Invalid file name or extension";
        } else {
            $newFileName = uniqid('', false).'.'.$extension;
            $target_file = $target_dir . $newFileName;
            $move_result = move_uploaded_file($file["tmp_name"], $target_file);
            if (!$move_result) {
                http_response_code(500); // Internal server error
                $data["error"] = "Failed to upload file";
            } else {
                $data["content-url"] = "/".$target_file;
            }
        }
    }

    header('Content-Type: application/json; charset=utf-8');
    // OUTPUT HERE
    echo json_encode($data);
}
?>
