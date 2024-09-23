<?php
include_once "../api/db.php";
?>
<style>
    #room {
        background: url('./icon/03D04.png');
        width: 540px;
        height: 370px;
        margin: auto;
        box-sizing: border-box;
        padding: 19px 110px 10px 110px;
        display: flex;
        flex-wrap: wrap;
    }

    .seat {
        width: 60px;
        height: 80px;
        margin: 2px;
    }

    #qt {
        color: #ff0;
        font-weight: bolder;
    }
</style>
<div id="room">
    <?php
    $orders = $Order->all($_POST);
    $seats = [];
    foreach ($orders as $ord) {
        $seat = unserialize($ord['seats']);
        $seats = array_merge($seats, $seat);
    }
    for ($i = 1; $i <= 20; $i++) {
        $col = ceil($i / 5);
        $num = ($i - 1) % 5 + 1;
    ?>
        <div class="seat">
            <div><?= $col ?>排<?= $num ?>號</div>
            <img src="./icon/03D0<?= (in_array($i, $seats)) ? 3 : 2 ?>.png" alt=""><?= (in_array($i, $seats)) ? "" : "<input type='checkbox'
            value='$i' class='chk'>" ?>
        </div>
    <?php
    }
    ?>
</div>
<div class="rb tab">
    <div>您選擇的電影是: <?= $_POST['movie'] ?></div>
    <div>您選擇的時刻是: <?= $_POST['date'] ?> <?= $_POST['session'] ?></div>
    <div>您已勾選<span id="qt">0</span>張票，最多可購買四張票</div>
    <div style="text-align:center"><button onclick="back()">上一步</button> | <button onclick="checkout()">訂購</button>
    </div>
</div>
<script>
    let qt = 0;
    let seats = new Array();
    $('.chk').on('change', function() {
        if ($(this).prop("checked")) {
            if (qt >= 4) {
                $(this).prop("checked", false);
                alert("已選取超過可訂購的四張票")
            } else {
                qt++;
                seats.push($(this).val());
            }
        } else {
            qt--;
            seats.splice(seats.indexOf($(this).val()), 1);
        }
        $("#qt").text(qt);
    })

    function back() {
        $('#order').show();
        $('#booking').hide();
    }

    function checkout() {
        let data = {
            movie: "<?= $_POST['movie'] ?>",
            date: "<?= $_POST['date'] ?>",
            session: "<?= $_POST['session'] ?>",
            seats,
            qt
        }
        $.post('../api/checkout.php?do=order', data, (res) => {
            // console.log(res)
            location.href = "./index.php?do=checkout&no=" + res;
        })

    }
</script>