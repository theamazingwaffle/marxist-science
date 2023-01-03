<?php
require '../../secrets.php';
require '../../lib/auth.php';

# DON'T OUTPUT ANYTHING HERE
if ($_SERVER["REQUEST_METHOD"] !== 'POST') {
    http_response_code(400);
    exit;
}

$dbconn = pg_connect("password=$db_pass");
if (!check_auth($dbconn)) {
    http_response_code(403); # Unauthorized
    $data["error"] = "Unauthorized upload attempt";
} else {
    $data = [];
    $target_dir = "../uploads/";

    if (!isset($_FILES["fileToUpload"]) || $_FILES["fileToUpload"]["size"] === 0) {
        http_response_code(400); # Bad Request
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
                http_response_code(500); # Internal server error
                $data["error"] = "Failed to upload file";
            } else {
                $end_location = str_replace('../', '/', $target_file, 1);
                $query = 'INSERT INTO images (url) VALUES ($1)';
                pg_query_params($dbconn, $query, [$end_location]);
                $data["content-url"] = $end_location;
            }
        }
    }
}

pg_close($dbconn);

// OUTPUT HERE
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
?>
