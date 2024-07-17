<?php
$row = $Movie->find($_GET['id']);
$year = explode("-", $row['ondate'])[0];
$month = explode("-", $row['ondate'])[1];
$day = explode("-", $row['ondate'])[2];
?>
<style>
#movie {
    display: flex;
    flex-wrap: wrap;
    margin: auto;
    width: 80%;
}

#movie>div:nth-child(odd) {
    width: 20%;
}

#movie>div:nth-child(even) {
    width: 70%;
    border: 1px solid #000;
}

#movie table td:nth-child(1) {
    text-align-last: justify;
}

#movie textarea {
    width: 90%;
    height: 100px;
    margin: 20px;
}

#movie div {
    margin: 1px;
}
</style>
<form action="./api/edit_movie.php" method="post" enctype="multipart/form-data">
    <div id="movie">
        <div>影片資料</div>
        <div>
            <table>
                <tr>
                    <td>片名</td>
                    <td>：<input type="text" name="name" value="<?= $row['name'] ?>"></td>
                </tr>
                <tr>
                    <td>分級</td>
                    <td>：<select name="level" id="level">
                            <option value="1" <?= ($row['level'] == 1) ? "selected" : "" ?>>普遍級</option>
                            <option value="2" <?= ($row['level'] == 2) ? "selected" : "" ?>>保護級</option>
                            <option value="3" <?= ($row['level'] == 3) ? "selected" : "" ?>>輔導級</option>
                            <option value="4" <?= ($row['level'] == 4) ? "selected" : "" ?>>限制級</option>
                        </select>
                        (普遍級、保護級、輔導級、限制級)
                    </td>
                </tr>
                <tr>
                    <td>片長</td>
                    <td>：<input type="text" name="length" value="<?= $row['length'] ?>"></td>
                </tr>
                <tr>
                    <td>上映日期</td>
                    <td>：
                        <select name="year" id="year">
                            <option value="2024" <?= ($year == 2024) ? "selected" : "" ?>>2024</option>
                            <option value="2025" <?= ($year == 2025) ? "selected" : "" ?>>2025</option>
                        </select>年
                        <select name="month" id="month">
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                $s = ($month == $i) ? "selected" : "";
                                echo "<option value='$i' $s>$i</option>";
                            }
                            ?>
                        </select>月
                        <select name="day" id="day">
                            <?php
                            for ($i = 1; $i <= 31; $i++) {
                                $s = ($day == $i) ? "selected" : "";
                                echo "<option value='$i' $s>$i</option>";
                            }
                            ?>
                        </select>日
                    </td>
                </tr>
                <tr>
                    <td>發行商</td>
                    <td>：<input type="text" name="publish" value=<?= $row['publish'] ?>></td>
                </tr>
                <tr>
                    <td>導演</td>
                    <td>：<input type="text" name="director" value=<?= $row['director'] ?>></td>
                </tr>
                <tr>
                    <td>預告影片</td>
                    <td>：<input type="file" name="trailer" id="trailer"></td>
                </tr>
                <tr>
                    <td>電影海報</td>
                    <td>：<input type="file" name="poster" id="poster"></td>
                </tr>
            </table>
        </div>
        <div>劇情簡介</div>
        <div><textarea name="intro" id="intro"><?= $row['intro'] ?></textarea></div>
    </div>
    <br>
    <div class="ct">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <input type="submit" value="修改"> <input type="reset" value="重置">
    </div>
</form>