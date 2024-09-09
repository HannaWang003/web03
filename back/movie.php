<style>
td {
    border-bottom: 2px solid #fff;
    padding: 5px 10px;
}

table {
    border-collapse: collapse;
}
</style>
<button onclick="location.href='?do=add_movie'">新增電影</button>
<div style="height:400px;overflow:auto">
    <table style="width:100%">
        <?php
        $rows = $DB->all("order by rank");
        foreach ($rows as $idx => $row) {
        ?>
        <tr style="background:#aaa">
            <td><img src="./img/<?= $row['poster'] ?>" style="width:100px;"></td>
            <td>分級:<img src="./icon/03C0<?= $row['level'] ?>.png" />
            </td>
            <td>
                <div style="display:flex;justify-content:space-between">
                    <span>片名:<?= $row['name'] ?></span><span>片長:<?= $row['length'] ?></span><span>上映日期:<?= $row['ondate'] ?></span>
                </div>
                <div style="text-align:end">
                    <input onclick="sw(this)" type="button" value="往上" data-id="<?= $row['id'] ?>"
                        data-sw="<?= ($idx == 0) ? $row['id'] : $rows[$idx - 1]['id'] ?>">
                    <input onclick="sw(this)" type="button" value="往下" data-id="<?= $row['id'] ?>"
                        data-sw="<?= ($idx == (count($rows) - 1)) ? $row['id'] : $rows[$idx + 1]['id'] ?>">
                    <input type="button" name="sh" onclick="sh(<?= $row['id'] ?>,<?= $row['sh'] ?>)"
                        value="<?= ($row['sh'] == 1) ? "顯示" : "隱藏" ?>">
                    <input type="button" name="del" onclick="del(<?= $row['id'] ?>,<?= $row['sh'] ?>)" value="刪除電影">
                    <input type="button" name="del"
                        onclick="location.href='?do=edit_movie?do=movie&id=<?= $row['id'] ?>'" value="編輯電影">
                </div>
                <div>
                    劇情簡介:<?= $row['intro'] ?>
                </div>
            </td>
            <td>

            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>
<script>
function sw(dom) {
    let id = $(dom).data('id');
    let sw = $(dom).data('sw');
    $.get('./api/sw.php?do=movie', {
        id,
        sw
    }, () => {
        location.reload();
    })
}

function sh(id, sh) {
    $.get('./api/sh.php?do=movie', {
        id,
        sh
    }, () => {
        location.reload();
    })
}

function del(id) {
    $.get('./api/del.php?do=movie', {
        id
    }, () => {
        location.reload();
    })
}
</script>