<?php
require_once '../home/header.php';

if (1 !== $_SESSION['status']) {
    echo "<script>window.location='login.php'</script>";
    exit();
}

// 获取应用信息
$query  = "SELECT * FROM `xay_config`";
$result = $mysqli->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $data = $row;
    }
}

// 处理上传图片
function uploadImg($inputName, $imgName)
{
    $resource = $_FILES[$inputName];
    if ((($resource["type"] == "image/gif")
        || ($resource["type"] == "image/jpeg")
        || ($resource["type"] == "image/pjpeg")
        || ($resource["type"] == "image/png"))
        && ($resource["size"] < 204800)
    ) {
        if ($resource["error"] > 0) {
            return false;
        } else {
            // 修改图片名称
            $suffixArr = explode("/", $resource["type"]);
            $suffix    = end($suffixArr);
            if (move_uploaded_file($resource["tmp_name"],
                '../uploads/images/' . $imgName . '.' . $suffix)
            ) {
                $avatar = $imgName . '.' . $suffix;
                return $avatar;
            } else {
                return false;
            }
        }
    } else {
        return false;
    }
}

// 修改应用信息
if ('m' == $_GET['o']) {
    if (filter_input(INPUT_POST, 'addYsContH', FILTER_SANITIZE_STRIPPED)
        && filter_input(INPUT_POST, 'addYsContM', FILTER_SANITIZE_STRIPPED)
        && filter_input(INPUT_POST, 'addYsContL', FILTER_SANITIZE_STRIPPED)
        && filter_input(INPUT_POST, 'addYesContH', FILTER_SANITIZE_STRIPPED)
        && filter_input(INPUT_POST, 'addYesContM', FILTER_SANITIZE_STRIPPED)
        && filter_input(INPUT_POST, 'addYesContL', FILTER_SANITIZE_STRIPPED)
        && filter_input(INPUT_POST, 'addBmContH', FILTER_SANITIZE_STRIPPED)
        && filter_input(INPUT_POST, 'addBmContM', FILTER_SANITIZE_STRIPPED)
        && filter_input(INPUT_POST, 'addBmContL', FILTER_SANITIZE_STRIPPED)
    ) {
        if ($_FILES["addImgA"]["name"]) {
            if (!$addImgA = uploadImg('addImgA', 'indexa')) {
                echo "<script>
                        alert('添加图片失败!');
                        window.history.back();
                    </script>";
                exit();
            }
        }
        if ($_FILES["addImgB"]["name"]) {
            if (!$addImgB = uploadImg('addImgB', 'indexb')) {
                echo "<script>
                        alert('添加图片失败!');
                        window.history.back();
                    </script>";
                exit();
            }
        }
        if ($_FILES["addImgC"]["name"]) {
            if (!$addImgC = uploadImg('addImgC', 'indexc')) {
                echo "<script>
                        alert('添加图片失败!');
                        window.history.back();
                    </script>";
                exit();
            }
        }

        $indexImgA = $addImgA ? '@uploads/images/' . $addImgA : $data['indexImgA'];
        $indexImgB = $addImgB ? '@uploads/images/' . $addImgB : $data['indexImgB'];
        $indexImgC = $addImgC ? '@uploads/images/' . $addImgC : $data['indexImgC'];
        $ysContH   = filter_input(INPUT_POST, 'addYsContH', FILTER_SANITIZE_STRIPPED);
        $ysContM   = filter_input(INPUT_POST, 'addYsContM', FILTER_SANITIZE_STRIPPED);
        $ysContL   = filter_input(INPUT_POST, 'addYsContL', FILTER_SANITIZE_STRIPPED);
        $yesContH  = filter_input(INPUT_POST, 'addYesContH', FILTER_SANITIZE_STRIPPED);
        $yesContM  = filter_input(INPUT_POST, 'addYesContM', FILTER_SANITIZE_STRIPPED);
        $yesContL  = filter_input(INPUT_POST, 'addYesContL', FILTER_SANITIZE_STRIPPED);
        $bmContH   = filter_input(INPUT_POST, 'addBmContH', FILTER_SANITIZE_STRIPPED);
        $bmContM   = filter_input(INPUT_POST, 'addBmContM', FILTER_SANITIZE_STRIPPED);
        $bmContL   = filter_input(INPUT_POST, 'addBmContL', FILTER_SANITIZE_STRIPPED);

        $sql = "UPDATE `xay_config`
                SET `indexImgA` = '" . $indexImgA . "', `indexImgB` = '" . $indexImgB . "',
                    `indexImgC` = '" . $indexImgC . "', `ysContH` = '" . $ysContH . "',
                    `ysContM` = '" . $ysContM . "', `ysContL` = '" . $ysContL . "',
                    `yesContH` = '" . $yesContH . "', `yesContM` = '" . $yesContM . "',
                    `yesContL` = '" . $yesContL . "', `bmContH` = '" . $bmContH . "',
                    `bmContM` = '" . $bmContM . "', `bmContL` = '" . $bmContL . "'";

        if ($mysqli->real_query($sql)) {
            echo "<script>window.location='modifyConfig.php';</script>";
        } else {
            echo "<script>
                    alert('修改失败!');
                    window.history.back();
                </script>";
            exit();
        }
    } else {
        echo "<script>
                alert('内容不能为空!');
                window.history.back();
            </script>";
    }
}

