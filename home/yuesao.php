<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, maximum-scale=1">
	<meta content="yes" name="apple-mobile-web-app-capable">
    <title></title>
    <link href="../public/css/ysstyle.css" rel="stylesheet" type="text/css">
	<script src="../public/js/jquery.js"></script>
</head>
<body>
	<div class="container">
		<ul class="nav-btn"></ul>
		<ul class="content"></ul>
	</div>
	<script>
		function getarg(url){
			arg=url.split("?id=");
			return arg[1];
		} 
		var id = getarg(window.location.search);
		var cont = '';
		var Scont = '';
		if(id == 1){
			cont = '<li class="high oringeRed" onclick="ysHcont()">高级月嫂</li>\
					<li class="middle" onclick="ysMcont()">中级月嫂</li>\
					<li class="primary" onclick="ysPcont()">初级月嫂</li>';
			Scont = '<a class="service" href="./service.php?id='+id+'">\
						<img src="../public/images/2nd/service.png">\
					</a>';
		}else if(id == 2){
			cont = '<li class="high oringeRed" onclick="yesHcont()">高级育儿嫂</li>\
					<li class="middle" onclick="yesMcont()">中级育儿嫂</li>\
					<li class="primary" onclick="yesPcont()">初级育儿嫂</li>';
			Scont = '<a class="service" href="./service.php?id='+id+'">\
						<img src="../public/images/2nd/service.png">\
					</a>';
		}else if(id == 3){
			cont = '<li class="high oringeRed" onclick="bmHcont()">高级保姆</li>\
					<li class="middle" onclick="bmMcont()">中级保姆</li>\
					<li class="primary" onclick="bmPcont()">初级保姆</li>';
			Scont = '<a class="service" href="./service.php?id='+id+'">\
						<img src="../public/images/2nd/service.png">\
					</a>';
		}
		$(".nav-btn").append(cont);
		$(".container").append(Scont);

		ysHcont();
		yesHcont();
		bmHcont();
/*
*月嫂页面
*
*函数 ysHcont(),ysMcont(),ysPcont()
*/
		function ysHcont(){
			$('.content li').remove();
			$('.high').addClass('oringeRed');
			$('.middle').removeClass('oringeRed');
			$('.primary').removeClass('oringeRed');	

			lid    = 1;
			count  = 0;          // 计数器初始化为0
			maxnum = 100;        // 设置一共要加载几次
			num    = 6;          // 每次加载条数
			LoadList(num);
			$(".content").scroll(function(){
				checkload();
			});		
		}
		function ysMcont(){

			$('.content li').remove();
			$('.middle').addClass('oringeRed');
			$('.high').removeClass('oringeRed');
			$('.primary').removeClass('oringeRed');

			lid    = 2;
			count  = 0;          // 计数器初始化为0
			maxnum = 100;        // 设置一共要加载几次
			num    = 6;          // 每次加载条数
			LoadList(num);
			$(".content").scroll(function(){
				checkload();
			});
		}
		function ysPcont(){
			$('.content li').remove();
			$('.primary').addClass('oringeRed');
			$('.high').removeClass('oringeRed');
			$('.middle').removeClass('oringeRed');
			lid    = 3;
			count  = 0;          // 计数器初始化为0
			maxnum = 100;        // 设置一共要加载几次
			num    = 6;          // 每次加载条数
			LoadList(num);
			$(".content").scroll(function(){
				checkload();
			});
		}
/*
*育儿嫂页面
*
*函数 yesHcont(),yesMcont(),yesPcont()
*/
		function yesHcont(){
			$('.content li').remove();
			$('.high').addClass('oringeRed');
			$('.middle').removeClass('oringeRed');
			$('.primary').removeClass('oringeRed');	

			lid    = 1;
			count  = 0;          // 计数器初始化为0
			maxnum = 100;        // 设置一共要加载几次
			num    = 6;          // 每次加载条数
			LoadList(num);
			$(".content").scroll(function(){
				checkload();
			});		
		}
		function yesMcont(){
			$('.content li').remove();
			$('.middle').addClass('oringeRed');
			$('.high').removeClass('oringeRed');
			$('.primary').removeClass('oringeRed');

			lid    = 2;
			count  = 0;          // 计数器初始化为0
			maxnum = 100;        // 设置一共要加载几次
			num    = 6;          // 每次加载条数
			LoadList(num);
			$(".content").scroll(function(){
				checkload();
			});
		}
		function yesPcont(){
			$('.content li').remove();
			$('.primary').addClass('oringeRed');
			$('.high').removeClass('oringeRed');
			$('.middle').removeClass('oringeRed');
			lid    = 3;
			count  = 0;          // 计数器初始化为0
			maxnum = 100;        // 设置一共要加载几次
			num    = 6;          // 每次加载条数
			LoadList(num);
			$(".content").scroll(function(){
				checkload();
			});
		}
