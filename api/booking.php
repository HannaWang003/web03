<?php
include_once "db.php";
$ords = $Order->all(['movie' => $_GET['movie'], 'date' => $_GET['date'], 'session' => $_GET['session']]);
$seats = [];
if (!empty($ords)) {
    foreach ($ords as $ord) {
        $tmp = unserialize($ord['seat']);
        $seats = array_merge($seats, $tmp);
    }
}
?>
<style>
    #room {
        margin: auto;
        width: 540px;
        height: 370px;
        box-sizing: border-box;
        padding: 19px 112px 0 112px;
        display: flex;
        flex-wrap: wrap;
        background: url("./icon/03D04.png");
        background-repeat: no-repeat;
        background-position: center;
    }

    .seat {
        width: 60px;
        height: 83px;
        /* background: #0ff; */
        margin: 1.5px;
        position: relative;
    }

    .seat>div:nth-child(3) {
        position: absolute;
        bottom: 2px;
        right: 2px;
    }

    #info {
        margin: auto;
        width: 540px;
        background: #eee;
        padding: 10px;
        box-sizing: border-box;

        div {
            margin: 5px;
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
            <div style="font-size:12px;"><?= $col . "排" . $num . "號" ?></div>
            <div><img src="./icon/03D0<?= (!empty($seats) && in_array($i, $seats)) ? 3 : 2 ?>.png"></div>
            <div>
                <?php
                if (!empty($seats) && in_array($i, $seats)) {
                ?>
                    X
                <?php
                } else {
                ?>
                    <input type="checkbox" name="chk" class="chk" value="<?= $i ?>">
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<div id="info">
    <div>電影名稱：<?= $_GET['movie'] ?></div>
    <div>選購的日期及場次: <?= $_GET['date'] ?> <?= $_GET['session'] ?></div>
    <div>已選購<span id="ticket">0</span>張票，每人每次最多可購買4張票</div>
    <div class="ct"><button onclick="$('#order,#booking').toggle()">上一步</button> <button onclick="order()">訂購</button>
    </div>
</div>
<script>
    let ticket = new Array();
    $('.chk').on('change', function() {
        if ($(this).prop("checked")) {
            if (ticket.length < 4) {
                ticket.push($(this).val())
            } else {
                alert("超過每人每次可訂購數量(4張)")
                $(this).prop("checked", false);
            }
        } else {
            ticket.splice(ticket.indexOf($(this).val()), 1);
        }
        $('#ticket').text(ticket.length);
        console.log(ticket)
    })

    function order() {
        let od = {
            movie: $('#movie').val(),
            date: $('#date').val(),
            session: $('#session').val(),
            qt: $('#ticket').text(),
            seat: ticket
        }
        $.post('./api/checkout.php', od, (res) => {
            location.href = `?do=checkout&no=${res}`
        })
    }
</script>