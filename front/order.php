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
                <input type="button" value="確定" onclick="booking()"><input type="reset" value="重置">
            </td>
        </tr>
    </table>
</form>
<div id="booking" style="display:none;">
</div>
<script>
function booking() {
    if ($('#session').val() == 0) {
        $('#order').show();
        $('#booking').hide();
    } else {
        let movie = $('#movie').val();
        let date = $('#date').val();
        let session = $('#session').val()
        $.post('./api/order.php', {
            movie,
            date,
            session
        }, (res) => {
            $('#booking').html(res)
        })
        $('#order').toggle();
        $('#booking').toggle();

    }
}
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
</script>