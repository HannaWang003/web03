<button onclick="location.href='?do=addMovie'">新增電影</button>
<div style="height:400px;overflow:auto;">
    <table style="width:95%;margin:auto;">
        <style>
        table {
            border-collapse: collapse;
        }

        tr {
            border-bottom: 1px solid #333;

        }

        td {
            padding: 10px;
        }
        </style>
        <?php
            $rows = $Movie->all("order by rank");
            $total = $Movie->count();
            if (!empty($rows)) {
                foreach ($rows as $idx => $row) {
            ?>
        <tr style="background:#999;">
            <td><img src="./img/<?= $row['poster'] ?>" style="width:100px"></td>
            <td>分級: <img src="./icon/03C0<?= $row['level'] ?>.png" style="width:25px;">
            </td>
            <td>
                <div style="display:flex;justify-content:space-between">
                    <div>片名: <?= $row['name'] ?></div>
                    <div>片長: <?= $row['length'] ?></div>
                    <div>上映日期:<?= $row['ondate'] ?></div>
                </div>
                <div style="text-align:end;">
                    <input type="button" class="sw" data-id="<?= $row['id'] ?>"
                        data-sw="<?= ($idx > 0) ? $rows[$idx - 1]['id'] : $row['id'] ?>" value="往上">
                    <input type="button" class="sw" data-id="<?= $row['id'] ?>"
                        data-sw="<?= ($idx < $total - 1) ? $rows[$idx + 1]['id'] : $row['id']   ?>" value="往下">
                    <input type="button" class="sh" value=" <?= ($row['sh'] == 1) ? "隱藏" : "顯示" ?>"
                        data-id="<?= $row['id'] ?>" data-sh="<?= $row['sh'] ?>">
                    <input type="button" value="編輯電影" onclick="location.href='?do=editMovie&id=<?= $row['id'] ?>'">
                    <input type="button" value="刪除電影" onclick="del('movie',<?= $row['id'] ?>)">
                </div>
                <div>
                    <?= $row['intro'] ?>
                </div>

            </td>
            <td style="text-align:center">

            </td>
        </tr>
        <input type="hidden" name="id[]" value="<?= $row['id'] ?>">
        <?php
                }
            }
            ?>
    </table>
</div>
<script>
$('.sw').on('click', function() {
    let id = $(this).data('id');
    let sw = $(this).data('sw');
    $.get('./api/sw.php', {
        id,
        sw,
        table: "movie"
    }, (res) => {
        location.reload();
    })
})
$('.sh').on('click', function() {
    let id = $(this).data('id');
    let sh = $(this).data('sh');
    $.get('./api/sh.php', {
        id,
        sh,
        table: "movie"
    }, (res) => {
        location.reload();
    })
})

function del(table, id) {
    $.get('./api/del.php', {
        table,
        id
    }, () => {
        location.reload();
    })
}
</script>