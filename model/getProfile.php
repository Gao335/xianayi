<?php
require_once "../config.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET'
    && @!empty($getProfile = (int) $_GET['wid'])
) {
    $query  = "SELECT * FROM `xay_waiter` WHERE `id`=" . $getProfile;
    $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
        $data[] = array('status' => 1, 'msg' => 'ok');
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $row['category'] = $category[$row['category']];
            $row['level']    = $level[$row['level']];
            $data[]          = $row;
        }
    }
    $data = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $data;
} else {
    $data[] = array('status' => 0, 'msg' => 'error');
    $data   = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $data;
}
