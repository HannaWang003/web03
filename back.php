<?php
include_once "./api/db.php";
if (!empty($_POST)) {
  if ($_POST['acc'] == "admin" && $_POST['pw'] == "1234") {
    $_SESSION['admin'] = 1;
    echo "<script>alert('登入成功')</script>";
  } else {
    $error = "<span style='color:yellow'>*帳號或密碼錯誤</span>";
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0055)?do=admin -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>影城</title>
  <link rel="stylesheet" href="./css/css.css">
  <link href="./css/s2.css" rel="stylesheet" type="text/css">
  <script src="./js/jquery-1.9.1.min.js"></script>
</head>

<body>
  <div id="main">
    <div id="top" style=" background:#999 center; background-size:cover; " title="替代文字">
      <h1>ABC影城</h1>
    </div>
    <div id="top2"> <a href="index.php">首頁</a> <a href="index.php?do=order">線上訂票</a> <a href="#">會員系統</a> <a href="back.php">管理系統</a> </div>
    <div id="text"> <span class="ct">最新活動</span>
      <marquee direction="right">
        ABC影城票價全面八折優惠1個月
      </marquee>
    </div>
    <div id="mm">
      <?php
      if (!isset($_SESSION['admin'])) {
      ?>
        <style>
          #login {
            width: 50%;
            margin: auto;
            border: 1px solid #999;
            padding: 10px;

            th {
              width: 40%;
              border: 1px solid #333;
            }

            th,
            td {
              padding: 10px;
            }

            input {
              width: 90%;
            }

          }
        </style>
        <h2 class="ct">管理登入</h2>
        <form action="?" method="post">
          <table id="login">
            <tr>
              <th>帳號</th>
              <td><input type="text" name="acc" id="acc"></td>
            </tr>
            <tr>
              <th>密碼</th>
              <td><input type="text" name="pw" id="pw"></td>
            </tr>
            <tr>
              <td colspan="2" class="ct rb">
                <div style="text-align:end"><?= ($error) ?? "請輸入帳號及密碼" ?></div>
                <button>登入</button>
              </td>
            </tr>
          </table>
        </form>
      <?php
      } else {
      ?>
        <div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> <a href="?do=title">網站標題管理</a>| <a href="?do=go">動態文字管理</a>| <a href="?do=poster">預告片海報管理</a>| <a href="?do=movie">院線片管理</a>| <a href="?do=order">電影訂票管理</a> </div>
        <div class="rb tab">
          <?php
          $do = $_GET['do'] ?? "main";
          $file = "./back/$do.php";
          if (file_exists($file)) {
            include $file;
          } else {
            include "./back/main.php";
          }
          ?>
        </div>
      <?php
      }
      ?>
    </div>
    <div id="bo" class="ct"> ©Copyright 2024 ABC影城 版權所有 </div>
  </div>
</body>

</html>