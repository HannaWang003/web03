<?php
include_once "db.php";
$rows = $Order->all(['name' => $_POST['movie'], 'date' => $_POST['date'], 'session' => $_POST['session']]);
if (!empty($rows)) {
    $seats = [];
    foreach ($rows as $row) {
        $seats = array_merge($seats, unserialize($row['seat']));
    }
    sort($seats);
}
?>

<style>
    #seats,
    #info {
        width: 540px;
        margin: auto;
    }

    #seats {
        box-sizing: border-box;
        height: 370px;
        padding: 19px 112px 0 112px;
        background: url('./icon/03D04.png');
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: normal;
    }

    .seat {
        width: 60px;
        height: 80px;

    }

    .seat img {
        width: 60%;
    }

    #info {
        background: #eee;
        padding: 5px;
    }

    #info div {
        margin: 5px;
    }
</style>
<div id="seats">
    <?php
    for ($i = 1; $i <= 20; $i++) {
        $col = ceil($i / 5);
        $num = ($i - 1) % 5 + 1;
    ?>
        <div class="seat">
            <div style="font-size:12px"><?= $col ?>排<?= $num ?>號</div>
            <div><img src="./icon/03D0<?= (isset($seats) && in_array($i, $seats)) ? 3 : 2 ?>.png" alt="">
                <?php
                if (isset($seats) && in_array($i, $seats)) {
                    echo "X";
                } else {
                ?>
                    <input type="checkbox" name="chk[]" class="chk" value="<?= $i ?>">
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<div class="ct">
    <button onclick="goback()">上一步</button><button onclick="checkout()">購買</button>
</div>
<div id="info">
    <div>您選擇的電影是: <?= $_POST['movie'] ?></div>
    <div>您選擇的時刻是: <?= $_POST['date'] ?> <?= $_POST['session'] ?></div>
    <div>您已勾選<span id="qt">0</span>張票，最多可購買四張票</div>
</div>
<script>
    let ticket = 0;
    let lin = new Array();
    $('input[type="checkbox"]').on('change', function() {
        if ($(this).prop("checked")) {
            if (ticket + 1 <= 4) {
                lin.push($(this).val());
                ticket++;
            } else {
                $(this).prop("checked", false)
                alert("已超過每人可購買的數量(4張)")
            }
        } else {
            lin.splice(lin.indexOf($(this).val()), 1);
            ticket--
        }
        $('#qt').text(ticket)
    })

    function goback() {
        $('input[type="checkbox"]').prop("check", false);
        $('#booking').hide();
        $('#order').show();
    }

    function checkout() {
        let data = {
            name: "<?= $_POST['movie'] ?>",
            date: "<?= $_POST['date'] ?>",
            session: "<?= $_POST['session'] ?>",
            seat: lin,
            qt: $('#qt').text()

        }
        $.post('./api/checkout.php', data, (res) => {
            location.href = `?do=checkout&no=${res}`;
        })
    }
</script>