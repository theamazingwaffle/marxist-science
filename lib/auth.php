<?php
function get_session_user($dbconn, $session) {
    $query = 'SELECT user_id FROM sessions WHERE content = $1';
    $result = pg_query_params($dbconn, $query, [$session]);
    if (pg_num_rows($result) == 0) { pg_free_result($result); return false; }
    $user_id = pg_fetch_result($result, 0, 0);
    pg_free_result($result);
    return $user_id;
}

function check_auth($dbconn) {
    if (!isset($_COOKIE["session"])) return false;
    $session = $_COOKIE["session"];
    return get_session_user($dbconn, $session);
}

function authenticate($dbconn, $user, $pass) {
    $query = 'SELECT id, pass_hash FROM users WHERE name = $1';
    $result = pg_query_params($dbconn, $query, [$user]);
    if (pg_num_rows($result) == 0) { pg_free_result($result); return false; }
    $hash = pg_fetch_result($result, 0, 'pass_hash');
    if (!password_verify($pass, $hash)) { pg_free_result($result); return false; }
    $user_id = pg_fetch_result($result, 0, 'id');
    $session = bin2hex(random_bytes(128));
    $query = 'INSERT INTO sessions (user_id, content) VALUES ($1, $2)';
    pg_query_params($dbconn, $query, [$user_id, $session]);
    return $session;
}
?>
