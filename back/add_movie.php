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
}
            </style>
            <div id="addmovie">
                <div>影片資訊:</div>
                <div>
                    <table style="background:#999;">
                        <tr>
                            <td style="text-align-last:justify">片名</td>
                            <td><input type="text" name="name" id=""></td>
                        </tr>
                        <tr>
                            <td style="text-align-last:justify">分級</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="text-align-last:justify">片長</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="text-align-last:justify">上映日期</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="text-align-last:justify">發行商</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="text-align-last:justify">導演</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="text-align-last:justify">預告影片</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="text-align-last:justify">電影海報</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <div>劇情簡介:</div>
                <div><textarea name="intro" id=""></textarea></div>
            </div>