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

    $sql = "UPDATE `xay_order`
            SET `status` = '" . $status . "' WHERE  `id`='" . $id . "'";
    if ($mysqli->real_query($sql)) {
        echo "<script>window.location = 'index.php';</script>";
        exit();
    } else {
        echo "<script>alert('修改失败！');window.history.back();</script>";
    }
}

// 获取总条数
$totalSql    = "SELECT COUNT(*) FROM `xay_order` WHERE `wid`!=0";
$totalResult = $mysqli->query($totalSql);
if ($totalResult->num_rows > 0) {
    $total = $totalResult->fetch_array(MYSQL_NUM)[0];
    $num   = 20;
    $page  = ceil($total / $num);
    $p     = (int) $_GET['p'] ? (int) $_GET['p'] : 1;

    $pageTop = ($p - 1) * $num;

    // 获取服务订单信息和对应的家政信息
    $sql = "SELECT *, `id` AS `oid`, `time` AS `otime` FROM `xay_order`
            WHERE `wid` !=0 ORDER BY `otime` DESC LIMIT " . $pageTop . "," . $num;
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

            $wsql    = "SELECT * FROM `xay_waiter` WHERE `id`=" . $row['wid'];
            $wresult = $mysqli->query($wsql);
            if ($wresult->num_rows > 0) {
                while ($wrow = $wresult->fetch_array(MYSQLI_ASSOC)) {
                    $data[] = array_merge($row, $wrow);
                }
            }

        }
    }
}
?>

<div id="bodyer">
    <div id="sidebar"><?php include 'sidebar.php';?></div>
    <div id="main" class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="main-title"><span class="yahei">家政订单</span><small>（查看所有雇佣家政的订单信息）</small></h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <tr><th>服务订单ID</th><th>雇主姓名</th><th>联系电话</th><th>受雇家政信息</th><th>详细服务地址</th><th>服务时间</th><th>预产期</th><th>宝宝出生日期</th><th>填写时间</th><th>状态</th></tr>
                        <?php for ($i = 0; $i < count($data); $i++): ?>
                            <tr>
                                <td><?php echo $data[$i]['oid'];?></td>
                                <td><?php echo $data[$i]['name'];?></td>
                                <td><?php echo $data[$i]['tel'];?></td>
                                <td>
                                    <a tabindex="0" class="btn btn-default" role="button" data-toggle="popover" data-trigger="focus" data-html="true" title="<?php echo $data[$i]['lastName'] . $data[$i]['firstName'] . '&nbsp;&nbsp;(' . $data[$i]['sex'] . ')';?>" data-content="<img style='width:50px;' src='<?php echo str_ireplace('@', '../', $data[$i]['avatar']);?>'><br>类别: <?php echo $category[$data[$i]['category']];?><br>等级: <?php echo $level[$data[$i]['level']];?><br>简介: <?php echo $data[$i]['brief'];?><br>收费: <?php echo $data[$i]['charge'];?><br>个人信息: <?php echo $data[$i]['profile'];?><br>个人履历: <?php echo $data[$i]['experience'];?>">
                                        <?php echo $data[$i]['lastName'] . '阿姨';?>
                                    </a>
                                </td>
                                <td><?php echo $data[$i]['address'];?></td>
                                <td><?php echo $data[$i]['date'];?></td>
                                <td><?php echo $data[$i]['expectDate'];?></td>
                                <td><?php echo $data[$i]['bornDate'];?></td>
                                <td><?php echo $data[$i]['otime'];?></td>
                                <?php if (1 == $data[$i]['status']): ?>
                                    <td><a class="btn btn-primary" href="?id=<?php echo $data[$i]['oid'];?>&s=2" role="button">未处理</a></td>
                                <?php elseif (2 == $data[$i]['status']): ?>
                                    <td><a class="btn btn-default" href="?id=<?php echo $data[$i]['oid'];?>&s=1" role="button">已处理</a></td>
                                <?php endif;?>
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
                                    <a href="index.php?p=<?php echo ($p - 1);?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif;?>

                            <?php for ($i = 1; $i <= $page; $i++): ?>
                                <?php if ($i == $p): ?>
                                    <li class="active"><a href="index.php?p=<?php echo $i;?>"><?php echo $i;?></a></li>
                                <?php else: ?>
                                    <li><a href="index.php?p=<?php echo $i;?>"><?php echo $i;?></a></li>
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
                                    <a href="index.php?p=<?php echo ($p + 1);?>" aria-label="Next">
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
<script>
// 初始化所有弹出框
$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});
</script>
</body>
</html>