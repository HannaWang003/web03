<?php
if (isset($_GET['id'])) {
    $se = $_GET['id'];
} else {
    $se = 0;
}
?>
<form action="" id="order">
    <table style="width:60%;margin:auto;border:1px solid #000">
        <tr>
            <th class="rb">電影:</th>
            <td width="80%">
                <select name="movie" id="movie" style="width:100%">
                    <option value="">1</option>
                    <option value="">2</option>
                </select>
            </td>
        </tr>
        <tr>
            <th class="rb">日期:</th>
            <td>
                <select name="date" id="date" style="width:100%"></select>
            </td>
        </tr>
        <tr>
            <th class="rb">場次:</th>
            <td>
                <select name="session" id="session" style="width:100%"></select>
            </td>
        </tr>
        <tr class="rb">
            <td colspan="2" style="text-align:center">
                <input type="button" value="確定" class="booking"><input type="reset" value="重置">
            </td>
        </tr>
    </table>
</form>
<div id="booking" style="display:none;">
    booking
    <div class="ct">
        <input type="button" value="上一步" class="booking"><input type="button" value="訂購" id="checkout">
    </div>
    </form>
</div>
<script>
    $('.booking').on('click', function() {
        $('#order').toggle();
        $('#booking').toggle();
    })
</script>