<?php
include 'header.php';

if (1 !== $_SESSION['status']) {
    echo "<script>window.location='login.php'</script>";
    exit();
}

// 修改状态
if ((int) $_GET['id'] && (int) $_GET['s']) {
    $id     = (int) $_GET['id'];
    $status = (int) $_GET['s'];

    $sql = "UPDATE `xay_waiter`
            SET `wstatus` = '" . $status . "' WHERE  `id`='" . $id . "'";
    if ($mysqli->real_query($sql)) {
        echo "<script>window.location = 'showWaiter.php';</script>";
        exit();
    } else {
        echo "<script>alert('修改失败！');window.history.back();</script>";
    }
}

// 获取总条数
$totalSql    = "SELECT COUNT(*) FROM `xay_waiter`";
$totalResult = $mysqli->query($totalSql);
if ($totalResult->num_rows > 0) {
    $total = $totalResult->fetch_array(MYSQL_NUM)[0];
    $num   = 20;
    $page  = ceil($total / $num);
    $p     = (int) $_GET['p'] ? (int) $_GET['p'] : 1;

    $pageTop = ($p - 1) * $num;

    // 获取家政信息
    $query = "SELECT * FROM `xay_waiter` LIMIT " . $pageTop . "," . $num;

    $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $row['category'] = $category[$row['category']];
            $row['level']    = $level[$row['level']];
            $data[]          = $row;
        }
    }
}

?>

<div id="bodyer">
    <div id="sidebar"><?php include 'sidebar.php';?></div>
    <div id="main" class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="main-title"><span class="yahei">所有家政信息</span><small>（查看所有家政人员的详细信息）</small></h2>
                <div class="table-responsive">
                    <table class="table-rule table table-bordered table-hover">
                        <tr><th>头像</th><th>姓名</th><th>类别</th><th>等级</th><th>性别</th><th>简介</th><th>个人信息</th><th>工作履历</th><th>收费</th><th>操作</th></tr>
                        <?php for ($i = 0; $i < count($data); $i++): ?>
                            <tr>
                                <td><img src="<?php echo str_ireplace('@', '../', $data[$i]['avatar']);?>" style="width:50px;"></td>
                                <td><?php echo $data[$i]['lastName'] . $data[$i]['firstName'];?></td>
                                <td><?php echo $data[$i]['category'];?></td>
                                <td><?php echo $data[$i]['level'];?></td>
                                <td><?php echo $data[$i]['sex'];?></td>
                                <td><?php echo $data[$i]['brief'];?></td>
                                <td><?php echo $data[$i]['profile'];?></td>
                                <td><?php echo $data[$i]['experience'];?></td>
                                <td><?php echo $data[$i]['charge'];?></td>
                                <td>
                                <a class="btn btn-default" href="addWaiter.php?id=<?php echo $data[$i]['id'];?>" role="button">修改</a>
                                <?php if (1 == $data[$i]['wstatus']): ?>
                                    <a class="btn btn-default" href="?id=<?php echo $data[$i]['id'];?>&s=2" role="button">禁用</a>
                                <?php elseif (2 == $data[$i]['wstatus']): ?>
                                    <a class="btn btn-primary" href="?id=<?php echo $data[$i]['id'];?>&s=1" role="button">启用</a>
                                <?php endif;?>
                                </td>
                            </tr>
                        <?php endfor;?>
                    </table>

                    <?php if ($total > $num): ?>
                    <nav>
                        <ul class="pagination">
                            <?php if (1 == $p): ?>
                                <li class="disabled">
                                    <a href="javascript:;" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a href="showWaiter.php?p=<?php echo ($p - 1);?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif;?>

                            <?php for ($i = 1; $i <= $page; $i++): ?>
                                <?php if ($i == $p): ?>
                                    <li class="active"><a href="showWaiter.php?p=<?php echo $i;?>"><?php echo $i;?></a></li>
                                <?php else: ?>
                                    <li><a href="showWaiter.php?p=<?php echo $i;?>"><?php echo $i;?></a></li>
                                <?php endif;?>
                            <?php endfor;?>

                            <?php if ($page == $p): ?>
                                <li class="disabled">
                                    <a href="javascript:;" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a href="showWaiter.php?p=<?php echo ($p + 1);?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php endif;?>
                        </ul>
                    </nav>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