?>
<div class="container">
    <nav class="navbar navbar-default" style="margin:2rem 0;">
        <div class="container-fluid">
            <div class="navbar-header">
              <span class="navbar-brand" style="cursor:default;">祥阿姨后台管理</span>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li><a href="index.php">家政订单</a></li>
                <li><a href="hourerOrder.php">小时工订单</a></li>
                <li><a href="addWaiter.php">添加家政</a></li>
                <li><a href="showWaiter.php">所有家政信息</a></li>
                <li class="active"><a href="modifyConfig.php">修改应用信息</a></li>
              </ul>
            </div>
        </div>
    </nav>
    <form action="?o=m" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="InputFileA">首页滚动图片1 (格式：jpeg | 大小：小于200KB)</label>
            <input type="file" name="addImgA" id="InputFileA">
        </div>
        <div class="form-group">
            <label for="InputFileB">首页滚动图片2 (格式：jpeg | 大小：小于200KB)</label>
            <input type="file" name="addImgB" id="InputFileB">
        </div>
        <div class="form-group">
            <label for="InputFileC">首页滚动图片3 (格式：jpeg | 大小：小于200KB)</label>
            <input type="file" name="addImgC" id="InputFileC">
        </div>
        <div class="form-group">
            <label for="ysContH">高级月嫂服务详情</label>
            <textarea class="form-control" name="addYsContH" id="ysContH" wrap="soft" rows="5"><?php echo $data['ysContH'];?></textarea>
        </div>
        <div class="form-group">
            <label for="ysContM">中级月嫂服务详情</label>
            <textarea class="form-control" name="addYsContM" id="ysContM" wrap="soft" rows="5"><?php echo $data['ysContM'];?></textarea>
        </div>
        <div class="form-group">
            <label for="ysContL">初级月嫂服务详情</label>
            <textarea class="form-control" name="addYsContL" id="ysContL" wrap="soft" rows="5"><?php echo $data['ysContL'];?></textarea>
        </div>
        <div class="form-group">
            <label for="yesContH">高级育儿嫂服务详情</label>
            <textarea class="form-control" name="addYesContH" id="yesContH" wrap="soft" rows="5"><?php echo $data['yesContH'];?></textarea>
        </div>
        <div class="form-group">
            <label for="yesContM">中级育儿嫂服务详情</label>
            <textarea class="form-control" name="addYesContM" id="yesContM" wrap="soft" rows="5"><?php echo $data['yesContM'];?></textarea>
        </div>
        <div class="form-group">
            <label for="yesContL">初级育儿嫂服务详情</label>
            <textarea class="form-control" name="addYesContL" id="yesContL" wrap="soft" rows="5"><?php echo $data['yesContL'];?></textarea>
        </div>
        <div class="form-group">
            <label for="bmContH">高级保姆服务详情</label>
            <textarea class="form-control" name="addBmContH" id="bmContH" wrap="soft" rows="5"><?php echo $data['bmContH'];?></textarea>
        </div>
        <div class="form-group">
            <label for="bmContM">中级保姆服务详情</label>
            <textarea class="form-control" name="addBmContM" id="bmContM" wrap="soft" rows="5"><?php echo $data['bmContM'];?></textarea>
        </div>
        <div class="form-group">
            <label for="bmContL">初级保姆服务详情</label>
            <textarea class="form-control" name="addBmContL" id="bmContL" wrap="soft" rows="5"><?php echo $data['bmContL'];?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">修改</button>
    </form>
</div>
</body>
</html>