<style>
#order {
    table {
        width: 60%;
        margin: auto;
        box-sizing: border-box;
        border: 1px solid #eee;
        padding: 20px 10px;

        td:nth-child(1) {
            width: 30%;
        }

        td:nth-child(2) {
            width: 70%;
        }

        select {
            width: 100%;
        }
    }
}

#booking {
    display: none;
}
</style>
<h3 class="wx ct" style="padding:10px">線上訂票</h3>
<div id="order">
    <table>
        <tr>
            <td class="rb">電影</td>
            <td><select name="movie" id="movie"></select></td>
        </tr>
        <tr>
            <td class="rb">日期</td>
            <td><select name="date" id="date"></select></td>
        </tr>
        <tr>
            <td class="rb">場次</td>
            <td><select name="session" id="session"></select></td>
        </tr>
        <tr>
            <td class="ct" colspan="2"><button onclick="booking()">確定</button> <button onclick="clean()">重置</button>
            </td>
        </tr>
    </table>
</div>
<div id="booking">3</div>
<script>
getMovie(<?= ($_GET['id']) ?? 0 ?>);
$('#movie').on('change', function() {
    let movie = $(this).val();
    getDate(movie);
})
$('#date').on('change', function() {
    let movie = $('#movie').val();
    let date = $(this).val();
    getSession(movie, date);
})

function booking() {
    if ($('#session').val() == 0) {
        alert("請重新選擇其他日期場次")
    } else {
        let data = {
            movie: $('#movie').val(),
            date: $('#date').val(),
            session: $('#session').val()
        }
        $.post('./front/booking.php?do=movie', data, (res) => {
            $('#booking').html(res)
            $('#order').hide()
            $('#booking').show();
        })
    }
}

function clean() {
    location.reload()
}

function getMovie(id) {
    $.post('./api/get_movie.php?do=movie', {
        id
    }, (res) => {
        $('#movie').html(res)
        let movie = $('#movie').val();
        getDate(movie);
    })
}

function getDate(movie) {
    $.post('./api/get_date.php?do=movie', {
        movie
    }, (res) => {
        $('#date').html(res)
        let movie = $('#movie').val();
        let date = $('#date').val();
        getSession(movie, date);
    })
}

function getSession(movie, date) {
    $.post('./api/get_session.php?do=order', {
        movie,
        date
    }, (res) => {
        $('#session').html(res);
    })
}
</script>