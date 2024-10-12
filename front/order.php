<style>
#order {
    border: 1px solid #999;
    margin: auto;
    width: 50%;
    padding: 20px 40px;
    box-shadow: 0 0 10px #666;

    table {
        /* border: 1px solid #666; */
        box-shadow: 0px 0px 10px #aaa;
    }
}
</style>
<h3 class="ct wx">線上訂票</h3>
<div id="order">
    <table width="100%" style="margin:auto;padding:5px 10px;">
        <tr>
            <td width="30%" class="rb">電影</td>
            <td width="70%"><select name="" id="movie" style="width:90%;"></select></td>
        </tr>
        <tr>
            <td width="30%" class="rb">日期</td>
            <td width="70%"><select name="" id="date" style="width:90%;"></select></td>
        </tr>
        <tr>
            <td width="30%" class="rb">場次</td>
            <td width="70%"><select name="" id="session" style="width:90%;"></select></td>
        </tr>
        <tr class="rb">
            <td colspan="2" class="ct"><input type="button" value="確定" onclick="bo()"><input type="button" value="重置"
                    onclick="clean()"></td>
        </tr>
    </table>
</div>
<div id="booking" style="display:none;"></div>
<script>
getMovie(<?= ($_GET['id']) ?? 0 ?>)

function bo() {
    if ($('#session').val() == "本日已無可訂購場次") {
        alert("請重新選擇日期")
    } else {
        $('#order,#booking').toggle();
        let data = {
            movie: $('#movie').val(),
            date: $('#date').val(),
            session: $('#session').val()
        }
        $.post('./api/booking.php?do=movie', data, (res) => {
            $('#booking').html(res)
        })
    }
}

function getMovie(id) {
    $.post('./api/get_movie.php?do=movie', {
        id
    }, (res) => {
        $('#movie').html(res)
        let name = $('#movie').val();
        getDate(name)
    })
}

function getDate(name) {
    $.post('./api/get_date.php?do=movie', {
        name
    }, (res) => {
        $('#date').html(res);
        let movie = $('#movie').val();
        let date = $('#date').val();
        getSess(movie, date);
    })
}

function getSess(movie, date) {
    $.post('./api/get_sess.php', {
        movie,
        date
    }, (res) => {
        $('#session').html(res)
    })
}
$('#movie').on('change', function() {
    let name = $(this).val();
    getDate(name);
})
$('#date').on('change', function() {
    let date = $(this).val();
    let movie = $('#movie').val();
    getSess(movie, date);
})
</script>