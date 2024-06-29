<?php
$rows = $Movie->all("order by rank");
?>
<button onclick="location.href='?do=add_movie'">新增電影</button>
<hr>
<?php
$max = $Movie->count() - 1;
foreach ($rows as $idx => $row) {
?>
    <div style="display:flex;align-items:center;">
        <div style="width:15%"><img src="./img/<?= $row['poster'] ?>" style="width:100%"></div>
        <div style="width:12%;">分級: <img src="./icon/03C0<?= $row['level'] ?>.png" style="width:25px;"></div>
        <div style="width:73%">
            <div style="display:flex;justify-content:space-between;">
                <div>片名: <?= $row['name'] ?></div>
                <div>片長: <?= $row['length'] ?>分</div>
                <div>上映日期: <?= $row['ondate'] ?></div>
            </div>
            <div style="text-align:end;">
                <input class="chg-btn" type="button" value="往上" data-id="<?= $row['id'] ?>" data-sw="<?= ($idx != 0) ? $rows[$idx - 1]['id'] : $row['id'] ?>"> <input class="chg-btn" type="button" value="往下" data-id="<?= $row['id'] ?>" data-sw="<?= ($idx != $max) ? $rows[$idx + 1]['id'] : $row['id'] ?>">
                <input type="button" onclick="location.href='?do=edit_movie&id=<?= $row['id'] ?>'" value="編輯電影"> <input onclick="del(<?= $row['id'] ?>,'movie')" type="button" value="刪除電影">
            </div>
            <div><?= $row['intro'] ?></div>
        </div>
    </div>
    <hr>
<?php
}
?>
<script>
    $('.chg-btn').on('click', function() {
        let id = $(this).data('id');
        let sw = $(this).data('sw');
        let table = "movie";
        $.post('./api/sw.php', {
            id,
            sw,
            table
        }, () => {
            location.reload();
        })
    })

    function del(id, table) {
        $.post('./api/del.php', {
            id,
            table
        }, () => {
            location.reload();
        })
    }
</script>