<style>
    #lists {
        width: 200px;
        height: 240px;
        margin: 10px auto;
        background: #0fe2;
        padding: 10px;
    }

    .item {
        width: 100%;
        display: none;
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
<div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;">
        <table>
            <tbody>
                <tr> </tr>
            </tbody>
        </table>
        <div class="ct"> </div>
    </div>
</div>