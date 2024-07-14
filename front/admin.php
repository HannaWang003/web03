<?php
if (isset($_SESSION['admin'])) {
    to("back.php");
}
?>
<h2 class="ct">管理者登入</h2>
<table style="margin:auto;">
    <tr>
        <td>帳號</td>
        <td><input type="text" name="acc" id="acc"></td>
    </tr>
    <tr>
        <td>密碼</td>
        <td><input type="password" name="pw" id="pw"></td>
    </tr>
</table>
<div class="ct"><button onclick="login()">登入</button></div>
<script>
function login() {
    let acc = $('#acc').val();
    let pw = $('#pw').val();
    if (acc == "admin" && pw == "1234") {
        <?php $_SESSION['admin'] = "admin" ?>
        location.href = "back.php";
    } else {
        alert("輸入錯誤");
    }
}
</script>