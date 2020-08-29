<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thuc thi</title>
</head>
<body>
    <h1>Thuc thi</h1>
    <?php

        

        $httt_ten = 'Mặt hàng trùm';
        $httt_ma = 3;
        $sql = <<<EOT
        UPDATE `hinhthucthanhtoan`
        SET
        httt_ten='$httt_ten'
        WHERE httt_ma=$httt_ma
EOT;
        mysqli_query($conn, $sql); 
    ?>
</body>
</html>
