<?php
$id=($_GET['id'])??0;
?>
<div class="ct mytitle">線上訂票</div>
<br>
<style>
table {
    width: 50%;
    margin: auto;
    /* border: 5px solid #000; */
}

tr,
td {
    border-collapse: collapse;
    border: 1px solid #000;
}

td:nth-child(1) {
    text-align: center;
}
</style>
<div id="order">
    <form>
        <table>
            <tr>
                <td>電影:</td>
                <td>
                    <select name="movie" id="movies"></select>
                </td>
            </tr>
            <tr>
                <td>日期:</td>
                <td>
                    <select name="date" id="dates"></select>
                </td>
            </tr>
            <tr>
                <td>場次:</td>
                <td>
                    <select name="session" id="sessions"></select>
                </td>
            </tr>
            <tr>
                <td class="ct mytitle" colspan="2"><input type="button" value="確定" onclick=booking()> <input
                        type="reset" value="重置"></td>
            </tr>
        </table>
    </form>
</div>
<div id="booking" style="display:none;">
    <!-- api/booking -->
</div>
<script>
getMovies(<?=$id?>);

function getMovies(id) {
    $.post('./api/get_movies.php', {
        id
    }, (movies) => {
        $('#movies').html(movies);
        let movie = $('#movies').val();
        getDates(movie);
    })
}

function getDates(movie) {
    $.post('./api/get_dates.php', {
        movie
    }, (dates) => {
        $('#dates').html(dates);
        let movie = $('#movies').val();
        let date = $('#dates').val();
        getSessions(movie, date);
    })
}

function getSessions(movie, date) {
    $.post('./api/get_sessions.php', {
        movie,
        date
    }, (sessions) => {
        $('#sessions').html(sessions);
    })
}
$('#movies').on("change", function() {
    getDates($(this).val())
})
$('#dates').on('change', function() {
    getSession($("#movies").val, $(this).val())
})

function booking() {
    let movie = $('#movies').val();
    let date = $('#dates').val();
    let session = $('#sessions').val();
    $.post("./api/booking.php", {
        movie,
        date,
        session
    }, (booking) => {
        $("#booking").html(booking)
    })
    $('#order').hide();
    $('#booking').show();
}
</script>