<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ví dụ UPDATE dữ liệu với FORM</title>
</head>
<body>
    <h1>Cập nhập Hình thức Thanh toán</h1>
    <?php
    // Truy vấn database để lấy danh sách
    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
    // C:\xampp\htdocs\web02\
    include_once(__DIR__ . '/connect.php');
    // 2. Chuẩn bị QUERY
    $httt_ma = $_GET['httt_ma'];
    // HERE DOC
    $sqlSelect = <<<EOT
    SELECT httt_ma, httt_ten FROM `hinhthucthanhtoan` WHERE httt_ma = $httt_ma;
EOT;
    // 3. Yêu cầu PHP thực thi QUERY
    $resultSelect = mysqli_query($conn, $sqlSelect);
    // 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
    // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
    // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
    $htttRow = [];
    while ($row = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC)) {
        $htttRow = array(
            'httt_ma' => $row['httt_ma'],
            'httt_ten' => $row['httt_ten'],
        );
    }
    ?>
    <form name="frmHTTT" id="frmHTTT" method="post" action="">
        Tên hình thức thanh toán: <input type="text" name="httt_ten" id="httt_ten" value="<?php echo $htttRow['httt_ten'] ?>" />
        <br />
        <input type="submit" name="btnSave" id="btnSave" value="Lưu dữ liệu" />
    </form>
    <?php
    if(isset($_POST['btnSave'])) {
        // 2. Chuẩn bị QUERY
        // HERE DOC
        $httt_ten = $_POST['httt_ten'];
        $sql = <<<EOT
        UPDATE `hinhthucthanhtoan`
        SET
            httt_ten='$httt_ten'
        WHERE httt_ma=$httt_ma
EOT;
        // 3. Yêu cầu PHP thực thi QUERY
        mysqli_query($conn, $sql); 
        // Redirect (điều hướng) về trang bạn mong muốn
       
    }
    ?>
</body>
</html>