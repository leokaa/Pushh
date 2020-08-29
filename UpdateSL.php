<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
        include_once(__DIR__.'/connect.php');
        $httt_ma = $_GET['httt_ma'];
        $sql= <<<EOT
        SELECT httt_ma, httt_ten 
        FROM hinhthucthanhtoan
        where httt_ma=$httt_ma;
EOT;

        $resultSelect = mysqli_query($conn, $sql);

        $htttRow = [];
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $htttRow  = array(
                'httt_ma'=> $row['httt_ma'],
                'httt_ten'=> $row['httt_ten'],
            );
        }
    ?>

    <from>
        <h1>Dữ liệu muốn sửa</h1>
        Tên hình thức thanh toán: <input type="text" name="httt_ten" id="httt_ten" value="<?php echo $htttRow['httt_ten'] ?>" />
        <input type="submit" name="sbThucThi" id="sbThucThi" value="Thực thi sửa"/>
    </from>

    <?php
         if(isset($_POST['sbThucThi'])) {
            // 2. Chuẩn bị QUERY
            // HERE DOC
            $httt_ten = $_POST['httt_ten'];
            $sqls = <<<EOT
            UPDATE `hinhthucthanhtoan`
            SET
            httt_ten='$httt_ten'
            WHERE httt_ma=$httt_ma
EOT;
            mysqli_query($conn, $sqls); 
         }   // 3. Yêu cầu PHP thực thi QUERY
    ?>
</body>
</html>