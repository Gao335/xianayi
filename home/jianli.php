<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, maximum-scale=1">
	<meta content="yes" name="apple-mobile-web-app-capable">
    <title></title>
    <link href="../public/css/nav.css" rel="stylesheet" type="text/css">
    <link href="../public/css/write.css" rel="stylesheet" type="text/css">
	<script src="../public/js/jquery.js"></script>
</head>
<body>
    <div class="container">
        <nav class="nav"  style="background-color: rgba(0,0,0,0.2);">
            <div class="logo"><h1 style="color: black">月嫂简历</h1></div>
        </nav>
		<div class="content">
			<div class="message" id="heading">
			</div>
			<div class="personal" id="personal">
			</div>
			<div class="work" id="work">
			</div>
		</div>
	</div>
	<script>
		function getarg(url){
			arg=url.split("?id=");
			return arg[1];
		} 
		var id = getarg(window.location.search);
		var jsonUrl = "../model/getProfile.php?wid="+id;
		window.jsonurl = jsonUrl;
		$.getJSON(jsonUrl, function(json){
			var cont = '';
			cont += '<div class="picture" style="background-image: url(&#34;../'+json[1].avatar.replace(/@/,"")+'&#34;)"></div><div class="information"><h1 class="name">\
			'+json[1].lastName+'阿姨</h1><p class="age">'+json[1].brief+'</p></div><span class="try" href="#">\
			<pre id="pre1">'+json[1].charge+'</pre></span>';
			$("div #heading").append(cont);
			var cont1 = '';
			cont1 += '<div class="self"><h3>基本信息</h3><p class="pre2">'+json[1].profile.replace(/\r\n/g,"<br>")+'</p></div>';
			$("div #personal").append(cont1);
			var cont2 = '';
			cont2 += '<h3 class="work_h4">工作履历</h3><div class="read" ><p class="pre2">'+json[1].experience.replace(/\r\n/g,"<br>")+'</p>\
			</div><a class="call y" href="write.php?id='+id+'"><div class="phone xx"></div><span>我的信息</span>\
			<a class="call" href="tel:0356-2293698"><div class="phone"></div><span>咨询电话</span></a>';
			$("div #work").append(cont2);
		});
	</script>
</body>
</html>