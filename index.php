<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, maximum-scale=1">
	<meta content="yes" name="apple-mobile-web-app-capable">
    <title></title>
    <link rel="stylesheet" href="public/css/style.css" type="text/css">
	<link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css" type="text/css">
	<script src="public/js/jquery.js"></script>
    <script src="public/bootstrap/js/bootstrap.min.js"></script>
</head> 
<body>
    <div id="container">
        <div id="content">
            <div class="image">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<!-- 轮播（Carousel）指标 -->
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
					</ol>   
					<!-- 轮播（Carousel）项目 -->
					<div class="carousel-inner">
						<div class="item active" id="indexA">
						</div>
						<div class="item" id="indexB">
						</div>
						<div class="item" id="indexC">
						</div>
					</div>
					<!-- 轮播（Carousel）导航 -->
					<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
					<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
				</div> 
			</div>
            <div class="text"></div>
                <a class="ys" href="home/yuesao.php?id=1">
                    <div id="image"></div>
                    <h3 id="text">月嫂</h3>
                </a>
            <div class="other">
                <a class="yrs" href="home/yuesao.php?id=2"><span>育儿嫂</span></a>
                <a class="bm" href="home/yuesao.php?id=3"><span>保姆</span></a>
                <a class="xsg" href="home/hour.php"><span>小时工</span></a>
            </div>
            <a class="call" href="">
                <span>0356&minus;2293698</span>
                <div class="phone"></div>
            </a>
        </div>
    </div>
</body>
<script>
	var jsonUrl = "./model/getConfig.php";
				window.jsonurl = jsonUrl;
				$.getJSON(jsonUrl, function(json){
					if(json){
						var contA = '<img src="'+json[1].indexImgA.replace(/@/,"")+'" alt="First slide">';
						var contB = '<img src="'+json[1].indexImgB.replace(/@/,"")+'" alt="Second slide">';
						var contC = '<img src="'+json[1].indexImgC.replace(/@/,"")+'" alt="Third slide">';
						$("#indexA").append(contA);
						$("#indexB").append(contB);
						$("#indexC").append(contC);
					}
				});
	function includeUA(keyword) {
	    var ua = navigator.userAgent;
	    var pattern = new RegExp(keyword,"i");
	    if (ua.match(pattern) != null) {
	        return true;
	    } else {
	        return false;
	    }
	}	
	if(includeUA('iphone') == true){
		$('.call').attr('href','tel:0356-2293698');
	}else{
		$('.call').attr('href',' ');
	}
</script>
</html>