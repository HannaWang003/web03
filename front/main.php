<?php
$posters = $Poster->all(['sh' => 1], "order by rank");
?>
<style>
#lists {
    width: 430px;
    height: 240px;
    margin: auto;
    background: rgba(255, 255, 255, 0.1);
    padding: 10px;
    box-sizing: border-box;

    .item {
        margin: auto;
        width: 180px;
        text-align: center;
        display: none;
    }
}

#controls {
    width: 430px;
    height: 100px;
    display: flex;
    justify-content: center;
    align-items: center;
}

#btns {
    width: 360px;
    height: 100%;
    display: flex;
    overflow: hidden;
    position: relative;
}

.btn {
    width: 80px;
    height: 100%;
    text-align: center;
    flex-shrink: 0;
    cursor: pointer;
    padding: 10px;
    box-sizing: border-box;
    background: rgba(255, 255, 255, 0.1);
    margin: 5px;
    font-size: 12px;
    position: relative;
}

.right,
.left {
    width: 0;
    border: 20px solid #333;
    border-top-color: transparent;
    border-bottom-color: transparent;
}

.right {
    border-right-width: 0px;
}

.left {
    border-left-width: 0px;
}
</style>
<div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
        <div id="lists">
            <?php
            foreach ($posters as $p) {
            ?>
            <div class="item" data-ani="<?= $p['ani'] ?>">
                <img src="./img/<?= $p['img'] ?>" style="width:100%;">
                <div><?= $p['name'] ?></div>
            </div>
            <?php
            }
            ?>
        </div>
        <div id="controls">
            <div class="left"></div>
            <div id="btns">
                <?php
                foreach ($posters as $p) {
                ?>
                <div class="btn">
                    <img src="./img/<?= $p['img'] ?>" style="width:60px;">
                    <div><?= $p['name'] ?></div>
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
        if (next == num) {
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
        right: 90 * p
    });
})
$('#btns').hover(() => {
    clearInterval(timer);
}, () => {
    timer = setInterval(slide, 3000)
})
$('.btn').on('click', function() {
    let n = $(this).index();
    slide(n);
})
</script>
<style>
.movie {
    width: 46%;
    margin: 1%;
    border: 1px solid #333;
    border-radius: 5px;
    padding: 5px;
    box-sizing: border-box;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-bteween;
    box-shadow: inset 0 0 10px #333;
    align-items: start;

    >img {
        width: 48%;
        border: 3px solid #000;
        border-radius: 5px;
        box-shadow: 0 0 5px #333;
    }

    >div {
        width: 45%;

        div:nth-child(2),
        div:nth-child(3) {
            font-size: 12px;
        }

        button {
            min-width: 10px;
            font-size: 14px;
            padding: 5px;
            margin: 2%;
        }
    }

}
</style>
<div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;display:flex;flex-wrap:wrap;">
        <?php
        $today = date("Y-m-d");
        $ago = date("Y-m-d", strtotime("-2 days"));
        $div = 4;
        $now = ($_GET['p']) ?? 1;
        $pages = $Movie->pages($div, $now, "where `sh`='1' && `ondate` between '$ago' and '$today'");
        $movies = $Movie->all("where `sh`='1' && `ondate` between '$ago' and '$today' order by rank limit {$pages['start']},$div");
        foreach ($movies as $m) {
        ?>
        <div class="movie">
            <img src="./img/<?= $m['poster'] ?>" alt="">
            <div>
                <div><?= $m['name'] ?></div>
                <div>分級:<img src="./icon/03C0<?= $m['level'] ?>.png" style="width:15px;" /><?= $level[$m['level']] ?>
                </div>
                <div>上映日期:<br><?= $m['ondate'] ?></div>
            </div>
            <div style="width:100%;text-align:end;"><button
                    onclick="location.href='?do=intro&id=<?= $m['id'] ?>'">劇情簡介</button><button
                    onclick="location.href='?do=order&id=<?= $m['id'] ?>'">線上訂票</button></div>
        </div>
        <?php
        }
        ?>
        <div class="ct" style="width:100%">
            <?php
            for ($i = 1; $i <= $pages['pages']; $i++) {
                $style = ($i == $now) ? "font-size:30px;" : "";
            ?>
            <a href="?p=<?= $i ?>" style="color:#fff;<?= $style ?>"><?= $i ?></a>
            <?php
            }
            ?>
        </div>
    </div>
</div>