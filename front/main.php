<style>
    #items {
        width: 200px;
        height: 240px;
        margin: auto;
        overflow: hidden;
    }

    .item {
        text-align: center;
        width: 100%;
        height: 100%;
        display: none;

        img {
            width: 100%;
        }
    }

    #control {
        width: 430px;
        height: 100px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;

    }

    #left,
    #right {
        width: 0;
        border: 20px solid #000;
        border-top-color: transparent;
        border-bottom-color: transparent;
    }

    #left {
        border-left-width: 0;
    }

    #right {
        border-right-width: 0;
    }

    #btns {
        width: 360px;
        height: 100px;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .btn {
        position: relative;
        width: 90px;
        height: 100px;
        flex-shrink: 0;
        text-align: center;

        img {
            width: 60px;
        }
    }
</style>
<div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <div class="rb tab" style="width:95%;height:380px;overflow:hidden;">
        <div id="items">
            <?php
            $posters = $Poster->all(['sh' => 1], "order by rank");
            foreach ($posters as $poster) {
            ?>
                <div class="item" data-ani="<?= $poster['ani'] ?>">
                    <img src="./img/<?= $poster['img'] ?>" alt="">
                    <div><?= $poster['name'] ?></div>
                </div>
            <?php
            }
            ?>
        </div>
        <br>
        <div id="control">
            <div id="left"></div>
            <div id="btns">
                <?php
                foreach ($posters as $poster) {
                ?>
                    <div class="btn">
                        <img src="./img/<?= $poster['img'] ?>" alt="">
                        <div><?= $poster['name'] ?></div>
                    </div>
                <?php
                }
                ?>
            </div>
            <div id="right"></div>
        </div>
    </div>
</div>
<style>
    #movie {
        display: flex;
        flex-wrap: wrap;

    }

    .half a {
        display: inline-block;
        margin: 5px;
        padding: 5px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 1px solid #fff;
        text-decoration: none;
        color: #fff;
    }

    #movie>div {
        width: 48%;
        box-sizing: border-box;
        border: 1px solid #fff;
        border-radius: 10px;
        padding: 5px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: 2px;
    }

    #movie>div>div:nth-child(1) {
        width: 50%;
        box-sizing: border-box;
        padding: 5px;

        img {
            width: 100%;
        }
    }

    #movie>div>div:nth-child(2) {
        width: 50%;
        box-sizing: border-box;
        padding: 5px;
    }

    #movie>div>div:nth-child(3) {
        width: 100%;
        text-align: end;

        button {
            width: fit-content;
            font-size: 14px;
            padding: 5px 10px;
        }
    }
</style>
<div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;height:380px;overflow:hidden;">
        <div id="movie">
            <?php
            $today = date("Y-m-d");
            $ondate = date("Y-m-d", strtotime("-2 days"));
            $div = 4;
            $total = $Movie->count(" where `sh`=1 && `ondate` between '$ondate' and '$today' ");
            $pages = ceil($total / $div);
            $now = $_GET['p'] ?? 1;
            $start = ($now - 1) * $div;
            $movies = $Movie->all(" where `sh`=1 && `ondate` between '$ondate' and '$today' ", "order by rank limit $start,$div");
            foreach ($movies as $movie) {
            ?>
                <div>
                    <div><img src="./img/<?= $movie['poster'] ?>" alt=""></div>
                    <div>
                        <div><?= $movie['name'] ?></div>
                        <div style="font-size:12px;">分級：<img src="./icon/03C0<?= $movie['level'] ?>.png" style="width:15px;"><?= $level[$movie['level']] ?></div>
                        <div style="font-size:12px;">上映日期：<?= $movie['ondate'] ?></div>
                    </div>
                    <div><button onclick="location.href='?do=intro&id=<?= $movie['id'] ?>'">劇情簡介</button> <button onclick="location.href='?do=order&id=<?= $movie['id'] ?>'">線上訂票</button></div>
                </div>
            <?php
            }
            ?>

        </div>
        <div class="ct">
            <?php
            for ($i = 1; $i <= $pages; $i++) {
                $style = ($i == $now) ? "style='background:black;'" : "";
                echo "<a href='?p=$i' $style>$i</a> ";
            }
            ?>
        </div>
    </div>
</div>
<script>
    $('.item').eq(0).show();
    let p = 0;
    let now = 0;
    let next = 0;
    let total = $('.item').length;
    let timer = setInterval(slide, 3000);

    function slide(n) {
        if (typeof(n) == "undefined") {
            next = now + 1;
            if (next >= total) {
                next = 0;
            }
        } else {
            next = n;
        }
        let ani = $('.item').eq(next).data('ani');
        switch (ani) {
            case 1:
                $('.item').eq(now).fadeOut(1000, () => {
                    $('.item').eq(next).fadeIn(1000);
                })
                break;
            case 2:
                $('.item').eq(now).slideUp(1000, () => {
                    $('.item').eq(next).slideDown(1000);
                })
                break;
            case 3:
                $('.item').eq(now).hide(1000, () => {
                    $('.item').eq(next).show(1000);
                })
                break;
        }
        now = next;
    }
    $('#btns').hover(() => {
        clearInterval(timer);
    }, () => {
        timer = setInterval(slide, 3000);
    })
    $('.btn').on('click', function() {
        let idx = $(this).index();
        slide(idx);
    })
    $('#left,#right').on('click', function() {
        let arrow = $(this).attr('id');
        switch (arrow) {
            case "left":
                if (p > 0) {
                    p--
                }
                break;
            case "right":
                if (p < total - 4) {
                    p++;
                }
                break
        }
        $('.btn').animate({
            right: 90 * p
        });
    })
</script>