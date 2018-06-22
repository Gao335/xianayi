<?php
	require_once '../config.php';
?>
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
    	
    </div>
	<script>
		function getarg(url){
				arg=url.split("?id=");
				return arg[1];
			} 
		var id = getarg(window.location.search);
		var cont = '';
		if(id==1){
			cont ='<div class="content">\
				<ul class="box">\
				</ul>\
			</div>';
		}else if(id==2){
			cont ='<div class="content">\
				<ul class="box">\
				</ul>\
			</div>';
		}else{
			cont ='<div class="content">\
				<ul class="box">\
				</ul>\
			</div>';
		}
		$(".container").append(cont);
		$(document).ready(function(){
			var count  = 0;          // 计数器初始化为0
			var maxnum = 100;        // 设置一共要加载几次
			var num    = 6;          // 每次加载条数
			LoadList(num);
			$("ul").scroll(function(){
				checkload();
			});
			// 建立加载判断函数
			// 如果页面滚动条达到页面底部，在 div 标签添加自定义属性并调用加载数据函数
			// 为 div 标签添加属性可视作一个锁机制，防止滚动条在底部时发生多次滚动事件从而同时调用\
			// 多次加载数据函数
			// 滚动条第一次到达底部时会执行加锁操作(即添加属性)，数据加载完成后执行解锁操作
			function checkload()
				{
					var srollPos     = $(window).scrollTop();   // 滚动条距离顶部的高度
					var windowHeight = $("ul").height();      // 窗口的高度
					var dbHiht       = $("ul").height();      // 整个页面文件的高度
					setTimeout(function(){
						if((windowHeight + srollPos) >= (dbHiht)
							&& count != maxnum
							&& "disenabled" != $("ul").attr("data-loadCont")   // 判断锁
						){
							$("ul").attr("data-loadCont","disenabled");    // 加锁
							$("ul").append("");
							count++;        // 计数器+1
							LoadList(num);  // 调用加载数据函数
						}
					},500);
				}
			// 获取 json 数据
			function LoadList(num)
			{
				var jsonUrl = "../model/getWaiter.php?cid="+id+"&lid=1&num="+num+"&snum="+parseInt(count*num);
				window.jsonurl = jsonUrl;
				$.getJSON(jsonUrl, function(json){
					if(json){
						var cont = '';
						//var b=json[i].avatar.replace(/@/,"");
						for(var i=1;i<json.length;i++){
							cont += '<li class="li">\
									<div class="details" onclick="location.href=&#39;jianli.php?id='+json[i].id+'&#39;;">\
									<div class="photo" style="background-image: url(&#34;../'+json[i].avatar.replace(/@/,"")+'&#34;)"></div>\
									<div class="txt1"><h2 class="h2">'+json[i].lastName+'阿姨</h2>\
									<p class="p">'+json[i].brief+'</p></div>\
									<a class="gy" href="write.php?id='+json[i].id+'">\
									雇佣Ta</a>\
									</div>\
									</li>';
						}
						$(".box").append(cont);
						$(".box").attr("data-loadCont","enabled"); 
					}
				});
			}
			
		});
	</script>
</body>
</html>