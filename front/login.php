<div class="ct">
    <p class="t botli">管理員登入區</p>
    <p class="cent">帳號 ： <input name="acc" type="text" id="acc"></p>
    <p class="cent">密碼 ： <input name="pw" type="password" id="pw"></p>
    <p class="cent"><input value="送出" type="button" id="login"><input type="button" value="清除" onclick="clean()"></p>
</div>
<script>
$('#login').on('click', () => {
    let acc = $('#acc').val();
    let pw = $('#pw').val()
    if (acc == "admin" && pw == "1234") {
        $.post('./api/login.php', {
            acc
        }, () => {
            location.href = "back.php";
        })
    } else {
        alert("帳號或密碼錯誤")
        location.reload();
    }
})

function clean() {
    location.reload();
}
</script>