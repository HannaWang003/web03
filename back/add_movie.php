<style>
    #movie {
        display: flex;
        flex-wrap: wrap;

        table {
            background: radial-gradient(transparent, #000);
            padding: 10px;
            box-shadow: 0 0 10px #000;
        }

        div {
            margin: 1%;
        }

        div:nth-child(odd) {
            width: 28%;
        }

        div:nth-child(even) {
            width: 68%;
        }

        td:nth-child(1) {
            text-align-last: justify;
        }

        input[type="text"] {
            width: 90%;
        }

        textarea {
            width: 98%;
            height: 150px;
        }
    }
</style>
<form action="./api/edit_movie.php?do=movie" method="post" enctype="multipart/form-data">
    <div id="movie">
        <div>影片資訊</div>
        <div>
            <table width="100%;margin:auto;">
                <tr>
                    <td width="30%">片名</td>
                    <td width="70%">: <input type="text" name="name" id=""></td>
                </tr>
                <tr>
                    <td width="30%">分級</td>
                    <td width="70%">:
                        <select name="level" id="">
                            <option value="0">請選擇分級</option>
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
                    <td width="30%">片長</td>
                    <td width="70%">: <input type="text" name="length" id=""></td>
                </tr>
                <tr>
                    <td width="30%">上映日期</td>
                    <td width="70%">:
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
                    <td width="30%">發行商</td>
                    <td width="70%">: <input type="text" name="publish" id=""></td>
                </tr>
                <tr>
                    <td width="30%">導演</td>
                    <td width="70%">: <input type="text" name="director" id=""></td>
                </tr>
                <tr>
                    <td width="30%">預告影片</td>
                    <td width="70%">: <input type="file" name="trailer" id=""></td>
                </tr>
                <tr>
                    <td width="30%">電影海報</td>
                    <td width="70%">: <input type="file" name="poster" id=""></td>
                </tr>
            </table>
        </div>
        <div>劇情簡介</div>
        <div><textarea name="intro" id=""></textarea></div>
    </div>
    <div class="ct"><input type="submit" value="新增"> <input type="reset" value="重置"></div>
</form>