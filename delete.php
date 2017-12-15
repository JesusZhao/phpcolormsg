<?php
session_start();
if($_SESSION['curUser'] == 'jesuszhao'){
  $id = $_GET['id'];
  if($id){
    include('DBConn.php');
    $sql = "delete from message where id='{$id}'";
    $mysqli->query($sql);
    $mysqli->close();
  }
}
header("Location: http://localhost/msg/index.php");# 无论删除情况如何最后都跳转回主页面
 ?>
