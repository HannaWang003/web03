<?php
include_once "db.php";
$ords = $Order->all($_POST);
$seats = [];
foreach ($ords as $ord) {
    $seats = array_merge($seats, unserialize($ord['seats']));
}
?>
<style>
    #info {
        width: 540px;
        padding: 20px 40px;
        margin: auto;
    }

    #room {
        width: 540px;
        height: 370px;
        padding: 20px 110px 6px 110px;
        margin: auto;
        background: url('./icon/03D04.png');
        display: flex;
        flex-wrap: wrap;
        box-sizing: border-box;
        justify-content: space-evenly;
    }

    .seat {
        width: 60px;
        height: 80px;
    }

    #qt {
        color: #ff0;
        font-weight: bolder;
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
            <img src="./icon/03D0<?= (in_array($i, $seats)) ? 3 : 2 ?>.png" alt=""><?= ((in_array($i, $seats))) ? "" : "<input type='checkbox' name='seat[]' value='$i'>"
                                                                                    ?>
        </div>
    <?php
    }
    ?>
</div>
<div id="info" class="rb">
    <div>您選擇的電影是 : <?= $_POST['movie'] ?></div>
    <div>您選擇的場次是 : <?= $_POST['date'] ?> <?= $_POST['session'] ?></div>
    <div>您已選擇<span id="qt">0</span>張票，最多可以購買四張票</div>
    <div class="ct"><button onclick="order()">上一步</button> <button onclick="checkout()">訂購</button></div>
</div>
<script>
    let qt = 0;
    let seats = new Array();
    $('input[type="checkbox"]').on('change', function() {
        if ($(this).prop('checked')) {
            if (qt < 4) {
                qt += 1;
                seats.push($(this).val());
            } else {
                $(this).prop('checked', false);
                alert("每個人最多僅可訂購四張票")
            }
        } else {
            seats.splice(seats.indexOf($(this).val()), 1);
            qt -= 1;
        }
        $('#qt').text(qt);
    })

    function order() {
        $('#booking').hide();
        $('#order').show();
    }

    function checkout() {
        $.post('./api/checkout.php?do=order', {
            movie: "<?= $_POST['movie'] ?>",
            date: "<?= $_POST['date'] ?>",
            session: "<?= $_POST['session'] ?>",
            qt,
            seats
        }, (res) => {
            location.href = "?do=checkout&no=" + res;
        })
    }
</script>