/*
*保姆页面
*
*函数 bmHcont(),bmMcont(),bmPcont()
*/
		function bmHcont(){
			$('.content li').remove();
			$('.high').addClass('oringeRed');
			$('.middle').removeClass('oringeRed');
			$('.primary').removeClass('oringeRed');	

			lid    = 1;
			count  = 0;          // 计数器初始化为0
			maxnum = 100;        // 设置一共要加载几次
			num    = 6;          // 每次加载条数
			LoadList(num);
			$(".content").scroll(function(){
				checkload();
			});		
		}
		function bmMcont(){
			$('.content li').remove();
			$('.middle').addClass('oringeRed');
			$('.high').removeClass('oringeRed');
			$('.primary').removeClass('oringeRed');

			lid    = 2;
			count  = 0;          // 计数器初始化为0
			maxnum = 100;        // 设置一共要加载几次
			num    = 6;          // 每次加载条数
			LoadList(num);
			$(".content").scroll(function(){
				checkload();
			});
		}
		function bmPcont(){
			$('.content li').remove();
			$('.primary').addClass('oringeRed');
			$('.high').removeClass('oringeRed');
			$('.middle').removeClass('oringeRed');
			lid    = 3;
			count  = 0;          // 计数器初始化为0
			maxnum = 100;        // 设置一共要加载几次
			num    = 6;          // 每次加载条数
			LoadList(num);
			$(".content").scroll(function(){
				checkload();
			});
		}
		// 建立加载判断函数、
		// 如果页面滚动条达到页面底部，在 div 标签添加自定义属性并调用加载数据函数
		// 为 div 标签添加属性可视作一个锁机制，防止滚动条在底部时发生多次滚动事件从而同时调用\
		// 多次加载数据函数
		// 滚动条第一次到达底部时会执行加锁操作(即添加属性)，数据加载完成后执行解锁操作
		function checkload(){
			var srollPos     = $(window).scrollTop();   // 滚动条距离顶部的高度
			var windowHeight = $(".content").height();      // 窗口的高度
			var dbHiht       = $(".content").height();      // 整个页面文件的高度
			setTimeout(function(){
				if((windowHeight + srollPos) >= (dbHiht)
					&& count != maxnum
					&& "disenabled" != $(".content").attr("data-loadCont")   // 判断锁
				){
					$(".content").attr("data-loadCont","disenabled");    // 加锁
					$(".content").append("");
					count++;        // 计数器+1
					LoadList(num);  // 调用加载数据函数
				}
			},500);
		}
		function LoadList(num){
			//var jsonUrl = "../model/getWaiter.php?cid="+id+"&lid=1&num="+num+"&snum="+parseInt(count*num);
			var jsonUrl = "../model/getWaiter.php?cid="+id+"&lid="+lid+"&num="+num+"&snum="+parseInt(count*num);
			window.jsonurl = jsonUrl;
			$.getJSON(jsonUrl, function(json){
				if(json){
					var cont1 = '';
					//var b=json[i].avatar.replace(/@/,"");
					for(var i=1;i<json.length;i++){
						cont1 += '<li>\
									<a class="jianli" href="jianli.php?id='+json[i].id+'">\
										<div class="ava">\
											<img src="../'+json[i].avatar.replace(/@/,"")+'">\
										</div>\
										<div class="name">\
											<h2 class="h2">'+json[i].lastName+'阿姨</h2>\
											<p>'+json[i].brief+'</p>\
											<button class="gy" onclick="location.href=&#39;write.php?id='+json[i].id+'&#39;">雇佣</button>\
										</div>\
									</a>\
								</li>';
						}
					$(".content").append(cont1);
					$(".content").attr("data-loadCont","enabled"); 
				}
			});
		}
	</script>
</body>
</html>