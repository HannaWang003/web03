<style>
#items {
    width: 200px;
    height: 240px;
    margin: auto;
    overflow: hidden;
}

.item {
    display: none;
    width: 100%;
    height: 100%;
    text-align: center;
}

#control {
    width: 430px;
    height: 100px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: auto;
}

#btns {
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
    text-align: center;
    position: relative;

    img {
        width: 60px;
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

.movie {
    width: 48%;
    box-sizing: border-box;
    padding: 5px;
    margin: 2%;
    display: flex;
    flex-wrap: wrap;
}

.movie>div:nth-child(3) {
    width: 100%;
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
                <img src="./img/<?= $poster['img'] ?>" style="width:100%">
                <div><?= $poster['name'] ?></div>
            </div>
            <?php
            }
            ?>
        </div>
        <div id="control">
            <div class="left"></div>
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
            <div class="right"></div>
        </div>
    </div>
</div>
<div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;">
        <div class="movie">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="ct"> </div>
    </div>
</div>
<script>
let total = $('.item').length;
let p = 0;
let now = 0;
let next = 0;
let timer = setInterval(slide, 3000);
$('.item').eq(now).show();

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
            });
            break;
        case 2:
            $('.item').eq(now).slideUp(1000, () => {
                $('.item').eq(next).slideDown(1000)
            });
            break;
        case 3:
            $('.item').eq(now).hide(1000, () => {
                $('.item').eq(next).show(1000)
            });
            break;
    }
    now = next;
}
$('.right,.left').on('click', function() {
    let arrow = $(this).attr('class');
    switch (arrow) {
        case "left":
            if (p != 0) {
                p--;
            }
            break;
        case "right":
            if (p != total - 4) {
                p++;
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
    timer = setInterval(slide, 3000);
})
$('.btn').on('click', function() {
    let idx = $(this).index();
    slide(idx);
})
</script>