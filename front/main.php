<style>
#lists {
    width: 200px;
    height: 240px;
    margin: auto;
    overflow: hidden;
    margin-bottom: 20px;
}

.item {
    width: 100%;
    display: none;
    text-align: center;
}

#controler {
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
    position: relative;
    overflow: hidden;
}

.btn {
    width: 90px;
    height: 100px;
    text-align: center;
    position: relative;
    flex-shrink: 0;
}

.right,
.left {
    border: 20px solid #000;
    border-bottom-color: transparent;
    border-top-color: transparent;
}

.left {
    border-left: 0;
}

.right {
    border-right: 0;
}
</style>
<div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
        <div id="lists">
            <?php
            $posters = $Poster->all(['sh' => 1], "order by rank");
            foreach ($posters as $p) {
            ?>
            <div class="item" data-ani="<?= $p['ani'] ?>">
                <img src="./img/<?= $p['img'] ?>" style="width:100%">
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
                    <img src="./img/<?= $p['img'] ?>" style="width:60px">
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
let total = $('.item').length;
let now = 0;
let next = 0;
let p = 0;
$('.item').eq(now).show();
let timer = setInterval(slide, 3000);

function slide(n) {
    if (typeof(n) == "undefined") {
        next = now + 1;
        if (next == total) {
            next = 0;
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
$('#btns').hover(() => {
    clearInterval(timer)
}, () => {
    timer = setInterval(slide, 3000)
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
                p--;
            }
            break;
        case "right":
            if (p < total - 4) {
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
    <div class="rb tab" style="width:95%;display:flex;flex-wrap:wrap;">
        <?php
        $today = date("Y-m-d");
        $ago = date("Y-m-d", strtotime("-2 days"));
        $div = 4;
        $total = $Movie->count("where `sh`='1' && `ondate` between '$ago' and '$today'");
        $pages = ceil($total / $div);
        $now = ($_GET['p']) ?? 1;
        $start = ($now - 1) * $div;
        $movies = $Movie->all("where `sh`='1' && `ondate` between '$ago' and '$today' order by rank limit $start,$div");
        foreach ($movies as $m) {
        ?>
        <div
            style="width:48%;margin:1%;height:200px;background:#333;display:flex;flex-wrap:wrap;justify-content:space-evenly;">
            <div style="width:45%;margin:2%"><img src="./img/<?= $m['poster'] ?>"
                    style="width:100%;border:5px solid #fff;"></div>
            <div style="width:45%;margin:2%">
                <div><?= $m['name'] ?></div>
                <div>分級 : <br><img src="./icon/03C0<?= $m['level'] ?>.png"
                        style="width:20px;"><?= $level[$m['level']] ?>
                </div>
                <div>上映日期 :<br> <?= $m['ondate'] ?></div>
            </div>
            <div><button onclick="location.href='?do=intro&id=<?=$m['id']?>'">劇情簡介</button> | <button
                    onclick="location.href='?do=order&id=<?=$m['id']?>'">線上訂票</button></div>
        </div>
        <?php
        }
        ?>

        <div class="ct" style="width:100%;">
            <style>
            a {
                color: #fff;
            }
            </style>
            <?php
            $prev = $now - 1;
            $next = $now + 1;
            echo ($prev > 0) ? "<a href='?p=$prev'> < </a>" : "";
            for ($i = 1; $i <= $pages; $i++) {
                $style = ($i == $now) ? "font-size:25px;border-weight:bolder" : ""
            ?>
            <a href="?p=<?= $i ?>" style="<?= $style ?>"><?= $i ?></a>
            <?php
            }
            echo ($next <= $pages) ? "<a href='?p=$next'> > </a>" : "";
            ?>
        </div>
    </div>
</div>