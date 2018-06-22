<?php
require_once '../home/header.php';

if (1 !== $_SESSION['status']) {
    echo "<script>window.location='login.php'</script>";
    exit();
}

// 获取家政信息
if ($id = (int) $_GET['id']) {
    $query  = "SELECT * FROM `xay_waiter` WHERE `id`=" . $id;
    $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $row['category'] = $category[$row['category']];
            $row['level']    = $level[$row['level']];
            $data            = $row;
        }
    }
}

// 添加家政信息
if (filter_input(INPUT_POST, 'addLastName', FILTER_SANITIZE_STRIPPED)
    && (int) $_POST['addCategory']
    && (int) $_POST['addLevel']
    && 'a' == $_GET['o']
) {
    // 处理上传图片
    if ($_FILES["file"]["name"]) {
        if ((($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/png"))
            && ($_FILES["file"]["size"] < 204800)
        ) {
            if ($_FILES["file"]["error"] > 0) {
                echo "<script>
                        alert('Return Code: " . $_FILES["file"]["error"] . "');
                        window.history.back();
                    </script>";
                exit();
            } else {
                // 修改图片名称
                $suffixArr  = explode("/", $_FILES["file"]["type"]);
                $suffix     = end($suffixArr);
                $newImgName = time() . mt_rand(1000, 9999);
                if (move_uploaded_file($_FILES["file"]["tmp_name"],
                    '../uploads/avatar/' . $newImgName . '.' . $suffix)
                ) {
                    $avatar = $newImgName . '.' . $suffix;
                } else {
                    echo "<script>
                            alert('Invalid file');
                            window.history.back();
                        </script>";
                    exit();
                }
            }
        } else {
            echo "<script>
                    alert('Invalid file');
                    window.history.back();
                </script>";
            exit();
        }
    }

    if (!empty($avatar)) {
        $avatar = '@uploads/avatar/' . $avatar;
    } else {
        $avatar = '@uploads/avatar/avatar.png';
    }
    $category   = (int) $_POST['addCategory'];
    $level      = (int) $_POST['addLevel'];
    $lastName   = filter_input(INPUT_POST, 'addLastName', FILTER_SANITIZE_STRIPPED);
    $firstName  = filter_input(INPUT_POST, 'addFirstName', FILTER_SANITIZE_STRIPPED);
    $sex        = filter_input(INPUT_POST, 'addSex', FILTER_SANITIZE_STRIPPED);
    $brief      = filter_input(INPUT_POST, 'addBrief', FILTER_SANITIZE_STRIPPED);
    $profile    = filter_input(INPUT_POST, 'addProfile', FILTER_SANITIZE_STRIPPED);
    $experience = filter_input(INPUT_POST, 'addExperience', FILTER_SANITIZE_STRIPPED);
    $charge     = filter_input(INPUT_POST, 'addCharge', FILTER_SANITIZE_STRIPPED);
    $time       = date("Y-m-d H:i:s", time());

    $sql = "INSERT INTO `xay_waiter` (`category`, `level`, `lastName`, `firstName`,
                                   `sex`, `avatar`, `brief`, `profile`,
                                   `experience`, `charge`, `time`)
                        VALUES ('" . $category . "','" . $level . "','" . $lastName . "',
                                '" . $firstName . "','" . $sex . "','" . $avatar . "',
                                '" . $brief . "','" . $profile . "','" . $experience . "',
                                '" . $charge . "','" . $time . "')";
    if ($mysqli->real_query($sql)) {
        echo "<script>window.location='showWaiter.php';</script>";
    } else {
        echo "<script>
                alert('添加失败!');
                window.history.back();
            </script>";
    }
}

// 修改家政信息
if (filter_input(INPUT_POST, 'addLastName', FILTER_SANITIZE_STRIPPED)
    && (int) $_POST['addCategory']
    && (int) $_POST['addLevel']
    && (int) $_GET['id']
    && 'm' == $_GET['o']
) {
    // 处理上传图片
    if ($_FILES["file"]["name"]) {
        if ((($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/png"))
            && ($_FILES["file"]["size"] < 204800)
        ) {
            if ($_FILES["file"]["error"] > 0) {
                echo "<script>
                        alert('Return Code: " . $_FILES["file"]["error"] . "');
                        window.history.back();
                    </script>";
                exit();
            } else {
                // 修改图片名称
                $suffixArr  = explode("/", $_FILES["file"]["type"]);
                $suffix     = end($suffixArr);
                $newImgName = time() . mt_rand(1000, 9999);
                if (move_uploaded_file($_FILES["file"]["tmp_name"],
                    "../uploads/avatar/" . $newImgName . '.' . $suffix)
                ) {
                    $avatar = $newImgName . '.' . $suffix;
                } else {

                    echo "<script>
                            alert('Invalid file');
                            window.history.back();
                        </script>";
                    exit();
                }
            }
        } else {
            echo "<script>
                    alert('Invalid file');
                    window.history.back();
                </script>";
            exit();
        }
    }

    if (!empty($avatar)) {
        $avatar = '@uploads/avatar/' . $avatar;
    }
    $id         = (int) $_GET['id'];
    $category   = (int) $_POST['addCategory'];
    $level      = (int) $_POST['addLevel'];
    $lastName   = filter_input(INPUT_POST, 'addLastName', FILTER_SANITIZE_STRIPPED);
    $firstName  = filter_input(INPUT_POST, 'addFirstName', FILTER_SANITIZE_STRIPPED);
    $sex        = filter_input(INPUT_POST, 'addSex', FILTER_SANITIZE_STRIPPED);
    $brief      = filter_input(INPUT_POST, 'addBrief', FILTER_SANITIZE_STRIPPED);
    $profile    = filter_input(INPUT_POST, 'addProfile', FILTER_SANITIZE_STRIPPED);
    $experience = filter_input(INPUT_POST, 'addExperience', FILTER_SANITIZE_STRIPPED);
    $charge     = filter_input(INPUT_POST, 'addCharge', FILTER_SANITIZE_STRIPPED);
    $time       = date("Y-m-d H:i:s", time());

    if (!empty($avatar)) {
        $sql = "UPDATE `xay_waiter`
                SET `category` = '" . $category . "', `level` = '" . $level . "',
                    `lastName` = '" . $lastName . "', `firstName` = '" . $firstName . "',
                    `sex` = '" . $sex . "', `avatar` = '" . $avatar . "',
                    `brief` = '" . $brief . "', `profile` = '" . $profile . "',
                    `experience` = '" . $experience . "', `charge` = '" . $charge . "',
                    `time` = '" . $time . "'
                WHERE  `id`='" . $id . "'";
    } else {
        $sql = "UPDATE `xay_waiter`
                SET `category` = '" . $category . "', `level` = '" . $level . "',
                    `lastName` = '" . $lastName . "', `firstName` = '" . $firstName . "',
                    `sex` = '" . $sex . "', `brief` = '" . $brief . "',
                    `profile` = '" . $profile . "', `experience` = '" . $experience . "',
                    `charge` = '" . $charge . "', `time` = '" . $time . "'
                WHERE  `id`='" . $id . "'";
    }

    if ($mysqli->real_query($sql)) {
        echo "<script>window.location='showWaiter.php';</script>";
    } else {
        echo "<script>
                alert('修改失败!');
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
                <li class="active"><a href="addWaiter.php">添加家政</a></li>
                <li><a href="showWaiter.php">所有家政信息</a></li>
                <li><a href="modifyConfig.php">修改应用信息</a></li>
              </ul>
            </div>
        </div>
    </nav>

    <?php if ($data): ?>
        <form action="?id=<?php echo $id;?>&o=m" method="post" enctype="multipart/form-data">
    <?php else: ?>
        <form action="?o=a" method="post" enctype="multipart/form-data">
    <?php endif;?>
        <div class="form-group">
            <label for="InputLastName">姓</label>
            <?php if ($data): ?>
                <input type="text" class="form-control" name="addLastName" id="InputLastName" value="<?php echo $data['lastName'];?>">
            <?php else: ?>
                <input type="text" class="form-control" name="addLastName" id="InputLastName" placeholder="姓">
            <?php endif;?>
        </div>
        <div class="form-group">
            <label for="InputFirstName">名</label>
            <?php if ($data): ?>
                <input type="text" class="form-control" name="addFirstName" id="InputFirstName" value="<?php echo $data['firstName'];?>">
            <?php else: ?>
                <input type="text" class="form-control" name="addFirstName" id="InputFirstName" placeholder="名">
            <?php endif;?>
        </div>
        <div class="form-group">
            <label>性别</label>
            <select class="form-control" name="addSex">
            <?php if (!$data || '保密' == $data['sex']): ?>
                <option selected>保密</option>
                <option>男</option>
                <option>女</option>
            <?php elseif ('男' == $data['sex']): ?>
                <option>保密</option>
                <option selected>男</option>
                <option>女</option>
            <?php elseif ('女' == $data['sex']): ?>
                <option>保密</option>
                <option>男</option>
                <option selected>女</option>
            <?php endif;?>
            </select>
        </div>
        <div class="form-group">
            <label for="InputFile">头像 (照片需小于200KB)</label>
            <?php if ($data['avatar']): ?>
                <p><?php echo $data['avatar'];?></p>
            <?php endif;?>
            <input type="file" name="file" id="InputFile">
        </div>
        <div class="form-group">
            <label>类别</label>
            <select class="form-control" name="addCategory">
                <option value="0">请选择类别</option>
                <?php if (!$data): ?>
                    <option value="1">月嫂</option>
                    <option value="2">育儿嫂</option>
                    <option value="3">保姆</option>
                    <option value="4">小时工</option>
                <?php elseif ('月嫂' == $data['category']): ?>
                    <option value="1" selected>月嫂</option>
                    <option value="2">育儿嫂</option>
                    <option value="3">保姆</option>
                    <option value="4">小时工</option>
                <?php elseif ('育儿嫂' == $data['category']): ?>
                    <option value="1">月嫂</option>
                    <option value="2" selected>育儿嫂</option>
                    <option value="3">保姆</option>
                    <option value="4">小时工</option>
                <?php elseif ('保姆' == $data['category']): ?>
                    <option value="1">月嫂</option>
                    <option value="2">育儿嫂</option>
                    <option value="3" selected>保姆</option>
                    <option value="4">小时工</option>
                <?php elseif ('小时工' == $data['category']): ?>
                    <option value="1">月嫂</option>
                    <option value="2">育儿嫂</option>
                    <option value="3">保姆</option>
                    <option value="4" selected>小时工</option>
                <?php endif;?>
            </select>
        </div>
        <div class="form-group">
            <label>级别</label>
            <select class="form-control" name="addLevel">
                <option value="0">请选择级别</option>
                <?php if (!$data): ?>
                    <option value="1">高级</option>
                    <option value="2">中级</option>
                    <option value="3">初级</option>
                <?php elseif ('高级' == $data['level']): ?>
                    <option value="1" selected>高级</option>
                    <option value="2">中级</option>
                    <option value="3">初级</option>
                <?php elseif ('中级' == $data['level']): ?>
                    <option value="1">高级</option>
                    <option value="2" selected>中级</option>
                    <option value="3">初级</option>
                <?php elseif ('初级' == $data['level']): ?>
                    <option value="1">高级</option>
                    <option value="2">中级</option>
                    <option value="3" selected>初级</option>
                <?php endif;?>
            </select>
        </div>
        <div class="form-group">
            <label for="InputBrief">一句话介绍</label>
            <?php if ($data): ?>
                <input type="text" class="form-control" name="addBrief" id="InputBrief" value="<?php echo $data['brief'];?>">
            <?php else: ?>
                <input type="text" class="form-control" name="addBrief" id="InputBrief" placeholder="一句话介绍">
            <?php endif;?>
        </div>
        <div class="form-group">
            <label for="InputProfile">个人信息</label>
            <?php if ($data): ?>
                <textarea class="form-control" name="addProfile" id="InputProfile" wrap="soft" rows="5" placeholder="个人信息"><?php echo $data['profile'];?></textarea>
            <?php else: ?>
                <textarea class="form-control" name="addProfile" id="InputProfile" wrap="soft" rows="5" placeholder="个人信息"></textarea>
            <?php endif;?>
        </div>
        <div class="form-group">
            <label for="InputExperience">工作履历</label>
            <?php if ($data): ?>
                <textarea class="form-control" name="addExperience" id="InputExperience" wrap="soft" rows="5" placeholder="工作履历"><?php echo $data['experience'];?></textarea>
            <?php else: ?>
                <textarea class="form-control" name="addExperience" id="InputExperience" wrap="soft" rows="5" placeholder="工作履历"></textarea>
            <?php endif;?>
        </div>
        <div class="form-group">
            <label for="InputCharge">试用期和费用</label>
            <?php if ($data): ?>
                <input type="text" class="form-control" name="addCharge" id="InputCharge" value="<?php echo $data['charge'];?>">
            <?php else: ?>
                <input type="text" class="form-control" name="addCharge" id="InputCharge" placeholder="试用期和费用">
            <?php endif;?>
        </div>
        <?php if ($data): ?>
            <button type="submit" class="btn btn-primary">修改</button>
        <?php else: ?>
            <button type="submit" class="btn btn-primary">添加</button>
        <?php endif;?>
    </form>

</div>
</body>
</html>
