            <style>
#addmovie {
    display: flex;
    flex-wrap: wrap;
    background: #aaa;
    padding: 10px;

    >div:nth-child(odd) {
        width: 20%;
    }

    >div:nth-child(even) {
        width: 80%;
    }

    table {
        background: #333;

        td {
            padding: 5px 10px;
        }

        input {
            width: 90%;
        }
    }
}
            </style>
            <div class="ct wx">新增院線片</div>
            <form action="./api/add_movie.php?do=movie" enctype="multipart/form-data" method="post">
                <div id="addmovie">
                    <div>影片資訊:</div>
                    <div>
                        <table style="width:100%">
                            <tr>
                                <td style="text-align-last:justify">片名</td>
                                <td><input type="text" name="name" id=""></td>
                            </tr>
                            <tr>
                                <td style="text-align-last:justify">分級</td>
                                <td><select name="level" id="">
                                        <option value="1">普通級</option>
                                        <option value="2">保護級</option>
                                        <option value="3">輔導級</option>
                                        <option value="4">限制級</option>
                                    </select>(普通級、保護級、輔導級、限制級)</td>
                            </tr>
                            <tr>
                                <td style="text-align-last:justify">片長</td>
                                <td><input type="text" name="length" id=""></td>
                            </tr>
                            <tr>
                                <td style="text-align-last:justify">上映日期</td>
                                <td>
                                    <select name="year" id="">
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                    </select>年
                                    <select name="month" id="">
                                        <?php
                                        for ($i = 1; $i <= 12; $i++) {
                                        ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>月
                                    <select name="day" id="">
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
                                <td style="text-align-last:justify">發行商</td>
                                <td><input type="text" name="publish" id=""></td>
                            </tr>
                            <tr>
                                <td style="text-align-last:justify">導演</td>
                                <td><input type="text" name="director" id=""></td>
                            </tr>
                            <tr>
                                <td style="text-align-last:justify">預告影片</td>
                                <td><input type="file" name="trailer" id=""></td>
                            </tr>
                            <tr>
                                <td style="text-align-last:justify">電影海報</td>
                                <td><input type="file" name="poster" id=""></td>
                            </tr>
                        </table>
                    </div>
                    <div>劇情簡介:</div>
                    <div><textarea name="intro" style="width:90%;margin-top:10px;height:150px;"></textarea></div>
                </div>
                <div class="ct"><input type="submit" value="新增"><input type="reset" value="重置"></div>
            </form>