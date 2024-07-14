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
</style>
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
        <td colspan="2" style="text-align:center;"><input type="button" value="確定">
            <input type="button" value="重置">
        </td>
    </tr>
</table>
<script>
getMovie(<?=$id?>);

function getMovie(id) {
    $.get('./api/getMovie.php', {
        id
    }, (res) => {
        $('#movie').html(res)
    })
}
</script>