<?php
include_once "db.php";
$rows = $Order->all($_POST);
$tmp = [];
foreach ($rows as $row) {
    $tmp = array_merge($tmp, unserialize($row['seat']));
}
?>
<style>
#room {
    width: 540px;
    height: 370px;
    padding: 19px 110px 10px 110px;
    box-sizing: border-box;
    background: url('./icon/03D04.png');
    margin: auto;
    display: flex;
    flex-wrap: wrap;

    .seat {
        width: 60px;
        height: 80px;
        margin: 2px;
        color: #333;
        font-family: Arial, Helvetica, sans-serif;
    }
}

#info {
    width: 540px;
    background: #999;
    box-shadow: inset 0 0 10px #eee;
    border: 1px solid #333;
    border-radius: 5px;
    padding: 19px 110px;
    box-sizing: border-box;
    margin: auto;
    color: #eee
}

#qt {
    font-weight: bolder;
    font-size: 30px;
    color: #0fe;
}
</style>
<div id="room">
    <?php
    for ($i = 1; $i <= 20; $i++) {
        $col = ceil($i / 5);
        $num = ($i - 1) % 5 + 1
    ?>
    <div class="seat">
        <?= $col . "排" . $num . "號" ?>
        <img src="./icon/03D0<?= in_array($i, $tmp) ? 3 : 2 ?>.png" alt="">
        <?=(in_array($i,$tmp))?"":"<input type='checkbox' name='chk' class='chk' style='float:right;' value='$i'>"?>
    </div>
    <?php
    }
    ?>
</div>
<div id="info">
    <div>您選擇的電影是 : <?= $_POST['movie'] ?></div>
    <div>您選擇的時刻是 : <?= $_POST['date'] . " " . $_POST['session'] ?></div>
    <div>您已勾選<span id="qt">0</span>張票，最多可以購買四張票</div>
    <div class="ct"><input type="button" value="上一步" onclick="bo()"> <input type="button" value="訂購"
            onclick="booking()"></div>
</div>
<script>
let qt = 0;
let seat = [];
$('.chk').on('change', function() {
    if ($(this).prop('checked')) {
        if (qt < 4) {
            qt++;
            seat.push($(this).val())
        } else {
            $(this).prop('checked', false);
            alert("每個人最多只能勾選四張票")
        }
    } else {
        seat.splice(seat.indexOf($(this).val()), 1)
        qt--;
    }
    $('#qt').text(qt);
    console.log(seat)
})

function booking() {
    let data = {
        movie: "<?= $_POST['movie'] ?>",
        date: "<?= $_POST['date'] ?>",
        session: "<?= $_POST['session'] ?>",
        seat,
        qt
    }
    console.log(data)
    $.post('api/checkout.php?do=order', data, (res) => {
        location.href = "?do=checkout&no=" + res;
    })
}
</script>