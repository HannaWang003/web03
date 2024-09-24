<style>
    #addMovie {
        width: 80%;
        box-sizing: border-box;
        margin: auto;
        display: flex;
        flex-wrap: wrap;

        >div:nth-child(odd) {
            width: 15%;
        }

        >div:nth-child(even) {
            width: 85%;
        }

        table {
            th {
                width: 30%;
                text-align-last: justify;
            }

            td {
                width: 70%;

                input {
                    width: 80%;
                }
            }
        }
    }
</style>
<form action="./api/add_movie.php?do=movie" method="post" enctype="multipart/form-data">
    <div id="addMovie">
        <div>影片資訊</div>
        <div>
            <table class="rb" width="100%" style="padding:10px 5px;box-sizing:border-box;">
                <tr>
                    <th width="30%">片名</th>
                    <td width="70%">: <input type="text" name="movie" id=""></td>
                </tr>
                <tr>
                    <th>分級</th>
                    <td>: <select name="level" id="">
                            <?php
                            for ($i = 1; $i <= 4; $i++) {
                            ?>
                                <option value="<?= $i ?>"><?= $level[$i] ?></option>
                            <?php
                            }
                            ?>
                        </select>(普遍級、保護級、輔導級、限制級)</td>
                </tr>
                <tr>
                    <th>片長</th>
                    <td>: <input type="text" name="length" id=""></td>
                </tr>
                <tr>
                    <th>上映日期</th>
                    <td>:
                        <select name="year" id="">
                            <?php
                            for ($i = 2024; $i <= 2025; $i++) {
                            ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php
                            }
                            ?>
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
                    <th>發行商</th>
                    <td>: <input type="text" name="publish" id=""></td>
                </tr>
                <tr>
                    <th>導演</th>
                    <td>: <input type="text" name="director" id=""></td>
                </tr>
                <tr>
                    <th>預告影片</th>
                    <td>: <input type="file" name="trailer" id=""></td>
                </tr>
                <tr>
                    <th>電影海報</th>
                    <td>: <input type="file" name="poster" id=""></td>
                </tr>
            </table>
        </div>
        <div>劇情簡介</div>
        <div>
            <textarea name="intro" id="" style="width:98%;height:100px;margin:10px auto;"></textarea>
        </div>
        <div style="width:100%;" class="ct"><input type="submit" value="新增"> <input type="reset" value="重置"></div>
    </div>
</form>