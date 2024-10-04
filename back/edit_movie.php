<?php
$row = $Movie->find($_GET['id']);
$ondate = explode("-", $row['ondate']);
?>
<form action="./api/edit_movie.php?do=movie" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <h2 class="ct wx">編輯院線片</h2>
    <div style="display:flex;flex-wrap:wrap;">
        <div style="width:20%">影片資料</div>
        <div style="width:80%">
            <table width="100%">
                <tr>
                    <td style="text-align-last:justify">片名</td>
                    <td><input type="text" name="name" value="<?= $row['name'] ?>" style="width:75%;"></td>
                </tr>
                <tr>
                    <td style="text-align-last:justify">分級</td>
                    <td>
                        <select name="level" id="">
                            <option value="1" <?= ($row['level'] == 1) ? "selected" : "" ?>>普遍級</option>
                            <option value="2" <?= ($row['level'] == 2) ? "selected" : "" ?>>保護級</option>
                            <option value="3" <?= ($row['level'] == 3) ? "selected" : "" ?>>輔導級</option>
                            <option value="4" <?= ($row['level'] == 4) ? "selected" : "" ?>>限制級</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="text-align-last:justify">片長</td>
                    <td><input type="text" name="length" id="" style="width:75%;" value="<?= $row['length'] ?>"></td>
                </tr>
                <tr>
                    <td style="text-align-last:justify">上映日期</td>
                    <td>
                        <select name="year" id="">
                            <option value="2024" <?= ($ondate[0] == 2024) ? "selected" : "" ?>>2024</option>
                            <option value="2025" <?= ($ondate[0] == 2025) ? "selected" : "" ?>>2025</option>
                        </select><select name="month" id="">
                            <option value="0">月份</option>
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                            ?>
                                <option value="<?= $i ?>" <?= ($ondate[1] == $i) ? "selected" : "" ?>><?= $i ?></option>
                            <?php
                            }
                            ?>
                        </select><select name="day" id="">
                            <option value="0">日期</option>
                            <?php
                            for ($i = 1; $i <= 31; $i++) {
                            ?>
                                <option value="<?= $i ?>" <?= ($ondate[2] == $i) ? "selected" : "" ?>><?= $i ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="text-align-last:justify">發行商</td>
                    <td><input type="text" name="publish" id="" style="width:75%;" value="<?= $row['publish'] ?>"></td>
                </tr>
                <tr>
                    <td style="text-align-last:justify">導演</td>
                    <td><input type="text" name="director" id="" style="width:75%;" value="<?= $row['director'] ?>"></td>
                </tr>
                <tr>
                    <td style="text-align-last:justify">預告片影片</td>
                    <td><input type="file" name="trailer" id="" style="width:75%;"></td>
                </tr>
                <tr>
                    <td style="text-align-last:justify">電影海報</td>
                    <td><input type="file" name="poster" id="" style="width:75%;"></td>
                </tr>
            </table>
        </div>
        <div style="width:20%">劇情簡介</div>
        <div style="width:80%"><textarea name="intro" style="width:80%;height:200px;"><?= $row['intro'] ?></textarea>
        </div>
    </div>
    <br>
    <div class="ct"><input type="submit" value="編輯"> <input type="reset" value="重置"></div>
</form>