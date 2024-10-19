<?php
include_once "db.php";
?>
<style>
    #room,
    #info {
        width: 540px;
        box-sizing: border-box;
        padding: 19px 110px 10px 110px;
        margin: auto;
    }

    #room {
        background: url('./icon/03D04.png');
        height: 370px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;

        .seat {
            width: 60px;
            height: 80px;
            margin: 2px;
            position: relative;
        }
    }

    #info {
        background: linear-gradient(#000, #fff);
        color: #0fe;
        padding: 10px;
        box-shadow: inset 0 0 10px #000;
        text-shadow: 2px 2px 5px #000;
    }

    #qt {
        color: #ff0;
        font-size: 30px;
    }
</style>
<div style="background:#fff;padding:10px;">
    <div id="room">
        <?php
        $rows = $Order->all($_POST);
        $seats = [];
        foreach ($rows as $row) {
            $seats = array_merge($seats, unserialize($row['seats']));
        }
        for ($i = 1; $i <= 20; $i++) {
            $col = ceil($i / 5);
            $num = ($i - 1) % 5 + 1;
        ?>
            <div class="seat">
                <div><?= $col . "排" . $num . "號" ?>
                </div>
                <img src="./icon/03D0<?= (in_array($i, $seats)) ? 3 : 2 ?>.png" alt="">
                <input type="checkbox" class="chk" value="<?= $i ?>" style="position:absolute;bottom:0px;right:0px;">
            </div>
        <?php
        }
        ?>
    </div>
    <div id="info">
        <p>您選擇的電影是 : <?= $_POST['name'] ?></p>
        <p>您選擇的時刻是 : <?= $_POST['date'] ?> <?= $_POST['session'] ?></p>
        <p>您已勾選<b id="qt">0</b>張票 最多可以購買四張票</p>
        <div class="ct"><button onclick="chg()">上一步</button> <button onclick="checkout()">訂購</button></div>
    </div>
</div>
<script>
    let qt = 0;
    let seats = new Array();
    $('.chk').on('change', function() {
        if ($(this).prop("checked")) {
            if (qt < 4) {
                qt++;
                seats.push($(this).val());
            } else {
                $(this).prop('checked', false);
                alert("每個人最多可勾選四張票")
            }
        } else {
            qt--;
            seats.splice(seats.indexOf($(this).val()), 1)
        }
        $('#qt').text(qt);
    })

    function checkout() {
        let data = {
            name: "<?= $_POST['name'] ?>",
            date: "<?= $_POST['date'] ?>",
            session: "<?= $_POST['session'] ?>",
            qt,
            seats
        }
        $.post('../api/checkout.php', data, (res) => {
            location.href = "?do=checkout&no=" + res
        })
    }
</script>