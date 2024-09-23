<div id="order">
    <h2 class="ct wx">線上訂票</h2>
    <table style="width:60%;margin:auto;border:1px solid #aaa;padding:10px;">
        <tr>
            <th class="rb" width="30%;">電影:</th>
            <td width="70%"><select name="movie" id="movie" style="width:90%"></select></td>
        </tr>
        <tr>
            <th class="rb">日期:</th>
            <td><select name="date" id="date" style="width:90%"></select></td>
        </tr>
        <tr>
            <th class="rb">場次:</th>
            <td><select name="session" id="session" style="width:90%"></select></td>
        </tr>
        <tr>
            <th colspan="2"><button onclick="booking()">確定</button> | <button onclick="reload()">重置</button></th>
        </tr>
    </table>
</div>
<style>
    #booking {
        display: none;
    }
</style>
<div id="booking"></div>
<script>
    getMovie(<?= ($_GET['id']) ?? 0 ?>)
    $('#movie').on('change', function() {
        let movie = $(this).val();
        getDate(movie);
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
            $('#movie').html(res)
            let movie = $('#movie').val();
            getDate(movie);
        })
    }

    function getDate(name) {
        $.post('./api/get_date.php?do=movie', {
            name
        }, (res) => {
            $('#date').html(res);
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
            $('#session').html(res)
        })
    }

    function reload() {
        location.reload();
    }

    function booking() {
        let session = $('#session').val();
        if (session == 0) {
            alert("請重新選取可訂購場次");
        } else {
            let movie = $('#movie').val();
            let date = $('#date').val();
            $.post('./front/booking.php', {
                movie,
                date,
                session
            }, (res) => {
                $('#booking').html(res)
                $('#order').hide();
                $('#booking').show();
            })
        }
    }
</script>