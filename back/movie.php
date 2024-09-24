<?php
$rows = $DB->all("order by rank");
$total = $DB->count();
?>
<button onclick="location.href='?do=add_movie'">新增院線片</button>
<h3 class="ct wx">院線片清單</h3>
<table style="width:100%;margin:auto;background:#aaa;">
    <?php
    foreach ($rows as $idx => $row) {
    ?>
        <tr>
            <td style="padding:10px 5px;border-bottom:1px solid #333"><img src="./img/<?= $row['poster'] ?>"
                    style="width:80px;"></td>
            <td style="padding:10px 5px;border-bottom:1px solid #333">分級 : <img src="./icon/03C0<?= $row['level'] ?>.png"
                    style="width:20px"></td>
            <td style="padding:10px 5px;border-bottom:1px solid #333">
                <div style="display:flex;justify-content:space-between">
                    <div>片名 : <?= $row['movie'] ?></div>
                    <div>片長 : <?= $row['length'] ?></div>
                    <div>上映日期 : <?= $row['ondate'] ?></div>
                </div>
                <div style="text-align:end">
                    <button>顯示/刪除</button>
                    <button
                        onclick="sw(<?= $row['id'] ?>,<?= ($idx == 0) ? $row['id'] : $rows[$idx - 1]['id'] ?>)">往上</button>
                    <button
                        onclick="sw(<?= $row['id'] ?>,<?= ($idx == $total - 1) ? $row['id'] : $rows[$idx + 1]['id'] ?>)">往下</button>
                    <button onclick="location.href='?do=edit_movie&id=<?= $row['id'] ?>'">編輯電影</button>
                    <button onclick="location.href='./api/del_movie.php?do=movie&id=<?= $row['id'] ?>'">刪除電影</button>
                </div>
                <div>劇情介紹 : <?= $row['intro'] ?></div>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
<script>
    function sw(id, sw) {
        $.post('./api/sw.php?do=<?= $table ?>', {
            id,
            sw
        }, () => {
            location.reload();
        })
    }
</script>