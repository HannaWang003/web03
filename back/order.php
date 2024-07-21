<div style="width:95%;margin:auto;">
    <h3 class="ct wx">訂票清單</h3>
    <form action="./api/del_ord.php" method="post">
        <div>
            快速刪除：
            <input type="radio" name="type" value="date" checked>依日期 <input type="text" name="date" id="date">
            <input type="radio" name="type" value="movie">依電影
            <select name="movie" id="movie">
                <?php
                $movie = $Order->all('group by `movie`');
                foreach ($movie as $m) {
                ?>
                    <option value="<?= $m['movie'] ?>"><?= $m['movie'] ?></option>
                <?php
                }
                ?>
            </select>
            <button>刪除</button>
        </div>
    </form>
    <style>
        .ord {
            td {
                border-bottom: 2px solid #999;
                padding: 5px 10px;
            }

            th {
                background: #999;
                padding: 10px;
            }
        }
    </style>
    <div style="height:350px;overflow:auto">
        <table class="ord rb" style="margin:auto;width:100%">
            <tr>
                <th>訂單編號</th>
                <th>電影名稱</th>
                <th>日期</th>
                <th>場次時間</th>
                <th>訂購數量</th>
                <th>訂購位置</th>
                <th>操作</th>
            </tr>
            <?php
            $ords = $Order->all();
            foreach ($ords as $ord) {
                $seat = unserialize($ord['seat']);
            ?>
                <tr>
                    <td><?= $ord['no'] ?></td>
                    <td><?= $ord['movie'] ?></td>
                    <td><?= $ord['date'] ?></td>
                    <td><?= $ord['session'] ?></td>
                    <td><?= $ord['qt'] ?></td>
                    <td>
                        座位：<br>
                        <?php
                        foreach ($seat as $s) {
                            $col = ceil($s / 5);
                            $num = ($s - 1) % 5 + 1;
                        ?>
                            <div><?= $col ?>排<?= $num ?>號</div>
                        <?php
                        }
                        ?>
                    </td>
                    <td><button onclick="del(this,<?= $ord['id'] ?>,'order')">刪除</button></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>
<script>
    function del(dom, id, table) {
        $.post('./api/del.php', {
            id,
            table
        }, () => {
            $(dom).parents('tr').remove();
        })

    }
</script>