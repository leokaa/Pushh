<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>COOKIE - GIAO DIỆN</title>
    <style>
        .theme-light {
            background: #fff;
            color: #000;
        }
        .theme-dark {
            background: #000;
            color: yellow;
        }
    </style>

    <?php
    // Mặc định giao diện là Theme nền sáng
    $theme_class = 'theme-dark';
    // Kiểm tra xem Người dùng có cấu hình giao diện theo ý thích không?
    if (isset($_COOKIE['theme_class'])) {
        // Lấy thông tin từ COOKIE từ Web Browser của client gởi đến
        $theme_class = isset($_COOKIE['theme_class']) ? $_COOKIE['theme_class'] : 'theme-light';
        echo '<script>setTimeout(function(){ window.location="/" }, 5000);</script>';

    }
    ?>
</head>
<body class="<?= $theme_class ?>">

    <!-- Form Select -->
    <form name="frmLogin" method="post" action="">
        <label><input type="radio" name="theme" id="theme-1" value="theme-light" checked />Giao diện nền Sáng</label><br />
        <label><input type="radio" name="theme" id="theme-2" value="theme-dark" />Giao diện nền Tối</label><br />
        <input type="submit" name="btnSave" value="Lưu" />
    </form>
    <?php
    // Xử lý nếu người dùng có bấm nút "btnSave"
    if (isset($_POST['btnSave'])) {
        // Lấy thông tin người dùng gởi đến Server
        $theme = $_POST['theme'];
        // Xử lý các logic/Nghiệp vụ ...
        // Thiết lập Cookie "theme_class" trong 15' ~ 3600s
        setcookie('theme_class', $theme, time() + 3, '/');
        // Hiển thị thông tin chào mừng
        echo "<h2>Cấu hình đã được lưu!</h2>";
    }
    ?>
</body>
</html>