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
<form action="./api/new_movie.php?do=movie" method="post" enctype="multipart/form-data">
    <div style="display:flex;flex-wrap:wrap;width:80%;margin:auto;">
        <div style="width:20%;">影片資訊</div>
        <div style="width:80%;" class="rb">
            <table id="newMovie">
                <tr>
                    <td width="20%">片名</td>
                    <td width="80%">: <input type="text" name="name" id=""></td>
                </tr>
                <tr>
                    <td>分級</td>
                    <td>:
                        <select name="level" id="">
                            <?php
                            for ($i = 1; $i <= 4; $i++) {
                            ?>
                            <option value="<?= $i ?>"><?= $level[$i] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>片長</td>
                    <td>:
                        <input type="text" name="length" id="">
                    </td>
                </tr>
                <tr>
                    <td>上映日期</td>
                    <td>:
                        <select name="year" id="">
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>年<select name="month" id="">
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                            ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                            <?php
                            }
                            ?>
                        </select>月<select name="day" id="">
                            <?php
                            for ($i = 1; $i <= 31; $i++) {
                            ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                            <?php
                            }
                            ?>
                        </select>日
                    </td>
                </tr>
                <tr>
                    <td>發行商</td>
                    <td>: <input type="text" name="publish" id=""></td>
                </tr>
                <tr>
                    <td>導演</td>
                    <td>: <input type="text" name="director" id=""></td>
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
            <textarea name="intro" style="width:100%;height:150px;margin-bottom:10px;"></textarea>
            <div class="ct"><input type="submit" value="新增"> | <input type="reset" value="重置"></div>
        </div>
    </div>
</form>