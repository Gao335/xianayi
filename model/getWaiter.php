<?php
require_once "../config.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET'
    && @!empty($getCategory = (int) $_GET['cid'])
    && @!empty($getLevel = (int) $_GET['lid'])
    && @!empty($getNum = (int) $_GET['num'])
) {

    $getSnum = empty((int) $_GET['snum']) ? 0 : (int) $_GET['snum'];
    $query   = "SELECT * FROM `xay_waiter`
        WHERE `category`=" . $getCategory . "
        AND `level`=" . $getLevel . " AND `wstatus`=1
        LIMIT " . $getSnum . "," . $getNum;
    $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
        $data[] = array('status' => 1, 'msg' => 'ok');
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $row['category'] = $category[$row['category']];
            $row['level']    = $level[$row['level']];
            $data[]          = $row;
        }
    }
    @$data = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $data;
} else {
    $data[] = array('status' => 0, 'msg' => 'error');
    $data   = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $data;
}
