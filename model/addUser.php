<?php
require_once "../config.php";

// 判断 cookies
if (isset($_COOKIE["xay_lastTime"])) {
    echo "<script>
            document.write('<div style=\'margin:2rem auto;padding:1rem 0;width:90%;font-size:1rem;color:#800;\'>请在 2 分钟后提交! 5 秒后返回上一页</div>');
            document.write('<div style=\'margin:2rem auto;padding:1rem 0;width:90%;text-align:center;font-size:1rem;border-radius:10px;color:#fff;background-color:#008000;cursor:pointer;\' onclick=\'window.history.go(-2);\'>返回上一页</div>');
            document.write('<div style=\'margin:2rem auto;padding:1rem 0;width:90%;text-align:center;font-size:1rem;border-radius:10px;color:#fff;background-color:#008000;cursor:pointer;\' onclick=\'location.href=\"../\";\'>返回祥阿姨首页</div>');
            setTimeout('window.history.go(-2)',5000);
        </script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && !empty(filter_input(INPUT_POST, 'addName', FILTER_SANITIZE_STRIPPED))
    && !empty(filter_input(INPUT_POST, 'addTel', FILTER_SANITIZE_STRIPPED))
) {
    $postWid    = (int) $_POST['addWid'];
    $postName   = filter_input(INPUT_POST, 'addName', FILTER_SANITIZE_STRIPPED);
    $postTel    = filter_input(INPUT_POST, 'addTel', FILTER_SANITIZE_STRIPPED);
    $postAddr   = filter_input(INPUT_POST, 'addAddr', FILTER_SANITIZE_STRIPPED);
    $postDate   = filter_input(INPUT_POST, 'addDate', FILTER_SANITIZE_STRIPPED);
    $postExpect = filter_input(INPUT_POST, 'addExpect', FILTER_SANITIZE_STRIPPED);
    $postBorn   = filter_input(INPUT_POST, 'addBorn', FILTER_SANITIZE_STRIPPED);
    $postRemark = filter_input(INPUT_POST, 'addRemark', FILTER_SANITIZE_STRIPPED);
    $postUa     = $_SERVER['HTTP_USER_AGENT'];
    $postTime   = date("Y-m-d H:i:s", time());

    $sql = "INSERT INTO `xay_order` (`wid`, `name`, `tel`, `address`,
                `date`, `expectDate`, `bornDate`, `remark`, `ua`, `time`)
            VALUES ('" . $postWid . "','" . $postName . "','" . $postTel . "',
                '" . $postAddr . "','" . $postDate . "','" . $postExpect . "',
                '" . $postBorn . "','" . $postRemark . "','" . $postUa . "',
                '" . $postTime . "')";

    if ($mysqli->real_query($sql)) {
        setcookie("xay_lastTime", time(), time() + 120);
        echo "<script>
                document.write('<div style=\'margin:2rem auto;padding:1rem 0;width:90%;font-size:1rem;color:#080;\'>提交成功! 5 秒后返回首页</div>');
                document.write('<div style=\'margin:2rem auto;padding:1rem 0;width:90%;text-align:center;font-size:1rem;border-radius:10px;color:#fff;background-color:#008000;cursor:pointer;\' onclick=\'window.history.go(-2);\'>返回上一页</div>');
                document.write('<div style=\'margin:2rem auto;padding:1rem 0;width:90%;text-align:center;font-size:1rem;border-radius:10px;color:#fff;background-color:#008000;cursor:pointer;\' onclick=\'location.href=\"../\";\'>返回祥阿姨首页</div>');
                setTimeout('location.href=\'../\';',5000);
            </script>";
    } else {
        echo "<script>
                document.write('<div style=\'margin:2rem auto;padding:1rem 0;width:90%;font-size:1rem;color:#800;\'>提交失败! 5 秒后返回上一页</div>');
                document.write('<div style=\'margin:2rem auto;padding:1rem 0;width:90%;text-align:center;font-size:1rem;border-radius:10px;color:#fff;background-color:#008000;cursor:pointer;\' onclick=\'window.history.go(-2);\'>返回上一页</div>');
                document.write('<div style=\'margin:2rem auto;padding:1rem 0;width:90%;text-align:center;font-size:1rem;border-radius:10px;color:#fff;background-color:#008000;cursor:pointer;\' onclick=\'location.href=\"../\";\'>返回祥阿姨首页</div>');
                setTimeout('window.history.go(-2)',5000);
            </script>";
    }
} else {
    echo "<script>
            document.write('<div style=\'margin:2rem auto;padding:1rem 0;width:90%;font-size:1rem;color:#800;\'>请正确填写表单信息! 5 秒后返回上一页</div>');
            document.write('<div style=\'margin:2rem auto;padding:1rem 0;width:90%;text-align:center;font-size:1rem;border-radius:10px;color:#fff;background-color:#008000;cursor:pointer;\' onclick=\'window.history.go(-2);\'>返回上一页</div>');
            document.write('<div style=\'margin:2rem auto;padding:1rem 0;width:90%;text-align:center;font-size:1rem;border-radius:10px;color:#fff;background-color:#008000;cursor:pointer;\' onclick=\'location.href=\"../\";\'>返回祥阿姨首页</div>');
            setTimeout('window.history.go(-2)',5000);
        </script>";
}
