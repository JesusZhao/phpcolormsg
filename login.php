<?php
if($_GET['reg'] == 'ok'){
  echo "<script type='text/javascript'>alert('注册成功！请登录！');</script>";
}
session_start();
$username = $_POST["username"];
$password = $_POST["password"];
$userType = $_POST['userType'];
if($username != null and $password != null and $username != '' and $password != ''){
  include('DBConn.php');
  $sql = "select * from {$userType} where username='{$username}'";
  $result = $mysqli->query($sql);
  if($result){
    $row = $result->fetch_row();
    $result->close();
    $mysqli->close();
    if($row != null){
      if($row[2] == $password){
        $_SESSION['curUser'] = $username;//向_SESSION数组中添加一个键为当前id+1，值为$username的新SESSION
        header("Location: http://localhost/msg/index.php");
        exit;
      }else{
        echo "<script type='text/javascript'>alert('密码错误！');</script>";
      }
    } else{
      echo "<script type='text/javascript'>alert('无此用户！请选择正确的用户类型或注册.');</script>";
    }
  } else{
    $result->close();
    $mysqli->close();
    echo "查询失败！";
  }
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/login.css">
    <title>登录</title>
    <script type="text/javascript">
      function check(){
        username = document.getElementById("username");
        password = document.getElementById("password");
        if(username.value == ""){
          alert("用户名不能为空！");
          return false;
        }
        if(password.value == ""){
          alert("密码不能为空！");
          return false;
        }
      }
    </script>
  </head>
  <body>
    <div class="login contain">
      <header>
        <h2><center>欢迎登陆</center></h2>
      </header>
      <form class="" action="login.php" method="post">
        <p>
          <label for="username">用户名：</label>
          <input type="text" name="username" id="username" value="<?php echo $_GET['loginuser'];?>">
        </p>
        <p>
          <label for="password">密码：</label>
          <input type="password" name="password" id="password">
        </p>
        <p>
          <label for="userType">用户类型：</label>
          <select id="userType" name="userType">
            <option value="users" default>用户</option>
            <option value="admin">管理员</option>
          </select>
        </p>
        <p class="btns">
          <a href="registe.php"><input type="button" class="btn" value="去注册"></a>
          <input type="submit" class="btn" value="登录" onclick="check()">
        </p>
      </form>
    </div>
    <script id="ribbon" size="280" alpha="0.6" src="js/canvas-ribbon.min.js"></script>
  </body>
</html>