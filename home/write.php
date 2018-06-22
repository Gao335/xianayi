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
	<div class="container">
		<div class="nav">
			<div class="logo"><h1>我的信息</h1></div>
		</div>
		<div class="content">
			<form  id="yswrite" action="../model/addUser.php" method="post">
				<input id="user" type="text" name="addName" placeholder="请输入您的姓名">
				<input id="phone" type="text" name="addTel" placeholder="请输入您的电话">
				<input id="time" type="text" name="addDate" placeholder="请选择服务时间">
				<input id="time1" type="text" name="addExpect" placeholder="请输入您宝宝的预产期">
				<input id="gps" type="text" name="addAddr" placeholder="请输入服务地点">
				<input id="wid" type="hidden" name="addWid" value="">
				<input id="sub" type="submit" value="提交">
			</form>
		</div>
	</div>
<script>
$(document).ready(function(){
	function getarg(url){
		arg=url.split("?id=");
		return arg[1];
	}
	var id = getarg(window.location.search);
	$("#wid").attr("value",id);
});
</script>
</body>
</html>
