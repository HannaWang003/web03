    <?php
    $m = $Movie->find($_GET['id']);
    ?>
    <div class="tab rb" style="width:87%;">
        <div style="background:#FFF; width:100%; color:#333; text-align:left">
            <video src="./img/<?= $m['trailer'] ?>" width="300px" height="250px" controls=""
                style="float:right;"></video>
            <font style="font-size:24px">
                <img src="./img/<?= $m['poster'] ?>" width="200px" height="250px" style="margin:10px; float:left">
                <div class="ct"><input type="button" value="線上訂票"
                        onclick="location.href='?do=order&id=<?= $_GET['id'] ?>'"
                        style="margin-left:50px; padding:10px 20px;font-size:18px" class="b2_btu"></div>
                <p style="margin:3px">影片名稱 ：<?= $m['name'] ?>
                </p>
                <p style="margin:3px">影片分級 ： <img src="./icon/03C0<?= $m['level'] ?>.png"
                        style="display:inline-block;"><?= $lev[$m['level']] ?>
                </p>
                <p style="margin:3px">影片片長 ： <?= $m['length'] ?></p>
                <p style="margin:3px">上映日期 <?= $m['ondate'] ?></p>
                <p style="margin:3px">發行商 ： <?= $m['publish'] ?></p>
                <p style="margin:3px">導演 ： <?= $m['director'] ?></p>
                <br>
                <br>
                <p style="margin:10px 3px 3px 3px; word-break:break-all"> 劇情簡介：<br>
                    <?= $m['intro'] ?>
                </p>
            </font>
            <table width="100%" border="0">
                <tbody>
                    <tr>
                        <td align="center"><input type="button" value="院線片清單" onclick="location.href='index.php'"
                                style=" padding:10px 20px;font-size:18px"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>