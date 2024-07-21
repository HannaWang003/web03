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
    }

    input[type='submit'],
    input[type='reset'] {
        padding: 10px 20px;
        font-size: 18px;
    }

    #movie table {
        padding: 10px;
    }

    #movie>div:nth-child(odd) {
        width: 15%;
        box-sizing: border-box;
        padding: 10px;
        text-align-last: justify;
    }

    #movie>div:nth-child(even) {
        width: 85%;
        box-sizing: border-box;
        padding: 10px;
    }

    #movie th {
        text-align-last: justify;
    }

    #movie td {
        padding: 5px;
    }

    #movie td>input {
        width: 80%;
    }
</style>
<div style="height: 450px;overflow: auto;">
    <h1 class="ct wx">新增電影</h1>
    <form action="./api/save_movie.php" method="post" enctype="multipart/form-data">
        <div id="movie">
            <div>影片資訊</div>
            <div>
                <table style="width:100%;" class="rb">
                    <tr>
                        <th>片名</th>
                        <td>：<input type="text" name="name" id="name" value="<?= $row['name'] ?>"></td>
                    </tr>
                    <tr>
                        <th>分級</th>
                        <td>
                            ：<select name="level" id="level">
                                <option value="1" value="<?= ($row['level'] == 1) ? "selected" : "" ?>">普遍級</option>
                                <option value="2" value="<?= ($row['level'] == 2) ? "selected" : "" ?>">保護級</option>
                                <option value="3" value="<?= ($row['level'] == 3) ? "selected" : "" ?>">輔導級</option>
                                <option value="4" value="<?= ($row['level'] == 4) ? "selected" : "" ?>">限制級</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>片長</th>
                        <td>：<input type="text" name="length" id="length" value="<?= $row['length'] ?>"></td>
                    </tr>
                    <tr>
                        <th>上映日期</th>
                        <td>：
                            <select name="year" id="">
                                <option value="2024" <?= ($year == 2024) ? "selected" : "" ?>>2024</option>
                                <option value="2025" <?= ($year == 2025) ? "selected" : "" ?>>2025</option>
                            </select>年
                            <select name="month" id="">
                                <?php
                                for ($i = 1; $i <= 12; $i++) {
                                ?>
                                    <option value="<?= $i ?>" <?= ($month == $i) ? "selected" : "" ?>><?= $i ?></option>
                                <?php
                                }
                                ?>
                            </select>月
                            <select name="day" id="">
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
                        <th>發行商</th>
                        <td>
                            ：<input type="text" name="publish" id="publish" value="<?= $row['publish'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>導演</th>
                        <td>：<input type="text" name="director" id="director" value="<?= $row['director'] ?>"></td>
                    </tr>
                    <tr>
                        <th>預告影片</th>
                        <td>
                            ：<input type="file" name="trailer" id="trailer">
                        </td>
                    </tr>
                    <tr>
                        <th>電影海報</th>
                        <td>：<input type="file" name="poster" id="poster"></td>
                    </tr>
                </table>
            </div>
            <div>劇情簡介</div>
            <div><textarea name="intro" id="intro" style="width:98%;height:200px;"><?= $row['intro'] ?></textarea></div>
        </div>
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <div class="ct"><input type="submit" value="修改"> <input type="reset" value="重置"></div>
</div>
</form>