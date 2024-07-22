<?php
$rows = $Movie->all("order by rank");
$total = count($rows);
?>
<style>
    #row {
        height: 420px;
        overflow: auto;

        td {
            border-bottom: 1px solid #eee;
            box-sizing: border-box;
            padding: 5px 10px;
        }

    }

    #row td:nth-child(1) {
        width: 20%;
    }

    #row td:nth-child(2) {
        width: 15%;

        img {
            width: 25px;
        }
    }

    #row td:nth-child(3) {
        width: 65%;

        button {
            font-size: 16px;
        }
    }
</style>
<button onclick="location.href='?do=add_movie'">新增院線片</button>
<div id="row">
    <table class="ts">
        <?php
        foreach ($rows as $idx => $row) {
            $s = ($row['sh'] == 1) ? "#fff" : "#333";
            $h = ($row['sh'] == 0) ? "#fff" : "#333";
        ?>
            <tr>
                <td><img src="./img/<?= $row['poster'] ?>" style="width:100%"></td>
                <td>分級：<img src="./icon/03C0<?= $row['level'] ?>.png" alt=""></td>
                <td>
                    <div style="display:flex;justify-content:space-between;">
                        <div>片名：<?= $row['name'] ?></div>
                        <div>片長：<?= $row['length'] ?></div>
                        <div>上映時間：<?= $row['ondate'] ?></div>
                    </div>
                    <div style="text-align:end">
                        <button onclick="sh(<?= $row['id'] ?>)"><span style="color:<?= $s ?>">顯示</span> / <span style="color:<?= $h ?>">隱藏</span></button>
                        <button class="sw" data-id=<?= $row['id'] ?> data-sw=<?= ($idx <= 0) ? $row['id'] : $rows[$idx - 1]['id'] ?>>往上</button>
                        <button class="sw" data-id=<?= $row['id'] ?> data-sw=<?= ($idx >= $total - 1) ? $row['id'] : $rows[$idx + 1]['id'] ?>>往下</button>
                        <button onclick="location.href='?do=edit_movie&id=<?= $row['id'] ?>'">編輯電影</button>
                        <button onclick="del(this,<?= $row['id'] ?>,'movie')">刪除電影</button>
                    </div>
                    <div>劇情介紹：<?= $row['intro'] ?></div>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>
<script>
    $('.sw').on('click', function() {
        let id = $(this).data('id');
        let sw = $(this).data('sw');
        $.post('./api/sw.php', {
            id,
            sw,
            table: "movie"
        }, () => {
            location.reload();
        })
    })

    function sh(id) {
        $.post('./api/sh.php', {
            id
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
</script>