<style>
form {
    height: 450px;
    overflow: auto;

}

#row {
    display: flex;
    flex-wrap: wrap;
    width: 95%;
    margin: auto;

    >div {
        box-sizing: border-box;
        padding: 10px;
    }

    div:nth-child(odd) {
        width: 20%;
        text-align: center;
    }

    div:nth-child(even) {
        width: 75%;
        border: 1px solid #999;

    }

    div {
        box-sizing: border-box;
        margin: 2px;
    }

    table {
        background: #999;
        width: 100%;
        box-sizing: border-box;

        input {
            width: 90%;
        }
    }

    th {
        text-align-last: justify;
    }

    textarea {
        width: 80%;
        height: 150px;
    }
}
</style>
<form action="./api/save_movie.php" method="post" enctype="multipart/form-data">
    <div id="row">
        <div>影片資料</div>
        <div>
            <table>
                <tr>
                    <th>片名</th>
                    <td>：<input type="text" name="name" id="name"></td>
                </tr>
                <tr>
                    <th>分級</th>
                    <td>：
                        <select name="level" id="level">
                            <option value="1">普遍級</option>
                            <option value="2">保護級</option>
                            <option value="3">輔導級</option>
                            <option value="4">限制級</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>片長</th>
                    <td>：<input type="text" name="length" id="length"></td>
                </tr>
                <tr>
                    <th>上映日期</th>
                    <td>：
                        <select name="year" id="year">
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>
                        <select name="month" id="month">
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                            ?>
                            <option value="<?= $i ?>" <?= ($i == date('m')) ? "selected" : "" ?>><?= $i ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <select name="day" id="day">
                            <?php
                            for ($i = 1; $i <= 31; $i++) {
                            ?>
                            <option value="<?= $i ?>" <?= ($i == date('d')) ? "selected" : "" ?>><?= $i ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>發行商</th>
                    <td>：<input type="text" name="publish" id="publish"></td>
                </tr>
                <tr>
                    <th>導演</th>
                    <td>：<input type="text" name="director" id="director"></td>
                </tr>
                <tr>
                    <th>預告影片</th>
                    <td>：<input type="file" name="trailer" id="trailer"></td>
                </tr>
                <tr>
                    <th>電影海報</th>
                    <td>：<input type="file" name="poster" id="poster"></td>
                </tr>
            </table>
        </div>
        <div>劇情簡介</div>
        <div><textarea name="intro" id="intro"></textarea></div>
    </div>
    <div class="ct"><input type="submit" value="新增"><input type="reset" value="重置"></div>
</form>