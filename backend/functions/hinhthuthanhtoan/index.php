
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <?php
         include_once( __DIR__ . '/../../layouts/style.php');
    ?>
</head>
<body>
    <!-- Phần header -->
        <?php
        include_once( __DIR__ . '/../../layouts/partials/header.php');
        ?> 
    <!-- header -->


    <!-- Phần sidebar -->
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <!-- Phần sidebar -->
                        <?php
                            include_once( __DIR__ . '/../../layouts/partials/sidebar.php');
                        ?> 
                    <!-- Phần sidebar -->
                </div>
                <div class="col-md-8">
                   <h3>Danh sách hình</h3>
                        <?php
                            include_once(__DIR__.'/../../../connect.php');
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
                        <button type="button" class="btn btn-info">                        
                            <a href="create.php">Thêm dữ liệu</a>
                        </button>

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
                                        <a href="delete.php?httt_ma=<?= $tt['httt_ma'];?>">Xóa</a>
                                        <a href="edit.php?httt_ma=<?= $tt['httt_ma'];?>">sửa</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                </div>
            </div>
        </div>
                    <!-- sidebar -->
                
    
    <!-- Phần footer -->
   <?php
        include_once( __DIR__ . '/../../layouts/partials/footer.php');
    ?> 
    <!-- header -->
    
  


    <?php
         include_once( __DIR__ . '/../../layouts/js.php');
    ?>
</body>
</html>