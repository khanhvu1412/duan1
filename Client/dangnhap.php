<?php
if (isset($_SESSION["user"])) {
    header("Location: index.php");
}

ob_start();
?>
<div class="wrapper">
    <div class="login">
        <h1>Đăng nhập</h1>
        <form action="index.php?act=dangnhap" method="post" class="form-login">
            <div class="form-input">
                <p>Email</p>
                <input type="text" name="email" />
            </div>
            <div class="form-input">
                <p>Mật khẩu</p>
                <input type="password" name="matkhau" />
                <?php
                ob_end_flush();
                ?>
            </div>

            <div class="login-btn">
                <input type="submit" name="dangnhap" value="Đăng nhập">
            </div>
            <div class="forget-password">
                <a href="">Quên mật khẩu?</a>
            </div>
            <div class="forget-password">
                <a href="index.php?act=dangky">Đăng ký tài khoản</a>
            </div>
        </form>
    </div>
</div>
</div>