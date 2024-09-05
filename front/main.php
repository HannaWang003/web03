<style>
    #items {
        width: 200px;
        height: 240px;
        overflow: hidden;
        margin: auto;
    }

    .item {
        width: 100%;
        height: 100%;
        text-align: center;
        display: none;
    }

    .controls {
        margin-top: 20px;
        width: 430px;
        height: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #btns {
        width: 360px;
        height: 100px;
        display: flex;
        overflow: hidden;
        position: relative;

        .btn {
            width: 90px;
            height: 100px;
            flex-shrink: 0;
            text-align: center;
            position: relative;

            img {
                width: 60px;
            }
        }
    }

    .right,
    .left {
        width: 0;
        border: 20px solid #000;
        border-top-color: transparent;
        border-bottom-color: transparent;
    }

    .left {
        border-left-width: 0;
    }

    .right {
        border-right-width: 0;
    }
</style>
<div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
        <div id="items">
            <?php
            $posters = $Poster->all(['sh' => 1], "order by rank");
            foreach ($posters as $poster) {
            ?>
                <div class="item" data-ani="<?= $poster['ani'] ?>">
                    <img src="./img/<?= $poster['img'] ?>" style="width:100%">
                    <div><?= $poster['name'] ?></div>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="controls">
            <div class="left"></div>
            <div id="btns">
                <?php
                foreach ($posters as $poster) {
                ?>
                    <div class="btn">
                        <img src="./img/<?= $poster['img'] ?>">
                        <div><?= $poster['name'] ?></div>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="right"></div>
        </div>
        <script>
            $('.item').eq(0).show();
            let num = $('.item').length;
            let now = 0;
            let next = 0;
            let p = 0;
            let timer = setInterval(slide, 3000);

            function slide(n) {
                if (typeof(n) == "undefined") {
                    next = now + 1;
                    if (next == num) {
                        next = 0
                    }
                } else {
                    next = n;
                }
                let ani = $('.item').eq(next).data('ani');
                switch (ani) {
                    case 1:
                        $('.item').eq(now).fadeOut(1000, function() {
                            $('.item').eq(next).fadeIn(1000)
                        })
                        break;
                    case 2:
                        $('.item').eq(now).slideUp(1000, function() {
                            $('.item').eq(next).slideDown(1000)
                        })
                        break;
                    case 3:
                        $('.item').eq(now).hide(1000, function() {
                            $('.item').eq(next).show(1000)
                        })
                        break;

                }
                now = next;
            }
            $('#btns').hover(function() {
                clearInterval(timer)
            }, function() {
                timer = setInterval(slide, 3000)
            })
            $('.btn').on('click', function() {
                let idx = $(this).index();
                slide(idx);
            })
            $('.left,.right').on('click', function() {
                let arrow = $(this).attr('class');
                switch (arrow) {
                    case "left":
                        if (p > 0) {
                            p--;
                        }
                        break;
                    case "right":
                        if (p < num - 4) {
                            p++
                        }
                        break;
                }
                $('.btn').animate({
                    right: 90 * p,
                })
            })
        </script>
    </div>
</div>
<style>
    #movie {
        display: flex;
        flex-wrap: wrap;
        margin: auto;
    }

    .movie {
        width: 48%;
        height: 150px;
        margin: 1%;
        display: flex;
        border: 1px solid #fff;
        padding: 5px;
        box-sizing: border-box;
        flex-wrap: wrap;


        >div:nth-child(1) {
            width: 40%;

            img {
                width: 100%;
                height: 100px;
                border: 3px solid #fff;
            }
        }

        >div:nth-child(2) {
            width: 55%;
            padding: 0 10px;
            box-sizing: border-box;

            >div:nth-child(2),
            div:nth-child(3) {
                font-size: 12px;
            }

            div {
                margin: 5px 0;
            }
        }

        >div:nth-child(3) {
            width: 100%;
            text-align: center;
        }
    }
</style>
<div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;">
        <div id="movie">
            <?php
            $date = date("Y-m-d");
            $ondate = date("Y-m-d", strtotime("-2 days"));
            $total = $Movie->count("where sh='1' && ondate between '$ondate' AND '$date'");
            $div = 4;
            $pages = ceil($total / $div);
            $now = ($_GET['p']) ?? 1;
            $start = ($now - 1) * $div;
            $movies = $Movie->all("where sh='1' && ondate between '$ondate' AND '$date' order by `rank` limit $start,$div");
            foreach ($movies as $movie) {
            ?>
                <div class="movie">
                    <div><img src="./img/<?= $movie['poster'] ?>" alt=""></div>
                    <div>
                        <div><?= $movie['name'] ?></div>
                        <div>分級:<img src="./icon/03C0<?= $movie['level'] ?>.png"
                                style="width:20px" /><?= $level[$movie['level']] ?>
                        </div>
                        <div>上映日期:<br><?= $movie['ondate'] ?></div>
                    </div>
                    <div><button onclick="location.href='?do=intro&id=<?= $movie['id'] ?>'">劇情簡介</button><button
                            onclick="location.href='?do=order&id=<?= $movie['id'] ?>'">線上訂票</button></div>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="ct">
            <?php
            for ($i = 1; $i <= $pages; $i++) {
                $style = ($i == $now) ? "font-size:30px" : "";
            ?>
                <a href="?p=<?= $i ?>" style="color:#fff;<?= $style ?>"><?= $i ?></a>
            <?php
            }
            ?>
        </div>
    </div>
</div>