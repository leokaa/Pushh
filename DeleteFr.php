<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>De</title>
</head>
<body>
<h1>Thuc thi</h1>
    <?php
        include_once(__DIR__.'/connect.php');
       
        $sql= <<<EOT
        SELECT httt_ma as MaTTT, httt_ten as TenTTT
        FROM hinhthucthanhtoan
EOT;
        $data = [];
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data [] = array(
                'Ma'=> $row['MaTTT'],
                'Ten'=> $row['TenTTT'],
            );
        }

    ?>
    <table border="1">
        <tr>
            <th>Mã</th>
            <th>Tên</th>
            <th>Thực thi</th>
        </tr>
        <?php   foreach($data as $tt): ?>
            <tr>
                <td> <?= $tt['Ma'] ?></td>
                <td> <?= $tt['Ten'] ?></td>
                <td>
                    <a href="Delete.php?httt_ma=<?= $tt['Ma'];?>">Xóa</a>
                   
                    <a href="UpdateSL.php?httt_ma=<?= $tt['Ma'];?>">Sửa</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</body>
</html>