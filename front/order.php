<style>
    #ord {
        width: 60%;
        border: 1px solid #aaa;
        margin: auto;
        padding: 10px;
        box-shadow: inset 0 0 10px #aaa;

        select {
            width: 90%;
        }
    }

    #bok {
        display: none;
    }
</style>
<h3 class="wx ct">線上訂票</h3>
<div id="ord">
    <table style="width:90%;margin:auto;table-layout:fixed;">
        <tr class="c w">
            <td class="rb">電影</td>
            <td><select name="name" id="name"></select></td>
        </tr>
        <tr class="c w">
            <td class="rb">日期</td>
            <td><select name="date" id="date"></select></td>
        </tr>
        <tr class="c w">
            <td class="rb">場次</td>
            <td><select name="session" id="session"></select></td>
        </tr>
    </table>
    <div class="ct"><input type="button" value="確定" onclick="chg();"> <input type="button" value="重置" onclick="location.reload()"></div>
</div>
<div id="bok">1</div>
<script>
    getMovie(<?= ($_GET['id']) ?? 0 ?>);

    function getMovie(id) {
        $.post('./api/get_movie.php?do=movie', {
            id
        }, (res) => {
            $('#name').html(res);
            let name = $('#name').val();
            getDate(name);
        })
    }

    function getDate(name) {
        $.post('./api/get_date.php?do=movie', {
            name
        }, (res) => {
            $('#date').html(res)
            let name = $('#name').val();
            let date = $('#date').val();
            getSession(name, date);
        })
    }

    function getSession(name, date) {
        $.post('./api/get_session.php?do=order', {
            name,
            date
        }, (res) => {
            $('#session').html(res);
        })
    }
    $('#name').on('change', function() {
        getDate($(this).val());
    })
    $('#date').on('change', function() {
        let name = $('#name').val()
        getSession(name, $(this).val());
    })

    function chg() {
        if ($('#session').val() == "本日已無可供訂購場次") {
            alert("請選擇其他日期")
        } else {
            $('#ord,#bok').toggle();
            let name = $('#name').val();
            let date = $('#date').val();
            let session = $('#session').val();
            $.post('./api/get_bok.php', {
                name,
                date,
                session
            }, (res) => {
                $('#bok').html(res);
            })
        }
    }
</script>