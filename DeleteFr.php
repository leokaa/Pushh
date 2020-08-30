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
        SELECT httt_ma , httt_ten 
        FROM hinhthucthanhtoan
EOT;
        $data = [];
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data [] = array(
                'httt_ma'=> $row['httt_ma'],
                'httt_ten'=> $row['httt_ten'],
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
                <td> <?= $tt['httt_ma'] ?></td>
                <td> <?= $tt['httt_ten'] ?></td>
                <td>
                    <a href="Delete.php?httt_ma=<?= $tt['httt_ma'];?>">Xóa</a>
                    <a href="UpdateSL.php?httt_ma=<?= $tt['httt_ma'];?>">Sửa</a>
                   
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</body>
</html>