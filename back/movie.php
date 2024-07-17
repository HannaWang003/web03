<button onclick="location.href='?do=add_movie'" style="margin:10px">新增電影</button>

<style>
.movie {
    display: flex;
    justify-content: space-evenly;
    background: #999;
    border-bottom: 1px solid #fff;
}

.movie>div {
    padding: 5px;
}

.movie>div:nth-child(1) {
    width: 20%;

    img {
        width: 60%;
    }
}

.movie>div:nth-child(2) {
    width: 20%;
}

.movie>div:nth-child(3) {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.movie>div:nth-child(3)>div:nth-child(1) {
    display: flex;
    justify-content: space-between;
}

.movie button>span:nth-child(2) {
    color: #aaa;
}
</style>
<?php
$rows = $Movie->all("order by rank");
$total = $Movie->count();
foreach ($rows as $idx => $row) {
?>

<div class="movie">
    <div><img src="./img/<?= $row['poster'] ?>" alt=""></div>
    <div>分級: <img src="./icon/03C0<?= $row['level'] ?>.png" style="width:25px"></div>
    <div>
        <div>
            <div>片名：<?= $row['name'] ?></div>
            <div>片長：<?= $row['length'] ?></div>
            <div>上映日期：<?= $row['ondate'] ?></div>
        </div>
        <div>
            <button
                onclick="sh(<?= $row['id'] ?>)"><?= ($row['sh'] == 1) ? "<span>顯示</span>/<span>隱藏</span>" : "<span>隱藏</span>/<span>顯示</span>" ?></button>
            <button class="sw" data-id="<?= $row['id'] ?>"
                data-sw="<?= ($idx > 0) ? $rows[$idx - 1]['id'] : $row['id'] ?>">往上</button>
            <button class="sw" data-id="<?= $row['id'] ?>"
                data-sw="<?= ($idx < $total - 1) ? $rows[$idx + 1]['id'] : $row['id'] ?>">往下</button>
            <button onclick="location.href='?do=edit_movie&id=<?= $row['id'] ?>'">編輯電影</button>
            <button onclick="del('movie',<?= $row['id'] ?>)">刪除電影</button>
        </div>
        <div>
            劇情簡介：<?= $row['intro'] ?>
        </div>
    </div>
</div>
<?php
}
?>
<script>
function sh(id) {
    $.get('./api/sh.php', {
        id
    }, () => {
        location.reload();
    })
}
$('.sw').on('click', function() {
    let id = $(this).data('id');
    let sw = $(this).data('sw');
    $.get('./api/sw.php', {
        id,
        sw
    }, () => {
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