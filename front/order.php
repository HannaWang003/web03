<h3 class="wx ct">線上訂票</h3>
<table id="order" width="60%" style="margin:auto;border:1px solid #333;padding:10px;">
    <tr>
        <th class="rb" width="30%">電影 : </th>
        <td><select name="movie" id="movie" style="width:90%;"></select></td>
    </tr>
    <tr>
        <th class="rb">日期 : </th>
        <td><select name="date" id="date" style="width:90%;"></select></td>
    </tr>
    <tr>
        <th class="rb">場次 : </th>
        <td><select name="session" id="session" style="width:90%;"></select></td>
    </tr>
    <tr>
        <th colspan="2" class="ct rb" style="padding:5px;"><button onclick="booking()">確定</button> <button
                onclick="location.reload();">重置</button></th>
    </tr>
</table>
<div id="booking"></div>
<script>
getMovie(<?= ($_GET['id']) ?? 0 ?>);
$('#movie').on('change', function() {
    let name = $(this).val();
    getDate(name);
})
$('#date').on('change', function() {
    let movie = $('#movie').val();
    let date = $(this).val();
    getSession(movie, date)
})

function getMovie(id) {
    $.post('./api/get_movie.php?do=movie', {
        id
    }, (res) => {
        $('#movie').html(res);
        let name = $('#movie').val();
        getDate(name);
    })
}

function getDate(name) {
    $.post('./api/get_date.php?do=movie', {
        name
    }, (res) => {
        $('#date').html(res)
        let name = $('#movie').val();
        let date = $('#date').val();
        getSession(name, date);
    })
}

function getSession(movie, date) {
    $.post('./api/get_session.php?do=movie', {
        movie,
        date
    }, (res) => {
        $('#session').html(res);
    })
}

function booking() {
    let data = {
        movie: $('#movie').val(),
        date: $('#date').val(),
        session: $('#session').val()
    }
    if (data.session != 0) {
        $.post('./api/booking.php?do=movie', data, (res) => {
            $('#booking').html(res)
        })
        $('#order').hide();
        $('#booking').show();
    } else {
        alert("請重新選擇可訂購場次")
    }
}
</script>