<div class="half" style="vertical-align:top;">
    <h1 class="ct">預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
        <style>
        .lists {
            width: 200px;
            height: 240px;
            overflow: hidden;
            margin: auto;
        }

        .item {
            width: 200px;
            height: 240px;
            margin: auto;
            display: none;
            text-align: center;
        }

        .item div img {
            width: 100%;
        }
        </style>
        <?php
        $posters = $Poster->all(['sh' => 1], "order by rank");
        ?>
        <div class="lists">
            <?php
            foreach ($posters as $poster) {
            ?>
            <div class="item" data-ani="<?= $poster['ani'] ?>">
                <div><img src="./img/<?= $poster['img'] ?>" alt=""></div>
                <div><?= $poster['name'] ?></div>
            </div>
            <?php
            }
            ?>
        </div>
        <style>
        .controls {
            width: 420px;
            height: 100px;
            display: flex;
            margin: auto;
            justify-content: space-between;
            align-items: center;
        }

        .left,
        .right {
            width: 0;
            border: 20px solid black;
            border-top-color: transparent;
            border-bottom-color: transparent;
        }

        .left {
            border-left-width: 0;
        }

        .right {
            border-right-width: 0;
        }

        .btns {
            width: 360px;
            height: 100px;
            display: flex;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        .btn {
            font-size: 13px;
            width: 90px;
            flex-shrink: 0;
            text-align: center;
            position: relative;
        }

        .btn div img {
            width: 60px;
        }
        </style>
        <div class="controls">
            <div class="left"></div>
            <div class="btns">
                <?php
                foreach ($posters as $poster) {
                ?>
                <div class="btn">
                    <div><img src="./img/<?= $poster['img'] ?>" alt=""></div>
                    <div><?= $poster['name'] ?></div>
                </div>
                <?php
                }
                ?>
            </div>
            <div class="right"></div>
        </div>
    </div>
    <script>
    let now = 0;
    let next = 0;
    let p = 0;
    let total = $('.item').length;
    let timer = setInterval(slide, 3000);

    function slide(n) {
        let ani = $('.item').eq(now).data('ani');
        if (typeof(n) == "undefined") {
            next = now + 1;
            if (next >= total) {
                next = 0
            }
        } else {
            next = n;
        }
        switch (ani) {
            case 1:
                $('.item').eq(now).fadeOut(1000, () => {
                    $('.item').eq(next).fadeIn(1000)
                })
                break;
            case 2:
                $('.item').eq(now).slideUp(1000, () => {
                    $('.item').eq(next).slideDown(1000)
                })
                break;
            case 3:
                $('.item').eq(now).hide(1000, () => {
                    $('.item').eq(next).show(1000)
                })
                break;
        }
        now = next;
    }
    $('.left,.right').on('click', function() {
        let arrow = $(this).attr('class');
        switch (arrow) {
            case "left":
                if (p - 1 >= 0) {
                    p--
                }
                break;
            case "right":
                if (p + 1 <= total - 4) {
                    p++
                }
                break;
        }
        $('.btn').animate({
            right: 90 * p
        });
    })
    $('.btns').hover(() => {
        clearInterval(timer);
    }, () => {
        timer = setInterval(slide, 3000)
    })
    $('.btn').on('click', function() {
        let idx = $(this).index();
        slide(idx);
    })
    </script>
</div>
<div class="half">
    <?php
    $today = date("Y-m-d");
    $ondate = date("Y-m-d", strtotime("-2 days"));
    $total = $Movie->count("where `sh`=1 && `ondate` between '$ondate' and '$today'");
    $div = 4;
    $pages = ceil($total / $div);
    $now = ($_GET['p']) ?? 1;
    $start = ($now - 1) * $div;
    $movies = $Movie->all("where `sh`=1 && `ondate` between '$ondate' and '$today'", "order by rank limit $start,$div");
    ?>
    <h1 class="ct">院線片清單</h1>
    <div class="rb tab" style="width:95%;">
        <style>
        .movies {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }

        .movie {
            width: 49%;
            padding: 5% 1%;
            margin: 0.5%;
            box-sizing: border-box;
            border: 1px solid #fff;
            border-radius: 5px;
            display: flex;
            flex-wrap: wrap;
        }
        </style>
        <div class="movies">
            <?php
            foreach ($movies as $movie) {
            ?>
            <div class="movie">
                <div style="width:33%"><img src="./img/<?= $movie['poster'] ?>"
                        style="width:100%;border:2px solid #fff">
                </div>
                <div style="width:63%;padding-left:5px;">
                    <div><?= $movie['name'] ?></div>
                    <div style="font-size:12px;">分級: <img src="./icon/03C0<?= $movie['level'] ?>.png"
                            style="width:20px">
                    </div>
                    <div style="font-size:12px;">上映日期: <?= $movie['ondate'] ?></div>
                    <div>
                        <button onclick="location.href='?do=intro&id=<?= $movie['id'] ?>'"
                            style="font-size:12px;">劇情簡介</button> <button
                            onclick="location.href='?do=order&id=<?= $movie['id'] ?>'"
                            style="font-size:12px;">線上訂購</button>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="ct">
            <?php
            for ($i = 1; $i <= $pages; $i++) {
            ?>
            <a href="?do=main&p=<?= $i ?>" style="color:#fff;text-decoration:none"><?= $i ?></a>
            <?php
            }
            ?>
        </div>
    </div>
</div>