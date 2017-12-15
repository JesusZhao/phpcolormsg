<?php
$username = $_POST['username'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
if($username != null and $username != '' and $password1 != null and $password1 != '' and $password2 != null and $password2 != '' and $password1 == $password2){
  include('DBConn.php');
  $sql = "insert into users(username, password) values('{$username}', '{$password1}')";
  $result = $mysqli->query($sql);
  if($result){
    header("Location: http://localhost/msg/login.php?reg=ok&loginuser=".$username);
    $result->close();
    $mysqli->close();
    exit;
  }else{
    $result->close();
    $mysqli->close();
    echo "<script type='text/javascript'>alert('注册失败！');</script>";
  }
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/registe.css">
    <title>注册</title>
    <script type="text/javascript">
      function checkpasswd(){
        username = document.getElementById("uname");
        password1 = document.getElementById("passwd1");
        password2 = document.getElementById("passwd2");
        if(username.value == ""){
          alert("用户名不能为空！");
          return false;
        }
        if(password1.value == ""){
          alert("密码不能为空！");
          return false;
        }
        if(password2.value == ""){
          alert("请再次填写密码！");
          return false;
        }
        if(password1.value != password2.value){
          alert("两次输入的密码不一致！");
          return false;
        }
      }
    </script>
  </head>
  <body>
    <div class="reg">
      <header>
        <h2><center>欢迎注册</center></h2>
      </header>
      <form action="registe.php" method="post">
        <p>
          <label for="uname">用户名：</label>
          <input type="text" id="uname" name="username">
        </p>
        <p>
          <label for="passwd1">密码：</label>
          <input type="password" id="passwd1" name="password1" placehoder="请输入不长于20位的密码">
        </p>
        <p>
          <label for="passwd2">确认密码：</label>
          <input type="password" id="passwd2" name="password2" placehoder="请再次输入密码">
        </p>
        <p class="btns">
          <input type="reset" value="重置">
          <input type="submit" value="注册" onclick="checkpasswd()">
        </p>
      </form>
    </div>
    <script id="ribbon" size="280" alpha="0.6" src="js/canvas-ribbon.min.js"></script>
  </body>
</html>
