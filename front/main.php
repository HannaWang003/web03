<style>
#lists {
    width: 200px;
    height: 240px;
    margin: auto;
    overflow: hidden;
}

.item {
    width: 100%;
    height: 100%;
    text-align: center;
    display: none;

    img {
        width: 100%;
    }
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
                <img src="./img/<?= $p['img'] ?>" alt="">
                <div><?= $p['text'] ?></div>
            </div>
            <?php
            }
            ?>
        </div>
        <style>
        #controler {
            width: 430px;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .left,
        .right {
            width: 0px;
            border: 20px solid #000;
            border-top-color: transparent;
            border-bottom-color: transparent
        }

        .left {
            border-left: 0px;
        }

        .right {
            border-right: 0px;
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
            flex-shrink: 0;
            text-align: center;
            position: relative;

            img {
                width: 60px;
            }
        }
        </style>
        <div id="controler">
            <div class="left"></div>
            <div id="btns">
                <?php
                foreach ($posters as $p) {
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
let total = $('.item').length;
let now = 0;
let next = 0;
let timer = setInterval(slide, 3000);
let p = 0;

function slide(n) {
    if (typeof(n) == "undefined") {
        next = now + 1
        if (next == total) {
            next = 0
        }
    } else {
        next = n
    }
    let ani = $('.item').eq(next).data('ani')
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
$('.right,.left').on('click', function() {
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
            break
    }
    $('.btn').animate({
        right: 90 * p
    });
})
$('#btns').hover(function() {
    clearInterval(timer)
}, function() {
    timer = setInterval(slide, 3000)
})
$('.btn').on('click', function() {
    let idx = $(this).index();
    slide(idx)
})
</script>
<div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;">

        <div class="ct"> </div>
    </div>
</div>