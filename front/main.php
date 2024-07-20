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
    display: none;
}

#control {
    width: 430px;
    height: 100px;
    display: flex;
    margin: auto;
    justify-content: space-between;
    align-items: center;
}

#btns {
    width: 360px;
    height: 100px;
    display: flex;
    margin: auto;
    align-items: center;
    overflow: hidden;
    position: relative;
}

.btn {
    width: 90px;
    height: 100px;
    text-align: center;
    flex-shrink: 0;
    position: relative;

    img {
        width: 60px;
    }
}

.left,
.right {
    width: 0;
    border: 20px solid #999;
    border-top-color: transparent;
    border-bottom-color: transparent;
}

.left {
    border-left-width: 0
}

.right {
    border-right-width: 0
}

#movies {
    display: flex;
    flex-wrap: wrap;
}

.movie {
    width: 49%;
    box-sizing: border-box;
    border: 1px solid #fff;
    border-radius: 5px;
    margin: 5px auto;

    div {
        margin: 2px;
    }
}

.movie>div:nth-child(1) {
    display: flex;
}

.movie>div:nth-child(1)>div:nth-child(1) {
    width: 45%;
}
</style>
<div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
        <div id="items">
            <?php
            $posters = $Poster->all(['sh' => 1], "order by rank");
            foreach ($posters as $p) {
            ?>
            <div class="item" data-ani="<?= $p['ani'] ?>"><img src="./img/<?= $p['img'] ?>" style="width:100%">
                <div class="ct"><?= $p['name'] ?></div>
            </div>
            <?php
            }
            ?>

        </div>
        <br>
        <div id="control">
            <div class="left"></div>
            <div id="btns">
                <?php
                foreach ($posters as $p) {
                ?>
                <div class="btn">
                    <img src="./img/<?= $p['img'] ?>">
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
<div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;">
        <div id="movies">
            <?php
            $today = date("Y-m-d");
            $ondate = date("Y-m-d", strtotime("-2 days"));
            $total = $Movie->count(" where `sh`=1 && `ondate` between '$ondate' and '$today'");
            $div = 4;
            $pages = ceil($total / $div);
            $now = $_GET['p'] ?? 1;
            $start = ($now - 1) * $div;
            $movies = $Movie->all(" where `sh`=1 && `ondate` between '$ondate' and '$today'", "order by rank limit $start,$div");
            foreach ($movies as $m) {
            ?>
            <div class="movie">
                <div style="font-size:12px;">
                    <div><img src="./img/<?= $m['poster'] ?>" style="width:100%;"></div>
                    <div>
                        <div style="font-size:16px;"><?= $m['name'] ?></div>
                        <div>分級：<img src="./icon/03C0<?= $m['level'] ?>.png"
                                style="width:15px;"><?= $lev[$m['level']] ?></div>
                        <div>上映日期：<?= $m['ondate'] ?></div>
                    </div>
                </div>
                <div class="ct"><button onclick="location.href='?do=intro&id=<?=$m['id']?>'">劇情簡介</button> <button
                        onclick="location.href='?do=order&id=<?=$m['id']?>'">線上訂票</button></div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="ct">
        <?php
        for ($i = 1; $i <= $pages; $i++) {
        ?>
        <a href="?p=<?= $i ?>" style="text-decoration:none"><?= $i ?></a>
        <?php
        }
        ?>
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
$('.left,.right').on('click', function() {
    let arrow = $(this).attr('class');
    switch (arrow) {
        case "left":
            if (p > 0) {
                p--
            }
            break;
        case "right":
            if (p < total - 4) {
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
    let idx = $(this).index();
    slide(idx);
})
</script>