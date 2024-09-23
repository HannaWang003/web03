<?php
$row = $Movie->find($_GET['id']);
?>
<style>
    td:nth-child(1) {
        text-align-last: justify;
    }

    #newMovie {
        width: 100%;
        padding: 20px;

        input {
            width: 90%;
        }
    }
</style>
<form action="./api/edit_movie.php?do=movie" method="post" enctype="multipart/form-data">
    <div style="display:flex;flex-wrap:wrap;width:80%;margin:auto;">
        <div style="width:20%;">影片資訊</div>
        <div style="width:80%;" class="rb">
            <table id="newMovie">
                <tr>
                    <td width="20%">片名</td>
                    <td width="80%">: <input type="text" name="name" value="<?= $row['name'] ?>"></td>
                </tr>
                <tr>
                    <td>分級</td>
                    <td>:
                        <select name="level" id="">
                            <?php
                            for ($i = 1; $i <= 4; $i++) {
                            ?>
                                <option value="<?= $i ?>" <?= ($i == $row['level']) ? "selected" : "" ?>><?= $level[$i] ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>片長</td>
                    <td>:
                        <input type="text" name="length" value="<?= $row['length'] ?>">
                    </td>
                </tr>
                <tr>
                    <td>上映日期</td>
                    <?php
                    $ondate = explode("-", $row['ondate']);
                    ?>
                    <td>:
                        <select name="year" id="">
                            <option value="2024" <?= ($ondate[0] == 2024) ? "selected" : "" ?>>2024</option>
                            <option value="2025" <?= ($ondate[0] == 2025) ? "selected" : "" ?>>2025</option>
                        </select>年<select name="month" id="">
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                            ?>
                                <option value="<?= $i ?>" <?= ($ondate[1] == $i) ? "selected" : "" ?>><?= $i ?></option>
                            <?php
                            }
                            ?>
                        </select>月<select name="day" id="">
                            <?php
                            for ($i = 1; $i <= 31; $i++) {
                            ?>
                                <option value="<?= $i ?>" <?= ($ondate[2] == $i) ? "selected" : "" ?>><?= $i ?></option>
                            <?php
                            }
                            ?>
                        </select>日
                    </td>
                </tr>
                <tr>
                    <td>發行商</td>
                    <td>: <input type="text" name="publish" value="<?= $row['publish'] ?>"></td>
                </tr>
                <tr>
                    <td>導演</td>
                    <td>: <input type="text" name="director" value="<?= $row['director'] ?>"></td>
                </tr>
                <tr>
                    <td>預告影片</td>
                    <td>: <input type="file" name="trailer" id=""></td>
                </tr>
                <tr>
                    <td>電影海報</td>
                    <td>: <input type="file" name="poster" id=""></td>
                </tr>
            </table>
        </div>
        <div style="width:20%;">劇情簡介</div>
        <div style="width:80%;padding:20px;box-sizing:border-box;border:1px solid #aaa;">
            <textarea name="intro" style="width:100%;height:150px;margin-bottom:10px;"><?= $row['intro'] ?></textarea>
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <div class="ct"><input type="submit" value="修改"> | <input type="reset" value="重置"></div>
        </div>
    </div>
</form>