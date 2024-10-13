<?php
$row = $Movie->find($_GET['id']);
$row['ondate'] = explode("-", $row['ondate']);
?>
<style>
#movie {
    display: flex;
    flex-wrap: wrap;
    width: 90%;
    margin: auto;

    >div {
        margin: 1%;
    }

    >div:nth-child(odd) {
        width: 10%;
    }

    >div:nth-child(even) {
        width: 84%;
        border: 1px solid #333;
        padding: 10px;
        box-sizing: border-box;
    }

    >div:nth-child(4) {
        padding: 10px;
        box-sizing: border-box;
        height: 150px;
        overflow: hidden auto;
    }

    table {
        background: #eee;
        color: #000;
        width: 99%;
        margin: auto;
        padding: 10px;

        td:nth-child(1) {
            width: 25%;
            text-align-last: justify;
        }

        input[type='text'],
        input[type="file"] {
            width: 99%;
        }

    }

    textarea {
        width: 99%;
        height: 150px;
    }
}
</style>
<form action="./api/edit_movie.php?do=movie" method="post" enctype="multipart/form-data">
    <div id="movie">
        <div>影片資訊</div>
        <div>
            <table>
                <tr>
                    <td>片名</td>
                    <td><input type="text" name="name" value="<?= $row['name'] ?>"></td>
                </tr>
                <tr>
                    <td>分級</td>
                    <td>
                        <select name="level" id="level">
                            <?php
                            for ($i = 1; $i <= 4; $i++) {
                                echo "<option value='$i' ({$row['level']}==$i))?'selected':''>$level[$i]</option>";
                            }
                            ?>
                        </select>(普遍級、保護級、輔導級、限制級)
                    </td>
                </tr>
                <tr>
                    <td>片長</td>
                    <td><input type="text" name="length" value="<?= $row['length'] ?>"></td>
                </tr>
                <tr>
                    <td>上映日期</td>
                    <td><select name="year" id="year">
                            <option value="2024" <?= ($row['ondate'][0] == "2024") ? "selected" : "" ?>>2024</option>
                            <option value="2025" <?= ($row['ondate'][0] == "2025") ? "selected" : "" ?>>2025</option>
                        </select>年
                        <select name="month" id="month">
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                            ?>
                            <option value='<?= $i ?>' <?= ($row['ondate'][1] == $i) ? "selected" : "" ?>><?= $i ?>
                            </option>
                            <?php
                            }
                            ?>
                        </select>月
                        <select name="day" id="day">
                            <?php
                            for ($i = 1; $i <= 31; $i++) {
                            ?>
                            <option value='<?= $i ?>' <?= ($row['ondate'][2] == $i) ? "selected" : "" ?>><?= $i ?>
                            </option>
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
                    <td><input type="file" name="trailer" id="trailer"></td>
                </tr>
                <tr>
                    <td>電影海報</td>
                    <td><input type="file" name="poster" id="poster"></td>
                </tr>
            </table>
        </div>
        <div>劇情簡介</div>
        <div><textarea name="intro" id="intro"><?= $row['intro'] ?></textarea></div>
    </div>
    <input type="hidden" name="id" value="<?=$row['id']?>">
    <div class="ct"><input type="submit" value="編輯"><input type="reset" value="重置"></div>
</form>