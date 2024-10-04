<form action="./api/edit_movie.php?do=movie" method="post" enctype="multipart/form-data">
    <h2 class="ct wx">新增院線片</h2>
    <div style="display:flex;flex-wrap:wrap;">
        <div style="width:20%">影片資料</div>
        <div style="width:80%">
            <table width="100%">
                <tr>
                    <td style="text-align-last:justify">片名</td>
                    <td><input type="text" name="name" id="" style="width:75%;"></td>
                </tr>
                <tr>
                    <td style="text-align-last:justify">分級</td>
                    <td>
                        <select name="level" id="">
                            <option value="0">請選擇分級</option>
                            <option value="1">普遍級</option>
                            <option value="2">保護級</option>
                            <option value="3">輔導級</option>
                            <option value="4">限制級</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="text-align-last:justify">片長</td>
                    <td><input type="text" name="length" id="" style="width:75%;"></td>
                </tr>
                <tr>
                    <td style="text-align-last:justify">上映日期</td>
                    <td>
                        <select name="year" id="">
                            <option value="0">西元年</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select><select name="month" id="">
                            <option value="0">月份</option>
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                            ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php
                            }
                            ?>
                        </select><select name="day" id="">
                            <option value="0">日期</option>
                            <?php
                            for ($i = 1; $i <= 31; $i++) {
                            ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="text-align-last:justify">發行商</td>
                    <td><input type="text" name="publish" id="" style="width:75%;"></td>
                </tr>
                <tr>
                    <td style="text-align-last:justify">導演</td>
                    <td><input type="text" name="director" id="" style="width:75%;"></td>
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
        <div style="width:80%"><textarea name="intro" style="width:80%;height:200px;"></textarea></div>
    </div>
    <br>
    <div class="ct"><input type="submit" value="新增"> <input type="reset" value="重置"></div>
</form>