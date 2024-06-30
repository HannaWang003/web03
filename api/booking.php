<?php
include_once "db.php";
?>
<style>
#seats {
    width: 540px;
    height: 370px;
    box-sizing: border-box;
    padding: 19px 112px 0 112px;
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-wrap: wrap;
    margin: auto;
    background: url("../icon/03D04.png")
}

.seat {
    position: relative;
    width: 60px;
    height: 85px;
    /* background: blue; */
}

.chk {
    position: absolute;
    bottom: 2px;
    right: 1px;
}

#tickets {
    color: red;
}
</style>
<?php
$movieName = $Movie->find($_POST['movie'])['name'];
$date = $_POST['date'];
$session = $_POST['session'];
$ords = $Order->all(['movie' => $movieName, 'date' => $date, 'session' => $session]);
$seats = [];
foreach ($ords as $ord) {
    $tmp = unserialize($ord['seats']);
    $seats = array_merge($seats, $tmp);
}
?>
<div class="ct">
    <div id="seats">
        <?php
        for ($i = 1; $i <= 20; $i++) {
            $col = ceil($i / 5);
            $num = ($i - 1) % 5 + 1;
        ?>
        <div class='seat'>
            <div><?= $col . "排" . $num . "號" ?></div>
            <div><img src="../icon/03D0<?= (in_array($i, $seats)) ? "3" : "2" ?>.png" alt=""></div>
            <?php
                if (!in_array($i, $seats)) {
                ?>
            <input type="checkbox" name="chk" value="<?= $i ?>" class="chk">
            <?php
                }
                ?>
        </div>
        <?php
        }
        ?>
    </div>
    <br>
    <div class="ct mytitle">
        <div style="width:50%;margin:auto;text-align:start">
            <div>您選擇的電影是: <?= $movieName ?></div>
            <div>您選擇的場次是: <?= $date . " " . $session ?></div>
            <div>您已勾選<span id="tickets">0</span>張票，最多可購買四張票</div>
        </div>
        <input type="button" value="上一步" onclick="$('#order,#booking').toggle()"> <input id="checkout" type="button"
            value="訂購">
    </div>
</div>
<script>
let seats = new Array();
$('.chk').on("change", function() {
    if ($(this).prop("checked")) {
        if (seats.length + 1 <= 4) {
            seats.push($(this).val());
        } else {
            $(this).prop("checked", false);
            alert("一次最多只能訂購4張票")
        }
    } else {
        seats.splice(seats.indexOf($(this).val(), 1))
    }
    $('#tickets').text(seats.length);
})
$('#checkout').on('click', function() {
    $.post('./api/checkout.php', {
        movie: "<?= $movieName ?>",
        date: "<?= $date ?>",
        session: "<?= $session ?>",
        qt: $('#tickets').text(),
        seats
    }, (no) => {
        location.href = `index.php?do=checkout&no=${no}`;
    })
})
</script>