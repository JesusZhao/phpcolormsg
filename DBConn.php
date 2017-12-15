<?php
# 使用 MAMP 的内置MySQL数据库
$mysqli = mysqli_connect('localhost','root','root','msg');//要记得在使用完数据库后调用mysqli_close($mysqli)关闭数据库连接
if($mysqli->connect_errno > 0){
  echo "连接失败：".$mysqli->connect_error;
  exit;
}
?>
