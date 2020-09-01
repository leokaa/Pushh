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
   
    include_once(__DIR__.'/../../../connect.php');
    $httt_ma = $_GET['httt_ma'];
    $sqlSelect = <<<EOT
    SELECT httt_ma, httt_ten FROM `hinhthucthanhtoan` WHERE httt_ma = $httt_ma;
EOT;
    $result = mysqli_query($conn, $sqlSelect);
    
    $htttRow = [];
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
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
       
        $httt_ten = $_POST['httt_ten'];
        $sql = <<<EOT
        UPDATE `hinhthucthanhtoan`
        SET
            httt_ten='$httt_ten'
        WHERE httt_ma=$httt_ma
EOT;
        mysqli_query($conn, $sql); 
       
    }
    ?>
</body>
</html>

