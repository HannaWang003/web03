<?php
$rows = $DB->all("order by rank");
$num = count($rows) - 1;
?>
<button onclick="location.href='?do=new_movie'">新增電影</button>
<table style="width:80%;margin:auto;">
    <?php
    foreach ($rows as $idx => $row) {
    ?>
        <tr>
            <td style="border-bottom:1px solid #333"><img src="./img/<?= $row['poster'] ?>" style="width:100px;"></td>
            <td style="border-bottom:1px solid #333">分級 : <img src="./icon/03C0<?= $row['level'] ?>.png" style="width:20px">
            </td>
            <td style="border-bottom:1px solid #333">
                <div style="display:flex;justify-content:space-between">
                    <div>片名 : <?= $row['name'] ?></div>
                    <div>片長 : <?= $row['length'] ?></div>
                    <div>上映時間 : <?= $row['ondate'] ?></div>
                </div>
                <div style="text-align:end">
                    <button
                        onclick="sh(this,<?= $row['sh'] ?>,<?= $row['id'] ?>)"><?= ($row['sh'] == 1) ? "顯示" : "隱藏" ?></button>
                    <button class="sw" data-id="<?= $row['id'] ?>"
                        data-sw="<?= ($idx == 0) ? $row['id'] : $rows[$idx - 1]['id'] ?>">往上</button>
                    <button class="sw" data-id="<?= $row['id'] ?>"
                        data-sw="<?= ($idx == $num) ? $row['id'] : $rows[$idx + 1]['id'] ?>">往下</button>
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
    function sh(dom, sh, id) {
        $.post('./api/sh.php?do=movie', {
            id,
            sh
        }, () => {
            if ($(dom).text() == "顯示") {
                $(dom).text("隱藏")
            } else {
                $(dom).text("顯示");
            }
        })
    }
    $('.sw').on('click', function() {
        let id = $(this).data('id');
        let sw = $(this).data('sw');
        $.post('./api/sw.php?do=movie', {
            id,
            sw
        }, () => {
            location.reload();
        })
    })
</script>