<style>
#seats {
    width: 540px;
    height: 370px;
    background: url('./icon/03D04.png');
    margin: auto;
    box-sizing: border-box;
    padding: 19px 114px 10px 114px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
}

.seat {
    width: 60px;
    height: 83px;
    position: relative;
    /* background: red; */

    .chk {
        position: absolute;
        bottom: 2px;
        right: 2px;
    }
}
</style>
<?php
include_once "db.php";
$seats = $Order->all(['movie' => $_POST['movie'], 'date' => $_POST['date'], 'session' => $_POST['session']]);
$ticket = [];
foreach ($seats as $seat) {
    $tmp = unserialize($seat['seats']);
    $ticket = array_merge($ticket, $tmp);
}
?>
<div id="seats">
    <?php
    for ($i = 1; $i <= 20; $i++) {
        $col = ceil($i / 5);
        $num = ($i - 1) % 5 + 1;
    ?>
    <div class="seat">
        <div><?= $col . "排" . $num . "號" ?></div>
        <div>
            <img src="./icon/03D0<?= (in_array($i, $ticket)) ? "3" : "2" ?>.png" alt="">
        </div>
        <div>
            <?php
                if (!in_array($i, $ticket)) {
                ?>
            <input type="checkbox" class="chk" value="<?= $i ?>">
            <?php
                }
                ?>
        </div>
    </div>
    <?php
    }
    ?>
</div>
<div class="rb" style="width:80%;margin:auto;padding:10px;">
    <div style="width:50%;margin:auto">
        <div>您選擇的電影是: <span><?= $_POST['movie'] ?></span></div>
        <div>您選擇的時刻是: <span><?= $_POST['date'] ?> <?= $_POST['session'] ?></span></div>
        <div>您已經勾選<span id="ticket">0</span>張票，最多可以購買四張票</div>
    </div>
</div>
<div class="ct">
    <input type="button" value="上一步" onclick="booking()"><input type="button" value="訂購" id="checkout">
</div>
<script>
let seat = [];
$('.chk').on('change', function() {
    if ($(this).prop("checked")) {
        if (seat.length < 4) {
            seat.push($(this).val());
        } else {
            $(this).prop("checked", false)
        }

    } else {
        seat.splice(seat.indexOf($(this).val()), 1)
    }
    $('#ticket').text(seat.length);
})
$('#checkout').on('click', () => {
    let data = {
        movie: $('#movie').val(),
        date: $('#date').val(),
        session: $('#session').val(),
        seats: seat,
        qt: seat.length
    }
    $.post('./api/booking.php', data, (res) => {
        location.href = "?do=booking&no=" + res
    })
})
</script>