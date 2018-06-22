<?php
require_once '../home/header.php';

if ($admin['user'] === $_POST['loginName']
    && $admin['pwd'] === $_POST['loginPwd']
) {
    $_SESSION['status'] = 1;
    echo "<script>window.location = 'index.php';</script>";
} else if (1 === $_SESSION['status']) {
    echo "<script>window.location = 'index.php';</script>";
}
?>

<div>
    <form action="" method="post">
        <div class="form-group">
            <label for="InputName">请输入登陆账号</label>
            <input type="text" class="form-control" id="InputName" name="loginName" placeholder="用户名">
        </div>
        <div class="form-group">
            <label for="InputPassword">请输入登陆密码</label>
            <input type="password" class="form-control" id="InputPassword" name="loginPwd" placeholder="密码">
        </div>
        <button type="submit" class="btn btn-default">登录</button>
    </form>
</div>

</body>
</html>
