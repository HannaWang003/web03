<script>
    function login() {
        let acc = $('#acc').val();
        let pw = $('#pw').val();
        if (acc != "admin" || pw != "1234") {
            alert("帳號或密碼錯誤");
        } else {
            $.post('?do=login', {
                acc,
                pw
            }, () => {
                location.href = "back.php";
            })
        }
    }
</script>