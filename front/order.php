<?php
$id = $_GET['id'] ?? 0;
?>
<style>
#order {
    width: 50%;
    margin: auto;
}

#order,
#booking {
    table tr td {
        border: 1px solid #999;
    }

    td {
        padding: 10px;
    }

    button {
        padding: 10px 20px;
        font-size: 16px;
    }
}

#movie,
#date,
#session {
    width: 95%;
}
</style>
<div id="order">
    <table style="width:100%;">
        <tr>
            <th class="rb">電影：</th>
            <td>
                <select name="movie" id="movie"></select>
            </td>
        </tr>
        <tr>
            <th class="rb">日期：</th>
            <td>
                <select name="date" id="date"></select>
            </td>
        </tr>
        <tr>
            <th class="rb">場次：</th>
            <td>
                <select name="session" id="session"></select>
            </td>
        </tr>
    </table>
    <div style="box-sizing:border-box;padding:10px;" class="rb ct">
        <button onclick="toggle()">確定</button> <button onclick="clean()">重置</button>
    </div>
</div>
<div id="booking" style="display:none">

</div>
<script>
getMovie(<?= $id ?>);

function getMovie(id) {
    $.get('./api/get_movie.php', {
        id
    }, (res) => {
        $('#movie').html(res);
        getDate($('#movie').val())
    })
}

function getDate(movie) {
    $.get('./api/get_date.php', {
        movie
    }, (res) => {
        $('#date').html(res);
        getSess($('#movie').val(), $('#date').val())
    })
}

function getSess(movie, date) {
    $.get('./api/get_sess.php', {
        movie,
        date
    }, (res) => {
        $('#session').html(res)
    })
}
$('#movie').on('change', () => {
    getDate($('#movie').val());
})
$('#date').on('change', () => {
    getSess($('#movie').val(), $('#date').val());
})

function clean() {
    location.reload();
}

function toggle() {
    if ($('#session').val() == "") {
        alert('本日已無可供訂購場次，請選擇其他日期');
    } else {
        let data = {
            movie: $('#movie').val(),
            date: $('#date').val(),
            session: $('#session').val()
        }
        $.post('./api/booking.php', data, (res) => {
            $('#booking').html(res);
        })
        $('#order,#booking').toggle();
    }
}
</script>