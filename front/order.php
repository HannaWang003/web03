<?php
if (isset($_GET['id'])) {
    $se = $_GET['id'];
} else {
    $se = 0;
}
?>
<form action="" id="order">
    <table style="width:60%;margin:auto;border:1px solid #000">
        <tr>
            <th class="rb">電影:</th>
            <td width="80%">
                <select name="movie" id="movie" style="width:100%"></select>
            </td>
        </tr>
        <tr>
            <th class="rb">日期:</th>
            <td>
                <select name="date" id="date" style="width:100%"></select>
            </td>
        </tr>
        <tr>
            <th class="rb">場次:</th>
            <td>
                <select name="session" id="session" style="width:100%"></select>
            </td>
        </tr>
        <tr class="rb">
            <td colspan="2" style="text-align:center">
                <input type="button" value="確定" class="booking"><input type="reset" value="重置">
            </td>
        </tr>
    </table>
</form>
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

    .chk {
        position: absolute;
        bottom: 2px;
        right: 2px;
    }
}
</style>
<div id="booking" style="display:none;">
    <div id="seats">
        <?php
        for ($i = 1; $i <= 20; $i++) {
            $col = ceil($i / 5);
            $num = ($i - 1) % 5 + 1;
        ?>
        <div class="seat">
            <div><?= $col . "排" . $num . "號" ?></div>
            <div><img src="./icon/03D02.png" alt=""></div>
            <div><input type="checkbox" class="chk" value="<?= $i ?>"></div>
        </div>
        <?php
        }
        ?>
    </div>
    <div class="rb" style="width:80%;margin:auto;padding:10px;">
        <div style="width:50%;margin:auto">
            <div>您選擇的電影是: <span id="seMovie"></span></div>
            <div>您選擇的時刻是: <span id="seDate"></span></div>
            <div>您已經勾選<span id="ticket">0</span>張票，最多可以購買四張票</div>
        </div>
    </div>
    <div class="ct">
        <input type="button" value="上一步" class="booking"><input type="button" value="訂購" id="checkout">
    </div>
    </form>
</div>
<script>
$('.booking').on('click', function() {
    if ($('#session').val() == 0) {
        $('#order').show();
        $('#booking').hide();
    } else {
        $('#order').toggle();
        $('#booking').toggle();
        $('#seMovie').text($('#movie').val());
        $('#seDate').text($('#date').val() + " " + $('#session').val())

    }
})
getMovie(<?= $se ?>)

function getMovie(movie) {
    $.get('./api/getMovie.php', {
        movie
    }, (res) => {
        $('#movie').html(res)
        getDate($('#movie').val())
    })
}

function getDate(movie) {
    $.get('./api/getDate.php', {
        movie
    }, (res) => {
        $('#date').html(res)
        getSess($('#movie').val(), $('#date').val())
    })
}

function getSess(movie, date) {
    $.get('./api/getSess.php', {
        movie,
        date
    }, (res) => {
        $('#session').html(res)
    })
}
$('#movie').on('change', function() {
    getDate($(this).val())
})
$('#date').on('change', function() {
    getSess($('#movie').val(), $(this).val())
})
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
    console.log(seat)
})
</script>