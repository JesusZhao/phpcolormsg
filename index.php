<?php
session_start();
include('DBConn.php');
if(count($_POST) > 0){
  if($_SESSION['curUser']!=null){
    $msgUser = $_SESSION['curUser'];
  }else{
    $msgUser = '未注册用户：'.$_POST['msgUser'];
  }
  $sql = "insert into message(username, content, pubtime) values('{$msgUser}','{$_POST['msg']}','".date('Y-m-d H:i:s')."')";
  $mysqli->query($sql);
}
$sql = "select * from message order by id desc";  # 查询全部留言并按id逆序排列（即让最新留言显示在top）
$result = $mysqli->query($sql);
 ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>留言板</title>
  <link rel="stylesheet" href="css/style.css">
  <script type="text/javascript">
  function check(){
    msg = document.getElementById("msgcontent");
    uname = document.getElementById("nickname");
    if(msg.value == ''){
      alert("留言内容不能为空");
      return false;
    }
    if(uname.value == ''){
      alert("留言姓名不能为空");
      return false;
    }
  }
  </script>
</head>

<body>
  <header>
    <h2><center>PHP彩带留言板</center></h2>
  </header>
  <div class="contain">
    <form action="index.php" method="post">
      <div class="repubcontent">
        <div>
          <textarea rows="8" class="usrcontent" placeholder="请输入留言内容" name="msg" id="msgcontent"></textarea>
        </div>
        <div class="btns">
          <?php
            if($_SESSION['curUser'] == null){
              echo "<input type='text' class='usr' placeholder='姓名' name='msgUser' id='nickname'>";
            } else {
              echo "<span>您好：{$_SESSION['curUser']}</span>";
            }
          ?>
          <input type="submit" value="发布" class="btn fb" onclick="return check();">
          <?php
          if($_SESSION['curUser'] == null){
          ?>
            <button type="button" name="loginbtn" class="btn"><a href="login.php">登录</a></button>
            <button type="button" name="loginbtn" class="btn"><a href="registe.php">注册</a></button>
          <?php
          }else{
          ?>
            <button type="button" name="loginbtn" class="btn"><a href="exit.php">退出</a></button>
          <?php
          }
          ?>
        </div>
      </div>
    </form>
    <?php
    while ($row = $result->fetch_row()) {
    ?>
    <div class="msg">
      <span class="username"><?php echo $row[1];?></span>
      <?php
      if($_SESSION['curUser'] == 'jesuszhao'){
      ?>
      <button class="delete"><a href="delete.php?id=<?php echo $row[0];?>">删除</a></button>
      <?php
      }
      ?>
      <span class="pubtime"><?php echo $row[3];?></span>
      <p class="pubcontent"><?php echo $row[2];?></p>
    </div>
    <?php
    }
    $result->close();
    $mysqli->close();
    ?>
  </div>
  <script id="ribbon" size="280" alpha="0.6" src="js/canvas-ribbon.min.js"></script>
</body>

</html>
