<style>
    table,
    tr,
    th,
    td {
        border-collapse: collapse;
    }

    table {
        background: #333;
    }

    .sc {
        border: 3px solid #0f08;
    }
</style>
<h3 class="wx ct">訂單清單</h3>
<table width="98%;" style="table-layout:fixed;margin:auto;">
    <form action="./api/fast_del.php?do=order" method="post">
        <tr>
            <td>快速刪除 : </td>
            <td colspan="2"><input type="radio" name="type" value="date" checked>依日期<input type="date" name="date" id=""></td>
            <td colspan="2"><input type="radio" name="type" value="name">依電影
                <select name="name" id="">
                    <?php
                    $ms = $DB->all("group by `name`");
                    foreach ($ms as $m) {
                    ?>
                        <option value="<?= $m['name'] ?>"><?= $m['name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </td>
            <td colspan="2"><input type="submit" value="刪除"></td>
        </tr>
    </form>
    <tr>
        <th class="rb">訂單編號</th>
        <th class="rb">電影名稱</th>
        <th class="rb">日期</th>
        <th class="rb">場次時間</th>
        <th class="rb">訂購數量</th>
        <th class="rb">訂購位置</th>
        <th class="rb">操作</th>
    </tr>
</table>
<div style="height:300px;overflow-y:auto;">
    <table width="98%;" style="table-layout:fixed;margin:auto">
        <?php
        $rows = $DB->all();
        foreach ($rows as $row) {
        ?>
            <tr class="c w ord">
                <th><?= $row['no'] ?></th>
                <th><?= $row['name'] ?></th>
                <th><?= $row['date'] ?></th>
                <th><?= $row['session'] ?></th>
                <th><?= $row['qt'] ?></th>
                <th>
                    <?php
                    $seats = unserialize($row['seats']);
                    foreach ($seats as $i) {
                        $col = ceil($i / 5);
                        $num = ($i - 1) % 5 + 1;
                        echo "<div>" . $col . "排" . $num . "號" . "</div>";
                    }
                    ?>
                </th>
                <th><button onclick="del(<?= $row['id'] ?>)">刪除</button></th>
            </tr>
        <?php
        }
        ?>
    </table>
</div>
<script>
    $('.ord').hover(function() {
        $(this).addClass('sc');
    }, () => {
        $('.ord').removeClass('sc');
    })

    function del(id) {
        $.post('./api/del.php?do=<?= $do ?>', {
            id
        }, () => {
            $(dom).parents('tr').remove();
        })
    }
</script>