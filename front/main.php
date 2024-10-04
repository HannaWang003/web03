<style>
    #list {
        width: 200px;
        height: 240px;
        margin: auto;
        text-align: center;

        .item {
            width: 100%;
            display: none;

            img {
                width: 100%;
            }
        }
    }

    #control {
        margin-top: 20px;
        width: 430px;
        height: 100px;
        display: flex;
        justify-content: center;
        align-items: center;

        #btns {
            width: 360px;
            height: 100px;
            display: flex;
            overflow: hidden;
            position: relative;

            .btn {
                text-align: center;
                width: 90px;
                height: 100px;
                flex-shrink: 0;
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
    }
</style>
<div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
        <div id="list">
            <?php
            $ps = $Poster->all(['sh' => 1], "order by rank");
            foreach ($ps as $p) {
            ?>
                <div class="item" data-ani="<?= $p['ani'] ?>">
                    <img src="./img/<?= $p['img'] ?>" alt="">
                    <div><?= $p['text'] ?></div>
                </div>
            <?php
            }
            ?>
        </div>
        <div id="control">
            <div class="left"></div>
            <div id="btns">
                <?php
                foreach ($ps as $p) {
                ?>
                    <div class="btn">
                        <img src="./img/<?= $p['img'] ?>" alt="">
                        <div><?= $p['text'] ?></div>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="right"></div>
        </div>
    </div>
</div>
<script>
    $('.item').eq(0).show();
    let now = 0;
    let next = 0;
    let p = 0;
    let num = $('.item').length;
    let timer = setInterval(slide, 3000);

    function slide(n) {
        if (typeof(n) == "undefined") {
            next = now + 1;
            if (next == num) {
                next = 0;
            }
        } else {
            next = n;
        }
        let ani = $('.item').eq(next).data('ani');
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
                if (p > 0) {
                    p--
                }
                break;
            case "right":
                if (p < num - 4) {
                    p++
                }
                break;
        }
        $('.btn').animate({
            right: 90 * p
        });
    })
    $('#btns').hover(() => {
        clearInterval(timer)
    }, () => {
        timer = setInterval(slide, 3000)
    })
    $('.btn').on('click', function() {
        let n = $(this).index();
        slide(n);
    })
</script>
<div class="half">
    <style>
        .vv {
            width: 48%;
            margin: 1%;
            display: flex;
            flex-wrap: wrap;
            box-sizing: border-box;
            border: 1px solid #fff;
            padding: 2px;

            >div:nth-child(1) {
                width: 48%;
                margin: 1%;

                img {
                    width: 90%;
                    border: 5px solid #333;
                }
            }

            >div:nth-child(2) {
                width: 48%;
                margin: 1%;
            }

            >div:nth-child(3) {
                width: 100%;
                display: flex;
                justify-content: space-evenly;
            }
        }
    </style>
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;display:flex;flex-wrap:wrap">
        <?php
        $div = 4;
        $today = date("Y-m-d");
        $ago = date("Y-m-d", strtotime("-2 days"));
        $num = $Movie->count("where `sh`='1' && `ondate` between '$ago' and '$today'");
        $pages = ceil($num / $div);
        $now = ($_GET['p']) ?? 1;
        $start = ($now - 1) * $div;
        $ms = $Movie->all("where `sh`='1' && `ondate` between '$ago' and '$today' order by rank limit $start,$div");
        foreach ($ms as $m) {
        ?>
            <div class="vv">
                <div><img src="./img/<?= $m['poster'] ?>"></div>
                <div>
                    <div><?= $m['name'] ?></div>
                    <div>分級 : <br><img src="./icon/03C0<?= $m['level'] ?>.png"
                            style="width:20px;"><?= $level[$m['level']] ?>
                    </div>
                    <div>上映日期 : <br><?= $m['ondate'] ?></div>
                </div>
                <div><button onclick="location.href='?do=intro&id=<?= $m['id'] ?>'">劇情介紹</button><button
                        onclick="location.href='?do=order&id=<?= $m['id'] ?>'">線上訂票</button></div>
            </div>
        <?php
        }
        ?>
        <div class="ct" style="width:100%;">
            <?php
            $today = date("Y-m-d");
            $ago = date("Y-m-d", strtotime("-1 days"));
            $now = ($_GET['p']) ?? 1;
            $div = 4;
            $page = $Movie->page($now, $div, "where `ondate` between '$ago' and '$today'");
            for ($i = 1; $i <= $page['pages']; $i++) {
                $style = ($now == $i) ? "font-size:22px;margin:10px;" : "";
            ?>
                <a href="?p=<?= $i ?>" style="color:#fff;<?= $style ?>"><?= $i ?></a>
            <?php
            }
            ?>
        </div>
    </div>
</div>