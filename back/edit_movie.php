<?php
$row = $Movie->find($_GET['id']);
$year = explode("-", $row['ondate'])[0];
$month = explode("-", $row['ondate'])[1];
$day = explode("-", $row['ondate'])[2];
?>
<style>
    .movie {
        display: flex;
        flex-wrap: wrap;
    }

    .movie table td:nth-child(1) {
        text-align-last: justify;
    }

    .td:nth-child(1) {
        width: 35%;
    }

    td:nth-child(2) {
        width: 65%;
    }

    td:nth-child(2)>input {
        width: 100%;
    }
</style>
<h3 class="ct mytitle">新增院線片</h3>
<form action="./api/edit_movie.php" method="post" enctype="multipart/form-data">
    <div class="movie">
        <div style="width:20%">影片資料</div>
        <div style="width:80%">
            <table>
                <tr>
                    <td>片名</td>
                    <td><input type="text" name="name" value="<?= $row['name'] ?>"></td>
                </tr>
                <tr>
                    <td>分級</td>
                    <td><select name="level">
                            <option value="1" <?= ($row['level'] == 1) ? "selected" : "" ?>>普遍級</option>
                            <option value="2" <?= ($row['level'] == 2) ? "selected" : "" ?>>保護級</option>
                            <option value="3" <?= ($row['level'] == 3) ? "selected" : "" ?>>輔導級</option>
                            <option value="4" <?= ($row['level'] == 4) ? "selected" : "" ?>>限制級</option>
                        </select>
                        <span>(普遍級、保護級、輔導級、限制級)</span>
                    </td>
                </tr>
                <tr>
                    <td>片長</td>
                    <td><input type="text" name="length" value="<?= $row['length'] ?>">分</td>
                </tr>
                <tr>
                    <td>上映日期</td>
                    <td>
                        <select name="year">
                            <option value="2024" <?= ($year == 2024) ? "selected" : "" ?>>2024</option>
                            <option value="2025" <?= ($year == 2025) ? "selected" : "" ?>>2025</option>
                        </select>年
                        <select name="month">
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                            ?>
                                <option value="<?= $i ?>" <?= ($month == $i) ? "selected" : "" ?>><?= $i ?></option>
                            <?php
                            }
                            ?>
                        </select>月
                        <select name="day">
                            <?php
                            for ($i = 1; $i <= 31; $i++) {
                            ?>
                                <option value="<?= $i ?>" <?= ($day == $i) ? "selected" : "" ?>><?= $i ?></option>
                            <?php
                            }
                            ?>
                        </select>日
                    </td>
                </tr>
                <tr>
                    <td>發行商</td>
                    <td><input type="text" name="publish" value="<?= $row['publish'] ?>"></td>
                </tr>
                <tr>
                    <td>導演</td>
                    <td><input type="text" name="director" value="<?= $row['director'] ?>"></td>
                </tr>
                <tr>
                    <td>預告影片</td>
                    <td><input type="file" name="trailer"></td>
                </tr>
                <tr>
                    <td>電影海報</td>
                    <td><input type="file" name="poster"></td>
                </tr>
            </table>
        </div>
        <div style="width:20%">劇情簡介</div>
        <div style="width:80%"><textarea name="intro" style="width:95%;height:100px;"><?= $row['intro'] ?></textarea>
        </div>
    </div>
    <br>
    <div class="ct"><input type="submit" value="修改"> <input type="reset" value="重置"></div>
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
</form>