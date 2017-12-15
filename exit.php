<?php
session_start();
session_destroy();//清除SESSION
header("Location: http://localhost/msg/index.php");//无论用户是否登录，最后都返回留言板主页
 ?>
