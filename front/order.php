<?php
$id = $_GET['id'] ?? 0;
?>
<style>
    #order>table {
        width: 60%;
        border: 1px solid #999;
        padding: 20px;
        margin: auto;

        th {
            width: 40%;
            padding: 5px;
            border: 1px solid #000;
            text-align-last: justify;
        }

        td {
            width: 60%;
            padding: 5px;
            border: 1px solid #000;

            select {
                width: 90%;
            }
        }
    }

    #booking {
        display: none;
        overflow: auto;
        height: 500px;
    }
</style>
<div id="order">
    <h2 class="wx ct">線上訂票</h2>
    <table>
        <tr>
            <th class="rb">電影名稱</th>
            <td>：<select name="movie" id="movie"></select></td>
        </tr>
        <tr>
            <th class="rb">日期</th>
            <td>：<select name="date" id="date"></select></td>
        </tr>
        <tr>
            <th class="rb">場次時間</th>
            <td>：<select name="session" id="session"></select></td>
        </tr>
        <tr>
            <td class="rb ct" colspan="2"><button onclick="toggle(this)">確定</button> <button onclick="clean()">重置</button>
            </td>
        </tr>
    </table>
</div>
<div id="booking"></div>
<script>
    get_movie(<?= $id ?>);

    function get_movie(id) {
        $.get('./api/get_movie.php', {
            id
        }, (res) => {
            $('#movie').html(res);
            get_date($('#movie').val())
        })
    }

    function get_date(movie) {
        $.get('./api/get_date.php', {
            movie
        }, (res) => {
            $('#date').html(res)
            get_sess($('#movie').val(), $('#date').val())
        })
    }

    function get_sess(movie, date) {
        $.get('./api/get_sess.php', {
            movie,
            date
        }, (res) => {
            $('#session').html(res)
        })
    }
    $('#movie').on('change', () => {
        get_date($('#movie').val())
    })
    $('#date').on('change', () => {
        get_sess($('#movie').val(), $('#date').val())
    })

    function clean() {
        location.reload();
    }

    function toggle(dom) {
        if ($('#session').val() == 0) {
            alert("請改選其他日期");
        } else {
            $('#order,#booking').toggle();
            if ($(dom).parents('div').attr('id') == "order") {
                let data = {
                    movie: $('#movie').val(),
                    date: $('#date').val(),
                    session: $('#session').val()
                }
                $.post('./api/booking.php', data, (res) => {
                    $('#booking').html(res);
                })
            }
        }
    }
</script>