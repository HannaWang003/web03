<style>
#items {
    width: 200px;
    height: 240px;
    margin: auto;
    overflow: hidden;
}

.item {
    width: 100%;
    height: 100%;
    display: none;
    text-align: center;
}

#control {
    width: 420px;
    height: 100px;
    display: flex;
    align-items: center;
    margin: 10px auto;
}

.btns {
    width: 360px;
    height: 100px;
    display: flex;
    overflow: hidden;
    position: relative;
}

.btn {
    width: 90px;
    height: 100px;
    flex-shrink: 0;
    position: relative;
    text-align: center;
}

.btn img {
    width: 60px;
}

.left,
.right {
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
                <div><img src="./img/<?= $poster['img'] ?>" style="width:100%;"></div>
                <div><?= $poster['name'] ?></div>
            </div>
            <?php
            }
            ?>
        </div>
        <div id="control">
            <div class="left"></div>
            <div class="btns">
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
            <div class="right"></div>
        </div>
    </div>
</div>
<script>
let p = 0;
let now = 0;
let next = 0;
let total = $('.item').length;
let timer = setInterval(slide, 3000);
$('.item').eq(0).show();

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
            if (p < total - 4) {
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
    timer = setInterval(slide, 3000);
})
$('.btn').on('click', function() {
    let idx = $(this).index();
    slide(idx);
})
</script>
<style>
.list {
    width: 45%;
    margin: 2px;
    display: flex;
    justify-content: space-evenly;
    flex-wrap: wrap;
}

.list>div {
    width: 45%;
    padding: 2px;
    margin: 1px;
    box-sizing: border-box;
}
</style>
<?php
$today = date("Y-m-d");
$ondate = date("Y-m-d", strtotime("-2 days"));
$total = $Movie->count(" where `sh` = '1' && `ondate` between '$ondate' and '$today' ");
$div = 4;
$pages = ceil($total / $div);
$now = $_GET['p'] ?? 1;
$start = ($now - 1) * $div;
$movies = $Movie->all(" where `sh` ='1' && `ondate` between '$ondate' and '$today' ", " order by rank limit $start,$div ");

?>
<div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;">
        <div style="display:flex;flex-wrap:wrap;justify-content:space-between;margin:auto">
            <?php
            foreach ($movies as $movie) {
            ?>
            <div class="list">
                <div><img src="./img/<?= $movie['poster'] ?>" style="width:95%"></div>
                <div>
                    <div><?= $movie['name'] ?></div>
                    <div style="font-size:12px;">分級:<img src="./icon/03C0<?= $movie['level'] ?>.png"
                            style="width:25px;">
                    </div>
                    <div style="font-size:12px;">上映日期:<br><?= $movie['ondate'] ?></div>
                </div>
                <div style="width:100%"><button onclick="location.href='?do=intro&id=<?=$movie['id']?>'">劇情簡介</button>
                    <button onclick="location.href='?do=order&id=<?=$movie['id']?>'">線上訂票</button></div>
            </div>
            <?php
            }
            ?>
        </div>

        <div class="ct">
            <?php
            for ($i = 1; $i <= $pages; $i++) {
                echo "<a href='?do=main&p=$i'>$i</a>";
            }
            ?>
        </div>
    </div>
</div>