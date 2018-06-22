<?php
require_once "../config.php";

$query  = "SELECT * FROM `xay_config`";
$result = $mysqli->query($query);
if ($result->num_rows > 0) {
    $data[] = array('status' => 1, 'msg' => 'ok');
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $data[] = $row;
    }
    $data = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $data;
} else {
    $data[] = array('status' => 0, 'msg' => 'error');
    $data   = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $data;
}
