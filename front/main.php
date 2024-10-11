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
<div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;">

        <div class="ct"> </div>
    </div>
</div>