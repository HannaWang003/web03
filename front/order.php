<?php
$id = $_GET['id'] ?? 0;
?>
<style>
    #order {
        border: 2px solid #000;
        padding: 10px;
    }

    #order td:nth-child(1) {
        width: 10%;
    }

    #order td:nth-child(2) select {
        width: 90%;
    }

    #booking {
        display: none;
    }
</style>
<!-- <form action="?do=booking" method="post"> -->
<form action="">
    <table id="order" style="width:50%;margin:auto;">
        <tr>
            <td>電影:</td>
            <td>
                <select name="movie" id="movie"></select>
            </td>
        </tr>
        <tr>
            <td>日期:</td>
            <td>
                <select name="date" id="date"></select>
            </td>
        </tr>
        <tr>
            <td>場次:</td>
            <td>
                <select name="session" id="session"></select>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center;">
                <!-- <input type="submit" value="確定"> -->
                <input type="button" value="確定" onclick="booking()">
                <input type="reset" value="重置">
            </td>
        </tr>
    </table>
</form>
<div id="booking">

</div>
<script>
    getMovie(<?= $id ?>);

    function getMovie(id) {
        $.get('./api/getMovie.php', {
            id
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
            $('#session').html(res);
        })
    }
    $('#movie').on('change', () => {
        getDate($('#movie').val())
    })
    $("#date").on('change', () => {
        getSess($('#movie').val(), $('#date').val());
    })

    function booking() {
        let data = {
            movie: $('#movie').val(),
            date: $('#date').val(),
            session: $('#session').val(),
        }
        $.post('./api/booking.php', data, (res) => {
            $('#booking').html(res)
        })
        $('#order').hide();
        $('#booking').show();
    }
</script>