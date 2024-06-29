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
<form action="./api/add_movie.php" method="post" enctype="multipart/form-data">
    <div class="movie">
        <div style="width:20%">影片資料</div>
        <div style="width:80%">
            <table>
                <tr>
                    <td>片名</td>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                    <td>分級</td>
                    <td><input type="text" name="level"></td>
                </tr>
                <tr>
                    <td>片長</td>
                    <td><input type="text" name="length"></td>
                </tr>
                <tr>
                    <td>上映日期</td>
                    <td>
                        <select name="year">
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>年
                        <select name="month">
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                            ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                            <?php
                            }
                            ?>
                        </select>月
                        <select name="day">
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
                    <td><input type="text" name="publish" id=""></td>
                </tr>
                <tr>
                    <td>導演</td>
                    <td><input type="text" name="director" id=""></td>
                </tr>
                <tr>
                    <td>預告影片</td>
                    <td><input type="file" name="trailer" id=""></td>
                </tr>
                <tr>
                    <td>電影海報</td>
                    <td><input type="file" name="poster" id=""></td>
                </tr>
            </table>
        </div>
        <div style="width:20%">劇情簡介</div>
        <div style="width:80%"><textarea name="intro" style="width:95%;height:100px;"></textarea></div>
    </div>
    <br>
    <div class="ct"><input type="submit" value="新增"> <input type="reset" value="重置"></div>
</form>