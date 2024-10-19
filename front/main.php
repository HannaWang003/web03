<style>
    #lists {
        width: 200px;
        height: 240px;
        margin: 10px auto;
        background: linear-gradient(#0fe2, #fff8);
        padding: 10px;
        border-radius: 2px;
    }

    .item {
        width: 100%;
        display: none;

        p {
            box-shadow: 0px 2px 5px #333;
            padding: 2px;
        }
    }

    #controls {
        width: 430px;
        height: 100px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: auto;
    }

    #btns {
        width: 360px;
        height: 100%;
        display: flex;
        position: relative;
        overflow: hidden;

        .btn {
            display: none;
            width: 90px;
            height: 100%;
            flex-shrink: 0;
            text-align: center;
            position: relative;

            img {
                width: 60px;
            }

            p {
                font-size: 13px;
            }
        }
    }

    .right,
    .left {
        width: 0;
        border: 20px solid #0fe;
        border-top-color: transparent;
        border-bottom-color: transparent;
    }

    .right {
        border-right-width: 0;
    }

    .left {
        border-left-width: 0;
    }
</style>
<div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
        <div id="lists">
            <?php
            $ps = $Poster->all(['sh' => 1], "order by rank");
            foreach ($ps as $p) {
            ?>
                <div class="item ct" data-ani="<?= $p['ani'] ?>">
                    <img src="./img/<?= $p['img'] ?>" style="width:90%;">
                    <p><?= $p['name'] ?></p>
                </div>
            <?php
            }
            ?>
        </div>
        <div id="controls">
            <div class="left"></div>
            <div id="btns">
                <?php
                foreach ($ps as $p) {
                ?>
                    <div class="btn">
                        <img src="./img/<?= $p['img'] ?>">
                        <p><?= $p['name'] ?></p>
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
    $('.item').eq(0).show(1000);
    $('.btn').slideDown(1000);
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
    $('#btns').hover(() => {
        clearInterval(timer);
    }, () => {
        timer = setInterval(slide, 3000);
    })
    $('.btn').on('click', function() {
        let idx = $(this).index();
        slide(idx);
    })
    $('.right,.left').on('click', function() {
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
</script>
<style>
    #movie {
        width: 48%;
        margin: 0.5%;
        box-sizing: border-box;
        border: 1px solid #000;
        padding: 5px;
        background: linear-gradient(#0fe2, #0002);
        display: flex;
        flex-wrap: wrap;
        border-radius: 5px;
        box-shadow: inset 0 0 10px #333;

        >div {
            margin: 0.5%;
        }

        >div:nth-child(1) {
            width: 43%;
        }

        >div:nth-child(2) {
            width: 43%;

            >div:nth-child(2) {
                font-size: 12px;
            }

            >div:nth-child(3) {
                font-size: 12px;
            }
        }
    }
</style>
<div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;display:flex;flex-wrap:wrap;">
        <?php
        $today = date("Y-m-d");
        $div = 4;
        $now = ($_GET['p']) ?? 1;
        $d = $Movie->date($today);
        $p = $Movie->page($div, $now, "where `sh`=1 && `ondate` between '2024-10-17' and '$today' ");
        $ms = $Movie->all("where `sh`=1 && `ondate` between '{$d['ago']}' and '$today' ", "order by rank limit {$p['start']},$div");
        foreach ($ms as $m) {
        ?>
            <div id="movie">
                <div><img src="./img/<?= $m['poster'] ?>" style="width:90%;border:5px solid #000;"></div>
                <div>
                    <div><?= $m['name'] ?></div>
                    <div>分級: <img src="./icon/03C0<?= $m['level'] ?>.png" style="width:20px;"><?= $level[$m['level']] ?></div>
                    <div>上映日期 : <?= $m['ondate'] ?></div>
                </div>
                <div style="width:100%"><a href="?do=intro&id=<?= $m['id'] ?>"><button>劇情簡介</button></a><a href="?do=order&id=<?= $m['id'] ?>"><button>線上訂票</button></a></div>
            </div>
        <?php
        }
        ?>

        <div class="ct" style="width:100%">
            <a href="?p=<?= $p['prev'] ?>"><button>上一頁</button></a>
            <?php
            for ($i = 1; $i <= $p['pages']; $i++) {
                $style = ($now == $i) ? "font-size:30px" : "";
            ?>
                <a href="?p=<?= $i ?>" style="<?= $style ?>"><?= $i ?></a>
            <?php
            }
            ?>
            <a href="?p=<?= $p['next'] ?>"><button>下一頁</button></a>
        </div>
    </div>
</div>