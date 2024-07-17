<style>
#order table {
    width: 60%;
    margin: auto;
    border: 1px solid #000;
    padding: 10px;
}

#order td:nth-child(odd) {
    background: #eee;
}

#order td {
    padding: 10px;
    text-align: center;
}

#booking {
    display: none;
}
</style>
<div id="order">
    <table>
        <tr>
            <td colspan="2">
                <h3>線上訂票</h3>
            </td>
        </tr>
        <tr>
            <td style="width:40%;">電影 : </td>
            <td style="width:60%;">
                <select name="movie" id="movie" style="width:80%;"></select>
            </td>
        </tr>
        <tr>
            <td style="width:40%;">日期 : </td>
            <td style="width:60%;">
                <select name="date" id="date" style="width:80%"></select>
            </td>
        </tr>
        <tr>
            <td style="width:40%;">場次 : </td>
            <td style="width:60%;">
                <select name="session" id="session" style="width:80%"></select>
            </td>
        </tr>
        <tr>
            <td colspan="2"><button onclick="booking()">確認</button> <input type="reset" value="重置"></td>
        </tr>
    </table>
</div>
<div id="booking"></div>
<script>
let id = "<?= $_GET['id'] ?? 0 ?>";
getMovie(id);

function booking() {
    let data = {
        movie: $('#movie').val(),
        date: $('#date').val(),
        session: $('#session').val()
    }
    $.get('./api/booking.php', data, (res) => {
        $('#booking').html(res)
    })
    $('#order,#booking').toggle()
}

function getMovie(id) {
    $.get('./api/get_movie.php', {
        id
    }, (res) => {
        $('#movie').html(res);
        getDate($('#movie').val());
    })
}

function getDate(movie) {
    $.get('./api/get_date.php', {
        movie
    }, (res) => {
        $('#date').html(res)
        getSess($('#movie').val(), $('#date').val())
    })
}

function getSess(movie, date) {
    $.get('./api/get_sess.php', {
        movie,
        date
    }, (res) => {
        $('#session').html(res);
    })
}

$('#movie').on('change', () => {
    getDate($('#movie').val());
})
$('#date').on('change', () => {
    getSess($('#movie').val(), $('#date').val())
})
</script>