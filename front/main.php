<div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
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
        text-align: center;
        display: none;
    }

    .item img {
        width: 100%;
    }

    .control {
        width: 420px;
        height: 100px;
        margin: auto;
        display: flex;
        align-items: center;
    }

    .btns {
        width: 360px;
        height: 100px;
        display: flex;
        overflow: hidden;
    }

    .btn {
        text-align: center;
        flex-shrink: 0;
        width: 90px;
        height: 100px;
        position: relative;
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
    <div class="rb tab" style="width:95%;">
        <div class="lists">
            <?php
            $posters = $Poster->all(['sh' => 1], "order by rank");
            foreach ($posters as $poster) {
            ?>
            <div class="item" data-ani="<?= $poster['ani'] ?>">
                <div>
                    <img src="./img/<?= $poster['img'] ?>">
                    <div><?= $poster['name'] ?></div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
        <br>
        <div class="control">
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
</div>
<script>
let p = 0
let now = 0;
let next = 0;
let total = $('.item').length;
let timer = setInterval(slide, 3000);

function slide(n) {
    if (typeof(n) == "undefined") {
        next = now + 1;
        if (next >= total) {
            next = 0
        }
    } else {
        next = n
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
    timer = setInterval(slide, 3000)
})
$('.btn').on('click', function() {
    let n = $(this).index();
    slide(n);
})
</script>
<div class="half">
    <?php
    $today = date("Y-m-d");
    $ondate = date("Y-m-d", strtotime("-2 days"));
    $total = $Movie->count("where `sh`='1' && `ondate` between '$ondate' and '$today'");
    $div = 4;
    $pages = ceil($total / $div);
    $now = $_GET['p'] ?? 1;
    $start = ($now - 1) * $div;
    $movies = $Movie->all("where `sh`='1' && `ondate` between '$ondate' and '$today'", "order by rank limit $start,$div");
    ?>
    <h1>院線片清單</h1>
    <style>
    .movies {
        display: flex;
        flex-wrap: wrap;
        margin: auto;
    }

    .movie {
        box-sizing: border-box;
        padding: 10px;
        margin: 1px;
        border: 1px solid #fff;
        width: 49%;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
    </style>
    <div class="rb tab" style="width:95%;height:300px;">
        <div class="movies">
            <?php
            foreach ($movies as $m) {
            ?>

            <div class="movie">
                <div style="width:30%;"><img src="./img/<?= $m['poster'] ?>" style="width:100%;border:3px solid #fff;">
                </div>
                <div style="width:70%;padding-left:10px;box-sizing:border-box;">
                    <div><?= $m['name'] ?></div>
                    <div style="font-size:12px;">分級: <img src="./icon/03C0<?= $m['level'] ?>.png" style="width:20px">
                    </div>
                    <div style="font-size:12px;">上映日期: <?= $m['ondate'] ?></div>
                </div>
                <div style="width:100%;margin:5px 0;">
                    <button onclick="location.href='?do=intro&id=<?= $m['id'] ?>'">劇情簡介</button> <button
                        onclick="location.href='?do=order&id=<?= $m['id'] ?>'">線上訂票</button>
                </div>
            </div> <?php
                    }
                        ?>

        </div>
    </div>
    <div class="ct">
        <?php
        for ($i = 1; $i <= $pages; $i++) {
            $active = ($i == $now) ? "color:red;font-size:18px;" : "";
        ?>
        <a href="?do=main&p=<?= $i ?>" style="text-decoration:none;<?= $active ?>"><?= $i ?></a>
        <?php
        }
        ?>
    </div>
</div>
</div>