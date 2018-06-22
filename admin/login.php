<?php
require_once '../config.php';

if ('exit' === $_GET['p']) {
    session_start();
    $_SESSION = array();
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }
    session_destroy();
}

if ($admin['user'] === $_POST['loginName']
    && $admin['pwd'] === $_POST['loginPwd']
) {
    $_SESSION['status'] = 1;
    echo "<script>window.location = 'index.php';</script>";
} else if (1 === $_SESSION['status']) {
    echo "<script>window.location = 'index.php';</script>";
}
?>

<!doctype html>
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
    <div class="container-fluid" style="">
        <h1 style="text-align:center;color:#939DA8;">祥阿姨后台管理系统</h1>
        <div class="row" style="margin-top:1rem;margin-bottom:1rem;">
            <img class="col-md-8 col-md-offset-2" style="padding:0;height:300px;border-radius:5px;" src="./Public/images/xay.jpg">
        </div>
        <div class="row">
            <form class="col-md-8 col-md-offset-2" style="padding:0;" action="" method="post">
                <div class="form-group">
                    <label for="InputName" style="color:#939DA8;">登录帐号:</label>
                    <input type="text" class="form-control" id="InputName" name="loginName" placeholder="用户名">
                </div>
                <div class="form-group">
                    <label for="InputPassword" style="color:#939DA8;">登录密码:</label>
                    <input type="password" class="form-control" id="InputPassword" name="loginPwd" placeholder="密码">
                </div>
                <button type="submit" class="btn btn-default">登 录</button>
            </form>
        </div>
    </div>


</body>
</html>
