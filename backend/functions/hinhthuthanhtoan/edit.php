
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
                    
                        <table>
                            <tr>
                                <td>
                                    Sửa đổi tên hình thức
                                </td>
                                <td>
                                <form name="frmHTTT" id="frmHTTT" method="post" action="">
                                    Tên hình thức thanh toán: <input type="text" name="httt_ten" id="httt_ten" value="<?php echo $htttRow['httt_ten'] ?>" />
                                    <br />
                                    <input type="submit" name="btnSave" id="btnSave" value="Lưu dữ liệu" />
                                </form>
                                </td>
                            </tr>
                        </table>
                    
                   
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

