<?php
include_once "../api/db.php";
?>
<style>
    #room {
        background: url("./icon/03D04.png");
        width: 540px;
        height: 370px;
        box-sizing: border-box;
        padding: 19px 110px 10px 110px;
        margin: auto;
        display: flex;
        flex-wrap: wrap;
    }

    .seat {
        width: 60px;
        height: 80px;
        padding: 2px;
    }

    #info {
        width: 540px;
        height: 150px;
        margin: auto;
        box-sizing: border-box;
        padding: 10px 110px 10px 110px;
        background: #333;
        color: #fff;

        span {
            color: #ff0;
            font-weight: bolder;
        }
    }
</style>
<div id="room">
    <?php
    $seats = [];
    $ords = $Order->all($_POST);
    foreach ($ords as $ord) {
        $seats = array_merge($seats, unserialize($ord['seats']));
    }
    for ($i = 1; $i <= 20; $i++) {
        $col = ceil($i / 5);
        $num = ($i - 1) % 5 + 1;
    ?>
        <div class="seat">
            <div><?= $col ?>排<?= $num ?>號</div>
            <img src="./icon/03D0<?= (in_array($i, $seats)) ? "3" : "2" ?>.png" alt=""><?= (in_array($i, $seats)) ? "" : "<input type='checkbox'
                value='$i' class='chk'>" ?>
        </div>
    <?php
    }
    ?>
</div>
<div id="info">
    <div>您選擇的電影是 : <?= $_POST['movie'] ?></div>
    <div>您選擇的時刻是 : <?= $_POST['date'] ?> <?= $_POST['session'] ?> </div>
    <div>您已勾選<span>0</span>張票，最多可以購買四張票</div>
    <div class="ct"><button onclick="back()">上一步</button> <button onclick="checkout()">訂購</button></div>
</div>
<script>
    let qt = 0;
    let seats = new Array();
    $('.chk').on('change', function() {
        if ($(this).prop('checked')) {
            if (qt >= 4) {
                alert("已超過可選取的四張票");
                $(this).prop("checked", false);
            } else {
                qt++;
                seats.push($(this).val());
            }
        } else {
            qt--;
            seats.splice(seats.indexOf($(this).val()), 1);
        }
        $('#info').find('span').text(qt);
    })

    function back() {
        $('#booking').hide();
        $('#order').show();
    }

    function checkout() {
        let data = {
            movie: "<?= $_POST['movie'] ?>",
            date: "<?= $_POST['date'] ?>",
            session: "<?= $_POST['session'] ?>",
            seats,
            qt
        }
        $.post('./api/checkout.php?do=order', data, (res) => {
            console.log(res);
            location.href = "?do=checkout&no=" + res
        })
    }
</script>