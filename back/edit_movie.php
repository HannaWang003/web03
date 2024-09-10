            <style>
                #editmovie {
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
            <div class="ct wx">編輯院線片</div>
            <form action="./api/edit_movie.php?do=movie" enctype="multipart/form-data"
                method="post">
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <?php
                $row = $Movie->find($_GET['id']);
                $row['year'] = explode("-", $row['ondate'])[0];
                $row['month'] = explode("-", $row['ondate'])[1];
                $row['day'] = explode("-", $row['ondate'])[2];
                ?>
                <div id="editmovie">
                    <div>影片資訊:</div>
                    <div>
                        <table style="width:100%">
                            <tr>
                                <td style="text-align-last:justify">片名</td>
                                <td><input type="text" name="name" value="<?= $row['name'] ?>"></td>
                            </tr>
                            <tr>
                                <td style="text-align-last:justify">分級</td>
                                <td><select name="level">
                                        <option value="1" <?= ($row['level'] == 1) ? "selected" : "" ?>>普通級</option>
                                        <option value="2" <?= ($row['level'] == 2) ? "selected" : "" ?>>保護級</option>
                                        <option value="3" <?= ($row['level'] == 3) ? "selected" : "" ?>>輔導級</option>
                                        <option value="4" <?= ($row['level'] == 4) ? "selected" : "" ?>>限制級</option>
                                    </select>(普通級、保護級、輔導級、限制級)</td>
                            </tr>
                            <tr>
                                <td style="text-align-last:justify">片長</td>
                                <td><input type="text" name="length" value="<?= $row['length'] ?>"></td>
                            </tr>
                            <tr>
                                <td style="text-align-last:justify">上映日期</td>
                                <td>
                                    <select name="year" value="<?= $row['year'] ?>">
                                        <option value="2024" <?= ($row['year'] == 2024) ? "selected" : "" ?>>2024
                                        </option>
                                        <option value="2025" <?= ($row['year'] == 2025) ? "selected" : "" ?>>2025
                                        </option>
                                    </select>年
                                    <select name="month" value="<?= $row['name'] ?>">
                                        <?php
                                        for ($i = 1; $i <= 12; $i++) {
                                        ?>
                                            <option value="<?= $i ?>" <?= ($row['month'] == $i) ? "selected" : "" ?>>
                                                <?= $i ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>月
                                    <select name="day" value="<?= $row['name'] ?>">
                                        <?php
                                        for ($i = 1; $i <= 31; $i++) {
                                        ?>
                                            <option value="<?= $i ?>" <?= ($row['day'] == $i) ? "selected" : "" ?>><?= $i ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>日
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align-last:justify">發行商</td>
                                <td><input type="text" name="publish" value="<?= $row['publish'] ?>"></td>
                            </tr>
                            <tr>
                                <td style="text-align-last:justify">導演</td>
                                <td><input type="text" name="director" value="<?= $row['director'] ?>"></td>
                            </tr>
                            <tr>
                                <td style="text-align-last:justify">預告影片</td>
                                <td><input type="file" name="trailer"></td>
                            </tr>
                            <tr>
                                <td style="text-align-last:justify">電影海報</td>
                                <td><input type="file" name="poster"></td>
                            </tr>
                        </table>
                    </div>
                    <div>劇情簡介:</div>
                    <div><textarea name="intro"
                            style="width:90%;margin-top:10px;height:150px;"><?= $row['intro'] ?></textarea></div>
                </div>
                <div class="ct"><input type="submit" value="修改"><input type="reset" value="重置"></div>
            </form>