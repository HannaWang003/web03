<style>
button {
    padding: 10px 20px;
    font-size: 16px;
}

td {
    border-bottom: 1px solid #eee;
    padding: 15px
}
</style>
<button onclick="location.href='?do=add_movie'">新增電影</button>
<br>
<div style="height:400px;overflow:auto">
    <table style="width:100%;text-align:center;" class="rb">
        <?php
        $movies = $Movie->all("order by rank");
        $total = count($movies);
        foreach ($movies as $idx => $m) {
            if ($m['sh'] == 1) {
                $s = "color:#fff";
                $h = "color:#666";
            } else {
                $s = "color:#666";
                $h = "color:#fff";
            }


        ?>
        <tr>
            <td>
                <img src="./img/<?= $m['poster'] ?>" style="width:100px;">
            </td>
            <td>分級：<img src="./icon/03C0<?= $m['level'] ?>.png" style="width:25px"></td>
            <td>
                <div style="display:flex;justify-content:space-between">
                    <div>片名：<?= $m['name'] ?></div>
                    <div>片長：<?= $m['length'] ?></div>
                    <div>上映日期：<?= $m['ondate'] ?></div>
                </div>
                <div style="text-align:end">
                    <button onclick="sh(<?= $m['id'] ?>,'movie')"><span style="<?= $s ?>">顯示</span>/<span
                            style="<?= $h ?>">隱藏</span></button>
                    <button class='sw' data-id="<?= $m['id'] ?>"
                        data-sw="<?= ($idx == 0) ? $m['id'] : $movies[$idx - 1]['id'] ?>">往上</button>
                    <button class='sw' data-id="<?= $m['id'] ?>"
                        data-sw="<?= ($idx == $total - 1) ? $m['id'] : $movies[$idx + 1]['id'] ?>">往下</button>
                    <button onclick="location.href='?do=edit_movie&id=<?=$m['id']?>'">編輯電影</button> <button
                        onclick="del(this,<?= $m['id'] ?>,'movie')">刪除電影</button>
                </div>
                <div style="text-align:start">
                    劇情介紹：<?= $m['intro'] ?>
                </div>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>
<script>
function sh(id, table) {
    $.post('./api/sh.php', {
        id,
        table
    }, () => {
        location.reload();
    })
}

function del(dom, id, table) {
    $.post('./api/del.php', {
        id,
        table
    }, () => {
        $(dom).parents('tr').remove();
    })

}
$('.sw').on('click', function() {
    let id = $(this).data('id');
    let sw = $(this).data('sw');
    let table = "movie";
    $.post('./api/sw.php', {
        table,
        id,
        sw
    }, () => {
        location.reload();
    })
})
</script>