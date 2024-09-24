<style>
    #list {
        width: 200px;
        height: 240px;
        margin: 20px auto;
    }

    .item {
        width: 100%;
        display: none;
        text-align: center;

        img {
            width: 100%;
        }
    }

    #controler {
        width: 430px;
        height: 100px;
        display: flex;
        justify-content: center;
        align-items: center;

        .right,
        .left {
            border: 20px solid #333;
            border-top-color: transparent;
            border-bottom-color: transparent;
        }

        .right {
            border-right-width: 0;
        }

        .left {
            border-left-width: 0;
        }

        #btns {
            width: 360px;
            height: 100px;
            display: flex;
            overflow: hidden;
            position: relative;

            .btn {
                width: 90px;
                flex-shrink: 0;
                text-align: center;
                position: relative;

                img {
                    width: 60px;
                }
            }
        }
    }
</style>
<div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
        <div id="list">
            <?php
            $posters = $Poster->all(" where `sh`='1' order by rank");
            foreach ($posters as $p) {
            ?>
                <div class="item" data-ani="<?= $p['ani'] ?>">
                    <img src="./img/<?= $p['img'] ?>">
                    <div><?= $p['text'] ?></div>
                </div>
            <?php
            }
            ?>
        </div>
        <div id="controler">
            <div class="left"></div>
            <div id="btns">
                <?php
                foreach ($posters as $p) {
                ?>
                    <div class="btn">
                        <img src="./img/<?= $p['img'] ?>">
                        <text><?= $p['text'] ?></text>
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
    let p = 0;
    let now = 0;
    let next = 0;
    let num = $('.item').length;
    let timer = setInterval(slide, 3000);

    function slide(n) {
        if (typeof(n) == "undefined") {
            next = now + 1;
            if (next >= num) {
                next = 0
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
                    p++;
                }
                break;
        }
        $('.btn').animate({
            right: 90 * p
        });
    })
</script>
<div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;display:flex;flex-wrap:wrap">
        <?php
        $div = 4;
        $today = date("Y-m-d");
        $ago = date("Y-m-d", strtotime("-2 days"));
        $total = $Movie->count("where `sh`='1' && `ondate` between '$ago' and '$today'");
        $pages = ceil($total / $div);
        $now = ($_GET['p']) ?? "1";
        $start = ($now - 1) * $div;
        $movies = $Movie->all("where `sh`='1' && `ondate` between '$ago' and '$today' order by rank limit $start,$div");
        foreach ($movies as $m) {
        ?>
            <div
                style="width:48%;margin:1%;box-sizing:border-box;padding:10px 5px;display:flex;flex-wrap:wrap;border:1px solid #aaa;">
                <div style="width:48%;margin:1%;"><img src="./img/<?= $m['poster'] ?>"
                        style="width:90%;border:3px solid #fff;"></div>
                <div style="width:48%;margin:1%;font-size:14px;">
                    <div><?= $m['movie'] ?></div>
                    <div>分𥾵: <img src="./icon/03C0<?= $m['level'] ?>.png" style="width:20px;"><?= $level[$m['level']] ?>
                    </div>
                    <div>上映日期: <?= $m['ondate'] ?></div>
                </div>
                <div style="width:100%;"><button onclick="location.href='?do=intro&id=<?= $m['id'] ?>'">劇情簡介</button> <button
                        onclick="location.href='?do=order&id=<?= $m['id'] ?>'">線上訂票</button></div>
            </div>
        <?php
        }
        ?>

        <div class="ct" style="width:100%;">
            <?php
            $prev = $now - 1;
            $next = $now + 1;
            echo ($prev > 0) ? "<a href='?p=$prev'> < </a>" : "";
            for ($i = 1; $i <= $pages; $i++) {
                $style = ($i == $now) ? "font-size:20px;color:#fff" : "";
                echo "<a href='?p=$i' style='padding:5px 10px;$style'>$i</a>";
            }
            echo ($next <= $pages) ? "<a href='?p=$next'> > </a>" : "";
            ?>
        </div>
    </div>
</div>