<?php
require_once '../config.php';
?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>祥阿姨后台管理系统</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link rel="stylesheet" type="text/css" href="./Public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./Public/css/admin.css">
    <script src="./Public/js/jquery.js"></script>
    <script src="./Public/bootstrap/js/bootstrap.min.js"></script>
    <script src="./Public/js/function.js"></script>
    <script src="./Public/js/listen.js"></script>
</head>
<body>
    <div id="header">
        <h1 id="title"><a href="index.php">祥阿姨后台管理</a></h1>
        <ul class="options pull-right">
            <li><a href="javascript:;"><i class="glyphicon glyphicon-user"></i> <span class="text">欢迎</span><strong>Admin</strong></a></li>
            <li><a href="login.php?p=exit"><i class="glyphicon glyphicon-log-out"></i> <span class="text">退出</span></a></li>
        </ul>
    </div>
