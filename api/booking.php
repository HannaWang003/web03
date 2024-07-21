<?php
include_once "db.php";

?>
<style>
    #room,
    #info {
        width: 540px;
        background: #aaa;
        box-sizing: border-box;
        margin: auto;
    }

    #room {
        background: url('../icon/03D04.png');
        background-position: center center;
        background-repeat: no-repeat;
        height: 370px;
        padding: 19px 112px 0px 112px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;

        .seat {
            width: 63px;
            height: 80px;
            position: relative;

            img {
                width: 60%;
            }

            .chk {
                position: absolute;
                bottom: 2px;
                right: 2px;
            }
        }
    }

    #info {
        padding: 10px;

        b {
            color: yellow;
        }
    }
</style>
<div id="room">
    <?php
    for ($i = 1; $i <= 20; $i++) {
        $col = ceil($i / 5);
        $num = ($i - 1) % 5 + 1;
    ?>
        <div class="seat">
            <div><?= $col ?>排<?= $num ?>號</div>
            <div><img src="../icon/03D02.png" alt=""></div>
            <input type="checkbox" class="chk" value="<?= $i ?>">
        </div>
    <?php
    }
    ?>
</div>
<div id="info">
    <div>您選擇的電影是：<b><?= $_POST['movie'] ?></b></div>
    <div>您選擇的時刻是：<b><?= $_POST['date'] ?> <?= $_POST['session'] ?></b></div>
    <div>您已經勾選<b><span id="qt">0</span></b>張票, 最多可以購買四張票</div>
    <div class="ct"><button onclick="toggle(this)">上一步</button> <button onclcik="checkout()">訂購</button></div>
</div>
<script>
    let seat = [];
    $('.chk').on('change', function() {
        if ($(this).prop("checked")) {
            if (seat.length < 4) {
                seat.push($(this).val());
            } else {
                alert("勾選數量已超過4張")
                $(this).prop("checked", false);
            }

        } else {
            seat.splice(seat.indexOf($(this).val()), 1);
        }
        console.log(seat)
        $('#qt').text(seat.length)
    })
</script>