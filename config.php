<?php

session_start();
header("Content-Type:text/html; charset=utf-8;");

/************************* Database *************************/

// WORK Environment
$mysqlHost     = '121.42.26.216';
$mysqlPort     = 3306;
$mysqlUser     = 'lol';
$mysqlPassword = 'lol';
$mysqlDatabase = 'lol';

// HOME Environment
// $mysqlHost     = 'localhost';
// $mysqlPort     = 3306;
// $mysqlUser     = 'kouler';
// $mysqlPassword = '';
// $mysqlDatabase = 'test';

// read database config form VCAP_SERVICES env
if (@$_ENV["VCAP_SERVICES"]) {
    $db            = parse_url($_ENV["DATABASE_URL"]);
    $mysqlDatabase = trim($db["path"], "/");
    $mysqlUser     = $db["user"];
    $mysqlPassword = $db["pass"];
    $mysqlHost     = $db["host"];
}

// connect mysql use mysqli
$mysqli = new mysqli($mysqlHost, $mysqlUser, $mysqlPassword, $mysqlDatabase);
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ')' . $mysqli->connect_error);
}
$mysqli->set_charset("utf8");

/************************* Constants *************************/

/************************* Variables *************************/

$admin    = ['user' => 'admin', 'pwd' => 'xiangayi']; // 管理员
$category = ["", "月嫂", "育儿嫂", "保姆", "小时工"];
$level    = ["", "高级", "中级", "初级"];

/************************* Functions *************************/

// 格式化输出变量,调试时可使用
function dump($para, $w = false)
{
    echo "<pre>";
    $w ? var_dump($para) : print_r($para);
    echo "</pre>";
}
