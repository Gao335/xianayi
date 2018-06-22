<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, maximum-scale=1">
	<meta content="yes" name="apple-mobile-web-app-capable">
    <title></title>
    <link rel="stylesheet" href="../public/css/nav.css" type="text/css">
    <link rel="stylesheet" href="../public/css/write.css" type="text/css">
    <script src="../public/js/jquery.js"></script>
</head>
<body>
    <div class="container hour">
        <div class="nav">
            <div class="logo"><h1>小时工</h1></div>
        </div>
        <div class="content">
            <div class="img"></div>
            <form  id="xsg" action="../model/addUser.php" method="post">
                <div class="xsg-img yname"></div><input type="text" name="addName" placeholder="请输入您的姓名">
                <div class="xsg-img ytel"></div><input type="text" name="addTel" placeholder="请输入您的电话">
                <div class="xsg-img stime"></div><input type="text" name="addDate" placeholder="请选择服务时间">
                <div class="xsg-img address"></div><input type="text" name="addAddr" placeholder="请输入服务地点">
                <div class="txt">
                    个性需求
                    <textarea id="txt" name="addRemark" rows="5" placeholder="注意事项：请您提前2小时预约，我们审核后将会在第一时间与您联系或者请您直接致电与我们联系。"></textarea>
                </div>
                <input id="sub1" type="submit" value="提交">
            </form>
        </div>
    </div>
</body>
</html>
