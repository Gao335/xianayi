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
        echo "<script>window.location = 'hourerOrder.php';</script>";
        exit();
    } else {
        echo "<script>alert('修改失败！');window.history.back();</script>";
    }
}

// 获取总条数
$totalSql    = "SELECT COUNT(*) FROM `xay_order` WHERE `wid`=0";
$totalResult = $mysqli->query($totalSql);
if ($totalResult->num_rows > 0) {
    $total = $totalResult->fetch_array(MYSQL_NUM)[0];
    $num   = 20;
    $page  = ceil($total / $num);
    $p     = (int) $_GET['p'] ? (int) $_GET['p'] : 1;

    $pageTop = ($p - 1) * $num;

    // 获取服务订单信息和对应的小时工信息
    $sql = "SELECT * FROM `xay_order` WHERE `wid`=0 ORDER BY `time` DESC
            LIMIT " . $pageTop . "," . $num;
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $data[] = $row;
        }
    }
}
?>

<div id="bodyer">
    <div id="sidebar"><?php include 'sidebar.php';?></div>
    <div id="main" class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="main-title"><span class="yahei">小时工订单</span><small>（查看所有雇佣小时工的订单信息）</small></h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <tr><th>服务订单ID</th><th>雇主姓名</th><th>联系电话</th><th>详细服务地址</th><th>服务时间</th><th>个性需求</th><th>填写时间</th><th>状态</th></tr>
                        <?php for ($i = 0; $i < count($data); $i++): ?>
                            <tr>
                                <td><?php echo $data[$i]['id'];?></td>
                                <td><?php echo $data[$i]['name'];?></td>
                                <td><?php echo $data[$i]['tel'];?></td>
                                <td><?php echo $data[$i]['address'];?></td>
                                <td><?php echo $data[$i]['date'];?></td>
                                <td><?php echo $data[$i]['remark'];?></td>
                                <td><?php echo $data[$i]['time'];?></td>
                                <?php if (1 == $data[$i]['status']): ?>
                                    <td><a class="btn btn-primary" href="?id=<?php echo $data[$i]['id'];?>&s=2" role="button">未处理</a></td>
                                <?php elseif (2 == $data[$i]['status']): ?>
                                    <td><a class="btn btn-default" href="?id=<?php echo $data[$i]['id'];?>&s=1" role="button">已处理</a></td>
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
                                    <a href="hourerOrder.php?p=<?php echo ($p - 1);?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif;?>

                            <?php for ($i = 1; $i <= $page; $i++): ?>
                                <?php if ($i == $p): ?>
                                    <li class="active"><a href="hourerOrder.php?p=<?php echo $i;?>"><?php echo $i;?></a></li>
                                <?php else: ?>
                                    <li><a href="hourerOrder.php?p=<?php echo $i;?>"><?php echo $i;?></a></li>
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
                                    <a href="hourerOrder.php?p=<?php echo ($p + 1);?>" aria-label="Next">
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